<?php

namespace App\Http\Services;
use App\Models\Classroom;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class UserClassroomService
{
    public function toggle(int $userId, int $classroomId): array
    {
        $user = User::findOrFail($userId);
        $classroom = Classroom::findOrFail($classroomId);

        $alreadyIn = $user->classrooms()
            ->where('classrooms.id', $classroomId)
            ->exists();

        if ($alreadyIn) {
            $user->classrooms()->detach($classroomId);
        } else {
            if ($classroom->users()->count() >= $classroom->vacancies) {
                throw ValidationException::withMessages([
                    'classroom_id' => 'A turma não possui vagas disponíveis.',
                ]);
            }

            $user->classrooms()->attach($classroomId);
        }

        return [
            'user' => $user->load('classrooms'),
            'attached' => !$alreadyIn,
        ];
    }
}