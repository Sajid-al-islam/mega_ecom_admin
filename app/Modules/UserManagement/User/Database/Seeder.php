<?php

namespace App\Modules\UserManagement\User\Database;

use Illuminate\Database\Seeder as SeederClass;
use Illuminate\Support\Facades\Hash;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     * app\Modules\UserManagement\User\Database\Seeder.php
     php artisan db:seed --class="\App\Modules\UserManagement\User\Database\Seeder"
     */

    static $userModel = \App\Modules\UserManagement\User\Models\Model::class;
    static $roleModel = \App\Modules\UserManagement\UserRole\Models\Model::class;
    static $userAddress = \App\Modules\UserManagement\User\Models\UserAddressModel::class;
    static $userAddressContactPerson = \App\Modules\UserManagement\User\Models\UserAddressContactPersonModel::class;
    static $userCustomerInformation = \App\Modules\UserManagement\User\Models\UserCustomerInformationModel::class;
    static $userSupplierInformation = \App\Modules\UserManagement\User\Models\UserSupplierInformationModel::class;
    static $userEmployeeInformation = \App\Modules\UserManagement\User\Models\UserEmployeeInformationModel::class;


    public function run(): void
    {


        self::$userModel::truncate();
        self::$userAddress::truncate();
        self::$userAddressContactPerson::truncate();
        self::$userCustomerInformation::truncate();
        self::$userSupplierInformation::truncate();
        self::$userEmployeeInformation::truncate();

        $roles = self::$roleModel::get();
        foreach ($roles as  $role) {
            $userData = self::$userModel::create([
                "name" => "Mr " . $role->name,
                "user_name" =>  $role->name,
                "role_serial" =>  $role->serial,
                "email" => $role->name . "@gmail.com",
                "phone_number" => rand(99999999999, 999999999999),
                "photo" => facker()->imageUrl(300, 300),
                "password" => Hash::make('@12345678'),
                "role_id" => $role->serial,
            ]);
            $userData->permissions()->attach([1, 2, 3, 4]);
            $userData->save();

            // $userAddress =  self::$userAddress::create([
            //     'user_id' => $userData->id,
            //     'is_shipping' => rand(0, 1),
            //     'is_billing' => rand(0, 1),
            //     'address_types' => facker()->randomElement(['office', 'pickup_point', 'store']),
            //     'address' => facker()->address,
            //     'country_id' => rand(1, 200),
            //     'state_division_id' => rand(1, 200),
            //     'division_id' => rand(1, 7),
            //     'district_id' => rand(1, 64),
            //     'station_id' => rand(1, 1000),
            //     'city_id' => rand(1, 1000),
            //     'zip_code' => rand(1, 200),
            //     'is_present_address' => rand(0, 1),
            //     'is_permanent_address' => rand(0, 1),
            // ]);
            $userAddress =  self::$userAddress::create([
                'user_id' => $userData->id,
                'is_shipping' => 0,
                'is_billing' => 1,
                'address_types' => "personal",
                'address' => facker()->address,
                'country_id' => 216,
                'state_division_id' => 3,
                'division_id' => 3,
                'district_id' => 1,
                'station_id' => 3,
                'city_id' => null,
                'zip_code' => 1213,
                'is_present_address' => 1,
                'is_permanent_address' => 0,
            ]);
            $userAddress =  self::$userAddress::create([
                'user_id' => $userData->id,
                'is_shipping' => 1,
                'is_billing' => 0,
                'address_types' => "delivery",
                'address' => facker()->address,


                'country_id' => 216,
                'state_division_id' => 3,
                'division_id' => 3,
                'district_id' => 1,
                'station_id' => 3,
                'city_id' => null,
                'zip_code' => 1213,
                'is_present_address' => 1,
                'is_permanent_address' => 0,

            ]);

            self::$userCustomerInformation::create([
                'customer_type_id' => rand(1, 10),
                'client_id' => rand(1, 10),
                'user_id' => $userData->id,
                'website' => facker()->url,
            ]);

            self::$userSupplierInformation::create([
                'supplier_type_id' => rand(1, 10),
                'user_id' => $userData->id,
                'supplier_id' => rand(1, 10),
                'alt_mobile_number' => facker()->phoneNumber(),
                'alt_email' => facker()->email(),
            ]);

            self::$userEmployeeInformation::create([
                'gender' =>  facker()->randomElement(['male', 'female', 'other']),
                'user_id' => $userData->id,
                'nick_name' => facker()->name,
                'date_of_birth' => facker()->date,
                'employee_code' => facker()->ean8,
            ]);
            self::$userAddressContactPerson::create([
                'user_id' => $userData->id,
                'user_address_id' => $userAddress->id,
                'name' => facker()->name,
                'phone_number' => facker()->phoneNumber(),
                'email' => facker()->email,
            ]);
        }
    }
}
