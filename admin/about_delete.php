<?php

include('db.php');
$id = $_GET['id'];

$sql= "DELETE FROM `about` where id=$id";
mysqli_query($conn,$sql);

if($conn->query($sql)===TRUE){

    echo "Record Deleted successfully";
}
else{

    echo "Error in Deleting Record:" .$conn->error;
}
header('Location: about_table.php');



?>