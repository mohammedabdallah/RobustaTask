<?php

namespace App\Http\Controllers\Admin\API;
use App\DataTables\DepartmentDataTable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Department;
class DepartmentsAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DepartmentDataTable $department)
    {
        //
        return $department->render('admin.departments.index', ['title' => 'Departments']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.departments.create', ['title' => trans('admin.add')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $this->validate(request(),
            [
                'title'     => 'required',
                'description'=>'',
                'fixed_salary'=>'required|numeric'
                
            ], [], [
                'name'     => 'title',
           
        ]);
        $result = Department::create($data);
        session()->flash('success', trans('admin.record_added'));
        if($result)
            return response()->json([
                'data'=>$result,
                'Status' => '200',
                'flag' => 'success'
            ]);
        else
            return response()->json([
            'status' => '500',
            'flag' => 'Error'
            ]);
        //return redirect(aurl('departments'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $department  = Department::find($id);
        $title = 'Edit';
        return view('admin.departments.edit', compact('department', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Department::find($id)->delete();
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('departments'));
    }
}
