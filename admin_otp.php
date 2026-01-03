<?php // php ki starting
session_start(); //eak session start hoga jisme temporarly data store hoga. Taki aage wale page ya aagr us page me hi vo data kaam aaye to vaha aapan use kar sake usko


if (!isset($_SESSION['admin_otp'])) { //direct otp page pe aane se rokega aagar bina login kare pahuch gaya to
    header("Location: admin_login.php");
    exit; //hata do user ko yaha se
}

$error = "";  //error store karega jisme inital empty hai.

if (isset($_POST['verify'])) {  //aagar verify button press kara hai to

    
    $enteredOtp = $_POST['otp']; //entered opt ko is  variable me store karwa diya hai

    
    if ($enteredOtp == $_SESSION['admin_otp']) {  //check ho rha hai kin entered otp and session me jo otp hai vo same hai kya?.

       
        $_SESSION['admin'] = $_SESSION['admin_email']; //ye admin ke login me baad mark kar rha hai ki ye wala admin login hai ya ho gaya hai.

       
        unset($_SESSION['admin_otp']);  //aab ye otp koi dusara na use kare to isko dtl kar do

        
        header("Location: admin_dashboard.php");  //iske baad amindashboard par le jao
        exit; //hat jao

    } else {
        $error = "Wrong OTP. Please try again.";  //error variable me ye store karwa do aagar koi error aaye to ye display ho jana chahiye
    }
}
?> //php over closed
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>my project</title>
</head>
<body>

<h2>Enter OTP</h2>


<?php if ($error != "") { echo "<p style='color:red;'>$error</p>"; } ?>  // aagar koi error hai to error wale variable me jo statement store karwaa tha vo red colour ki css me dikha do.

<form method="POST">
    OTP: <input type="number" name="otp" required><br><br>
    <button name="verify">Verify</button>
</form>

</body>
</html>
