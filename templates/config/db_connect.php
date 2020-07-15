<?php
//connect to // Db
$conn = mysqli_connect('localhost', 'root', '', 'aya_books');

//check connections
if(!$conn){
  echo 'connections error' . mysqli_connect_error();
}


 ?>
