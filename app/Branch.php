<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $guarded = [];

    protected $appends = ['full_name'];

    public function getFullNameAttribute(){

        return $this->name. ' ('.$this->code.')';
    }
}
