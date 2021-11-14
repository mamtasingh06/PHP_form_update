<?php
    $db_host = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_name = "test";
    $conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);
    // Database Connection
    if(!$conn)
    {
        die('connection failed');
    }
    echo "connected successfully". "<hr>";
    // Update
    if(isset($_REQUEST['update']))
    {
        if(($_REQUEST['name'] == "") || ($_REQUEST['email'] == "") || ($_REQUEST['phone'] == ""))
        {
            echo "<small>Fill all fields </small>";
        }
        else{
            $name = $_REQUEST['name'];
            $email = $_REQUEST['email'];
            $phone = $_REQUEST['phone'];
            $sql = "Update student Set name = '$name', email = '$email', phone = '$phone' 
             Where id = {$_REQUEST['id']}";
            if(mysqli_query($conn,$sql))
            {
                echo "Updated";
            }
            else{
                echo "Not Updated";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                
                <?php
                // Data shown in form from database 
                     if(isset($_REQUEST['edit']))
                     {
                         $sql = "Select * From student Where id = {$_REQUEST['id']}";
                         $result = mysqli_query($conn, $sql);
                         $row = mysqli_fetch_assoc($result);

                     }
                ?>
                <!-- form -->
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id = "name" value="<?php
                        if(isset($row['name'])){
                        echo $row["name"];}
                        ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email" id = "email" value="<?php
                        if(isset($row['email'])){
                        echo $row["email"];}
                        ?>">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" name="phone" id = "phone" value="<?php
                        if(isset($row['phone'])){
                        echo $row["phone"];}
                        ?>">
                    </div>
                    <input type="hidden" name="id" value="<?php 
                        echo $row['id']
                    ?>">
                    <button type ="submit" class="btn btn-success mt-3" name = "update" >Update</button>
                </form>
            </div>
            <div class = "col-sm-6 offset-sm-2">
                 <?php
                    
                     $sql = "Select * From student";
                     $result = mysqli_query($conn, $sql);
                     if(mysqli_num_rows($result) > 0)
                     {
                         echo '<table class = "table">';
                             echo "<thead>";
                                 echo "<tr>";
                                     echo "<th>ID</th>";
                                     echo "<th>Name</th>";
                                     echo "<th>Email</th>";
                                     echo "<th>Phone</th>";
                                     echo "<th>Action</th>";
                                 echo "</tr>";
                             echo "</thead>";
                             echo "<tbody>";
                                 while($row = mysqli_fetch_assoc($result))
                                 {
                                     echo "<tr>";
                                         echo "<td>" . $row["id"] . "</td>";
                                         echo "<td>" . $row["name"] . "</td>";
                                         echo "<td>" . $row["email"] . "</td>";
                                         echo "<td>" . $row["phone"] . "</td>";
                                         echo '<td><form action="" method="POST">
                                          <input type = "hidden" name = "id" value = ' . $row["id"] . '>
                                         <input type = "submit" class = "btn btn-sm btn-danger" name = "edit"
                                          value = "Edit"></form></td>';
                                          echo "</tr>";
                                 }
                                 
                             echo "</tbody>";
                         echo '</table>';
                     
                     }
                     else
                     {
                         echo " 0 results";
                     }
                 ?>
                
            </div>
        </div>

    </div>

    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/popper.js"></script>
</body>
</html>