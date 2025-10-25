<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory;


class GroupSeeder extends Seeder
{
    /**
     * Sinh ngẫu nhiên tên nhóm bằng cách ghép họ + tên.
     */

    /**
     * Tạo nội dung mô tả giả (không gọi API bên ngoài để tránh lỗi).
     */

    /**
     * Run the database seeds.
     */
    public function run()
    {
        $now = now();
        $groups = [];
        $faker = Factory::create();


        for ($i = 1; $i <= 20; $i++) {
            $name = $faker->name();
            $groups[] = [
                'name'        => $name,
                'slug'        => Str::slug($name) . '-' . $i,
                'description' => $faker->sentence(),
                'created_at'  => $faker->dateTimeThisYear(),
                'updated_at'  => $faker->dateTimeThisYear(),
            ];
        }

        DB::table('groups')->insert($groups);
    }
}
