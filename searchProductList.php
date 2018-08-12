<html>
<head>
</head>
<body>

<?php
include("config.php");

$conn = config();

$s = $_REQUEST['srch'];
$f = $_REQUEST['fltr'];
$search = $s.'%';
$filter = '%'.$f.'%';

if (!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
}

$sql = "SELECT product.productID,product.productPicture, product.productName, category.categoryName, product.productPrice
    FROM product  
    INNER JOIN category
    ON product.categoryID = category.categoryID
    WHERE product.productName LIKE '$search' 
    AND product.categoryID LIKE '$filter'
    ORDER BY productName ASC";

$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($result)) {
    ?>

<tr onclick="window.document.location.href='editProductList.php?varname=<?php echo $row["productID"]; ?> ';">
    <td class="chk" onclick="if (event.stopPropagation) {event.stopPropagation;}event.cancelBubble = true;return true;">
        <div class="checkbox">
          <label>
            <input type="checkbox" value="<?php echo $row["productID"]; ?>" aria-label="..." name="chkbox[]">
          </label>
        </div>
    </td>
    <td class="pic"><img class="img-thumbnail img-responsive" src="<?php 
        if ($row['productPicture'] == 'ProductImage/'){
            echo 'images/preview.png';
        } else {
            echo $row['productPicture'];
            }
            ?>"></td>
    <td class="name"><?php echo $row['productName'];?></td>
    <td class="ctgry"><?php echo $row['categoryName'];?></td> 
    <td class="price"><?php echo '&#8369; '.$row['productPrice'];?></td>
</tr>

    <?php
}
mysqli_close($conn);
?>
</body>
</html>