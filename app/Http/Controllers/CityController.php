<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        //$cities= DB::select('SELECT * FROM cities');
        //$cities= DB::table('cities')->get();
          $cities= City::all();

        //
        return response()->view('cms.cities.index',['cities' => $cities]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return response()->view('cms.cities.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // echo "nnnn";
        // dd($request->all);

        //لتحقق من البيانات 
            $request->validate([
                'name_en' =>     'required|String|min:3|max:100',
                'name_ar' => 'required|String|min:3|max:100',
                'active' => 'nullable|String|in:on',

                
            ],['name_en.min'=> 'please, city name must be at least 3 characters'],
            ['name_en.required'=> 'You must Enter city name' ] );

        $city = new City();
        $city->name_en = $request->input('name_en');
        $city->name_ar = $request->input('name_ar');
        $city->active = $request->has('active');
        $isSaved =$city->save();


          
 
        if($isSaved){
            // return redirect()->route('cities.index');
            session()->flash('message','City Created successufuly');
            return redirect()->back();


        } else {
           return redirect()->back();
            

        }

      

     


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        //
        return response()->view('cms.cities.edit',['city'=>$city]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        //
        $request->validate([
            'name_en' =>     'required|String|min:3|max:100',
            'name_ar' => 'required|String|min:3|max:100',
            'active' => 'nullable|String|in:on',
        ]);

        $city->name_en = $request->input('name_en');
        $city->name_ar = $request->input('name_ar');
        $city->active = $request->has('active');
        $isSaved =$city->save();


          
  
        if($isSaved){
            return redirect()->route('cities.index');

        } else {
           return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City  $city)
    {
        //

        // isDeleted = DB::delete('DELETE FROM cities where id = ?', [$id]);
        // isDeleted = DB::table('cities'->delete($id));
        $isDelted = $city->delete();
        return redirect()->route('cities.index');



    }
}
