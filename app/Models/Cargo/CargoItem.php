<?php

namespace App\Models\Cargo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class CargoItem extends Model
{
    //use SoftDeletes;

    protected $table = 'cargo_items';

    protected $fillable = [
        'cargo_id', 'category_id', 'goods_type_id','packing_type_id', 'qty', 'weight', 'remarks'
    ];

    /*
     * Set the logged in user id on resource create in DB
     * */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($query) {
            $query->company_id = 1;
            $query->user_id = Auth::user()->id;
        });
    }

    public function newQuery()
    {
        return parent::newQuery()->where([
            ['company_id', 1],
            //['terminal_id', Auth::user()->terminal_id]
        ]);
    }

    /*----------------  Relations  ----------------*/

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function goodsType(){
        return $this->belongsTo(GoodsType::class);
    }

    public function packingType(){
        return $this->belongsTo(PackingType::class);
    }

    public function cargo(){
        return $this->belongsTo(Cargo::class, 'cargo_id');
    }


}
