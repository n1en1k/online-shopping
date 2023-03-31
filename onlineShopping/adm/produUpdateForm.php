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
            $produCat = $rivi['produCat'];
            echo "
                <form name='produAddForm' method='post' action='produUpdate.php'>
                Product list number (have to be unique): <br />
                <input type='text' id='produListNumber' name='produListNumber' value='{$row['produList']}' /><br />
                Product name: <br />
                <input type='text' value='{$row['produName']}' name='produName' id='produName' /><br />         
                Product Desc: <br />
                <textarea name='produDesc' id='produDesc' rows='5' cols='50'>{$row['produDesc']}</textarea><br />
                <input type='hidden' value='{$row['produid']}' id='produid' name='produid' />
                <label for='categories'>Choose category:</label><br >
                <select name='categories' id='categories'>
            ";
                // Attempt select query execution
                $squalo = "SELECT catid, catList, catName, catDesc FROM cats ORDER BY catList ASC LIMIT 100;";
                if($resultti = mysqli_query($link, $squalo)){
                    if(mysqli_num_rows($result) > 0){
                        while($rivi = mysqli_fetch_array($resultti)){
                            $catid = $rivi['catid']; 
                            $catName = $rivi['catName'];

                            $catid = htmlspecialchars($catid);            
                            $catName = htmlspecialchars($catName);
                            
                            if($catid == $produCat) {
                                echo "<option selected='selected' value='$catid'>$catName</option>";
                            }
                            else {
                            echo "<option value='$catid'>$catName</option>";
                            }            
                                            
                        }
                        // Free result set
                        mysqli_free_result($resultti);
                    } else{
                        echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                    }
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }

            echo "
            </select> 
            <br ><br >
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