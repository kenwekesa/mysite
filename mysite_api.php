<?php
include "connection.php"; // Using database connection file here



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
    

    $insert = mysqli_query($conn,"INSERT INTO `user_details`(`first_name`, `second_name`,`id_number`,
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