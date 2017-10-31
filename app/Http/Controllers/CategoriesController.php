<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

use App\Category;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(25);
        return View::make('admin.categories.index',['categories'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('admin.categories.add',[]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newFileName = "";
        if( $request->hasFile('image') ) {
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName().'.'.$file->getClientOriginalExtension();
            $newFileName = time().'.'.$file->getClientOriginalExtension();
            $path = 'uploads/';
            $file = $file->move($path, $newFileName);
        }
        $request->request->add(['file'=>$newFileName]);
        $category = Category::create($request->all());
        return Redirect::route('categories.index');
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
        $category = Category::find($id);
        return View::make('admin.categories.add',['id'=>$id,'category'=>$category]);
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
        $newFileName = "";
        if( $request->hasFile('image') ) {
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName().'.'.$file->getClientOriginalExtension();
            $newFileName = time().'.'.$file->getClientOriginalExtension();
            $path = 'uploads/';
            $file = $file->move($path, $newFileName);
        }else {
            $newFileName = Input::get('filehidden');
        }
        

        $category = Category::find($id);
        $category->name            = Input::get('name');
        $category->description     = Input::get('description');
        $category->status          = Input::get('status');
        $category->file            = $newFileName;
        
        $category->save();
        return Redirect::route('categories.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        // redirect
        //Session::flash('message', 'Successfully deleted the Student!');
        return Redirect::to('categories');
    }
}
