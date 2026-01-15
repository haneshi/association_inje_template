<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Board;
use App\Models\BoardPosts;
use Illuminate\Database\Seeder;

class BoardSeeder extends Seeder
{
    protected $boards = [
        [
            'seq' => 1,
            'board_name' => 'notice',
            'title' => '공지사항',
            'type' => 'list',
            'is_fixed' => true,
            'is_secret' => false,
            'is_comment' => false,
            'is_period' => false,
            'page_show_num' => 10,
            'is_active' => true,
        ],
        [
            'seq' => 2,
            'board_name' => 'gallery',
            'title' => '갤러리',
            'type' => 'gallery',
            'is_fixed' => false,
            'is_secret' => false,
            'is_comment' => false,
            'is_period' => false,
            'page_show_num' => 12,
            'is_active' => true,
        ],
        [
            'seq' => 3,
            'board_name' => 'qna',
            'title' => '자주 묻는 질문',
            'type' => 'list',
            'is_fixed' => false,
            'is_secret' => false,
            'is_comment' => false,
            'is_period' => false,
            'page_show_num' => 10,
            'is_active' => true,
        ],
    ];

    protected $posts = [
        'notice' => [
            [
                'title' => '2026년 신년 인사말',
                'content' => '<p>안녕하세요. 새해 복 많이 받으세요.</p><p>2026년에도 변함없는 성원 부탁드립니다.</p>',
                'is_fixed' => true,
                'is_active' => true,
            ],
            [
                'title' => '홈페이지 리뉴얼 안내',
                'content' => '<p>홈페이지가 새롭게 리뉴얼 되었습니다.</p><p>더 나은 서비스로 보답하겠습니다.</p>',
                'is_fixed' => false,
                'is_active' => true,
            ],
            [
                'title' => '개인정보처리방침 개정 안내',
                'content' => '<p>개인정보처리방침이 2026년 1월 1일자로 개정되었습니다.</p><p>자세한 내용은 본문을 확인해 주세요.</p>',
                'is_fixed' => false,
                'is_active' => true,
            ],
            [
                'title' => '시스템 점검 안내',
                'content' => '<p>시스템 점검이 예정되어 있습니다.</p><p>점검 시간: 2026년 1월 20일 02:00 ~ 06:00</p><p>이용에 참고 부탁드립니다.</p>',
                'is_fixed' => false,
                'is_active' => true,
            ],
            [
                'title' => '회원 서비스 이용 안내',
                'content' => '<p>회원 서비스 이용 방법에 대해 안내드립니다.</p><p>1. 회원가입 후 로그인</p><p>2. 마이페이지에서 정보 확인</p><p>3. 다양한 서비스 이용</p>',
                'is_fixed' => false,
                'is_active' => true,
            ],
        ],
        'gallery' => [
            [
                'title' => '2026년 신년회 행사 사진',
                'content' => '<p>2026년 신년회 행사가 성공적으로 마무리되었습니다.</p>',
                'is_fixed' => false,
                'is_active' => true,
            ],
            [
                'title' => '봄맞이 행사 현장',
                'content' => '<p>봄을 맞이하여 진행된 행사 현장입니다.</p>',
                'is_fixed' => false,
                'is_active' => true,
            ],
            [
                'title' => '워크샵 현장 스케치',
                'content' => '<p>지난 워크샵 현장을 담았습니다.</p>',
                'is_fixed' => false,
                'is_active' => true,
            ],
        ],
        'qna' => [
            [
                'title' => '회원가입은 어떻게 하나요?',
                'content' => '<p>회원가입 방법에 대해 안내드립니다.</p>',
                'content_sub' => '<p>상단 메뉴의 회원가입 버튼을 클릭하시면 회원가입 페이지로 이동합니다. 필수 정보를 입력하시고 가입 완료 버튼을 누르시면 됩니다.</p>',
                'is_fixed' => false,
                'is_active' => true,
            ],
            [
                'title' => '비밀번호를 잊어버렸어요.',
                'content' => '<p>비밀번호 분실 시 대처 방법입니다.</p>',
                'content_sub' => '<p>로그인 페이지에서 "비밀번호 찾기"를 클릭하세요. 가입 시 등록한 이메일로 임시 비밀번호가 발송됩니다.</p>',
                'is_fixed' => false,
                'is_active' => true,
            ],
            [
                'title' => '문의는 어디로 하면 되나요?',
                'content' => '<p>문의 방법 안내입니다.</p>',
                'content_sub' => '<p>홈페이지 하단의 연락처로 전화 문의 또는 이메일 문의가 가능합니다. 운영시간: 평일 09:00 ~ 18:00</p>',
                'is_fixed' => false,
                'is_active' => true,
            ],
            [
                'title' => '회원 탈퇴는 어떻게 하나요?',
                'content' => '<p>회원 탈퇴 절차 안내입니다.</p>',
                'content_sub' => '<p>마이페이지 > 회원정보 > 회원탈퇴 메뉴에서 탈퇴가 가능합니다. 탈퇴 시 모든 정보가 삭제되며 복구가 불가능합니다.</p>',
                'is_fixed' => false,
                'is_active' => true,
            ],
        ],
    ];

    public function run(): void
    {
        $admin = Admin::first();

        foreach ($this->boards as $boardData) {
            $board = Board::create($boardData);

            $boardName = $boardData['board_name'];
            if (isset($this->posts[$boardName])) {
                foreach ($this->posts[$boardName] as $postData) {
                    $postData['board_id'] = $board->id;
                    $postData['author_id'] = $admin?->id;
                    $postData['author_type'] = $admin ? Admin::class : null;
                    $postData['ip'] = '127.0.0.1';
                    $postData['hit'] = rand(0, 100);

                    BoardPosts::create($postData);
                }
            }
        }
    }
}
