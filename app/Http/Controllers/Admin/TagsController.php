<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\DataTables\TagDatatable;
use App\Http\Controllers\Controller;
use App\Tag;
class TagsController extends Controller
{
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TagDatatable $admin)
    {
        //
        return $admin->render('admin.tags.index',['title'=>'Tags dashboard']);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.tags.create', ['title' => trans('admin.add')]);
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
        Tag::create($data);
        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('tags'));
    }

    public function edit($id) {
        $tag  = Tag::find($id);
        $title = trans('admin.edit');
        return view('admin.tags.edit', compact('tag', 'title'));
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
                
                'slug'    => 'required|unique:tags,slug,'.$id,
            ], [], [
                'name'     => trans('admin.name'),
                'slug'    => trans('admin.slug'),
               
            ]);
        $data['slug'] = str_slug($data['name']);
        Tag::where('id', $id)->update($data);
        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('tags'));
    }
    public function destroy($id) {
        Tag::find($id)->delete();
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('tags'));
    }

}