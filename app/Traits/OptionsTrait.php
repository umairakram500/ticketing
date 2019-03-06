<?php
namespace App\Traits;

Trait OptionsTrait
{

    public static function scopeOptions($query, $name = 'title', $id = 'id'){
        return $query->addSelect([$id, $name])->where('status', 1)->get()->toArray();
    }

    public function scopeSelection($query, $val = 'title', $id = 'id')
    {
        $data = $query->addSelect([$id, $val])->where('status', 1)->get()->toArray();

        return (is_array($data) && count($data) )? array_combine(array_column($data, $id), array_column($data, $val))
            : array();
    }

    public function scopeList($query, $val = 'title', $id = 'id')
    {
        $data = $query->addSelect([$id, $val])->where('status', 1)->get()->pluck($val, $id)->toArray();

        return (is_array($data) && count($data) )? $data : array();
    }

}