<?php

require_once('config.php');

echo "<table><tr><td>produid</td><td>produListNumber</td><td>produName</td><td>produDesc</td><td>produCat</td><td>edit</td><td>delete</td></tr>";

// Attempt select query execution
$sql = "SELECT produid, produList, produName, produDesc, produCat FROM products ORDER BY produList ASC LIMIT 500;";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            $produid = $row['produid']; 
            $produList = $row['produList'];
            $produName = $row['produName'];
            $produDesc = $row['produDesc'];
            $produCat = $row['produCat'];

            $produid = htmlspecialchars($produid);            
            $produList = htmlspecialchars($produList);
            $produName = htmlspecialchars($produName);
            $produDesc = nl2br($produDesc);
            $produCat = htmlspecialchars($produCat);
                            
            echo "<tr>\n
                    <td>$produid</td>        
                    <td>$produList</td>
                    <td>$produName</td>
                    <td>$produDesc</td>
                ";
                    // Prepare a select statement
                    $squalo = "SELECT * FROM cats WHERE catid = ?";
                    
                    if($statementti = mysqli_prepare($link, $squalo)){
                        // Bind variables to the prepared statement as parameters
                        mysqli_stmt_bind_param($stmt, "i", $param_catid);
                    
                        // Set parameters
                        $param_catid = $produCat;
                    
                        // Attempt to execute the prepared statement
                        if(mysqli_stmt_execute($statementti)){
                            $resultti = mysqli_stmt_get_result($statementti);
                    
                            if(mysqli_num_rows($resultti) == 1){
                                $rivi = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                $catName = $rivi['catName']; 
                                echo "<td>$catName</td>";
                           
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
                    mysqli_stmt_close($statementti);

                echo "
                    <td><a href='./produUpdateForm.php?produid=$produid'>edit</a></td>
                    <td><a href='./produDelete.php?produid=$produid'>delete</a></td>\n
            </tr>\n";
            
                            
        }
        echo "</table>";
        // Free result set
        mysqli_free_result($result);
    } else{
        echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
    }
} else{
    echo "Oops! Something went wrong. Please try again later.";
}
?>