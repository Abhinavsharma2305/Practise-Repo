<?php
session_start(); //eak session start hoga jisme temporarly data store hoga. Taki aage wale page ya aagr us page me hi vo data kaam aaye to vaha aapan use kar sake usko

include "config.php";


if (!isset($_SESSION['admin'])) {  //direct otp page pe aane se rokega aagar bina login kare pahuch gaya to
    header("Location: admin_login.php");
    exit; //hata do user ko yaha se
}

$message = ""; //succesfull ka message aayega yaha se


if (isset($_POST['create'])) {  //aagar admin create user par click karge

    $name  = $_POST['name'];  //in variables me inke data store ho jayega
    $email = $_POST['email'];
    $pass  = $_POST['password'];

    
    if ($name == "" || $email == "" || $pass == "") { //aagar koi bhi empty field hogi to nhi jayega aage
        $message = "Please fill all fields.";
    } else {

       
        $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, 'user')"); //stmt prevent sql injections , $conn iss liye lagaya ki database ko access kaene ke liye pehele conn ko access karna padega , prepare eak functon hai jo sql ki query prepaer karega , email ? value will be give later to prevent injections first the will be checked and then actuall inputs will be provided.
        $stmt->bind_param("sss", $name, $email, $pass); // bind_param == aab jo upar khali jagha choodi hai usme value insert karta hai safely

        if ($stmt->execute()) {  //query execute ho gai hai jii.
            $message = "User Created Successfully!";
        } else {
            $message = "Error creating user!";
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

<h2>Create User</h2>


<p style="color: green;"><?php echo $message; ?></p>

<form method="POST">
    Name: <input type="text" name="name" required><br><br>

    Email: <input type="email" name="email" required><br><br>

    Password: <input type="password" name="password" required><br><br>

    <button name="create">Create User</button>
</form>

<br>
<a href="admin_dashboard.php">Back to Dashboard</a>

</body>
</html>
