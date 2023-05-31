<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dictation;
use Illuminate\Http\Request;
use App\Services\DictationService;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Http\Request\TestRequest;
use Illuminate\Validation\ValidationException;

class DictationController extends Controller
{
    private $dictationService;
    public function __construct(DictationService $dictationService){
        $this->dictationService = $dictationService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        return $this->dictationService->getAll();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $validData = $request->validated();
        return $this->dictationService->create($validData);
        return response()->json($this->dictationService->create($validData), 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Dictation $dictation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dictation $dictation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $validData = $request->validated();
        return response()->json($this->dictationService->update($validData, $id), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return $this->dictationService->delete($id);
    }
}
