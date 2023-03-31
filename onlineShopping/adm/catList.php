<?php

require_once('config.php');

echo "<table><tr><td>catid</td><td>catListNumber</td><td>catName</td><td>catDesc</td><td>edit</td><td>delete</td></tr>";

// Attempt select query execution
$sql = "SELECT catid, catList, catName, catDesc FROM cats ORDER BY catList ASC LIMIT 100;";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            $catid = $row['catid']; 
            $catList = $row['catList'];
            $catName = $row['catName'];
            $catDesc = $row['catDesc'];

            $catid = htmlspecialchars($catid);            
            $catList = htmlspecialchars($catList);
            $catName = htmlspecialchars($catName);
            $catDesc = nl2br($catDesc);
                            
            echo "<tr>\n
                    <td>$catid</td>        
                    <td>$catList</td>
                    <td>$catName</td>
                    <td>$catDesc</td>
                    <td><a href='./catUpdateForm.php?catid=$catid'>edit</a></td>
                    <td><a href='./catDelete.php?catid=$catid'>delete</a></td>\n
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