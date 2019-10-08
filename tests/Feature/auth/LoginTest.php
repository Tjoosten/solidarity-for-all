<?php

namespace Tests\Feature\Auth;

use App\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class LoginTest
 *
 * @package Tests\Feature\Auth
 */
class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Map the home route to a method.
     *
     * @return string
     */
    protected function successfulLoginRoute(): string
    {
        return route('home');
    }

    /**
     * Map the login method to a route
     *
     * @return string
     */
    protected function loginGetRoute(): string
    {
        return route('login');
    }

    /**
     * Map the login POST route to a method.
     *
     * @return string
     */
    protected function loginPostRoute(): string
    {
        return route('login');
    }

    /**
     * Map the logout route to a method.
     *
     * @return string
     */
    protected function logoutRoute(): string
    {
        return route('logout');
    }

    /**
     * Map route after logout to a method.
     *
     * @return string
     */
    protected function successfulLogoutRoute(): string
    {
        return '/';
    }

    /**
     * Add the dashboard route to a method.
     *
     * @return string
     */
    protected function guestMiddlewareRoute(): string
    {
        return route('home');
    }

    /**
     * Too many logins trottling message
     *
     * @return string
     */
    protected function getTooManyLoginAttemptsMessage(): string
    {
        return sprintf('/^%s$/', str_replace('\:seconds', '\d+', preg_quote(__('auth.throttle'), '/')));
    }

    /**
     * @testdox User can view a login form
     */
    public function testUserCanViewALoginForm(): void
    {
        $response = $this->get($this->loginGetRoute());
        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
    }

    /**
     * @testdox user cannot view a login form when authenticated
     */
    public function testUserCannotViewALoginFormWhenAuthenticated(): void
    {
        $user = factory(User::class)->make();
        $response = $this->actingAs($user)->get($this->loginGetRoute());
        $response->assertRedirect($this->guestMiddlewareRoute());
    }

    /**
     * @testdox User can login with correct credentials
     */
    public function testUserCanLoginWithCorrectCredentials(): void
    {
        $user = factory(User::class)->create(['password' => $password = 'i-love-laravel',]);

        $response = $this->post($this->loginPostRoute(), ['email' => $user->email, 'password' => $password]);
        $response->assertRedirect($this->successfulLoginRoute());

        $this->assertAuthenticatedAs($user);
    }

    /**
     * @tesdox Remember me functionality
     * @throws \Exception
     */
    public function testRememberMeFunctionality(): void
    {
        $user = factory(User::class)->create(['id' => random_int(1, 100), 'password' => $password = 'i-love-laravel']);

        $response = $this->post($this->loginPostRoute(), ['email' => $user->email, 'password' => $password, 'remember' => 'on']);

        $user = $user->fresh();

        $response->assertRedirect($this->successfulLoginRoute());
        $response->assertCookie(Auth::guard()->getRecallerName(), vsprintf('%s|%s|%s', [$user->id, $user->getRememberToken(), $user->password]));

        $this->assertAuthenticatedAs($user);
    }

    /**
     * @testdox User cannot login with incorrect password
     */
    public function testUserCannotLoginWithIncorrectPassword(): void
    {
        $user = factory(User::class)->create(['password' => Hash::make('i-love-laravel')]);
        $fields = ['email' => $user->email, 'password' => 'invalid-password'];

        $response = $this->from($this->loginGetRoute())->post($this->loginPostRoute(), $fields);
        $response->assertRedirect($this->loginGetRoute());
        $response->assertSessionHasErrors('email');

        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

    /**
     * @testdox User cannot login with email that doesn't exist
     */
    public function testUserCannotLoginWithEmailThatDoesNotExist(): void
    {
        $fields = ['email' => 'nobody@example.com', 'password' => 'invalid-password'];

        $response = $this->from($this->loginGetRoute())->post($this->loginPostRoute(), $fields);
        $response->assertRedirect($this->loginGetRoute());
        $response->assertSessionHasErrors('email');

        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

    /**
     * @testdox ser can logout
     */
    public function testUserCanLogout(): void
    {
        $this->be(factory(User::class)->create());
        $response = $this->post($this->logoutRoute());
        $response->assertRedirect($this->successfulLogoutRoute());
        $this->assertGuest();
    }

    /**
     * @testdox User cannot logout when not authenticated
     */
    public function testUserCannotLogoutWhenNotAuthenticated(): void
    {
        $response = $this->post($this->logoutRoute());
        $response->assertRedirect($this->successfulLogoutRoute());

        $this->assertGuest();
    }

    /**
     * @testdox User cannot more than five attempt in one minute
     */
    public function testUserCannotMakeMoreThanFiveAttemptsInOneMinute(): void
    {
        $user = factory(User::class)->create(['password' => Hash::make($password = 'i-love-laravel')]);

        foreach (range(0, 5) as $_) {
            $fields = ['email' => $user->email, 'password' => 'invalid-password'];
            $response = $this->from($this->loginGetRoute())->post($this->loginPostRoute(), $fields);
        }

        $response->assertRedirect($this->loginGetRoute());
        $response->assertSessionHasErrors('email');

        $this->assertRegExp($this->getTooManyLoginAttemptsMessage(),
            collect($response->baseResponse->getSession()->get('errors')->getBag('default')->get('email'))->first()
        );

        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }
}
