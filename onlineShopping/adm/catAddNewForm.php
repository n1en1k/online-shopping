<h2>Add new category</h2>
<form name="catAddForm" action="catAddNew.php" method="post">
    Category list number (have to be unique):<br />
    <input type="text" name="catListNumber" id="catListNumber" />
    Category name:<br />
    <input type="text" name="catName" id="catName" />
    <br /><br />
    Category desc:<br />
    <textarea id="catDesc" name="catDesc"></textarea>
    <br /><br />
    <input type="submit" value="Save" name="save" />
</form>