<?php

namespace App\Http\Controllers\Admin\Special;

use App\Models\Special;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\Special\AdminSpecialService;

class AdminSpecialController extends Controller
{
    private function getParamData(Request $req):array
    {
        return [
            'st' => $req->input('st', null),
            'page' => $req->input('page', null),
        ];
    }

    public function index(Request $req)
    {
        $this->data['paramData'] = $this->getParamData($req);
        $service = new AdminSpecialService();
        $this->data['dataList'] = $service->getList($this->data);
        return view('admin.pages.special.index', $this->data);
    }

    public function write(Request $req)
    {
        $this->data['paramData'] = $this->getParamData($req);
        return view('admin.pages.special.write', $this->data);
    }

    public function view(Request $req, int $id)
    {
        $this->data['paramData'] = $this->getParamData($req);
        $this->data['special'] = Special::getData(['id' => $id]);
        if(!$this->data['special']) {
            RedirectBack([
                'flash_error' => config('message.flash_error.id'),
                'flash_error_toast' => true,
            ]);
        }
        return view('admin.pages.special.view', $this->data);
    }

    public function data(Request $req)
    {
        if($req->ajax() && $req->isMethod('post')) {
            $service = new AdminSpecialService();
            return match ($req->pType) {
                'setSeq' => $service->setSeq($req),

                'addSpecial' => $service->addSpecial($req),
                'setSpecial' => $service->setSpecial($req),
            };
        }
    }
}
