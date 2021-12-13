<?php

$db = new mysqli("localhost","root","","phpoop");

// Check

if($db->connect_errno){
 echo"Failed";
 exit();
}