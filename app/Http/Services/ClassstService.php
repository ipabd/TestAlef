<?php
/**
 * Created by PhpStorm.
 * User: master
 * Date: 29.03.2022
 * Time: 18:24
 */

namespace App\Http\Services;
use App\Http\Requests\ClassstRequest;
use App\Models\Classst;

class ClassstService
{
    public function getClassst()
    {   $resultClassst = [];
        $classst= Classst::get();
        $resultClassst[] = $classst->map(function($elem) {
            return $elem->name;
        });
        return $resultClassst;
    }

    public function getShow($id)
    {
        $resultClassst = [];
        $classst= Classst::with('student:classst_id,name,email')->where('id',$id)->get();
        $classst->each(function ($item, $key) use (&$resultClassst) {
            $collection=$item->lecture()->get();
            $resultClassst['lecture'] = $collection->map(function($elem) {
                return $elem->name;
            });
            $resultClassst['student'] = $item->student->map(function($elem) {
                return $elem->name;
            });
        });
        return $resultClassst;
    }


    public function save(ClassstRequest $request,  Classst $classst)
    {
        $classst->fill($request->only($classst->getFillable()));
        $classst->save();
        return $classst;
    }
}