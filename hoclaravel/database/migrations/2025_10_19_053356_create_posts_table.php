<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('content')->nullable();

            // trạng thái bài viết
            $table->boolean('is_published')->default(false)->index();

            // khóa ngoại tới groups
            $table->foreignId('group_id')
                ->constrained('groups')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            // nếu sau này muốn gắn user, chỉ cần thêm:
            // $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();

            $table->timestamps();
            $table->softDeletes();

            // index hay lọc theo group + publish
            $table->index(['group_id', 'is_published']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
