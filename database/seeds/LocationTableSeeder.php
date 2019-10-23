<?php

use App\Models\Location as CollectionPoint;
use Illuminate\Database\Seeder;

/**
 * Class LocationTableSeeder
 */
class LocationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // TODO: Complete full seeder.

        CollectionPoint::create(['name' => 'VLAAMS-BRABANT Solidarity for all', 'address' => 'Hal 5', 'postal' => 3010, 'city' => 'Leuven']);
        CollectionPoint::create(['name' => 'ANTWERPEN Helpen Helpt', 'address' => 'Lage kaai 548', 'postal' => 2930, 'city' => 'Brasschaat']);
        CollectionPoint::create(['name' => 'Vzw Goblin', 'address' => 'Sint-Lambertusstraat', 'postal' => 2600, 'city' => 'Berchem']);
    }
}
