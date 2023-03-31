<?php
if(!isset($_REQUEST['catid'])) header('location: ./index.php');

$catid = $_REQUEST['catid'];
$catid = htmlspecialchars($catid);

require_once('./config.php');
// old require_once('dbopen.php');

// Otetaan data talteen:
$catListNumber   = (isset($_REQUEST['catListNumber']))   ?
                $_REQUEST['catListNumber'] : ''; 
				
$catName   = (isset($_REQUEST['catName']))   ?
                $_REQUEST['catName'] : ''; 

$catDesc   = (isset($_REQUEST['catDesc']))   ?
                $_REQUEST['catDesc'] : ''; 


$catListNumber = htmlspecialchars($catListNumber);
$catName = htmlspecialchars($catName);
$catDesc = htmlspecialchars($catDesc);
$catDesc = wordwrap($catDesc, 25, " ", true);

// Prepare an update statement
$sql = "UPDATE cats SET catList=?, catName=?, catDesc=? WHERE catid=?";
     
if($stmt = mysqli_prepare($link, $sql)){
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "issi", $param_catListNumber, $param_catName, $param_catDesc, $param_catid);
        
    // Set parameters
    $param_catListNumber = $catListNumber;
    $param_catName = $catName;
    $param_catDesc = $catDesc;
    $param_catid = $catid;
        
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