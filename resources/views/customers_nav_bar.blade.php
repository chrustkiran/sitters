
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
<style>
    /* Add a black background color to the top navigation */
    .topnav {
        background-color: darkslategrey;
        overflow: hidden;
    }

    /* Style the links inside the navigation bar */
    .topnav a {
        float: left;
        color: #f2f2f2;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        font-size: 17px;
    }

    /* Change the color of links on hover */
    .topnav a:hover {
        background-color: #ddd;
        color: green;
    }

    /* Add a color to the active/current link */


    /* Right-aligned section inside the top navigation */
    .topnav-right {
        float: right;
    }
</style>
<div class="topnav">
    <a  href="../customers/home">Home</a>
    <a href="../customers/profile">Profile</a>
    <a href="#">Message</a>
    <div class="topnav-right">
        <a href="#search">Search</a>

        <a href="../logout">Logout</a>
    </div>
</div>
