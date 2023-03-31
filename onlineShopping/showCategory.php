<?php 
if(!isset($_GET['catid'])) header('location: ./index.php');

$catid = $_GET['catid'];
$catid = htmlspecialchars($catid);

require_once('config.php');
echo "<ul>";
// Prepare a select statement
$sql = "SELECT * FROM products WHERE produCat = ? ORDER BY produList ASC LIMIT 500;";

if($stmt = mysqli_prepare($link, $sql)){
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "i", $param_catid);

    // Set parameters
    $param_catid = $catid;
    if(mysqli_stmt_execute($stmt)){
        $result = mysqli_stmt_get_result($stmt);
    }
        if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            $produid = $row['produid']; 
            $produList = $row['produList'];
            $produName = $row['produName'];
            $produDesc = $row['produDesc'];

                            
            echo "<li>\n
                    <a href='./showProduct.php?produid=$produid'>$produList. $produName</a>\n
                  </li>\n";
            
                            
        }
        echo "</ul>";
        // Free result set
        mysqli_free_result($result);
    } else{
        echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
    }


} else{
    echo "Oops! Something went wrong. Please try again later.";
}

// Close statement
mysqli_stmt_close($stmt);
    
// Close connection
mysqli_close($link);

?>
