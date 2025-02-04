<?php
    include 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <h1>What do you want to search?</h1>

    <form action="searchResult.php" method="post">
        <input type="text" placeholder="Search data" name="search">
        <button class="btn" name="submit">Search</button>
    </form>

    <h1>Display Data</h1>
    <div class="table">
        <a href="index.php">Back</a>
        <?php

        // <!-- Pagination Logic -->
        // Setting the Start from, value.
        $start=0;

        // Setting no of rows to display in a page
        $rows_per_page=2;        

        // Querying Data for displaying

        $display_data=mysqli_query($conn,"Select * from `phpcrud`");
        $num=1;
        $number_rows=mysqli_num_rows($display_data);

        // Pagination Logic continues
        // Calculating no of pages
        $pages=ceil($number_rows / $rows_per_page);
        $current_page = $_GET['page-nr'];
        // $offset=0;
        $limit = 2;
        if (!empty($current_page)){
            $start = ($current_page - 1)*$limit;
            // echo $current_page;
        }

        $result=mysqli_query($conn,"Select * from `phpcrud` LIMIT $limit OFFSET $start");

        // If user clicks on pagination buttons we set a new starting point
        if(isset($_GET['page-nr'])){
            $page=$_GET['page-nr'] - 1;
            $start=$page * $rows_per_page;
        }

        
        // echo $number_rows;

        // Displaying Data

        if(mysqli_num_rows($display_data)>0){
            echo "<table>
        <thead>
            <th>SL No</th>
            <th>Username</th>
            <th>Email</th>
            <th>Mobile Number</th>
            <th>Address</th>
            <th>Hobbies</th>
            <th>Operations</th>
        </thead>
        <tbody>";

        while($row=mysqli_fetch_assoc($result)){
        // echo $row['username'];
        ?>
        <tr>
            <td><?php echo $num?></td>
            <td><?php echo $row['username']?></td>
            <td><?php echo $row['email']?></td>
            <td><?php echo $row['mobile']?></td>
            <td><?php echo $row['address']?></td>
            <td><?php echo $row['hobbies']?></td>
            <td>
                <a href="delete.php?delete=<?php echo $row['id']?>" onclick="return confirm('Are you sure want to delete this data?'); " >Delete</a>
                <a href="update.php?edit=<?php echo $row['id']?>">Edit</a>
            </td>
        </tr>
    </div>

    <?php
    $num++;
            }
        }else{
            echo "<div>No data</div>";
        }    

    ?>  
    </tbody>
    </table>

    <!-- Displaying the page info text -->

    <footer>
        <div class="page-info">
        <?php 
          if(!isset($_GET['page-nr'])){
            $page = 1;
          }else{
            $page = $_GET['page-nr'];
          }  
        ?>

            Showing <?php echo $page ?> of <?php echo $pages ?> Pages
        </div>

        <div class="pagination">        
            <!-- Go to the First page -->
            <a href="?page-nr=1">First</a>

            <!-- Go to the previous page -->
            <?php
                if(isset($_GET['page-nr']) && $_GET['page-nr'] > 1){
            ?>
                <a href="?page-nr=<?php echo $_GET['page-nr'] - 1 ?>">Previous</a>
                <?php 
                }else{
                ?>
                    <a>Previous</a>
                <?php
                }
            ?>

            <!-- Output the page numbers -->
            <div class="page-numbers"> 
                <?php 
                    for($counter = 1; $counter <= $pages; $counter ++){
                ?>
                    <a href="?page-nr=<?php echo $counter ?>"><?php echo $counter ?></a>
                <?php
                    }
                ?>
                
            </div>

            <!-- Go to Next Page -->
            <?php 
                if(!isset($_GET['page-nr'])){
            ?>
                <a href="?page-nr=2">Next</a>
            <?php
            }else{
                if($_GET['page-nr'] >= $pages){
            ?>
                <a>Next</a>
            <?php
            }else{
            ?>
                <a href="?page-nr=<?php echo $_GET['page-nr'] + 1 ?>">Next</a>

                <?php
            }
            }                
            ?>            

            <!-- Go to last Page -->
            <a href="?page-nr=<?php echo $pages ?>">Last</a>
        </div>
    </footer>
</body>
</html>