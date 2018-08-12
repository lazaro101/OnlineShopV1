<?php
include("../config.php");

$conn = config();

// $s = $_REQUEST['srch'];
$f = $_REQUEST['fltr'];
$s = $_REQUEST['sort'];
// $search = '%'.$s.'%';
$filter = '%'.$f.'%';

    $sql = "SELECT * FROM product WHERE categoryID LIKE '$filter' AND deleted = '0' ORDER BY $s ;" ;
    $conn = config();
    $ctr = 0;

    if ($result = mysqli_query($conn,$sql)) {
        while ($row =  mysqli_fetch_assoc($result)){
    ?>
    <div class="col-sm-3 product">
        <a href="showProduct.php?varname=<?php echo $row['productID'] ?>" class="thumbnail">
            <img src="<?php
            if ($row['productPicture'] == 'ProductImage/'){
                echo '../images/preview.png';
            } else {
                echo '../'.$row['productPicture'];
                }
            ?>" alt="" class="img-thumbnail">
            <div class="caption">
                <h4><strong><?php echo $row['productName']?></strong></h4>
                <p><?php echo '&#8369; '.number_format($row['productPrice'], 2)?></p>
            </div>
        </a>
    </div>
    <?php 
            $ctr += 1;
            }
        }

?>
<script type="text/javascript">
    document.getElementById("number").innerHTML = "<?php echo $ctr?>";
</script>