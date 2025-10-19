<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Sinh tiêu đề ngẫu nhiên.
     */
    private function randomTitle(): string
    {
        $titles = [
            'Hướng dẫn sử dụng hệ thống hiệu quả',
            'Cập nhật phiên bản mới nhất',
            'Bí quyết học nhanh lập trình PHP',
            'Những lỗi phổ biến khi dùng Laravel',
            'Top 5 mẹo tối ưu hiệu năng website',
            'Cách bảo mật thông tin người dùng',
            'Giới thiệu giao diện quản trị mới',
            'Chia sẻ kinh nghiệm học Node.js',
            'Thông báo bảo trì hệ thống định kỳ',
            'Làm sao để debug hiệu quả trong Laravel',
            'Tổng hợp shortcut hữu ích cho VSCode',
            'Tạo slug tự động trong Laravel',
            'Hiểu rõ về migration và seeder',
            'Kinh nghiệm triển khai project đầu tiên',
            'Cách dùng middleware trong thực tế',
            'Thực hành CRUD nhanh với Eloquent',
            'Kết nối cơ sở dữ liệu MySQL trong Laravel',
            'Giải thích rõ về relationship trong model',
            'Các bước deploy website lên hosting',
            'Khắc phục lỗi migrate trong Laravel',
        ];

        return $titles[array_rand($titles)];
    }

    /**
     * Sinh nội dung mô tả ngắn ngẫu nhiên.
     */
    private function randomContent(): string
    {
        $samples = [
            'Bài viết này hướng dẫn chi tiết các bước thực hiện.',
            'Chia sẻ kinh nghiệm thực tế giúp bạn tiết kiệm thời gian.',
            'Cập nhật những thay đổi mới trong framework Laravel.',
            'Cung cấp thông tin hữu ích cho lập trình viên mới bắt đầu.',
            'Hướng dẫn từng bước triển khai tính năng phổ biến.',
            'Giúp bạn hiểu rõ hơn về cách thức hoạt động của hệ thống.',
            'Giới thiệu các tính năng mới giúp tối ưu hiệu năng.',
            'Tổng hợp các mẹo nhỏ hữu ích trong quá trình phát triển.',
            'Phân tích và hướng dẫn xử lý lỗi thường gặp.',
            'Khuyến nghị các phương pháp tốt nhất khi làm việc nhóm.',
        ];
        return $samples[array_rand($samples)];
    }

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

        for ($i = 1; $i <= $totalPosts; $i++) {
            $title = $this->randomTitle();
            $slug  = Str::slug($title) . '-' . $i . '-' . Str::random(3);

            $posts[] = [
                'title'        => $title,
                'slug'         => $slug,
                'content'      => $this->randomContent(),
                'is_published' => (bool)random_int(0, 1),
                'group_id'     => $groupIds[array_rand($groupIds)],
                'created_at'   => $now,
                'updated_at'   => $now,
                'deleted_at'   => null,
            ];
        }

        DB::table('posts')->insert($posts);
    }
}
