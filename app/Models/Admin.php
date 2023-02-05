<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable implements MustVerifyEmail 
{
    use HasFactory, HasRoles,Notifiable;
// ************* before laravel-9 ***********

// public function getActiveKeyAttribute (){
//     return  $this->active ? 'Active': 'IN-Active' ;  
// }
//Attribute make as  set and get

//*************laravl-9***********


public function userName(): Attribute {
    return new Attribute(get: fn() => $this->name);
}

    public function activeKey(): Attribute {
        return new Attribute(get: fn()=> $this->active ? 'Active': 'IN-Active');  
    }

    public function genderKey(): Attribute {
        return new Attribute(get: fn()=> $this->gender == 'M' ? 'Male' : 'Female');  
    }
}
