<?php

use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * Class UserTableSeeder
 */
class UserTableSeeder extends Seeder
{
    public const WEBMASTER = 'webmaster';  // Role name for webmasters in the application.
    public const ADMIN     = 'admin';      // Role name for board members in the application.

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        factory(User::class)->create(['name' => 'admin', 'email' => 'admin@' . config('mail.host')])
            ->assignRole(self::ADMIN);

        factory(User::class)->create(['name' => 'webmaster', 'email' => 'webmaster@' . config('mail.host')])
            ->assignRole(self::WEBMASTER);
    }
}
