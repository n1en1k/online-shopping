<?php
if(!isset($_REQUEST['produid'])) header('location: ./index.php');

$produid = $_REQUEST['produid'];
$produid = htmlspecialchars($produid);

require_once('./config.php');
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


$produListNumber = htmlspecialchars($produListNumber);
$produName = htmlspecialchars($produName);
$produDesc = htmlspecialchars($produDesc);
$produDesc = wordwrap($produDesc, 25, " ", true);
$categories = htmlspecialchars($categories);

// Prepare an update statement
$sql = "UPDATE products SET produList=?, produName=?, produDesc=?, produCat=? WHERE produid=?";
     
if($stmt = mysqli_prepare($link, $sql)){
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "issii", $param_produListNumber, $param_produName, $param_produDesc, $param_categories, $param_produid);
        
    // Set parameters
    $param_produListNumber = $produListNumber;
    $param_produName = $produName;
    $param_produDesc = $produDesc;
    $param_categories = $categories;
    $param_produid = $produid;
        
    // Attempt to execute the prepared statement
    if(mysqli_stmt_execute($stmt)){
        // Records updated successfully. Redirect to landing page
        header("location: ./index.php");
        exit();
    } else{
        echo "Oops! Something went wrong. Please try again later.";
    }
}
     
// Close statement
mysqli_stmt_close($stmt);

?>