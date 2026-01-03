<?php //php ki starting
session_start(); //eak session start hoga jo admin ka data store karle rakhega jese email and passs
include "config.php"; //config file ko include karga

// php  mailer ki file lagai hai 
             //library //class

// stmp mail send karta hai aapne rules ke hisab se php mailer stmp ko bolta hai ki bhai eak mail bhejani hai or usko vo mail deta hai jo bhejani hai stmp vo mail bhejata hai or bolta hai done bhej di
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/Exception.php'; //require= extrenal file ko lagane ke liye. 
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if (isset($_POST['login'])) { //aagar login butoon press kara hai to
    //if to condition checker hai and isset exixtance check karta hai

    $email = $_POST['email']; //email insert karo as an input lo
    $pass  = $_POST['password']; //password insert karo as an input lo

    //(stmt)Stores the prepared SQL query
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ? AND role = 'admin'");
    //prepare eak gate lock hai
    //empty space par kewal data aayega commond nhi
    //prepare() makes a SQL query that treats injected wrong commands by hackers as normal values (data), not as SQL commands, so the database stays safe.
    //this line of code mean making a query that will only intake value enterd by user not the commond enterd by hackers 
    //$stmt is a statement object that stores a prepared SQL query and safely holds user values (data), not commands, and is executed when needed.

    // finally ye kaha raha hai mughe eak query check karwani hai jab tak tum values ke liye wait karo ..
    //then in bind wali line vo value deti hai na ki koi sql code jo hacker ne dala hai yese like abc@gmail.com\' OR \'1\'=\'1

    // prepare() locks SQL structure first.
    //It does NOT allow user input to change the SQL command. 

    // prepare() makes SQL safe by separating query structure from user input.
    $stmt->bind_param("ss", $email, $pass);  // bind_param == aab jo upar khali jagha choodi hai usme value insert karta hai safely
    $stmt->execute();  //query execute ho gai hai jii.
    $result = $stmt->get_result(); //aab jo output hai usko isme dalega ki hai ya nhi sahi user?.

    if ($result->num_rows === 1) { //check kar rha hai aagar yesa kuch entry hai kya database me.

        
        $otp = rand(100000, 999999); //opt generate karga aagar 1==1 correct ho gaya to.

        
        $_SESSION['admin_email'] = $email;  //session me admin ki email and otp store karega.
        $_SESSION['admin_otp']   = $otp;

        
        $mail = new PHPMailer(true);  //setup karga php mailer ko ki aab mail ready karna hai
           


        // try catch run time errors(like stmp errors internet issues etc) handle karti hai and website crash na hone ke liye hai
        try {
            $mail->isSMTP();   //ye bata rha hai ki mail smtp wale mail ke server se jayegi 
            $mail->Host       = 'smtp.gmail.com'; //uss mail ka address.
            $mail->SMTPAuth   = true;  //check karega user exit karta hai kya jo mail mene di hai vo actuallu me exist karti hai ya nhi

        
            $mail->Username   = 'abhinavsharma5583@gmail.com';  //admin ki mail and app password 
            $mail->Password   = 'kkgw gxbs ozmy rdoo';          //admin ka app password  

            $mail->SMTPSecure = 'tls';  //security jisse to mail bani hai vo encrupt hokar jati hai taki hackers jo hai vo mail nhi padh sake . means tls= transport layer security.
            $mail->Port       = 587; //ye prot number se mail bheji gai hai
             

            
            $mail->setFrom('abhinavsharma5583@gmail.com', 'Admin Login OTP');  //email send hogi admin ko with subject this.
            $mail->addAddress($email);   // Send OTP to admin email

            $mail->isHTML(true);  //acctual email ka formate yaha se banta hai.
            $mail->Subject = 'Admin Login OTP'; //  mail ka subject kya hoga
            $mail->Body    = "<h2>Your OTP is: $otp</h2>"; //body generation yah se hota hai bold space line br etc.

            $mail->send(); //aab mail chali gai.

            header("Location: admin_otp.php"); //admin otp par jayega
            exit;

        } catch (Exception $e) {  //aab iske baad bhi koi error aata hai to vo yaha se check out hoga
            echo "<p style='color:red;'>OTP could not be sent. Error: {$mail->ErrorInfo}</p>";
        }

    } else {
        echo "<p style='color:red;'>Invalid Admin Email or Password!</p>";
    }
}
?>
<<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>my project</title>
</head>
<body>

    <form method="POST">
    <h2>Admin Login</h2>

    Email: <input type="email" name="email" required><br><br>
    Password: <input type="password" name="password" required><br><br>

    <button name="login">Send OTP</button>
</form>


</body>
</html>
 //Prepared statement (stmt) acts like a wall that prevents SQL injection by stopping user input from changing or controlling database commands.