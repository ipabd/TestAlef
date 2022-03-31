<?php
/**
 * Created by PhpStorm.
 * User: master
 * Date: 29.03.2022
 * Time: 18:24
 */

namespace App\Http\Services;
use App\Http\Requests\PlanRequest;
use App\Models\Plan;

class PlanService
{

    public function getShow($classst)
    {
        $resultPlan = [];
        $plan= Plan::with('lecture')->where('classst_id',$classst->id)->
           orderBy('parent')->get();
        $plan->each(function ($item, $key) use (&$resultPlan,$classst) {
            $resultPlan['classst']=$classst->name;
            $collection=$item->lecture()->get();
            foreach ($collection as $i=> $col) {
                $resultPlan['lecture'][] =[$col->name,$item->parent];
            }
        });
        return $resultPlan;
    }


    public function save(PlanRequest $request,  Plan $plan)
    {
        $plan->fill($request->only($plan->getFillable()));
        $plan->save();
        return $plan;
    }
}