function validateForm() {
    let firstname = document.forms["customer_details_form"]["firstname"].value;
    let secondname = document.forms["customer_details_form"]["secondname"].value;
    let gender = document.forms["customer_details_form"]["gender"].value;
    let address = document.forms["customer_details_form"]["address"].value;
    let city = document.forms["customer_details_form"]["city"].value;
    let zipcode = document.forms["customer_details_form"]["zipcode"].value;
    let id_number = document.forms["customer_details_form"]["id_number"].value;
    let phone_number = document.forms["customer_details_form"]["phone_number"].value;
    let email = document.forms["customer_details_form"]["email"].value;


    //RegEx for numbers
    var numbers = /^[0-9]+$/;

    //RegEx for Email address
    var email_regx = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;



    if (firstname == "") {
        alert("First name must be filled out");
        return false;
    } else if (secondname == "") {
        alert("Second name must be filled out");
        return false;
    } else if (id_number == "") {
        alert("ID number field cannot be blank");
        return false;
    }

    //Validate the integer only requirement for ID number using RegEx above
    if (!(id_number.match(numbers))) {
        alert("ID number should contain numbers only");
        return false;
    }

    if (!(String(email).toLowerCase.match(email_regx))) {
        aalert("Invalid Email address, ensure you put the right email address");
        return false;
    }

}