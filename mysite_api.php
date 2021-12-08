<?php
include "connection.php"; // Using database connection file here





$id = $_POST['id_number']; // get id through query string

$qry = mysqli_query($conn,"select * from customer_details where id_number='$id'"); // select query

$data = mysqli_fetch_array($qry); // fetch data

if(isset($_POST['update'])) // when click on Update button
{
    $firstname = $_POST['firstname'];
    $gender = $_POST['gender'];
     $address = $_POST['address'];
      $email = $_POST['email'];
       $secondname = $_POST['secondname'];
        $zipcode = $_POST['zipcode'];
         $city = $_POST['city'];
          $id_number = $_POST['id_number'];
          $phone = $_POST['phone_number'];
    

	

    
    $edit = mysqli_query($conn,"update customer_details set first_name='$firstname', gender='$gender', second_name='$secondname',
    email='$email', city='$city',phone_number='$phone',address='$address',zipcode='$zipcode',id_number='$id_number'
     where id_number='$id'");
	
    if($edit)
    {
        mysqli_close($conn); // Close connection
        $_SESSIOM['msg'] = 'Details updated successfully';
        header("location:view.php"); // redirects to all records page
        exit;
    }
    else
    {
        echo mysqli_error();
    }    	
}

/*
// Processing form data when form is submitted
if(isset($_POST["upte"]) && !empty($_POST["update"])){
    // Get hidden input value
    $id = $_POST["id_number"];
    
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
    if(isset($_GET["id_number"]) && !empty(trim($_GET["id_number"]))){
        // Get URL parameter
        $id =  trim($_GET["id_number"]);
        
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
                    contains only one row, we don't need to use while loop 
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
}*/


if(isset($_POST['submit']))
{		
    $firstname = $_POST['firstname'];
    $gender = $_POST['gender'];
    $city = $_POST['city'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];
    $zipcode = $_POST['zipcode'];
    $id_number = $_POST['id_number'];
    $secondname = $_POST['secondname'];
    $email = $_POST['email'];
    

    $insert = mysqli_query($conn,"INSERT INTO `customer_details`(`first_name`, `second_name`,`id_number`,
    `phone_number`,`address`,`zipcode`,`gender`,`city`,`email`) 
    VALUES ('$firstname','$secondname','$id_number','$phone_number','$address','$zipcode','$gender','$city','$email')");

    if(!$insert)
    {
        echo mysqli_error($conn);
    }
    else
    {
        echo "Records added successfully.";
    }
}
else{
   echo "form not submited";
}

mysqli_close($conn); // Close connection
?>