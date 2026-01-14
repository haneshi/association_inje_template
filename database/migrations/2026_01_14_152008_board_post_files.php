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
        Schema::create('board_post_files', function (Blueprint $table) {
            $table->id()->comment('게시글 파일 고유값');
            $table->morphs('fileable');
            $table->enum('type', ['attached', 'thumbnail', 'image', 'etc'])->comment('파일 타입');
            $table->integer('seq')->default(9999)->comment('순서');

            $table->string('path')->comment('파일 경로');
            $table->string('filename')->comment('원본 파일명');
            $table->string('mime_type')->nullable()->comment('MIME 타입');

            $table->unsignedBigInteger('file_size')->nullable()->comment('파일 크기 (바이트)');
            $table->softDeletes()->comment('삭제일시'); // deleted_at

            $table->timestamps();

            $table->comment('게시글의 첨부파일(이미지, 등등)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('board_post_files');
    }
};
