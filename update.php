<?php
include 'connect.php';

// Update Query Logic
if(isset($_POST['update_btn'])){
    $data_id=$_POST['data_id'];
    $username=$_POST['username'];
    $email=$_POST['email'];
    $mobile=$_POST['mobile'];
    $address=$_POST['address'];

    if(empty($_POST['hobbies'])){
        echo die("Please select atleast one hobby");        
        // echo "<a href='index.php'>Back</a>";    
    }else{
        $data=$_POST['hobbies'];
        $alldata=explode(',',$data);
    }
    $sql="update `phpcrud` set username='$username',email='$email',mobile='$mobile',address='$address',hobbies='$alldata' where id=$data_id";
    $result=mysqli_query($conn,$sql);
    if($result){
        header('location:display.php');
    }else{
        echo die("Error in updating data");
    }
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data-Project</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Update Data</h1>
    <a href="display.php">View Data</a>
<?php
    if(isset($_GET['edit'])){
        $edit_id=$_GET['edit'];
        $get_data=mysqli_query($conn,"Select * from `phpcrud` where id=$edit_id");
        if(mysqli_num_rows($get_data)>0){
            $fetch_data=mysqli_fetch_assoc($get_data);
            $hobbies = explode(',', $fetch_data['hobbies']);
?>

<form action="" method="post">
    <input type="hidden" name="data_id" value="<?php echo $fetch_data['id']?>">
    <input type="text" required autocomplete="off" value="<?php echo $fetch_data['username']?>" name="username">
    <input type="email" required autocomplete="off" value="<?php echo $fetch_data['email']?>" name="email">
    <input type="number" required autocomplete="off" value="<?php echo $fetch_data['mobile']?>" name="mobile">
    <input type="text" required autocomplete="off" value="<?php echo $fetch_data['address']?>" name="address">
    <label for="hobbies">Select Hobbies</label>
        <div class="checkbox">
            <input type="checkbox" name="hobbies[]" value="playing" <?php if(in_array("playing", $hobbies)){ echo "checked";} ?> > 
                <label for="hobbies">Playing</label><br>
        </div>
        <div class="checkbox">
            <input type="checkbox" name="hobbies[]" value="swimming" <?php if(in_array("swimming", $hobbies)){ echo "checked";} ?> >
                <label for="hobbies">Swimming</label><br>
        </div>
        <div class="checkbox">
            <input type="checkbox" name="hobbies[]" value="drawing" <?php if(in_array("drawing", $hobbies)){ echo "checked";} ?> >
                <label for="hobbies">Drawing</label><br><br>
        </div>
    <input type="submit" class="btn" name="update_btn">
    </form>
<?php
        }
    }
?>

</body>
</html>