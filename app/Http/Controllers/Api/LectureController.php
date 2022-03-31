<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lecture;
use App\Http\Services\LectureService;
use App\Http\Services\ResponseServise;
use App\Http\Requests\LectureRequest;

class LectureController extends Controller
{
    private $service;
    public function __construct(LectureService $lectureService)
    {
        $this->service = $lectureService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ResponseServise::sendJsonResponse(true, 200,[],[
            'items' =>  $this->service->getLecture()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(LectureRequest $request)
    {
        $item = $this->service->save($request, new Lecture());
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
    public function show(Lecture $lecture)
    {
        return ResponseServise::sendJsonResponse(true, 200,[],[
            'item' =>   $this->service->getShow($lecture->id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LectureRequest $request, Lecture $lecture)
    {
        $item = $this->service->save($request, $lecture);
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
    public function destroy(Lecture $lecture)
    {
        $lecture->delete();
        return ResponseServise::sendJsonResponse(true, 200,[],[
            'item' =>  $lecture
        ]);
    }
}
