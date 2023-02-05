<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Category::all();

        return response()->view('cms.categories.index',['categories'=>$categories]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return response()->view('cms.categories.create');


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
        $validator = Validator($request -> all(),[
            'name' => 'required|string',


        ]); 
        if(!$validator-> fails()){
            $category = new Category();
            $category->name = $request->input('name');
            $isSaved = $category->save();
            return response()->json([
                'message'=> $isSaved ? 'Saved Successfuly ' : ' Saved Failed '
            ], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
             
        }else {
            return response()->json(['message'=>$validator->getMessageBag()->first() ],
             Response::HTTP_BAD_REQUEST);
            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
        $subCategories = $category->subCategories;
        return response()->json(['subCategories'=>$subCategories]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
        return response()->view('cms.categories.edit',['category'=> $category,]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
        $validator = Validator($request -> all(),[
            'name' => 'required|string',


        ]); 
        if(!$validator-> fails()){
            $category->name = $request->input('name');
            $isSaved = $category->save();
            return response()->json([
                'message'=> $isSaved ? 'Updated Successfuly ' : ' Updated Failed '
            ], $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
             
        }else {
            return response()->json(['message'=>$validator->getMessageBag()->first() ],
             Response::HTTP_BAD_REQUEST);
            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
        $deleted = $category->delete();
        return response()->json([
            'message'=> $deleted ? 'Deleted successfully': 'Deleted Failed',
        ], $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
