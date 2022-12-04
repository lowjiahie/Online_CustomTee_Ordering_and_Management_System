<?php

namespace Database\Seeders;

use App\Models\Type;
use App\Models\Color;
use App\Models\Customer;
use App\Models\CustomTeeDesign;
use Illuminate\Database\Seeder;
use App\Models\PlainTeeTypeColor;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Type::create([
            'name' => 'Gildan',
            'material' => 'Cotton',
            'description' => 'Soft and comfortable',
            'detail' => 'short T-shirt',
            'price' => 10.00,
        ])->save();

        Color::create([
            'color_name' => 'Blue',
            'color_code' => '#0000FF',
        ])->save();

        PlainTeeTypeColor::create([
            'plain_tee_img' => null,
            'color_id' => 'CL00001',
            'type_id' => 'TY00001',
        ])->save();

        Customer::create([
            'name' => 'John Doe',
            'email' => 'john@gmail.com',
            'password' => Hash::make('password')
        ])->save();

        CustomTeeDesign::create([
            'name' => '123',
            'pt_type_color_id' => 'TC00001',
            'cus_id' => 'CS00001',
        ])->save();

        CustomTeeDesign::create([
            'name' => '1234',
            'pt_type_color_id' => 'TC00001',
            'cus_id' => 'CS00001',
        ])->save();
    }
}
