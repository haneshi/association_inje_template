<?php

namespace App\Services\Admin\Board;

use App\Models\Admin;
use App\Models\Board;
use App\Models\BoardPosts;
use Illuminate\Http\Request;
use App\Helper\ImageUploadHelper;
use Illuminate\Support\Facades\DB;
use App\Services\Admin\AdminService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

/**
 * Class AdminBoardPostService
 * @package App\Services
 */
class AdminBoardPostService extends AdminService
{

    public function getBoardData(array $where = [])
    {
        return Board::getData($where);
    }

    public function getBoardPostData(array $where = [])
    {
        return BoardPosts::getData($where);
    }

    public function getPaginate(int $board_id, array $arrData, int $pagenate = 10)
    {
        $st = $arrData['paramData']['st'];

        $query = BoardPosts::where('board_id', $board_id)
            ->orderByRaw('is_active desc, is_fixed desc, created_at desc');

        if ($st) {
            $query->fullTextSearch($st);
        }

        $query->with('author');
        return $query->paginate($pagenate);
    }

    public function addBoardPost(Request $req, Model $board)
    {
        $data = $req->except(['pType', 'image', 'images']);
        $data['board_id'] = $board->id;
        $data['author_id'] = config('auth.admin')->id;
        $data['author_type'] = Admin::class;
        $data['is_fixed'] = $req->boolean('is_fixed');
        $data['ip'] = $req->ip();
        $data['is_active'] = $req->boolean('is_active');

        // 유효성 검사 규칙
        $validator = Validator::make($req->all(), [
            'image' => 'image|mimes:jpeg,png|max:10240', // 10MB (10240KB)
        ], [
            'image.image' => '이미지 파일만 업로드 가능합니다!<br>',
            'image.mimes' => 'jpeg, png 이미지만 등록이 가능합니다!',
            'image.max' => '대표 이미지 크기는 10MB를 초과할 수 없습니다!',
        ]);
        // 유효성 검사 실패 시
        if ($validator->fails()) {
            return $this->returnJsonData('modalAlert', [
                'type' => 'error',
                'title' => '대표 이미지 추가 에러',
                'content' => implode(', ', $validator->errors()->get('image')),
            ]);
        }
        DB::beginTransaction();
        try {
            // 게시글의 모델 객체
            $post = $board->posts()->create($data);
            if ($post) {
                // 갤러리 대표이미지 (썸네일)
                if ($req->file('image')) {
                    $imageData = ImageUploadHelper::upload(
                        $req->file('image'),
                        'board/' . $board->type . '/' . $post->id . '/thumbnail/',
                        ['width' => 1920]
                    );
                    $post->image = $imageData['file_path'];
                    $post->save();
                }

                // 갤러리 이미지들
                if ($req->hasFile('images')) {
                    $images = $req->file('images');
                    $imagesCount = count($images);
                    foreach ($images as $image) {
                        $tempImage = ImageUploadHelper::upload(
                            $image,
                            'board/' . $board->type . '/' . $post->id . '/',
                            ['width' => 1920],
                            $imagesCount
                        );
                        if ($tempImage) {
                            if ($post->files()->create($tempImage)) {
                                $imagesCount++;
                            }
                        }
                    }
                }
                DB::commit();
                return $this->returnJsonData('toastAlert', [
                    'type' => 'success',
                    'delay' => 1000,
                    'delayMask' => true,
                    'content' => "게시글이 추가 되었습니다..",
                    'event' => [
                        'type' => 'replace',
                        'url' => route('admin.board', $board->board_name),
                    ],
                ]);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            $boardLog = new Board();
            $boardLog->setHistoryLog([
                'type' => 'error',
                'description' => "게시글 추가 에러",
                'queryData' => $this->json_encode($data),
                'rowData' => JsonEncode(['error' => $e->getMessage()]),
            ], $this->user());

            return $this->returnJsonData('modalAlert', [
                'type' => 'error',
                'title' => "게시글 추가 에러",
                'content' => "게시글이 추가 되지 않았습니다. <br> 관리자에게 문의해 주세요!",
            ]);
        }
    }

    public function setBoardPost(Request $req, Model $board)
    {
        $data = $req->except(['pType', 'image', 'images']);
        $data['is_fixed'] = $req->boolean('is_fixed');
        $data['is_active'] = $req->boolean('is_active');
        $data['ip'] = $req->ip();

        // 유효성 검사 규칙
        $validator = Validator::make($req->all(), [
            'image' => 'image|mimes:jpeg,png|max:10240', // 10MB (10240KB)
        ], [
            'image.image' => '이미지 파일만 업로드 가능합니다!<br>',
            'image.mimes' => 'jpeg, png 이미지만 등록이 가능합니다!',
            'image.max' => '대표 이미지 크기는 10MB를 초과할 수 없습니다!',
        ]);
        // 유효성 검사 실패 시
        if ($validator->fails()) {
            return $this->returnJsonData('modalAlert', [
                'type' => 'error',
                'title' => '대표 이미지 추가 에러',
                'content' => implode(', ', $validator->errors()->get('image')),
            ]);
        }
        // 게시글
        $boardPost = $this->getBoardPostData(['id' => $data['id']]);
        if (!$boardPost) {
            return $this->returnJsonData('modalAlert', [
                'title' => "게시글 수정 에러",
                'content' => "존재하지 않는 게시글 입니다.",
                'event' => [
                    'type' => 'replace',
                    'url' => route('admin.board', $board->board_name),
                ],
            ]);
        }

        DB::beginTransaction();
        try {
            $origin = $boardPost->getOriginal();
            if ($req->hasFile('image')) {
                $imageData = ImageUploadHelper::upload(
                    $req->file('image'),
                    'board/' . $board->type . '/' . $boardPost->id . '/thumbnail/',
                    ['width' => 1920]
                );
                if ($imageData) {
                    $oldImagePath = $origin['image'];
                    $boardPost->image = $imageData['file_path'];
                    $boardPost->save();
                }
            }

            if ($req->hasFile('images')) {
                $images = $req->file('images');
                $imagesCount = count($images);
                foreach ($images as $image) {
                    $tempImage = ImageUploadHelper::upload(
                        $image,
                        'board/' . $board->type . '/' . $boardPost->id . '/',
                        ['width' => 1920],
                        $imagesCount
                    );
                    if ($tempImage) {
                        if ($boardPost->files()->create($tempImage)) {
                            $imagesCount++;
                        }
                    }
                }
            }

            if ($boardPost->update($data)) {
                DB::commit();
                if ($req->hasFile('image')) {
                    // 대표이미지가 바뀐다면 DB 저장이후 원본 사진 삭제
                    // 데이터 유실방지
                    $this->deleteStorageData($oldImagePath);
                }
                return $this->returnJsonData('toastAlert', [
                    'type' => 'success',
                    'delay' => 1000,
                    'delayMask' => true,
                    'content' => "게시글이 수정 되었습니다..",
                    'event' => [
                        'type' => 'reload',
                    ],
                ]);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            $boardLog = new Board();
            $boardLog->setHistoryLog([
                'type' => 'error',
                'description' => "게시글 수정 에러",
                'queryData' => $this->json_encode($data),
                'rowData' => JsonEncode(['error' => $e->getMessage()]),
            ], $this->user());

            return $this->returnJsonData('modalAlert', [
                'type' => 'error',
                'title' => "게시글 수정 에러",
                'content' => "게시글이 수정 되지 않았습니다. <br> 관리자에게 문의해 주세요!",
            ]);
        }
    }
}
