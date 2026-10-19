<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Http\Resources\CourseResource;
use App\Http\Services\CourseService;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function __construct(private CourseService $courseController)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return CourseResource::collection($this->courseController->getWithFilters($request->all()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseRequest $request)
    {
        return new CourseResource($this->courseController->store($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new CourseResource($this->courseController->show($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseRequest $request, string $id)
    {
        return new CourseResource($this->courseController->update($request->validated(), $id));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->courseController->destroy($id);

        return response()->noContent();
    }
}
