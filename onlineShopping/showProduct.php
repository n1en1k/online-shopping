<?php 
if(!isset($_GET['produid'])) header('location: ./index.php');

$produid = $_GET['produid'];
$produid = htmlspecialchars($produid);

require_once('config.php');

// Prepare a select statement
$sql = "SELECT * FROM products WHERE produid = ?";

if($stmt = mysqli_prepare($link, $sql)){
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "i", $param_produid);

    // Set parameters
    $param_produid = $produid;

    // Attempt to execute the prepared statement
    if(mysqli_stmt_execute($stmt)){
        $result = mysqli_stmt_get_result($stmt);

        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    
            echo "
                <h3>{$row['produList']}. {$row['produName']}</h3>\n
                <h3>{$row['produDesc']}</h3>\n
                <h3>{$row['produDesc']}</h3>\n
            ";
       
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
mysqli_close($link);

?>
