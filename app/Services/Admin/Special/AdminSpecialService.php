<?php

namespace App\Services\Admin\Special;

use App\Models\Special;
use App\Models\DataFile;
use Illuminate\Http\Request;
use App\Helper\ImageUploadHelper;
use Illuminate\Support\Facades\DB;
use App\Services\Admin\AdminService;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AdminSpecialService
 * @package App\Services
 */
class AdminSpecialService extends AdminService
{
    public function getData(array $where = []): Model|null
    {
        if (empty($where))
            return null;

        return Special::where($where)->first();
    }
    public function getList(array $arrData)
    {
        $st = $arrData['paramData']['st'];
        $query = Special::orderByRaw('is_active desc, seq asc');
        if ($st) {
            $query = $query->where(function ($q) use ($st) {
                $q->orWhere('name', 'LIKE', "%{$st}%");
            });
        }
        return $query->get();
    }

    public function addSpecial(Request $req)
    {
        DB::beginTransaction();
        try {
            $data = $req->except(['pType', 'images']);
            $data['is_active'] = $req->boolean('is_active');
            if ($data['is_active'] === true) {
                $data['seq'] = Special::where('is_active', 1)->count() + 1;
            }
            $special = Special::create($data);
            if ($req->hasFile('images')) {
                $images = $req->file('images');
                $imagesCount = count($images);

                foreach ($images as $image) {
                    $tempImage = ImageUploadHelper::upload(
                        $image,
                        'special/' . $special->id . '/',
                        ['width' => 1920],
                        $imagesCount
                    );

                    if ($tempImage) {
                        if ($special->files()->create($tempImage)) {
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
                'title' => '특산물 등록 성공',
                'event' => [
                    'type' => 'replace',
                    'url' => route('admin.special'),
                ]
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            $specialLog = new Special();
            $specialLog->setHistoryLog([
                'type' => 'error',
                'description' => "특산물 추가 에러",
                'queryData' => $this->json_encode($data),
                'rowData' => JsonEncode(['error' => $e->getMessage()]),
            ], $this->user());

            return $this->returnJsonData('modalAlert', [
                'type' => 'error',
                'title' => "특산물 추가 에러",
                'content' => "특산물이 추가 되지 않았습니다. <br> 관리자에게 문의해 주세요!",
            ]);
        }
    }

    public function setSpecial(Request $req)
    {
        $special = $this->getData(['id' => $req->id]);
        if (!$special) {
            return $this->returnJsonData('modalAlert', [
                'type' => 'error',
                'title' => '특산물 수정 에러',
                'content' => '존재하지 않은 특산물입니다.',
                'event' => [
                    'type' => 'replace',
                    'url' => route('amdin.special'),
                ]
            ]);
        }
        DB::beginTransaction();
        try {
            $data = $req->except(['pType', 'images']);
            $data['is_active'] = $req->boolean('is_active');
            $origin = $special->getOriginal();

            // 사용유무 처리 로직
            if ($origin['is_active'] == 1 && $data['is_active'] == 0) {
                $data['seq'] = 9999;
            } elseif ($origin['is_active'] == 0 && $data['is_active'] == 1) {
                $data['seq'] = Special::active()->count() + 1;
            }

            if ($req->hasFile('images')) {
                $images = $req->file('images');
                $imagesCount = count($images);

                foreach ($images as $image) {
                    $tempImage = ImageUploadHelper::upload(
                        $image,
                        'special/' . $special->id . '/',
                        ['width' => 1920],
                        $imagesCount
                    );

                    if ($tempImage) {
                        if ($special->files()->create($tempImage)) {
                            $imagesCount++;
                        }
                    }
                }
            }

            if ($special->update($data)) {
                DB::commit();
                return $this->returnJsonData('toastAlert', [
                    'type' => 'success',
                    'delay' => 1000,
                    'delayMask' => true,
                    'content' => '특산물 정보가 수정되었습니다.',
                    'event' => [
                        'type' => 'reload',
                    ]
                ]);
            }

            return $this->returnJsonData('modalAlert', [
                'type' => 'error',
                'title' => "특산물 수정 에러",
                'content' => "특산물 정보가 수정 되지 않았습니다.",
                'event' => [
                    'type' => 'reload',
                ],
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            $specialLog = new Special();
            $specialLog->setHistoryLog([
                'type' => 'error',
                'description' => "특산물 수정 에러",
                'queryData' => $this->json_encode($data),
                'rowData' => JsonEncode(['error' => $e->getMessage()]),
            ], $this->user());

            return $this->returnJsonData('modalAlert', [
                'type' => 'error',
                'title' => "특산물 수정 에러",
                'content' => "특산물이 수정 되지 않았습니다. <br> 관리자에게 문의해 주세요!",
            ]);
        }
    }



    ################# System Logic
    public function setSeq(Request $req): array
    {
        $data = $req->except(['pType']);
        $count = 1;
        foreach ($data['seqIdxes'] as $id) {
            Special::where('id', $id)->update([
                'seq' => $count
            ]);
            $count++;
        }
        return $this->returnJsonData('toastAlert', [
            'type' => 'success',
            'delay' => 1000,
            'delayMask' => true,
            'title' => '순서가 변경 되었습니다.',
            'event' => [
                'type' => 'reload',
            ],
        ]);
    }

    public function deleteImages(Request $req)
    {
        $data = $req->only('id');
        $dataFile = DataFile::find($data['id']);
        if (!$dataFile) {
            return $this->returnJsonData('modalAlert', [
                'type' => 'error',
                'title' => '이미지 삭제에러',
                'content' => '이미 삭제된 이미지 입니다.',
                'event' => [
                    'type' => 'reload',
                ]
            ]);
        }

        $origin = $dataFile->getOriginal();
        if ($dataFile->delete()) {
            $this->deleteStorageData($origin['file_path']);
            return $this->returnJsonData('toastAlert', [
                'type' => 'success',
                'delay' => 1000,
                'delayMask' => true,
                'title' => '이미지 삭제 성공',
                'event' => [
                    'type' => 'reload',
                ],
            ]);
        }
        return $this->returnJsonData('modalAlert', [
            'type' => 'error',
            'title' => "이미지 삭제 에러",
            'content' => "이미지 삭제 되지 않았습니다."
        ]);
    }

    public function setImagesSeq(Request $req)
    {
        $data = $req->except(['pType']);
        $count = 1;
        foreach ($data['seqIdxes'] as $id) {
            DataFile::where('id', $id)->update([
                'seq' => $count,
            ]);
            $count++;
        }
        return $this->returnJsonData('toastAlert', [
            'type' => 'success',
            'delay' => 1000,
            'delayMask' => true,
            'title' => '순서가 변경 되었습니다.',
            'event' => [
                'type' => 'reload',
            ],
        ]);
    }
}
