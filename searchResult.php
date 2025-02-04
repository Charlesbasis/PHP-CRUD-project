<?php
    include 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- CSS File -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <a href="display.php">View Data</a>
    <h1>Your Search Results</h1>
    <div class="table">
            <table>
                <?php  
                    if(isset($_POST['submit'])){
                        $search=$_POST['search'];

                        $sql="Select * from `phpcrud` where id like '%$search%' or username like '%$search%' or email like '%$search%' or mobile like '%$search%' or address like '%$search%' or hobbies like '%$search%'";
                        $result=mysqli_query($conn,$sql);                    
                        if($result){
                            if($num=mysqli_num_rows($result)>0){
                                echo '<thead>
                                <tr>
                                <th>Sl No</th>                            
                                <th>Username</th>
                                <th>Email</th>
                                <th>Mobile Number</th>
                                <th>Address</th>
                                <th>Hobbies</th>
                                </tr>
                                </thead>
                                ';

                                while($row=mysqli_fetch_assoc($result)){
                                echo '<tbody>
                                <tr>                            
                                    <td>'.$row['id'].'</td>
                                    <td>'.$row['username'].'</td>
                                    <td>'.$row['email'].'</td>
                                    <td>'.$row['mobile'].'</td>
                                    <td>'.$row['address'].'</td>
                                    <td>'.$row['hobbies'].'</td>
                                </tr>
                                </tbody>';
                                }
                            }else{
                                echo '<h2>Data Not Found!</h2>';
                            }                     
                        }
                    }
                ?>            
            </table>
    </div>
</body>
</html>