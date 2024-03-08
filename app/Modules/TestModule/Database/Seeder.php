<?php
namespace App\Modules\TestModule\Database;

use Illuminate\Database\Seeder as SeederClass;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class=\App\Modules\TestModule\Database\Seeder
     */
    static $model = \App\Modules\TestModule\Models\Model::class;
    public function run(): void
    {
        // self::$model::factory()->count(100)->create();
        self::$model::truncate();
        self::$model::create([
            'name' => 'name',
            'email' => 'email',
            'phone' => 'phone',
            'address' => 'address',
            'active' => 'active',
            'image' => 'image',
        ]);
    }
}