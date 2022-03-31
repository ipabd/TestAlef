<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Http\Services\ResponseServise;
use App\Http\Services\StudentService;
use App\Models\Student;


class StudentController extends Controller
{
    private $service;
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
        return ResponseServise::sendJsonResponse(true, 200,[],[
            'items' =>  $this->service->getStudent()
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(StudentRequest $request)
    {
        $item = $this->service->save($request, new Student());
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

    public function show(Student $student)
    {
        return ResponseServise::sendJsonResponse(true, 200,[],[
            'item' =>   $this->service->getShow($student->id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StudentRequest $request, Student $student)
    {
        $item = $this->service->save($request, $student);
        return ResponseServise::sendJsonResponse(true, 200,[],[
            'item' =>  $item->toArray()
        ]);
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return ResponseServise::sendJsonResponse(true, 200,[],[
            'item' =>  $student
        ]);
    }
}
