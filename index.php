<?php
include_once('functions.php');
?>


<html>
<head>
<title>FITB - Welcome</title>
<link rel="stylesheet" href="fitb.css" type="text/css" media="screen" /> 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
</head>

<body>
<?php include_once('header.php'); # includes the <div> for the header ?>
<div id="wrap">
    <?php include_once('side.php'); # includes the <div> for the side bar ?>
    <div id="main">
        <h2>Welcome to FITB</h2>
        <p>FITB is a automatic, RRDTool based graphing product that leaves no port untouched.</p>
        <p>Select a host from the left.</p>
<?php 
        if (!function_exists("pg_connect")) {
            echo '<p><span class="red">It looks like you don\'t have PHP PostgreSQL libraries installed. FITB will require these to connect to the
                database</span></p>';
        } 
        if (!connectToDB()) {
            echo '<p><span class="red">FITB is having trouble connecting to your database. Have you set up MySQL with the FITB database and specified 
                the correct connection parameters in config.php?</span></p>';
        }

        ?>
    <div>
</div>


</body>
</html>
