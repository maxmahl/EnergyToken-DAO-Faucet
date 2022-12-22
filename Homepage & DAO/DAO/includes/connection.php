<?php
  $servername = "127.0.0.1";
  $username = "blockc_maxmahl";
  $password = "qNHYdX6R3299";
  $dbname = "blockc_DAO";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);


  if ($conn->connect_error) {
    echo '<script>alert("Welcome to Geeks for Geeks")</script>';
    die("Connection failed: " . $conn->connect_error);
  }
?>