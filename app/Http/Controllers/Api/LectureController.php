<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Lecture;
use App\Http\Services\LectureService;
use App\Http\Services\ResponseServise;
use App\Http\Requests\LectureRequest;

class LectureController extends Controller
{
    private Object $service;

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
        if (count(Lecture::all()))
            return ResponseServise::sendJsonResponse(true, 200, [], [
                'items' => $this->service->getLecture()
            ]);
        else
            return ResponseServise::notFound();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(LectureRequest $request)
    {
        $request->validate($request->rules());
        $item = $this->service->save($request);
        return ResponseServise::sendJsonResponse(true, 200, [], [
            'item' => $item->toArray()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $lecture = Lecture::find($id);
        if ($lecture)
            return ResponseServise::sendJsonResponse(true, 200, [], [
                'item' => $this->service->getShow($id)
            ]);
        else
            return ResponseServise::notFound();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(LectureRequest $request, int $id)
    {
        $lecture = Lecture::find($id);
        if (!$lecture) return ResponseServise::notFound();
        $request->validate($request->rules());
        $item = $this->service->save($request, $id);
        return ResponseServise::sendJsonResponse(true, 200, [], [
            'item' => $item->toArray()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $lecture = Lecture::find($id);
        if (!$lecture) return ResponseServise::notFound();
        $lecture->delete();
        return ResponseServise::sendJsonResponse(true, 200, [], [
            'item' => $lecture
        ]);
    }
}
