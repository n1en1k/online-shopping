<?php

require_once('config.php');

echo "<ul>";

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
                            
            echo "<li>\n
                    <a href='./showCategory.php?catid=$catid'>$catName</a>\n
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
?>