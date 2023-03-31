<?php 

if(!isset($_GET['catid'])) header('location: ./index.php');

$delcatid = $_GET['catid'];
$delcatid = htmlspecialchars($delcatid);

require_once('./config.php');

// Prepare a delete statement
$sql = "DELETE FROM cats WHERE catid = ?";
    
if($stmt = mysqli_prepare($link, $sql)){
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "i", $param_delid);
        
    // Set parameters
    $param_delid = $delcatid;
        
    // Attempt to execute the prepared statement
    if(mysqli_stmt_execute($stmt)){
        // Records deleted successfully. Redirect to landing page
        header("location: ./index.php");
        exit();
    } else{
        echo "Oops! Something went wrong. Please try again later.";
    }
}
     
// Close statement
mysqli_stmt_close($stmt);

// Close connection
mysqli_close($link);

?>