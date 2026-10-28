<?php

namespace App\Http\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UserRepository extends BaseRepository
{
    public function __construct(private User $model)
    {
        parent::__construct($model);
    }

    public function getWithFilters(array $data)
    {
        $builder = $this->model->query()->where(function ($query) use ($data) {
            if (data_get($data, 'name')) {
                $query->where('name', 'like', '%' . $data['name'] . '%');
            }

            if (data_get($data, 'email')) {
                $query->where('email', 'like', '%' . $data['email'] . '%');
            }
        });

        return $this->index($builder);
    }

    public function findOrFail(int $id): User
    {
        return User::findOrFail($id);
    }

    public function toggleClassroom(User $user, int $classroomId): array
    {
        return $user->classrooms()->toggle($classroomId);
    }
}
