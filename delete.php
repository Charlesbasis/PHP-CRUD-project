<?php
include 'connect.php';

if(isset($_GET['delete'])){
    $delete_id=$_GET['delete'];
    // Delete Query

    
    $delete_data=mysqli_query($conn,"Delete from `phpcrud` where id=$delete_id") or die("Query Failed");
    if($delete_data){
        header('location:display.php');
    }else{
        header('location:display.php');
    }
}
?>