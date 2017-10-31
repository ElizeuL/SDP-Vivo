<?php


$host = "localhost"; // ORACLE host name eg. localhost
$user = "D_DESDB"; // ORACLE user. eg. root ( if your on localserver)
$pass = "vivo2013"; // ORACLE user password  (if password is not set for your root user then keep it empty )
$database = "MEDQA1"; // ORACLE Database name

$tns ="(DESCRIPTION =(ADDRESS_LIST =(ADDRESS = (PROTOCOL = TCP)(HOST = 10.129.177.215)(PORT = 1521)))(CONNECT_DATA =(SID = MEDQA1)))";

/*
$host = "localhost"; // ORACLE host name eg. localhost
$user = "oracle"; // ORACLE user. eg. root ( if your on localserver)
$pass = "oracle123"; // ORACLE user password  (if password is not set for your root user then keep it empty )
$database = "XE"; // ORACLE Database name

$tns ="(DESCRIPTION =(ADDRESS_LIST =(ADDRESS = (PROTOCOL = TCP)(HOST = 127.0.0.1)(PORT = 1521)))(CONNECT_DATA =(SID = XE)))";
*/

$db = oci_connect($user,$pass,$tns, 'WE8ISO8859P1');

?>