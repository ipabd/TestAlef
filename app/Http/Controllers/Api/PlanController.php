<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlanRequest;
use App\Http\Services\PlanService;
use App\Models\Classst;
use App\Models\Plan;
use App\Http\Services\ResponseServise;

class PlanController extends Controller
{
    private $service;
    public function __construct(PlanService $planService)
    {
        $this->service = $planService;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(PlanRequest $request)
    {
        $item = $this->service->save($request, new Plan());
        return ResponseServise::sendJsonResponse(true, 200,[],[
            'item' =>  $item->toArray()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show(Classst $classst)
    {
        return ResponseServise::sendJsonResponse(true, 200,[],[
            'item' =>   $this->service->getShow($classst)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PlanRequest $request, Plan $plan)
    {
        $item = $this->service->save($request, $plan);
        return ResponseServise::sendJsonResponse(true, 200,[],[
            'item' =>  $item->toArray()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plan $plan)
    {
        $plan->delete();
        return ResponseServise::sendJsonResponse(true, 200,[],[
            'item' =>  $plan
        ]);
    }
}
