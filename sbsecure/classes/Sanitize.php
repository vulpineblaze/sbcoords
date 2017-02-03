<?php

/************************************
* 	Name your datum   $value
* 	Use include("classes/Sanitize.php");
*	Make $original = $value
*			Robert'); DROP TABLE Students;-- .,
*************************************/

#$value=str_ireplace("'","\'",$value);
#$value=str_ireplace('"',"\"",$value);
#$value=str_ireplace(";","\;",$value);
#$value=str_ireplace("');"," ",$value);
#$value=str_ireplace(");"," ",$value);
#$value=str_ireplace("};"," ",$value);
#$value=str_ireplace("\'\)\;"," ",$value);
#$value=str_ireplace("\)\;"," ",$value);
#$value=str_ireplace("\}\;"," ",$value);
#$value=str_ireplace(";--"," ",$value);
#$value=str_ireplace("DROP TABLE"," ",$value);
$value=preg_replace('/[^a-zA-Z0-9\.\,\-\+\'\"\:\;\\\!\#\%\&\(\)\/\s]/', ' ', $value);

?>