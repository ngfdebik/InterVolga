<?php

$a = 100;
$arr = array(1,2,42,30,54,22);

print_r($arr);                  //изначальный массив

print_r(insert($a, $arr));      //конечный массив

function insert($a, $arr, $num = 2){                    //вставляет после элементов содержащих 2, $a
    $arr = resizeArray($arr, $num);                     
    for ($i = count($arr)-1; $i >= 0; $i--){
        if(is_int(strpos($arr[$i], (string)$num))){
            $arr = swapElemenst($arr, $i);
            $arr[$i+1] = $a; 
        }
    }
    return $arr;
}

function resizeArray($arr, $num){                       //функция изменяет размер массива 
    $lengthAttay = count($arr);                         //добавляя в его конец столько null елементов, сколько
    foreach ($arr as &$value){                          //его элементов содержат в себе цифру 2
        if(is_int(strpos($value, (string)$num))){
            $lengthAttay++;
        }
    }
    return array_pad($arr, $lengthAttay, null);
}

function swapElemenst($arr, $index){                    //меняет местами элементы массива так, чтобы
    for ($i = count($arr)-1; $i >= $index; $i--){       //после элемента с передоваемым индексом был null
        if(!is_null($arr[$i]) && $i != $index){
            $tmp = $arr[$i];
            $arr[$i] = $arr[$i+1];
            $arr[$i+1] = $tmp;
        }
    }
    return $arr;
}



?>