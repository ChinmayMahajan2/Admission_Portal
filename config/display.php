<?php

require_once('db.php');
$query = "select * from form";
$result = mysqli_query($con,$query);

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fetch and display data from database</title>
    <style>
        nav {
  background-color: #4d4c4c; /* Change the background color to a suitable color */
  text-align: center;
  padding: 10px 0;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

nav ul {
  list-style: none;
  padding: 0;
}

nav ul li {
  display: inline;
  margin-right: 20px;
}

nav ul li:last-child {
  margin-right: 0;
}

nav a {
  text-decoration: none;
  color: #fff;
  font-weight: bold;
  font-size: 16px;
}

nav a:hover {
  color: #FF5733;
}


</style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
    crossorigin="anonymous">
</head>
<header>
<nav>
  <ul>
    <li><a href="/Assignment_3/home.html">Home</a></li>
    <li><a href="/Assignment_3/form.html">Registration Form</a></li>
    <li><a href="dashboard.php">Data Analytics Dashboard</a></li>
    <li><a href="/Assignment_3/WIM_Profile/index.html">My Profile</a></li>
    <li><a href="display.php">Registered Candidate's Data</a></li>
  </ul>
</nav>
</header>
<body class="bg-dark">
    <div class="container">
        <div class="row mt-5">
            <div class="col">
                <div class="card mt-5">
                    <div class="card header">
                        <h2 class="display-6 text-center">Data of Registered Candidates</h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered text-center">
                            <tr class="bg-dark text-white">
                                <td>Candidate ID</td>
                                <td>First Name</td>
                                <td>last Name</td>
                                <td>email</td>
                                <td>phone no.</td>
                                <td>address</td>
                                <td>birth date</td>
                                <td>Nationality</td>
                                <td>Gender</td>
                                <td>Aadhar No.</td>
                                <td>Degree</td>
                                <td>Course</td>
                                <td>CPI</td>
                            </tr>
                            <tr>
                                <?php

                                    while($row = mysqli_fetch_assoc($result)){
                                        ?>
                                        <td><?php echo $row['id'];?></td>
                                        <td><?php echo $row['fname'];?></td>
                                        <td><?php echo $row['lname'];?></td>
                                        <td><?php echo $row['email'];?></td>
                                        <td><?php echo $row['phone'];?></td>
                                        <td><?php echo $row['address'];?></td>
                                        <td><?php echo $row['bdate'];?></td>
                                        <td><?php echo $row['nationality'];?></td>
                                        <td><?php echo $row['gender'];?></td>
                                        <td><?php echo $row['aadhar'];?></td>
                                        <td><?php echo $row['degree'];?></td>
                                        <td><?php echo $row['course'];?></td>
                                        <td><?php echo $row['CPI'];?></td>
                                        </tr>

                                        <?php
                                    }
                                ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>