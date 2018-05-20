<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\CategoriesTableDataTable;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CategoriesTableDataTable $admin)
    {
        //
        return $admin->render('admin.categories.index',['title'=>'categories dashboard']);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.categories.create', ['title' => trans('admin.add')]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store() {
        $data = $this->validate(request(),
            [
                'name'     => 'required',
                'description'=>''
                
            ], [], [
                'name'     => trans('admin.name'),
           
        ]);
       $data['slug'] = str_slug($data['name']);
        category::create($data);
        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('categories'));
    }

    public function edit($id) {
        $category  = category::find($id);
        $title = trans('admin.edit');
        return view('admin.categories.edit', compact('category', 'title'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $r, $id) {

        $data = $this->validate(request(),
            [
                'name'     => 'required',
                
                'slug'    => 'required|unique:categories,slug,'.$id,
            ], [], [
                'name'     => trans('admin.name'),
                'slug'    => trans('admin.slug'),
               
            ]);
        $data['slug'] = str_slug($data['name']);
        category::where('id', $id)->update($data);
        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('categories'));
    }
    public function destroy($id) {
        category::find($id)->delete();
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('categories'));
    }
}
