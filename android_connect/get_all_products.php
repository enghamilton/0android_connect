<?php
$servername = "localhost";
$database = "id6312982_pizzaria_db";
$username = "id6312982_pizzaria_user";
$password = "qweewq123321";

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


$sql_user = "SELECT pid,name,price,description FROM `products` ";

$query_user = mysqli_query($conn, $sql_user) or die(mysqli_error($conn));

if ($result=mysqli_query($conn,$sql_user))
  {
  // Return the number of rows in result set
  $rowcount=mysqli_num_rows($result);
  if($rowcount > 0){
      $response["products"] = array();
      while($row = mysqli_fetch_array($query_user)){
        $product = array();
        $product["pid"] = $row["pid"];
        $product["name"] = $row["name"];
        $product["price"] = $row["price"];
        $product["description"] = $row["description"];
        array_push($response["products"], $product);
      }
      $response["success"] = 1;
      echo json_encode($response);
  }
  mysqli_free_result($result);
  }

mysqli_close($conn);
?>
<html>
    <body>
    
    </body>    
</html>