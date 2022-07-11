<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\City;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\CssSelector\Parser\Reader;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //SELECT * FROM admins
        $admins = Admin::all();
        return response()->view('cms.admins.index',['admins' => $admins]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $cities = City::where('active','=',true)->get();
        return response()->view('cms.admins.create',['cities' => $cities]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //dd($request->all());
        $validator = Validator($request -> all(),[
            'city_id' =>'required|numeric|exists:cities,id',
            'name' => 'required|string|min:3',
            'email' => 'required|string|unique:admins,email',
            'active' => 'required|boolean',


        ]); 
        if(!$validator-> fails()){
            $admin = new Admin();
            $admin->name = $request->input('name');
            $admin->email = $request->input('email');
            $admin->password = Hash::make(12345);
            $admin->city_id = $request->input('city_id');
            $admin->active = $request->input('active');
            $isSaved = $admin->save();
            return response()->json([
                'message'=> $isSaved ? 'Saved Successfuly ' : ' Saved Failed '
            ], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
             
        }else {
            return response()->json(['message'=>$validator->getMessageBag()->first() ],
             Response::HTTP_BAD_REQUEST);
            
        }

        /* */
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
        $cities = City::Where('active','=',true)->get();
        return response()->view('cms.admins.edit',['admin'=>$admin,'cities'=>$cities]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
        $validator = Validator($request->all(),[
            'city_id'=> 'required|numeric|exists:cities,id',
            'name'=> 'required|string|min:3',
            'email'=> 'required|email|unique:admins,email,'.$admin->id,
            'active'=> 'required|boolean',

        ]);

        if(!$validator->fails()){
            $admin->name = $request->input('name');
            $admin->email = $request->input('email');
            $admin->active = $request->input('active');
            $admin->city_id = $request->input('city_id');
            $isSaved = $admin->save();
            return response()->json([
                'message'=> $isSaved ? 'Saved Successfuly ' : ' Saved Failed '],
                  $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        }else{
            return response()->json(
                ['message'=>$validator->getMessageBag()->first() ],
            Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
        $deleted = $admin->delete();
        return response()->json([
            'icon'=>  $deleted ? 'success': 'error', 
            'tittle'=> $deleted ? 'Deleted successfully': 'Deleted Failed',
            'message'=> $deleted ? 'Item delted permenantly': 'Item delted failed',
        ], $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
