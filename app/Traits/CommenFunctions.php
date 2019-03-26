<?php
namespace App\Traits;

Trait CommenFunctions
{

    public function toSelect($data, $val = 'title', $id = 'id')
    {
        //$bus_types = BusType::addSelect(['id', 'title'])->where('status', 1)->get()->toArray();

        return (is_array($data) && count($data) )? array_combine(array_column($data, $id), array_column($data, $val))
            : array();
    }

    function getCombinations($base, $n = 0)
    {

        $newCombs = array();
        //dd($base);
        if(count($base)){
            foreach($base as $ik => $i){
                for($d=$ik; $d<count($base); $d++){
                    if($i != $base[$d])
                        $newCombs[] = array($i, $base[$d]);
                }
                /*foreach($base as $dk => $d){
                    if($i != $d)
                        $newCombs[] = array($i, $d);
                }*/
            }
        }

        return $newCombs;
    }

}