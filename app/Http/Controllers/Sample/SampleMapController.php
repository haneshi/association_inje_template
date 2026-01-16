<?php

namespace App\Http\Controllers\Sample;

use App\Http\Controllers\Controller;
use App\Models\Pension;
use Illuminate\Http\Request;

class SampleMapController extends Controller
{
    public function mapIndex()
    {
        $this->data['pensions'] = Pension::where('is_active', true)->get();
        return view('sample.map.index', $this->data);
    }
}
