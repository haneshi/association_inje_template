<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::create('board_posts', function (Blueprint $table) {
            $table->id()->comment('게시글 고유값');

            $table->unsignedBigInteger('board_id')->comment('게시판 고유값');
            $table->nullableMorphs('author');

            $table->boolean('is_fixed')->default(false)->comment('고정유무');
            $table->boolean('is_secret')->default(false)->comment('비밀글 여부');

            $table->string('title')->nullable()->comment('제목');
            $table->mediumText('content')->nullable()->comment('내용');
            $table->mediumText('content_sub')->nullable()->comment('추가 내용 ex) answer');

            $table->date('start_date')->nullable()->comment('시작일');
            $table->date('end_date')->nullable()->comment('종료일');

            $table->json('jsonData')->nullable()->comment('추가 데이터');

            $table->ipAddress('ip')->comment('작성자 IP');
            $table->text('user_agent')->nullable()->comment('접속정보 (헤더)');

            $table->unsignedInteger('hit')->default(0)->comment('조회수');
            $table->boolean('is_active')->default(false)->comment('사용 유무');

            $table->softDeletes()->comment('삭제일시');
            $table->timestamps();

            $table->fullText(['title', 'content', 'content_sub'], 'board_posts_fulltext_search');
            $table->index('board_id');

            $table->comment('게시판 게시글');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('board_posts');
    }
};
