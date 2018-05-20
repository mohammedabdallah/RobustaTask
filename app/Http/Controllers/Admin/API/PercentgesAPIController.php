<?php

namespace App\Http\Controllers\Admin\API;
use App\DataTables\PercentageDataTable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Percentage;
class PercentgesAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PercentageDataTable $percentge)
    {
        //
        return $percentge->render('admin.percentages.index', ['title' => 'Percentges']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.percentages.create', ['title' => trans('admin.add'),'employess'=>\App\Employee::all()]);
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
                'employee_id'     => 'required',
                'percentage'=>'required|numeric',
                
                
            ], [], [
           
        ]);
        Percentage::create($data);
        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('percentages'));
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
        $percentage  = Percentage::find($id);
        $title = 'Edit';
        return view('admin.percentages.edit', compact('percentage', 'title'));
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
         $data = $this->validate(request(),
            [
                'percentage'     => 'required|numeric',
                'employee_id'=>'required'
                
            ], [], [
                
               
            ]);
         $input = $request->all();
        
        Percentage::where('id', $id)->update($data);
        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('percentages'));
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
        Percentage::find($id)->delete();
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('percentages'));

    }
}
