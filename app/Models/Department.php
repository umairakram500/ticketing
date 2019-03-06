<?php

namespace App\Models;

use App\Traits\OptionsTrait;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use OptionsTrait;

    public static function boot()
    {
        parent::boot();

        /*static::deleting(function($invoice) {
            $invoice->payments()->delete();

        });*/
    }


    public function users(){
        $this->hasMany(User::class, 'dept_id');
    }
}
