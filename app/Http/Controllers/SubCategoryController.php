<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $subCategories = SubCategory::all();

        return response()->view('cms.sub_categories.index',['subCategories'=>$subCategories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
        return response()->view('cms.categories.create', ['categories'=>'$categories']);

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
            'category_id' => 'required|numeric|exists:categories,id',
            'name' => 'required|string',


        ]); 
        if(!$validator-> fails()){
            $subCategory = new SubCategory();
            $subCategory->name = $request->input('name');
            $subCategory->category_id = $request->input('category_id');

            $isSaved = $subCategory->save();
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
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategory $subCategory)
    {
        //
        $categories = Category::all();
        return response()->view('cms.sub_categories.edit',['subCategory'=> $subCategory, 'categories'=>'categories']);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubCategory $subCategory)
    {
        //
        $validator = Validator($request -> all(),[
            'category_id' => 'required|numeric|exists:categories,id',
            'name' => 'required|string',


        ]); 
        if(!$validator-> fails()){
            $subCategory->name = $request->input('name');
            $subCategory->category_id = $request->input('category_id');

            $isSaved = $subCategory->save();
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
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCategory $subCategory)
    {
        //
    }
}
