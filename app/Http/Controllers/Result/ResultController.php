<?php

namespace App\Http\Controllers\Result;

use App\Http\Controllers\Controller;
use App\Http\Service\Result\ResultService;
use App\Models\Result;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    private $resultService;

    public function __construct()
    {
        $this->resultService = ResultService::getInstance();
    }

    public function insertResult(Request $request)
    {
        $this->resultService->insertResult($request->only(['country','state' , 'temp']));
    }
}
