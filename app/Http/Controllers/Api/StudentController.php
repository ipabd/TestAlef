<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Http\Services\ResponseServise;
use App\Http\Services\StudentService;
use App\Models\Student;


class StudentController extends Controller
{
    private  Object $service;

    public function __construct(StudentService $studentService)
    {
        $this->service = $studentService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (count(Student::all()))
            return ResponseServise::sendJsonResponse(true, 200, [], [
                'items' => $this->service->getStudent()
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

    public function store(StudentRequest $request)
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
        $student = Student::find($id);
        if ($student)
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
    public function update(StudentRequest $request,int $id)
    {
        $student = Student::find($id);
        if (!$student) return ResponseServise::notFound();
        $request->validate($request->rules());
        $item = $this->service->save($request, $id);
        return ResponseServise::sendJsonResponse(true, 200, [], [
            'item' => $item->toArray()
        ]);
    }

    public function destroy(int $id)
    {
        $student = Student::find($id);
        if (!$student) return ResponseServise::notFound();
        $student->delete();
        return ResponseServise::sendJsonResponse(true, 200, [], [
            'item' => $student
        ]);
    }
}
