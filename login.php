<?php
session_start(); //eak session start hoga jo admin ka data store karle rakhega jese email and passs
include "config.php";

$message = "";   //succesfull ka message aayega yaha 

if (isset($_POST['login'])) {  // aagar login par click kara hai to

    $email = $_POST['email'];  //email and password jo admin ne banaya hai vo input lo
    $pass  = $_POST['password'];

    
    if ($email == "" || $pass == "") {  //check karo ki koi feild khali to nhi raha gai hai
        $message = "Please enter both email and password.";
    } else {

      
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ? AND role = 'user'"); //the email and pass created by admin are stored in database were now been checked by this in a sequre way by applying stmt for preventing sql injections
        $stmt->bind_param("ss", $email, $pass);
        $stmt->execute();
        $result = $stmt->get_result();

       
        if ($result->num_rows === 1) {  //check ki result me jo value hai vo equal hai kya kisi row mw databse ke if 1==1 then userdashboard open ho jayega..
            $_SESSION['user'] = $email;  // ye yaad rakhega ki user iss mail se login hua tha.
            header("Location: user_dashboard.php"); //user ka dashboard aa jayega
            exit;
        } else {
            $message = "Invalid Email or Password!";
        }
    }
}
?>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>my project</title>
</head>
<body>

<h2>User Login</h2>

<!-- Show error message -->
<p style="color:red;"><?php echo $message; ?></p>

<form method="POST">
    Email: <input type="email" name="email" required><br><br>

    Password: <input type="password" name="password" required><br><br>

    <button name="login">Login</button>
</form>

</body>
</html>
