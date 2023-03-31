<?php
require_once('config.php');
// old require_once('dbopen.php');

// Otetaan data talteen:
$catListNumber   = (isset($_REQUEST['catListNumber']))   ?
                $_REQUEST['catListNumber'] : ''; 

$catName   = (isset($_REQUEST['catName']))   ?
                $_REQUEST['catName'] : ''; 
				
$catDesc   = (isset($_REQUEST['catDesc']))   ?
                $_REQUEST['catDesc'] : ''; 


if($catName == "") {
	header("location: fail.php"); exit();
}

else if($catDesc == "") {
	header("location: fail.php"); exit();
}

else if($catListNumber == "") {
	header("location: fail.php"); exit();
}

$catName = htmlspecialchars($catName);

$catDesc = htmlspecialchars($catDesc);

$catDesc = wordwrap($catDesc, 25, " ", true);

$catListNumber = htmlspecialchars($catListNumber);


// Prepare an insert statement
$sql = "INSERT INTO cats (catList, catName, catDesc) VALUES (?, ?, ?)";
     
if($stmt = mysqli_prepare($link, $sql)){
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "iss", $param_catListNumber, $param_catName, $param_catDesc);
        
    // Set parameters
    $param_catName = $catName;
    $param_catDesc = $catDesc;
    $param_catListNumber = $catListNumber;
        
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