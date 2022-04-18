<?php
namespace App\Http\Services;

use App\Http\Requests\StudentRequest;
use App\Models\Student;

class StudentService
{
protected Object $model;

    public function __construct(Student $student)
    {
        $this->model = $student;
    }

    public function getStudent(): array
    {
        $resultStudent = (array)[];
        $students = (Object)$this->model::all();
        foreach ($students as $i => $student) {
            $classst = $student->classst()->get()->map(function (Object $elem) {
                return (string)$elem->name;
            });
            $resultStudent[] = ['class' => $classst->first(), 'name' => $student->name,
                'email' => $student->email];
        }
        return (array)$resultStudent;
    }

    public function getShow(int $id): array
    {
        $resultStudent = (array)[];
        $student = (Object)$this->model::findOrFail($id);
        $resultStudent['name'] = $student->name;
        $resultStudent['email'] = $student->email;
        $classst = $student->classst()->get()->map(function (Object $elem) use (&$resultStudent) {
            $elem->lecture()->get()->map(function (Object $el) use (&$resultStudent) {
                $resultStudent['lecz'][] = $el->name;
            });
            return (string)$elem->name;
        });
        $resultStudent['class'] = $classst->first();
        return (array)$resultStudent;
    }


    public function save(StudentRequest $request, ?int $id = 0): Object
    {
        $student = (!$id) ? (Object)new $this->model : (Object)$this->model::find($id);
        $student->fill($request->only($student->getFillable()));
        $student->save();
        return (Object)$student;
    }
}
