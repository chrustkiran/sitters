<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
<style>
    /* Add a black background color to the top navigation */
   /* .topnav {
        background-color: #333;
        overflow: hidden;
    }*/

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
       // background-color: #ddd;
        color: silver;
    }

    /* Add a color to the active/current link */
    .topnav a.active {
        background-color: #4CAF50;
        //color: white;
    }

    /* Right-aligned section inside the top navigation */
    .topnav-right {
        float: right;
    }
</style>

<body>

<div class="topnav">
    <h2 class="text-center" style="color: white;">S I T T E R S <span class="glyphicon glyphicon-heart-empty"></span> </h2>
    <a href="./home"><i title="home" class="material-icons" style="font-size:25px">home</i></a>
    <a href="./advertisement"><i title="posts" class="material-icons" style="font-size:25px">note_add</i></a>
    <div class="topnav-right">
        <a href="../logout"><i title="logout" class="material-icons" style="font-size:25px">power_settings_new</i></a>

    </div>
</div>
<br>
</body>