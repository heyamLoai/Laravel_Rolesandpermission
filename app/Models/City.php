<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

 /**
     * Create a new attribute accessor / mutator.
     *
     * @param  callable|null  $get
     * @param  callable|null  $set
     * @return void
     */
class City extends Model
{

    use HasFactory;

    
    protected $appeends = ['active_Key'];

    public function getActiveKeyAttribute(){
        return $this->active ? 'active': 'IN-Active';

    }

    // public function activeKey(){
    //     return new Attribute(get: fn () => '');

    // }
}
