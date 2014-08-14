<?php
/*************************************************************
 * Created: 2010-4-1
 * 
 * 数组变xml
 * 
 * @author chuxuwang(chuxuwang@shenpang.cc)
 **************************************************************/
class array2xml {
        var $xml;
        function array2xml($array,$encoding='utf8') {
                $this->xml='<?xml version="1.0" encoding="UTF-8"?>';
                $this->xml.="<statuses>";
                $this->xml.=$this->_array2xml($array);
                $this->xml.="</statuses>";
               
        }
        function getXml() {
                return $this->xml;
        }
        function _array2xml($array) {
        	    $xml='';
                foreach($array as $key=>$val) {
                	   
                        is_numeric($key)&&$key="status";
                        if(!is_numeric($key)&&count($array)>1){$xml.="<$key>";
                        $xml.=is_array($val)?$this->_array2xml($val):$val;
                        list($key,)=explode(' ',$key);
                        $xml.="</$key>";}
                }
                return $xml;
        }
}
?>