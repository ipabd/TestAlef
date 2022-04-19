<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClassstRequest;
use App\Http\Services\ClassstService;
use App\Http\Services\ResponseServise;
use App\Models\Classst;


class ClassstController extends Controller
{
    private Object $service ;

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
        if (count(Classst::all()))
            return ResponseServise::sendJsonResponse(true, 200, [], [
                'items' => $this->service->getClassst()
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
    public function store(ClassstRequest $request)
    {
        //die();
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
        $classst = Classst::find($id);
        if ($classst)
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
    public function update(ClassstRequest $request, int $id)
    {
        $classst = Classst::find($id);
        if (!$classst) return ResponseServise::notFound();
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
        $classst = Classst::find($id);
        if (!$classst) return ResponseServise::notFound();
        $this->service->saveStudent($classst->student()->get());
        $classst->delete();
        return ResponseServise::sendJsonResponse(true, 200, [], [
            'item' => $classst
        ]);
    }
}
