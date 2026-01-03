<?php
$host = "localhost";  //  jo server host use me le rhe hai jisse sql and website eak hi machine par chal sake 
$user = "root"; //by default username given by xampp server
$pass = ""; //by default empty password by xampp taki development setup ke time koi problem na aaye
$db = "company_login"; //database ka naam jo xampp server  me diya hai

$conn = new mysqli($host, $user, $pass, $db); //eak naya conn banata hai table ke sath with php code and mysql database ke sath



if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
 //aagar koi error ho to usko display karega.
    //die jo hai vo imediate rok deta hai koi bhi process ko chalte

?>
