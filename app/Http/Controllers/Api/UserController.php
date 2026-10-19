<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Resources\UserResource;
use App\Http\Services\UserService;
use Illuminate\Http\Request;
use App\Http\Requests\AttachUserClassroomRequest;
use App\Services\UserClassroomService;

class UserController extends Controller
{
    public function __construct(public UserService $userService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return UserResource::collection($this->userService->getWithFilters($request->all()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request)
    {
        return new UserResource($this->userService->store($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new UserResource($this->userService->show($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:100', 'min:3'],
            'email' => ['sometimes', 'email'],
            'password' => ['sometimes', 'min:4', 'max:20']
        ]);

        return new UserResource($this->userService->update($data, $id));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->destroy($id);

        return response('Usuário deletado com sucesso!');
    }
    public function __construct(
        private readonly UserClassroomService $userClassroomService
    ) {
    }

    public function attachUserClassroom(AttachUserClassroomRequest $request, int $id)
    {
        $result = $this->userClassroomService->toggle(
            $id,
            $request->validated('classroom_id')
        );

        return (new UserResource($result['user']))->additional([
            'message' => $result['attached']
                ? 'Usuário adicionado à turma.'
                : 'Usuário removido da turma.',
            'attached' => $result['attached'],
        ]);
    }
}
