<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClassstRequest;
use App\Http\Services\ClassstService;
use App\Http\Services\ResponseServise;
use App\Models\Classst;


class ClassstController extends Controller
{
    private $service;
    public function __construct(ClassstService $classstService)
    {
        $this->service = $classstService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ResponseServise::sendJsonResponse(true, 200,[],[
            'items' =>  $this->service->getClassst()
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClassstRequest $request)
    {
        $item = $this->service->save($request, new Classst());
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
            'item' =>   $this->service->getShow($classst->id)
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClassstRequest $request, Classst $classst)
    {
        $item = $this->service->save($request, $classst);
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
    public function destroy(Classst $classst)
    {
        $classst->saveStudent($classst->student()->get());
        $classst->delete();
        return ResponseServise::sendJsonResponse(true, 200,[],[
            'item' =>  $classst
        ]);
    }
}
