<?php

/*
 * Following code will get single product details
 * A product is identified by product id (pid)
 */
$servername = "localhost";
$database = "id6312982_pizzaria_db";
$username = "id6312982_pizzaria_user";
$password = "qweewq123321";

/*
 * Following code will get single product details
 * A product is identified by product id (pid)
 */

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    // echo "Connected successfully</br>";    
}
// array for JSON response
$response = array();


// check for post data
if (isset($_GET["pid"])) {
    $pid = $_GET['pid'];

    // get a product from products table
    //$result = mysql_query("SELECT * FROM products WHERE pid = $pid");
    
    
    // mysql update row with matched pid
	$sql_user = "SELECT * FROM products WHERE pid = $pid";

	$result = mysqli_query($conn, $sql_user) or die(mysqli_error($conn));

    if (!empty($result)) {
        // check for empty result
        if (mysqli_num_rows($result) > 0) {

            $result = mysqli_fetch_array($result);

            $product = array();
            $product["created_at"] = $result["created_at"];
            $product["updated_at"] = $result["updated_at"];
			$product["name"] = $result["name"];
            $product["price"] = $result["price"];
			$product["description"] = $result["description"];
            // success
            $response["success"] = 1;

            // user node
            $response["product"] = array();

            array_push($response["product"], $product);

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
?>