<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Board;
use App\Models\BoardPosts;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'post_count' => 20000,
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
            'post_count' => 15000,
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
            'post_count' => 15000,
        ],
    ];

    protected $noticeTitles = [
        '시스템 점검 안내',
        '서비스 이용 안내',
        '개인정보처리방침 개정 안내',
        '홈페이지 리뉴얼 안내',
        '회원 서비스 변경 안내',
        '연휴 운영 안내',
        '신규 서비스 오픈 안내',
        '이벤트 당첨자 발표',
        '정기 점검 완료 안내',
        '보안 업데이트 안내',
        '이용약관 변경 안내',
        '고객센터 운영시간 변경',
        '신년 인사말',
        '추석 연휴 안내',
        '설 연휴 안내',
        '서버 이전 안내',
        '앱 업데이트 안내',
        '회원등급 혜택 안내',
        '포인트 정책 변경 안내',
        '제휴 서비스 안내',
    ];

    protected $galleryTitles = [
        '신년회 행사 현장',
        '봄맞이 행사 사진',
        '워크샵 현장 스케치',
        '창립기념일 행사',
        '송년회 현장',
        '세미나 현장 사진',
        '전시회 방문 사진',
        '체육대회 현장',
        '봉사활동 현장',
        '연수 프로그램 사진',
        '시상식 현장',
        '간담회 현장',
        '오픈식 행사 사진',
        '기념행사 현장',
        '특별 이벤트 사진',
    ];

    protected $qnaTitles = [
        '회원가입은 어떻게 하나요?',
        '비밀번호를 잊어버렸어요',
        '회원 탈퇴는 어떻게 하나요?',
        '개인정보 변경은 어디서 하나요?',
        '문의는 어디로 하면 되나요?',
        '서비스 이용시간이 어떻게 되나요?',
        '결제 방법이 궁금합니다',
        '환불 절차가 어떻게 되나요?',
        '포인트는 어떻게 사용하나요?',
        '회원 등급 기준이 궁금합니다',
        '앱 설치는 어떻게 하나요?',
        '알림 설정은 어디서 하나요?',
        '이용권 구매 방법이 궁금합니다',
        '제휴 할인은 어떻게 받나요?',
        '예약 취소는 어떻게 하나요?',
    ];

    protected $contentTemplates = [
        '<p>안녕하세요. 관련 내용을 안내드립니다.</p><p>자세한 사항은 아래 내용을 확인해 주세요.</p><p>문의사항이 있으시면 고객센터로 연락 바랍니다.</p>',
        '<p>해당 서비스에 대해 안내드립니다.</p><p>이용에 참고 부탁드립니다.</p><p>감사합니다.</p>',
        '<p>공지사항을 알려드립니다.</p><p>변경된 내용을 꼭 확인해 주세요.</p><p>더 나은 서비스로 보답하겠습니다.</p>',
        '<p>중요 안내사항입니다.</p><p>해당 내용은 모든 회원에게 적용됩니다.</p><p>궁금하신 점은 문의 바랍니다.</p>',
        '<p>서비스 이용 관련 안내입니다.</p><p>원활한 이용을 위해 확인 부탁드립니다.</p><p>항상 최선을 다하겠습니다.</p>',
    ];

    protected $answerTemplates = [
        '<p>해당 문의에 대한 답변입니다.</p><p>마이페이지에서 관련 설정을 확인하실 수 있습니다.</p><p>추가 문의사항이 있으시면 고객센터로 연락 바랍니다.</p>',
        '<p>문의해 주셔서 감사합니다.</p><p>해당 기능은 로그인 후 이용 가능합니다.</p><p>자세한 이용방법은 도움말을 참고해 주세요.</p>',
        '<p>안내드립니다.</p><p>홈페이지 또는 앱에서 동일하게 이용 가능합니다.</p><p>이용에 불편이 있으시면 말씀해 주세요.</p>',
    ];

    public function run(): void
    {
        $admin = Admin::first();
        $now = now();

        foreach ($this->boards as $boardData) {
            $postCount = $boardData['post_count'];
            unset($boardData['post_count']);

            $board = Board::create($boardData);
            $boardName = $boardData['board_name'];

            $titles = match ($boardName) {
                'notice' => $this->noticeTitles,
                'gallery' => $this->galleryTitles,
                'qna' => $this->qnaTitles,
                default => $this->noticeTitles,
            };

            $posts = [];
            $chunkSize = 1000;

            for ($i = 0; $i < $postCount; $i++) {
                $titleIndex = $i % count($titles);
                $contentIndex = $i % count($this->contentTemplates);
                $createdAt = $now->copy()->subDays(rand(0, 365))->subHours(rand(0, 23))->subMinutes(rand(0, 59));

                $post = [
                    'board_id' => $board->id,
                    'author_id' => $admin?->id,
                    'author_type' => $admin ? Admin::class : null,
                    'title' => $titles[$titleIndex] . ' #' . ($i + 1),
                    'content' => $this->contentTemplates[$contentIndex],
                    'content_sub' => $boardName === 'qna' ? $this->answerTemplates[$i % count($this->answerTemplates)] : null,
                    'is_fixed' => $i < 3 && $boardName === 'notice',
                    'is_secret' => false,
                    'is_active' => true,
                    'ip' => '127.0.0.1',
                    'hit' => rand(0, 500),
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                ];

                $posts[] = $post;

                if (count($posts) >= $chunkSize) {
                    DB::table('board_posts')->insert($posts);
                    $posts = [];
                }
            }

            if (!empty($posts)) {
                DB::table('board_posts')->insert($posts);
            }
        }
    }
}
