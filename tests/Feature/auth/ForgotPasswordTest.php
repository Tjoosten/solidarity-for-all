<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

/**
 * Class ForgotPasswordTest
 *
 * @package Tests\Feature\Auth
 */
class ForgotPasswordTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Bind the password request route to a method.
     *
     * @return string
     */
    protected function passwordRequestRoute(): string
    {
        return route('password.request');
    }

    /**
     * Bind the email GET route to a method.
     *
     * @return string
     */
    protected function passwordEmailGetRoute(): string
    {
        return route('password.email');
    }

    /**
     * Bind the password email route to a method.
     *
     * @return string
     */
    protected function passwordEmailPostRoute(): string
    {
        return route('password.email');
    }

    /**
     * Bind the guest middelware route to a method.
     *
     * @return string
     */
    protected function guestMiddlewareRoute(): string
    {
        return route('home');
    }

    /**
     * @testdox User can view an email password form
     */
    public function testUserCanViewAnEmailPasswordForm(): void
    {
        $response = $this->get($this->passwordRequestRoute());
        $response->assertSuccessful();
        $response->assertViewIs('auth.passwords.email');
    }

    /**
     * @testdox User cannot view an email password form when authenticated
     */
    public function testUserCannotViewAnEmailPasswordFormWhenAuthenticated(): void
    {
        $user = factory(User::class)->make();
        $response = $this->actingAs($user)->get($this->passwordRequestRoute());
        $response->assertRedirect($this->guestMiddlewareRoute());
    }

    /**
     * @testdox User receive an email with a password reset link
     */
    public function testUserReceivesAnEmailWithAPasswordResetLink(): void
    {
        Notification::fake();

        $user = factory(User::class)->create(['email' => 'john@example.com']);

        $this->post($this->passwordEmailPostRoute(), ['email' => 'john@example.com']);
        $this->assertNotNull($token = DB::table('password_resets')->first());

        Notification::assertSentTo($user, ResetPassword::class, static function ($notification, $channels) use ($token): bool {
            return Hash::check($notification->token, $token->token) === true;
        });
    }

    /**
     * @testdox User does not receive email when not registered
     */
    public function testUserDoesNotReceiveEmailWhenNotRegistered(): void
    {
        Notification::fake();

        $fields = ['email' => 'nobody@example.com'];

        $response = $this->from($this->passwordEmailGetRoute())->post($this->passwordEmailPostRoute(), $fields);
        $response->assertRedirect($this->passwordEmailGetRoute());
        $response->assertSessionHasErrors('email');

        Notification::assertNotSentTo(factory(User::class)->make(['email' => 'nobody@example.com']), ResetPassword::class);
    }

    /**
     * @testdox Email is required
     */
    public function testEmailIsRequired(): void
    {
        $response = $this->from($this->passwordEmailGetRoute())->post($this->passwordEmailPostRoute(), []);
        $response->assertRedirect($this->passwordEmailGetRoute());
        $response->assertSessionHasErrors('email');
    }

    /**
     * @testdox Email is a valid email
     */
    public function testEmailIsAValidEmail(): void
    {
        $response = $this->from($this->passwordEmailGetRoute())->post($this->passwordEmailPostRoute(), ['email' => 'invalid-email']);
        $response->assertRedirect($this->passwordEmailGetRoute());
        $response->assertSessionHasErrors('email');
    }
}
