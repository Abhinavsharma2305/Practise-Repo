    <?php //php ka start hoga
    session_start(); //eak sesion start hoga jo ki temparorly daya store karega jo ki aage wali file ya ushi file me kaam aa sakata hai

     
    if (!isset($_SESSION['admin'])) { //aagar amin par bina click kare iss page [par aa gye to mat aane do]
        header("Location: admin_login.php"); //then admin login par le jao
        exit;
    }
    ?>

    <html>
    <head>
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="style.css">
        <title>Admin can create multiple user project</title> 
    </head>
    <body>

        <h2>Admin Dashboard</h2>
<p>Welcome, <b><?php echo $_SESSION['admin']; ?></b></p>   //diplay hogi admin ki mail id
 <a href="create_user.php">Create New User</a>  
    <a href="logout.php">Logout</a>

    


    </body>
    </html>
