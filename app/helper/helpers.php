<?php 
function getYears(){

    for($i=1969;$i<=date("Y");$i++){
        $years[$i] =$i;
    }
    return $years;
}