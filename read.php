<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "connection.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM customer_details WHERE id_number = ?";
    
    if($stmt = mysqli_prepare($conn, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $fname = $row["first_name"];
                $sname = $row["second_name"];
                $phone = $row["phone_number"];
                $address = $row["address"];
                $email = $row["email"];
                
                $city = $row["city"];
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($conn);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
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
    

    <div class="container">
    <div class="main-body">
    
          <!-- Breadcrumb -->
          <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html">Home</a></li>
              <li class="breadcrumb-item"><a href="view.php">View</a></li>
              <li class="breadcrumb-item active" aria-current="page">Customer Profile</li>
            </ol>
          </nav>
          <!-- /Breadcrumb -->
    
          <div class="row gutters-sm mt-5 shadow">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="https://bootdey.com/img/Content/avatar/avatar4.png" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4><?php echo $row["first_name"]." ".$row["second_name"]; ?></h4>
                      <p class="text-secondary mb-1">P.O BOX</p>
                      <p class="text-muted font-size-sm"><?php echo $row["address"]."-".$row["zipcode"].", ".$row["city"]; ?></p>
                      <button class="btn btn-primary"><i class="fa fa-phone" aria-hidden="true"></i>Contacts</button>
                      <button class="btn btn-outline-danger">Delete</button>
                    </div>
                  </div>
                </div>
              </div>
              
            </div>
            <div class="col-md-8 ">
              <div class="card mb-3 shadow">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Full Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $row["first_name"]." ".$row["second_name"]; ?>
                    </div>
                  </div>
                  <hr>
                   <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">ID number</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $row["id_number"]; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                     <?php echo $row["email"]; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Phone</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                     <?php echo $row["phone_number"]; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Gender</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                     <?php echo $row["gender"]; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Address</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $row["address"]."-".$row["zipcode"].", ".$row["city"]; ?>
                    </div>
                  </div>
                   
                  <hr>
                  <div class="row">
                    <div class="col-sm-12">
                      <a class="btn btn-info " target="__blank" href="https://www.bootdey.com/snippets/view/profile-edit-data-and-skills">Edit</a>
                    </div>
                  </div>
                </div>
              </div>

              
                
                  </div>
                </div>
              </div>



            </div>
          </div>

        </div>
    </div>
</body>
</html>