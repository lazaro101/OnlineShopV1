<html>
<head>
</head>
<body>

<?php
include("config.php");

$conn = config();

$q = $_REQUEST['q'];
$search = $q.'%';

if (!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
}

$sql = "SELECT * FROM category 
        WHERE categoryName LIKE '$search' 
        AND deleted = '0'
        ORDER BY categoryName ASC";

$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($result)) {
    ?>

<tr onclick="window.document.location.href='editProductType.php?varname=<?php echo $row["categoryID"]; ?> ';">
    <td class="chk" onclick="if (event.stopPropagation) {event.stopPropagation;}event.cancelBubble = true;return true;">
        <div class="checkbox">
          <label>
            <input type="checkbox" aria-label="..." value="<?php echo $row["categoryID"]; ?>" name="chkbox[]">
          </label>
        </div>
    </td>
    <td><?php echo $row['categoryName'];?></td>
</tr>

    <?php
}
mysqli_close($conn);
?>
</body>
</html>