<?php

namespace Tests\Feature\Auth;

use App\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class ResetPasswordTest
 *
 * @package Tests\Feature\Auth
 */
class ResetPasswordTest extends TestCase
{
    use RefreshDatabase;


    /**
     * Map the valid user token to a method.
     *
     * @param  User $user The storage entity for the given authentication user.
     * @return string
     */
    protected function getValidToken($user): string
    {
        return Password::broker()->createToken($user);
    }

    /**
     * Map the invalid user token to a method.
     *
     * @return string
     */
    protected function getInvalidToken(): string
    {
        return 'invalid-token';
    }

    /**
     * Map the reset password route to a method.
     *
     * @param  string $token The generated password token from the password broker.
     * @return string
     */
    protected function passwordResetGetRoute($token): string
    {
        return route('password.reset', $token);
    }

    /**
     * Map the password reset POST route to a method.
     *
     * @return string
     */
    protected function passwordResetPostRoute(): string
    {
        return '/password/reset';
    }

    /**
     * Map the password reset route (when successful) to a method.
     *
     * @return string
     */
    protected function successfulPasswordResetRoute(): string
    {
        return route('home');
    }

    /**
     * Map the guest middelware route to a method.
     *
     * @return string
     */
    protected function guestMiddlewareRoute(): string
    {
        return route('home');
    }

    /**
     * @testdox User can view password reset form
     */
    public function testUserCanViewAPasswordResetForm(): void
    {
        $user = factory(User::class)->create();
        $response = $this->get($this->passwordResetGetRoute($token = $this->getValidToken($user)));
        $response->assertSuccessful();
        $response->assertViewIs('auth.passwords.reset');
        $response->assertViewHas('token', $token);
    }

    /**
     * @testdox User cannot view password reset form when authenticated
     */
    public function testUserCannotViewAPasswordResetFormWhenAuthenticated(): void
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get($this->passwordResetGetRoute($this->getValidToken($user)));
        $response->assertRedirect($this->guestMiddlewareRoute());
    }

    /**
     * @testdox User can reset password with valid token
     */
    public function testUserCanResetPasswordWithValidToken(): void
    {
        Event::fake();
        $user = factory(User::class)->create();

        $response = $this->post($this->passwordResetPostRoute(), [
            'token' => $this->getValidToken($user),
            'email' => $user->email,
            'password' => 'new-awesome-password',
            'password_confirmation' => 'new-awesome-password',
        ]);

        $response->assertRedirect($this->successfulPasswordResetRoute());

        $this->assertEquals($user->email, $user->fresh()->email);
        $this->assertTrue(Hash::check('new-awesome-password', $user->fresh()->password));
        $this->assertAuthenticatedAs($user);

        Event::assertDispatched(PasswordReset::class, static function (PasswordReset $event) use ($user): bool {
            return $event->user->id === $user->id;
        });
    }

    /**
     * @testdox User cannot reset password with invalid token.
     */
    public function testUserCannotResetPasswordWithInvalidToken(): void
    {
        $user = factory(User::class)->create(['password' => Hash::make('old-password')]);

        $response = $this->from($this->passwordResetGetRoute($this->getInvalidToken()))->post($this->passwordResetPostRoute(), [
            'token' => $this->getInvalidToken(),
            'email' => $user->email,
            'password' => 'new-awesome-password',
            'password_confirmation' => 'new-awesome-password',
        ]);

        $response->assertRedirect($this->passwordResetGetRoute($this->getInvalidToken()));

        $this->assertEquals($user->email, $user->fresh()->email);
        $this->assertTrue(Hash::check('old-password', $user->fresh()->password));
        $this->assertGuest();
    }

    /**
     * @testdox User cannot reset password without providing a new password.
     */
    public function testUserCannotResetPasswordWithoutProvidingANewPassword(): void
    {
        $user = factory(User::class)->create(['password' => Hash::make('old-password')]);

        $response = $this->from($this->passwordResetGetRoute($token = $this->getValidToken($user)))->post($this->passwordResetPostRoute(), [
            'token' => $token,
            'email' => $user->email,
            'password' => '',
            'password_confirmation' => '',
        ]);

        $response->assertRedirect($this->passwordResetGetRoute($token));
        $response->assertSessionHasErrors('password');

        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertEquals($user->email, $user->fresh()->email);
        $this->assertTrue(Hash::check('old-password', $user->fresh()->password));
        $this->assertGuest();
    }

    /**
     * @testdox User cannot reset password without providing an email
     */
    public function testUserCannotResetPasswordWithoutProvidingAnEmail(): void
    {
        $user = factory(User::class)->create(['password' => Hash::make('old-password')]);

        $response = $this->from($this->passwordResetGetRoute($token = $this->getValidToken($user)))->post($this->passwordResetPostRoute(), [
            'token' => $token,
            'email' => '',
            'password' => 'new-awesome-password',
            'password_confirmation' => 'new-awesome-password',
        ]);

        $response->assertRedirect($this->passwordResetGetRoute($token));
        $response->assertSessionHasErrors('email');

        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertEquals($user->email, $user->fresh()->email);
        $this->assertTrue(Hash::check('old-password', $user->fresh()->password));
        $this->assertGuest();
    }
}
