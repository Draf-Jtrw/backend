<?php
    $servername = 'localhost';
    $username = 'rott';
    $password = '';
    $dbname = 'projectfood';

    $connect = new mysqli($servername, $username, $password, $dbname);
    $connect->set_charset("utf8");


