<?php
/**************************************************
*  Created:  2010-06-13
*
*  数组排列
*
*  @Author chuxuwang(chuxuwang@gmail.com)
*  
***************************************************/
function multi_array_sort($multi_array,$sort_key,$sort=SORT_ASC){
    if(is_array($multi_array)){
        foreach ($multi_array as $row_array){
            if(is_array($row_array)){
                $key_array[] = $row_array[$sort_key];
            }else{
                return -1;
            }
        }
    }else{
        return -1;
    }
    array_multisort($key_array,$sort,$multi_array);
    return $multi_array;
}
?>
