<?php
namespace App\Modules\TodoList\Database;

use Illuminate\Database\Seeder as SeederClass;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     */
    static $model = \App\Modules\TodoList\Models\Model::class;
    public function run(): void
    {
        self::$model::factory()->count(100)->create();
    }
}