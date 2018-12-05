<?php
$servername = "localhost";
$database = "id6312982_pizzaria_db";
$username = "id6312982_pizzaria_user";
$password = "qweewq123321";

/*
 * Following code will get single product details
 * A product is identified by product id (pid)
 */

// array for JSON response
$response = array();

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    // echo "Connected successfully</br>";    
}

// check for required fields
if (isset($_POST['pid'])) {
    $pid = $_POST['pid'];

    // mysql update row with matched pid
	$sql_user = "DELETE FROM products WHERE pid = $pid";

	$result = mysqli_query($conn, $sql_user) or die(mysqli_error($conn));
    
    // check if row deleted or not
    if (mysqli_affected_rows($conn) > 0) {
        // successfully updated
        $response["success"] = 1;
        $response["message"] = "Product successfully deleted";

        // echoing JSON response
        echo json_encode($response);
    } else {
        // no product found
        $response["success"] = 0;
        $response["message"] = "No product found";

        // echo no users JSON
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    // echoing JSON response
    echo json_encode($response);
}

mysqli_close($conn);
?>