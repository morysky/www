<?php
/**
 * MySQL数据库类。
 *
 * 包含数据库的基本操作函数，如(connect,query..)
 * 
 * @version $Rev$ $Date$
 * @author chuxu
 */
class mysql{
	 private $Host="";
	 private $User="";
	 private $Password="";
	 private $DB="";
	 private $dbCharSet="";
	 //==================
	 private $Link_ID=0;    //数据库连接 
	 private $Query_ID=0;   //查询结果
	 private $Row_Result=array();  //结果集成组的数组
	 private $Field_Result=array();  //结果集字段名组成数组
	 private $Affected_row;   //影响行数
	 private $Rows;   //结果集中记录的行数
	 private $Fields;  //结果集字段数
	 private $Row_Position; //记录指针位置索引
	 private $Error;
 
  
 function __construct($dbArr){
	  $this->Host=$dbArr['hostname'];
	  $this->User=$dbArr['username'];
	  $this->Password=$dbArr['password'];
	  $this->DB=$dbArr['db'];
	  $this->dbCharSet=$dbArr['dbcharset'];
 }
 //连接数据库
 private function connect(){
	  if(0 == $this->Link_ID){
		   $this->Link_ID=mysql_connect($this->Host,$this->User,$this->Password);
		   if(!$this->Link_ID){
			    $this->halt("连接数据库服务端失败!");
		   }
		   if(!mysql_select_db($this->DB,$this->Link_ID)){
			    $this->halt("不能打开指定的数据库".$this->DB);
		   }
		   mysql_query("SET NAMES $this->dbCharSet");
	  }
 }
 //查询数据
 function query($Query_string){
	  if($this->Query_ID){
	       $this->free();
	  }
	  if(0 == $this->Link_ID){
	       $this->connect();
	  }
	  $this->Query_ID=mysql_query($Query_string);
	  if(!$this->Query_ID){
	       $this->halt("SQL查询语句出错：".$Query_string);
	  }
	  return $this->Query_ID;
 }
 //将结果集指针指向指定行
 
 function seek($Position){
	  if(@mysql_data_seek($this->Query_ID,$Position)){
	       $this->Row_Position=$Position;
	       return true;
	  }else{
	       $this->halt("定位结果集发生错误");
	       return false;
	  }
 }
 //释放内存
 function free(){
	  if(@mysql_free_result($this->Query_ID)){
	       unset($this->Row_Result);   //释放由结果集组成的数组
	  }
	  $this->QueryID=0;
 }
 //返回结果集记录组成的数组
 function get_rows_array(){
	  $this->get_rows();
	  for($i=0;$i<$this->Rows;$i++){
		   if(!mysql_data_seek($this->Query_ID,$i)){
			    $this->halt("mysql_data_seek查询语句出错");
		   }
		   $this->Row_Result[$i]=mysql_fetch_array($this->Query_ID);
	  }
	  return $this->Row_Result;
 }

 //返回结果集字段组成的数组
 function get_fields_array(){
	  $this->get_fields();
	  for($i=0;$i<$this->Fields;$i++){
	       $obj=mysql_fetch_field($this->Query_ID);
	       $this->Field_Result[$i]=$obj->name;
	  }
	  return $this->Field_Result;
 }
 //返回影响记录数
 function affected_rows(){
	  $this->Affected_row=mysql_affected_rows($this->Link_ID);
	  return $this->Affected_row;
 }
 //返回结果集的记录行数
 public function get_rows(){
	  $this->Rows=mysql_num_rows($this->Query_ID);
	  return $this->Rows;
 }
 //返回结果集字段数
 public function get_fields(){
	  $this->Fields=mysql_num_fields($this->Query_ID);
	  return $this->Fields;
 }
 //执行SQL语句并返回由查询结果中第一行记录组成的数组
 function fetch_one_array($Query_string){
	  $this->query($Query_string);
	  return mysql_fetch_array($this->Query_ID);
 }
 //取得Mysql数据库的版本
 function version(){
    return mysql_get_server_info();
 }
 //打印错误信息
 function halt($msg){
	  $this->Error=mysql_error();
	  printf("<br><b>数据库发生错误：</b>%s<br>\n",$msg);
	  printf("<b>MySQL 返回错误信息:</b> %s <br>\n",$this->Error);
	  die("脚本终止");
 }
 //关闭数据库
 function close(){
	  if(0 != $this->Link_ID){
	        mysql_close($this->Link_ID);
	  }
 }

 function __destruct(){
      $this->close();
 }

}

?>