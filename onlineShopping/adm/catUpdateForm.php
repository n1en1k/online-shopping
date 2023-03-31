<?php 
if(!isset($_GET['catid'])) header('location: ./index.php');

$catid = $_GET['catid'];
$catid = htmlspecialchars($catid);

require_once('config.php');

// Prepare a select statement
$sql = "SELECT * FROM cats WHERE catid = ?";

if($stmt = mysqli_prepare($link, $sql)){
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "i", $param_catid);

    // Set parameters
    $param_catid = $catid;

    // Attempt to execute the prepared statement
    if(mysqli_stmt_execute($stmt)){
        $result = mysqli_stmt_get_result($stmt);

        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    
            echo "
                <form name='catUpdateForm' method='post' action='catUpdate.php'>
                Category list number (have to be unique): <br />
                <input type='text' id='catListNumber' name='catListNumber' value='{$row['catList']}' /><br />
                Category name: <br />
                <input type='text' value='{$row['catName']}' name='catName' id='catName' /><br />         
                Category Desc: <br />
                <textarea name='catDesc' id='catDesc' rows='5' cols='50'>{$row['catDesc']}</textarea><br />
                <input type='hidden' value='{$row['catid']}' id='catid' name='catid' />
                <input type='submit' value='Save' name='save' />
                </form>
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
