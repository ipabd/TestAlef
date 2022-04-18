<?php
namespace App\Http\Services;

use App\Http\Requests\LectureRequest;
use App\Models\Lecture;
use Prophecy\Argument\Token\ObjectStateToken;


class LectureService
{
protected Object $model;

    public function __construct(Lecture $lecture)
    {
        $this->model = $lecture;
    }

    public function getLecture(): array
    {
        $resultLecture = (array)[];
        $this->model::all()->map(function (Object $elem) use (&$resultLecture) {
            $resultLecture[] = $elem->name;
        });
        return (array)$resultLecture;
    }

    public function getShow(int $id): array
    {
        $resultLecture = (array)[];
        $lecture = $this->model::findOrFail($id);
        $lecture->classst()->get()->map(function (Object $elem) use (&$resultLecture) {
            $resultLecture['class'][] = $elem->name;
            $elem->student()->get()->map(function (Object $el) use (&$resultLecture) {
                $resultLecture['sduden'][] = $el->name;
            });
        });
        return (array)$resultLecture;
    }


    public function save(LectureRequest $request, ?int $id = 0): Object
    {
        $lecture = (!$id) ? new $this->model : $this->model::find($id);
        $lecture->fill($request->only($lecture->getFillable()));
        $lecture->save();
        return (Object)$lecture;
    }
}
