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
        Schema::create('pension', function (Blueprint $table) {
            $table->id()->comment('펜션 고유값');
            $table->smallInteger('seq')->default(9999)->comment('순서'); // -32,768 ~ 32,767 범위
            $table->string('name', 50)->comment('펜션 이름');
            $table->string('owner', 50)->comment('펜션주 이름');
            $table->string('tel', 50)->comment('펜션 전화번호');

            // 주소관련
            $table->string('post', 50)->nullable()->comment('펜션 우편번호');
            $table->string('address_basic', 50)->nullable()->comment('도로명주소');
            $table->string('address_local', 50)->nullable()->comment('도로명 동');
            $table->string('address_detail', 50)->nullable()->comment('도로명 상세주소');
            $table->string('address_jibun', 50)->nullable()->comment('지번주소');

            // 위도 경도
            $table->string('lat', 50)->nullable()->comment('위도');
            $table->string('lng', 50)->nullable()->comment('경도');

            // 지역 config() 활용 config('sites.location')
            $table->string('location', 50)->nullable()->comment('팬션 지역');

            $table->string('reservation_key')->nullable()->comment('예약시스템 키');
            $table->boolean('is_active')->default(true)->comment('사용유무');

            $table->timestamps();

            $table->comment('협회 관리펜션');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pension');
    }
};
