<?php
/**
 * Created by PhpStorm.
 * User: master
 * Date: 29.03.2022
 * Time: 18:24
 */

namespace App\Http\Services;
use App\Http\Requests\StudentRequest;
use App\Models\Student;

class StudentService
{
    public function getStudent()
    {
        $resultStudent = [];
        $student= Student::with('classst:id,name')->get();
        $resultStudent[] = $student->map(function($elem) {
            $cl=$elem->classst()->get()->map(function($el){
                return $el->name;
            });
            return ['name'=>$elem->name,'email'=>$elem->email,'classst'=>$cl->first()];
        });
        return $resultStudent;
    }

    public function getShow($id)
    {
        $resultStudent = [];
        $student= Student::with('classst:id,name')->where('id',$id)->get();
        $student->each(function ($item, $key) use (&$resultStudent) {
            $resultStudent['student']=['name'=>$item->name,'email'=>$item->email];
            $collection=$item->classst()->get();
            foreach ($collection as $i=> $col) {
                $collectionst=$col->lecture()->get();
                $resultStudent['student']['classst']=$col->name;
                $resultStudent['lecture'] = $collectionst->map(function($elem) {
                    return $elem->name;
                });
            }
        });
        return $resultStudent;
    }


    public function save( StudentRequest $request,  Student $student)
    {
        $student->fill($request->only($student->getFillable()));
        $student->save();
        return $student;
    }
}