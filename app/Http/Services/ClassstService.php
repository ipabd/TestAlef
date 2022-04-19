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
            $resultClassst['lecz'][] = $elem->name . '_' . $elem->pivot->parent;
        });
        $classst->student()->get()->map(function (Object $elem) use (&$resultClassst) {
            $resultClassst['studen'][] = $elem->name;
        });
//        dump($resultClassst);
        return (array)$resultClassst;
    }


    public function save(ClassstRequest $request, ?int $id = 0): Object
    {
        if ($id) {
            $req = (array)$request->all();
            $lecture_id = (isset($req['lecture'])) ? (int)$req['lecture'] : 0;
            $parent = (isset($req['parent'])) ? (int)$req['parent'] : 0;
            $classst = (Object)$this->model::find($id);
            if ($lecture_id && $parent > 1) {
                if ($this->lecz->find($lecture_id)) {
                    $lecture = (Object)$classst->lecture()->get()->where('id', $lecture_id);
                    if (count($lecture)) {
                        $lecture->map(function (Object $elem) use (&$parent) {
                            $id = (int)$elem->pivot->id;
                            DB::update("UPDATE plans  SET parent = ? WHERE id=?", [$parent++, $id]);
                        });
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
