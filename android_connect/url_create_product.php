<?php
$servername = "localhost";
$database = "id6312982_pizzaria_db";
$username = "id6312982_pizzaria_user";
$password = "qweewq123321";
/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */

// array for JSON response
$response = array();

// check for required fields
if (isset($_POST['name']) && isset($_POST['price']) && isset($_POST['description'])) {
    
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        // echo "Connected successfully</br>";
				// check if row inserted or not
		if ($result = $mysqli->query("INSERT INTO products(name, price, description) VALUES('$name', '$price', '$description')")) {
			// successfully inserted into database
			$response["success"] = 1;
			$response["message"] = "Product successfully created.";

			// echoing JSON response
			echo json_encode($response);
			
			/* free result set */
			$result->close();
			
		} else {
			// failed to insert row
			$response["success"] = 0;
			$response["message"] = "Oops! An error occurred.";
			
			// echoing JSON response
			echo json_encode($response);
		}

    }

} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    // echoing JSON response
    echo json_encode($response);
}
?>