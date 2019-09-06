<?php
  /* Set oracle user login and password info */
  $dbuser = "kmlam";  /* your deakin login */
  $dbpass = "caesar55BcJulius";  /* your deakin password */
  $dbname = "SSID"; 
  $db = oci_connect($dbuser,$dbpass,$dbname);

  if (!$db)  {
    print_r ("An error occurred connecting to the database"); 
    exit; 
  }
?>