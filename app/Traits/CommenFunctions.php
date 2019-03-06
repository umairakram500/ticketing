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

        /*$baselen = count($base);
        if ($baselen == 0) {
            return;
        }
        if ($n == 1) {
            $return = array();
            foreach ($base as $b) {
                $return[] = array($b);
            }
            return $return;
        } else {
            //get one level lower combinations
            $oneLevelLower = $this->getCombinations($base, $n - 1);

            //for every one level lower combinations add one element to them that the last element of a combination is preceeded by the element which follows it in base array if there is none, does not add
            $newCombs = array();

            foreach ($oneLevelLower as $oll) {

                $lastEl = $oll[$n - 2];
                $found = false;
                foreach ($base as $key => $b) {
                    if ($b == $lastEl) {
                        $found = true;
                        continue;
                        //last element found

                    }
                    if ($found == true) {
                        //add to combinations with last element
                        if ($key < $baselen) {

                            $tmp = $oll;
                            $newCombination = array_slice($tmp, 0);
                            $newCombination[] = $b;
                            $newCombs[] = array_slice($newCombination, 0);
                        }

                    }
                }

            }

        }

        return $newCombs;*/

        $newCombs = array();

        if(count($base)){
            foreach($base as $i){
                foreach($base as $d){
                    if($i != $d)
                        $newCombs[] = array($i, $d);
                }
            }
        }

        return $newCombs;
    }

}