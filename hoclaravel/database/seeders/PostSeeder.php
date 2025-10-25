<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory;

class PostSeeder extends Seeder
{
    /**
     * Sinh tiêu đề ngẫu nhiên.
     */

    /**
     * Sinh nội dung mô tả ngắn ngẫu nhiên.
     */

    public function run()
    {
        $now = now();
        $posts = [];

        // Lấy danh sách group_id hiện có
        $groupIds = DB::table('groups')->pluck('id')->toArray();
        if (empty($groupIds)) {
            echo "⚠️ Không có dữ liệu nhóm (groups), hãy chạy GroupSeeder trước!\n";
            return;
        }

        // Số lượng bài post muốn sinh
        $totalPosts = 50;

        $faker = Factory::create();

        for ($i = 1; $i <= $totalPosts; $i++) {
            $title = $faker->sentence();
            $slug  = Str::slug($title) . '-' . $i . '-' . Str::random(3);

            $posts[] = [
                'title'        => $title,
                'slug'         => $slug,
                'content'      => $faker->paragraph(),
                'is_published' => (bool)random_int(0, 1),
                'group_id'     => $groupIds[array_rand($groupIds)],
                'created_at'   => $faker->dateTimeThisYear(),
                'updated_at'   => $faker->dateTimeThisYear(),
                'deleted_at'   => null,
            ];
        }

        DB::table('posts')->insert($posts);
    }
}
