<?php
require_once('config.php');
// old require_once('dbopen.php');

// Otetaan data talteen:
$produListNumber   = (isset($_REQUEST['produListNumber']))   ?
                $_REQUEST['produListNumber'] : ''; 

$produName   = (isset($_REQUEST['produName']))   ?
                $_REQUEST['produName'] : ''; 
				
$produDesc   = (isset($_REQUEST['produDesc']))   ?
                $_REQUEST['produDesc'] : '';

$categories   = (isset($_REQUEST['categories']))   ?
                $_REQUEST['categories'] : ''; 




if($produName == "") {
	header("location: fail.php"); exit();
}

else if($produDesc == "") {
	header("location: fail.php"); exit();
}

else if($produListNumber == "") {
	header("location: fail.php"); exit();
}

$produName = htmlspecialchars($produName);

$produDesc = htmlspecialchars($produDesc);

$produDesc = wordwrap($produDesc, 25, " ", true);

$produListNumber = htmlspecialchars($produListNumber);

$categories = htmlspecialchars($categories);


// Prepare an insert statement
$sql = "INSERT INTO products (produList, produName, produDesc, produCat) VALUES (?, ?, ?, ?)";
     
if($stmt = mysqli_prepare($link, $sql)){
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "issi", $param_produListNumber, $param_produName, $param_produDesc, $param_producategories);
        
    // Set parameters
    $param_produName = $produName;
    $param_produDesc = $produDesc;
    $param_produListNumber = $produListNumber;
    $param_producategories = $producategories;
        
    // Attempt to execute the prepared statement
    if(mysqli_stmt_execute($stmt)){
        // Records created successfully. Redirect to landing page
        header("location: ./index.php");
        exit();
    } else{
        echo "Oops! Something went wrong. Please try again later.";
    }
}
     
// Close statement
mysqli_stmt_close($stmt);

?>