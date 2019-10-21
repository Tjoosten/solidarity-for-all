<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

/**
 * Class CategoryTableSeeder
 */
class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        foreach ($this->getBasicCategories() as $category => $value) {
            Category::create(['name' => $value]);
        }
    }

    /**
     * Method for all the basic categories that need to be seeded.
     *
     * @return array
     */
    private function getBasicCategories(): array
    {
        return [
            'Blikvoeding', 'Toiletgerief', 'Tenten', 'Slaap materieel',
            'Winterkleding (mannen)', 'Winterkleding (vrouwen)', 'Winterkleding (kinderen)',
            'Schoenen (mannen)', 'Schoenen (vrouwen)', 'Schoenen (kinderen)',
        ];
    }
}
