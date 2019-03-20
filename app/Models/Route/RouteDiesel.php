<?php

namespace App\Models\Route;

use Illuminate\Database\Eloquent\Model;

class RouteDiesel extends Model
{
    protected $fillable = [
        'route_id', 'bustype_id', 'litres'
    ];

    public function route(){
        return $this->belongsTo(Route::class);
    }
}
