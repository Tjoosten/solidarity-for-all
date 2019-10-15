<?php

namespace Tests\Feature\AccountSettings;

use App\Models\User;
use Tests\TestCase;

/**
 * Class InformationSettingsTest
 *
 * @package Tests\Feature\AccountSettings
 */
class InformationSettingsTest extends TestCase
{
    /**
     * @testdox User can display information settings view when authenticated
     */
    public function testUserCanDisplayInformationViewWhenAuthenticated(): void
    {
        $helena = factory(User::class)->create();

        $response = $this->actingAs($helena)->get(route('profile.settings.info'));
        $response->isSuccessful();
        $response->assertViewIs('profile.information');
    }

    /**
     * @testdox User cannot display information settings viw when not authenticated
     */
    public function testUserCannotDisplayWhenNotAuthenticated(): void
    {
        $response = $this->get(route('profile.settings.info'));
        $response->isSuccessful();
        $response->isRedirect(route('login'));

        $this->assertGuest();
    }

    /**
     * @testdox User can update his account information without problems
     */
    public function testUserCanUpdateHisAccountInformationWithoutProblems(): void
    {
        $this->markTestIncomplete();
    }

    /**
     * @testdox Name field is Required
     */
    public function testNameIfRequired(): void
    {
        $this->markTestIncomplete();
    }

    /**
     * @testdox The email address is valid as format.
     */
    public function testEmailIsvalid(): void
    {
        $this->markTestIncomplete();
    }

    /**
     * @testdox The email is unique in the database table except for the user himself.
     */
    public function testEmailIsUnique(): void
    {
        $this->markTestIncomplete();
    }

    /**
     * @testdox The email field is required.
     */
    public function testEmailIsRequired(): void
    {
        $this->markTestIncomplete();
    }
}
