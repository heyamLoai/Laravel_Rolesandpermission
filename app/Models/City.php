<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{

    use HasFactory;

    
    protected $appeends = ['active_Key'];

    public function getActiveKeyAttribute(){
        return $this->active ? 'active': 'IN-Active';

    }
}
