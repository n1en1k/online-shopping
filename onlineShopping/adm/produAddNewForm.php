<h2>Add new product</h2>
<form name="produAddForm" action="produAddNew.php" method="post">
    Product list number (have to be unique):<br />
    <input type="text" name="produListNumber" id="produListNumber" />
    Product name:<br />
    <input type="text" name="produName" id="produName" />
    <br /><br />
    Product desc:<br />
    <textarea id="produDesc" name="produDesc"></textarea>
    <br /><br />
    <label for="categories">Choose category:</label><br >
    <select name="categories" id="categories">
<?php
// list categories
require_once('config.php');
// Attempt select query execution
$sql = "SELECT catid, catList, catName, catDesc FROM cats ORDER BY catList ASC LIMIT 100;";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            $catid = $row['catid']; 
            $catName = $row['catName'];

            $catid = htmlspecialchars($catid);            
            $catName = htmlspecialchars($catName);
            
            echo "<option value='$catid'>$catName</option>";            
                            
        }
        // Free result set
        mysqli_free_result($result);
    } else{
        echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
    }
} else{
    echo "Oops! Something went wrong. Please try again later.";
}
?>
    </select> 
    <br ><br >
    <input type="submit" value="Save" name="save" />
</form>