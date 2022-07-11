<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
// ************* before laravel-9 ***********

// public function getActiveKeyAttribute (){
//     return  $this->active ? 'Active': 'IN-Active' ;  
// }
//Attribute make as  set and get

//*************laravl-9***********
    public function activeKey(): Attribute {
        return new Attribute(get: fn()=> $this->active ? 'Active': 'IN-Active');  
    }

    public function genderKey(): Attribute {
        return new Attribute(get: fn()=> $this->gender == 'M' ? 'Male' : 'Female');  
    }
}
