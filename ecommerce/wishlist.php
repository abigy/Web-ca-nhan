<?php 
require('top.php');
if(!isset($_SESSION['USER_LOGIN'])){
	?>
	<script>
	    window.location.href='index.php';
	</script>
	<?php
}
$uid=$_SESSION['USER_ID'];
$res=mysqli_query($con,"select product.name,product.image,product_attributes.price,product_attributes.mrp,product.id as pid,wishlist.id from product,wishlist,product_attributes where wishlist.product_id=product.id and wishlist.user_id='$uid' and product_attributes.product_id=product.id group by product_attributes.product_id");
?>

<div class="ht__bradcaump__area bg__white">
    <div class="ht__bradcaump__wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="bradcaump__inner">
                        <nav class="bradcaump-inner">
                            <a class="breadcrumb-item" href="index.php">Home</a>
                            <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                            <span class="breadcrumb-item active">Wishlist</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        
<!-- cart-main-area -->
<div class="cart-main-area ptb--40 bg__white" >
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <form action="#">               
                    <div class="table-content table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">products</th>
                                    <th class="product-name">name of products</th>
                                    <th class="product-name">Remove</th>
                                    <th class="product-name"></th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php while($row=mysqli_fetch_assoc($res)) { ?>
                                    <tr>
                                        <td class="product-thumbnail"><a href="#"><img src="./media/product/<?php echo $row['image']?>"  /></a></td>
                                        <td class="product-name"><a href="product.php?id=<?php echo $row['pid']?>"><?php echo $row['name']?></a>
                                            <ul  class="pro__prize">
											    <li class="old__prize"><small><strike><?php echo formatMoney($row['mrp'])?></strike></small></li>
                                                <li><?php echo formatMoney($row['price'])?> đ</li>
                                            </ul>
                                        </td>
                                        <td class="product-remove"><a href="wishlist.php?wishlist_id=<?php echo $row['id']?>"><i class="icon-trash icons"></i></a></td>
                                        <td class="product-remove"><a href="javascript:void(0)" onclick="manage_cart('<?php echo $row['pid']?>','add')">Add to Cart</a></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="buttons-cart--inner">
                                <div class="buttons-cart">
                                    <a href="<?php echo SITE_PATH?>">Continue Shopping</a>
                                </div>
                                <div class="buttons-cart checkout--btn">
                                    <a href="<?php echo SITE_PATH?>checkout.php">checkout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form> 
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="qty" value="1"/>	

<?php require('footer.php')?> 