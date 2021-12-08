<?php
// Include config file
require_once "connection.php";
 
// Define variables and initialize with empty values
$name = $address = $salary = "";
$name_err = $address_err = $salary_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
    }
    
    // Validate address address
    $input_address = trim($_POST["address"]);
    if(empty($input_address)){
        $address_err = "Please enter an address.";     
    } else{
        $address = $input_address;
    }
    
    // Validate salary
    $input_salary = trim($_POST["salary"]);
    if(empty($input_salary)){
        $salary_err = "Please enter the salary amount.";     
    } elseif(!ctype_digit($input_salary)){
        $salary_err = "Please enter a positive integer value.";
    } else{
        $salary = $input_salary;
    }
    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($address_err) && empty($salary_err)){
        // Prepare an update statement
        $sql = "UPDATE customer_details SET name=?, address=?, salary=? WHERE id=?";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssi", $param_name, $param_address, $param_salary, $param_id);
            
            // Set parameters
            $param_name = $name;
            $param_address = $address;
            $param_salary = $salary;
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($conn);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM customer_details WHERE id_number = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if($stmt){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $firstname = $row["first_name"];
                    $address = $row["address"];
                    $phone = $row["phone_number"];
                    $id = $row["id_number"];
                    $secondname = $row["second_name"];
                    $city = $row["city"];
                    $zipcode = $row["zipcode"];
                    $email = $row["email"];
                    $gender = $row["gender"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
        mysqli_stmt_close($stmt);
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
     
        
        // Close connection
        mysqli_close($conn);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js"></script>
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
          <a class="nav-link font-weight-bold" href="index.html">Home</a>
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

<div class="container form_container shadow justify-content-center mt-4 pt-4 pb-4" style="text-align: center">
  <div class="col-7" style="display: inline-block; text-align: left" >
    <h3 style ="color: #33A4F1">Update Customer Details</h3>
    <form action="mysite_api.php" name="customer_details_form" method = "post" class="form-horizontal" onsubmit="return validateForm()">
      
        <div class="form-group row">
            <label for="id1" class="col-4">First Name</label>
            
            <input class="form-control col-8"
                   type="text" 
                   id="id1" 
                  name="firstname" 
                   placeholder="Enter your First Name"
                   <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>
                   value="<?php echo $firstname; ?>"
                   >
                   
        </div>
        <div class="form-group row">
            <label for="id1" class="col-4">Second Name</label>
            <input class="form-control col-8"
                   type="text" 
                   id="id1"
                   name="secondname" 
                   placeholder="Enter your Second Name"
                    <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>
                   value="<?php echo $secondname; ?>"
                   >
        </div>
        <div class="form-group row">
            <label for="id2" class="col-4">ID NO:</label>
            <input class="form-control col-8" 
                   type="number" 
                   id="id2"
                   name="id_number" 
                   placeholder="Enter your ID Number"
                    <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>
                   value="<?php echo $id; ?>"
                   >
        </div>
        <div class="form-group row">
            <label for="id2" class="col-4">Gender:</label>
            <input class="form-control col-8" 
                   type="text" 
                   id="id2"
                   name="gender" 
                   placeholder="Gender"
                    <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>
                   value="<?php echo $gender; ?>"
                   >
        </div>


        <div class="form-group row">
            <label for="id1" class="col-4">Email</label>
            <input class="form-control col-8"
                   type="email" 
                   id="id1" 
                   name="email"
                   placeholder="Enter your email address"
                    <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>
                   value="<?php echo $email; ?>"
                   >
        </div>
        <div class="form-group row">
            <label for="id1" class="col-4">Address</label>
            <input class="form-control col-8"
                   type="text" 
                   id="id1" 
                   name="address"
                   placeholder="Enter your postal address"
                    <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>
                   value="<?php echo $address; ?>"
                   
                   >
        </div>
        <div class="form-group row">
            <label for="id1" class="col-4">Zip code</label>
            <input class="form-control col-sm-8"
                   type="text" 
                   id="id1" 
                   name="zipcode"
                   placeholder="Your zip code"
                    <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>
                   value="<?php echo $zipcode; ?>"
                   >
        </div>
        <div class="form-group row">
            <label for="id1" class="col-4">Phone number</label>
            <input class="form-control col-8"
                   type="text" 
                   id="id1" 
                   name="phone_number"
                   placeholder="Enter your User Name"
                    <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>
                   value="<?php echo $phone; ?>"
                   >
        </div>
        <div class="form-group row">
            <label for="id2" class="col-4">City</label>
            <input class="form-control col-8" 
                   type="text" 
                   id="id2"
                   name="city" 
                   placeholder="Enter your password"
                    <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>
                   value="<?php echo $city; ?>"
                   >
        </div>
        <div class="container">
            <button type="submit" 
                    class="btn btn-primary" name="update">Save changes</button>
            <a href="index.html"
                    class="btn btn-danger">Cancel</a>
           
        </div>
    </form>
    </div>
</div>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Update Record</h2>
                    <p>Please edit the input values and submit to update the employee record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <textarea name="address" class="form-control <?php echo (!empty($address_err)) ? 'is-invalid' : ''; ?>"><?php echo $address; ?></textarea>
                            <span class="invalid-feedback"><?php echo $address_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Salary</label>
                            <input type="text" name="salary" class="form-control <?php echo (!empty($salary_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $salary; ?>">
                            <span class="invalid-feedback"><?php echo $salary_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>