<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OfferRequest;


class OfferController extends Controller
{
    public function index(OfferRequest $request)
    {

        return view('jobList', [
            'keyword' => $request->keyword,
            'location' => $request->location,
        ]);
    }
}
