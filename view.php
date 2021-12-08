<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View</title>

    <title></title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: white">
  <!-- Container wrapper -->
  <div class="container-fluid">
    <!-- Toggle button -->
    <button
      class="navbar-toggler"
      type="button"
      data-toggle="collapse"
      data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <i class="fa fa-bars"></i>
    </button>

    <!-- Collapsible wrapper -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Navbar brand -->
      <a class="navbar-brand mt-2 mt-lg-0 mr-5" href="#">
        <h4 style = "color: #33A4F1  ">My-Site</h4>
      </a>
     <!-- Left links -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 ml-5">
        <li class="nav-item">
          <a class="nav-link font-weight-bold" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link font-weight-bold" href="#">Items</a>
        </li>
        <li class="nav-item">
          <a class="nav-link font-weight-bold" href="#">More</a>
        </li>
      </ul>
      <!-- Left links -->
    </div>
    <!-- Collapsible wrapper -->

    <!-- Right elements -->
    <div class="d-flex align-items-center" id="navbarSupportedContent">
       
  </div>
  <!-- Container wrapper -->
</nav>
<!-- Navbar -->

  
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Customer Details</h2>
                        <a href="create.html" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add New Customer</a>
                    </div>
                    <?php
                    // Include config file
                    require_once "connection.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM customer_details";
                    if($result = mysqli_query($conn, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        
                                        echo "<th>First name</th>";
                                        echo "<th>Second name</th>";
                                        echo "<th>ID Number</th>";
                                        echo "<th>Gender</th>";
                                        echo "<th>Address</th>";
                                        echo "<th>Phone</th>";
                                        echo "<th>City</th>";
                                        echo "<th>Email</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['first_name'] . "</td>";
                                        echo "<td>" . $row['second_name'] . "</td>";
                                        echo "<td>" . $row['id_number'] . "</td>";
                                        echo "<td>" . $row['gender'] . "</td>";
                                        echo "<td>" . $row['address']."-".$row['zipcode'].", ".$row['city']."</td>";
                                        echo "<td>" . $row['phone_number'] . "</td>";
                                        echo "<td>" . $row['city'] . "</td>";
                                        echo "<td>" . $row['email'] . "</td>";
                                        
                                        echo "<td>";
                                            echo '<a href="read.php?id='. $row['id_number'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                            echo '<a href="update.php?id='. $row['id_number'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                            echo '<a href="delete.php?id='. $row['id_number'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
 
                    // Close connection
                    mysqli_close($conn);
                    ?>
                </div>
                  
        </div>
    </div>



    <!--Footer-->
<footer class="text-center text-white mt-5 " style="background-color: #f1f1f1;bottom:0 !important; position:absolute; width:100%">
  <!-- Grid container -->
  <div class="container pt-4">
    <!-- Section: Social media -->
    <section class="mb-4">
      <!-- Facebook -->
      <a
        class="btn btn-link btn-floating btn-lg text-dark m-1"
        href="#!"
        role="button"
        data-mdb-ripple-color="dark"
        ><i class="fa fa-facebook-f"></i
      ></a>

      <!-- Twitter -->
      <a
        class="btn btn-link btn-floating btn-lg text-dark m-1"
        href="#!"
        role="button"
        data-mdb-ripple-color="dark"
        ><i class="fa fa-twitter"></i
      ></a>

      <!-- Google -->
      <a
        class="btn btn-link btn-floating btn-lg text-dark m-1"
        href="#!"
        role="button"
        data-mdb-ripple-color="dark"
        ><i class="fa fa-google"></i
      ></a>

      <!-- Instagram -->
      <a
        class="btn btn-link btn-floating btn-lg text-dark m-1"
        href="#!"
        role="button"
        data-mdb-ripple-color="dark"
        ><i class="fa fa-instagram"></i
      ></a>

      <!-- Linkedin -->
      <a
        class="btn btn-link btn-floating btn-lg text-dark m-1"
        href="#!"
        role="button"
        data-mdb-ripple-color="dark"
        ><i class="fa fa-linkedin"></i
      ></a>
      <!-- Github -->
      <a
        class="btn btn-link btn-floating btn-lg text-dark m-1"
        href="#!"
        role="button"
        data-mdb-ripple-color="dark"
        ><i class="fa fa-github"></i
      ></a>
    </section>
    <!-- Section: Social media -->
  </div>
  <!-- Grid container -->

  <!-- Copyright -->
  <div class="text-center text-dark p-3" style="background-color: rgba(0, 0, 0, 0.2);">
    © 2021 Copyright:
    <a class="text-dark" href="#">My-Site</a>
  </div>
  <!-- Copyright -->
</footer>
<!--Footer-->
</body>
</html>