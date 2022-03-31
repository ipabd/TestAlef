<?php
/**
 * Created by PhpStorm.
 * User: master
 * Date: 29.03.2022
 * Time: 18:24
 */

namespace App\Http\Services;
use App\Http\Requests\LectureRequest;
use App\Models\Lecture;


class LectureService
{
    public function getLecture()
    {
        $resultLecture = [];
        $lecture= Lecture::all();
        $resultLecture[] = $lecture->map(function($elem) {
            return ['name'=>$elem->name,'description'=>$elem->description];
        });
        return $resultLecture;
    }

    public function getShow($id)
    {
        $resultLecture = [];
        $lecture= Lecture::where('id',$id)->get();
        $lecture->each(function ($item, $key) use (&$resultLecture) {
            $resultLecture['lecture']=['name'=>$item->name,'description'=>$item->description];
            $collection=$item->classst()->get();
            foreach ($collection as $i=> $col) {
                $resultLecture['classst'][]=$col->name;
                $collectionst=$col->student()->get();
                $st = $collectionst->map(function($elem) {
                    return $elem->name;
                });
                foreach ($st->all() as $ii=> $s) {
                    $resultLecture['student'][]=$s;
                }
            }
        });
        return $resultLecture;
    }


    public function save(LectureRequest $request,  Lecture $lecture)
    {
        $lecture->fill($request->only($lecture->getFillable()));
        $lecture->save();
        return $lecture;
    }
}