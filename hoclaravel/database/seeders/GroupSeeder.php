<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GroupSeeder extends Seeder
{
    /**
     * Sinh ngẫu nhiên tên nhóm bằng cách ghép họ + tên.
     */
    private function randomName(): string
    {
        $firstname = [
            'Johnathon',
            'Anthony',
            'Erasmo',
            'Raleigh',
            'Nancie',
            'Tama',
            'Camellia',
            'Augustine',
            'Christeen',
            'Luz',
            'Diego',
            'Lyndia',
            'Thomas',
            'Georgianna',
            'Leigha',
            'Alejandro',
            'Marquis',
            'Joan',
            'Stephania',
            'Elroy',
            'Zonia',
            'Buffy',
            'Sharie',
            'Blythe',
            'Gaylene',
            'Elida',
            'Randy',
            'Margarete',
            'Margarett',
            'Dion',
            'Tomi',
            'Arden',
            'Clora',
            'Laine',
            'Becki',
            'Margherita',
            'Bong',
            'Jeanice',
            'Qiana',
            'Lawanda',
            'Rebecka',
            'Maribel',
            'Tami',
            'Yuri',
            'Michele',
            'Rubi',
            'Larisa',
            'Lloyd',
            'Tyisha',
            'Samatha',
        ];

        $lastname = [
            'Mischke',
            'Serna',
            'Pingree',
            'Mcnaught',
            'Pepper',
            'Schildgen',
            'Mongold',
            'Wrona',
            'Geddes',
            'Lanz',
            'Fetzer',
            'Schroeder',
            'Block',
            'Mayoral',
            'Fleishman',
            'Roberie',
            'Latson',
            'Lupo',
            'Motsinger',
        ];

        return $firstname[array_rand($firstname)] . ' ' . $lastname[array_rand($lastname)];
    }

    /**
     * Tạo nội dung mô tả giả (không gọi API bên ngoài để tránh lỗi).
     */
    private function randomLorem(): string
    {
        $samples = [
            'Nhóm chia sẻ kinh nghiệm học tập và làm việc.',
            'Cộng đồng trao đổi kiến thức công nghệ.',
            'Nơi cập nhật tin tức mới nhất mỗi ngày.',
            'Kênh thảo luận và hỏi đáp thân thiện.',
            'Chia sẻ cảm hứng và câu chuyện cuộc sống.',
            'Nơi lưu trữ tài liệu học tập hữu ích.',
            'Bản tin về kỹ năng mềm và phát triển bản thân.',
            'Không gian sáng tạo dành cho lập trình viên.',
            'Câu lạc bộ học tập và nghiên cứu chuyên sâu.',
            'Kênh hướng dẫn các bước học lập trình cơ bản.',
        ];
        return $samples[array_rand($samples)];
    }

    /**
     * Run the database seeds.
     */
    public function run()
    {
        $now = now();
        $groups = [];

        for ($i = 1; $i <= 20; $i++) {
            $name = $this->randomName();
            $groups[] = [
                'name'        => $name,
                'slug'        => Str::slug($name) . '-' . $i,
                'description' => $this->randomLorem(),
                'created_at'  => $now,
                'updated_at'  => $now,
            ];
        }

        DB::table('groups')->insert($groups);
    }
}
