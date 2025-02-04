<?php
include 'connect.php';

// inserting data into table
if(isset($_POST['submit'])){
    // echo "Success!";
    $username=$_POST['username'];
    $email=$_POST['email'];
    $mobile=$_POST['mobile'];
    $address=$_POST['address'];
    
    if(empty($_POST['hobbies'])){
        echo die("Please select atleast one hobby");        
        // echo "<a href='index.php'>Back</a>"; 
    }else{
        $data=$_POST['hobbies'];
        $hobbies=implode(',',$data);       
    }
    
    // insert query
    $sql="insert into `phpcrud` (username,email,mobile,address,hobbies) values ('$username','$email','$mobile','$address','$hobbies')";
    $result=mysqli_query($conn,$sql);
    if($result){
        echo header('location:display.php');
    }else{
        echo die("Data not inserted");
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP CRUD-project</title>
    <!-- CSS File -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>PHP CRUD</h1>
    
    <a href="display.php">View Data</a>
    <h1>Join Now by fill in the details below</h1>
    <form action="" method="post">
        <input type="text" placeholder="Enter your name" required autocomplete="off" name="username">
        <input type="email" placeholder="Enter your email" required autocomplete="off" name="email">
        <input type="number" placeholder="Enter your mobile number" required autocomplete="off" name="mobile">
        <input type="text" placeholder="Enter your address" required autocomplete="off" name="address">
        <label for="hobbies">Select Hobbies</label>
            <div class="checkbox">
                <input type="checkbox" name="hobbies[]" value="playing"> 
                    <label for="hobbies">Playing</label><br>
            </div>
            <div class="checkbox">
                <input type="checkbox" name="hobbies[]" value="swimming">
                    <label for="hobbies">Swimming</label><br>
            </div>
            <div class="checkbox">        
                <input type="checkbox" name="hobbies[]" value="drawing">
                    <label for="hobbies">Drawing</label><br><br>
            </div>
        <input type="submit" class="btn" name="submit">

    </form>
    
</body>
</html>