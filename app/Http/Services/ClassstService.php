<?php
namespace App\Http\Services;

use App\Http\Requests\ClassstRequest;
use App\Models\Classst;
use App\Models\Lecture;
use Illuminate\Support\Facades\DB;

class ClassstService
{
protected Object $model;
protected Object $lecz;

    public function __construct(Classst $classst, Lecture $lec)
    {
        $this->model = $classst;
        $this->lecz = $lec;
    }

    public function getClassst(): array
    {
        $resultClassst = (array)[];
        $this->model::all()->map(function (Object $elem) use (&$resultClassst) {
            $resultClassst[] = $elem->name;
        });
        return (array)$resultClassst;
    }

    public function getShow(int $id): array
    {
        $resultClassst = (array)[];
        $classst = $this->model::findOrFail($id);
        $resultClassst['name'] = $classst->name;
        $classst->lecture()->get()->map(function (Object $elem) use (&$resultClassst) {
            $resultClassst['lecz'][] = $elem->name;
        });
        $classst->student()->get()->map(function (Object $elem) use (&$resultClassst) {
            $resultClassst['studen'][] = $elem->name;
        });
        return (array)$resultClassst;
    }


    public function save(ClassstRequest $request, ?int $id = 0): Object
    {
        if ($id) {
            $req = (array)$request->all();
            $lecture_id = (isset($req['lecture'])) ? (int)$req['lecture'] : 0;
            $parent = (isset($req['parent'])) ? (int)$req['parent'] : 0;
            $classst = (Object)$this->model::find($id);
            if ($lecture_id) {
                if ($this->lecz->find($lecture_id)) {
                    $lecture = ($classst->lecture()->find($lecture_id)) ?
                        (Object)$classst->lecture()->find($lecture_id) : null;
                    if ($lecture) {
                        $lecture->pivot->parent = $parent;
                        $lecture->pivot->update();
                    } else {
                        DB::insert("INSERT INTO plans (classst_id,lecture_id,parent)
                           values (?,?,?)", [$id, $lecture_id, $parent]);
                    }
                }
            }
        } else {
            $classst = (Object)new $this->model;
        }
        $classst->fill($request->only($classst->getFillable()));
        $classst->save();
        return (Object)$classst;
    }

    public function saveStudent(Object $student): void
    {
        if (count($student)) {
            $student->toQuery()->update([
                'classst_id' => 0,
            ]);
        }
    }
}
