<?php
$hostname = "localhost";
$hostusername = "root";
$hostpassword = "";
$hostdatabase = "point_of_sale";
$config = mysqli_connect($hostname, $hostusername, $hostpassword, $hostdatabase);

if (!$config) {
    echo "Connection Failed";
}