<?php

namespace App\Http\Controllers\Web\Sample;

use App\Http\Controllers\Controller;
use App\Models\Pension;
use Illuminate\Http\Request;

class WebSampleMapController extends Controller
{
    //

    public function mapIndex()
    {
        $this->data['pensions'] = Pension::where('is_active', true)->get();
        return view('sample.map.index', $this->data);
    }
}
