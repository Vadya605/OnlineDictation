<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\DictationResultService;
use App\Services\Admin\DictationService;
use App\Services\Admin\UserService;


class HomeController extends Controller
{
    private $dictationService;
    private $dictationResultService;
    private $userService;

    public function __construct(DictationResultService $dictationResultService, DictationService $dictationService, UserService $userService)
    {
        $this->dictationService = $dictationService;
        $this->dictationResultService = $dictationResultService;
        $this->userService = $userService;
    }

    public function index(Request $request){
        return view('admin.homeAdmin', [
            'countDictation' => $this->dictationService->getCount(),
            'countDictationResult' => $this->dictationResultService->getCount(),
            'countUser' => $this->userService->getCount(),
        ]);
    }
}
