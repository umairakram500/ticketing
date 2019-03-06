<?php

namespace App\Models;

use App\Traits\OptionsTrait;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use OptionsTrait;

    public function users(){
        $this->hasMany(User::class, 'design_id');
    }

    public function delete()
    {
        if($this->users()->count()){
            $error = true;
            $msg = 'You can\'t delete because Designation belongs to other data';
        } else {
            $error = false;
            $msg = 'Designation deleted successfully';
            parent::delete();
        }
        return array('error'=>$error, 'msg' => $msg);
    }
}
