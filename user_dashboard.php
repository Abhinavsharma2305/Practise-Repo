<?php
session_start();


if (!isset($_SESSION['user']))  //This line checks whether the user is logged in, and if not, prevents access to the page.
{
    header("Location: login.php");
    exit;
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

<h2>User Dashboard</h2>

<p>Welcome, <b><?php echo $_SESSION['user']; ?></b></p>  //Displays logged-in user’s email.

<a href="logout.php">Logout</a>

</body>
</html>
