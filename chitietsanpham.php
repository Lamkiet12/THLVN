<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<html>
    <head>
        <title>BOOKSTORE</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="css/style_detail.css">
    </head>
    <body>
        <?php
        include './connect_db.php';
        $result = mysqli_query($kn, "SELECT * FROM `sanpham` WHERE `id_sp` =1 ");//.$_GET['id']
        $product = mysqli_fetch_assoc($result);
        $imgLibrary = mysqli_query($kn, "SELECT * FROM `khoanh` WHERE `id_sanpham` = 1 ");//.$_GET['id']
        $product['image'] = mysqli_fetch_all($imgLibrary, MYSQLI_ASSOC);
		if($product['soluong']>0){
        ?>
        <div class="container">
            <h2>Chi tiết sản phẩm</h2>
            <div id="product-detail">
                <!--<div id="product-img">
                    <img src="admin1/<?=$product['hinh_sp']?>" />
                </div>-->
                <div id="product-info">
                    <h1><?=$product['ten_sp']?></h1>
                    <label>Tên tác giả: </label><span class="product-price"><?=$product['tentacgia']?></span><br/>
					<label>Giá: </label><span class="product-price"><?= number_format($product['gia'], 0, ",", ".") ?> VND</span><br/>
					<label>Thể loại: </label><span class="product-price"><?=$product['theloai']?></span><br/>
                    <form id="add-to-cart-form" action="giohang.php?action=add" method="POST" >
						<input type="text" value="1" name="quantity[<?= $product['id_sp']?>]" size="2" /><br>
						<input type="submit" value="Mua sản phẩm" />
					</form>
                    <?php if(!empty($product['hinh_sp'])){ ?>
                    <div id="gallery">
                        <ul>
                            <?php foreach($product['image'] as $img) { ?>
                                <li><img src="admin1/<?=$img['path']?>" /></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <?php } ?>
                </div>
                <div class="clear-both"></div>
                <?=$product['chitiet']?>
            </div>
        </div>
		<?php }else{ ?>
		<div class="container">
            <h2>Chi tiết sản phẩm</h2>
            <div id="product-detail">
                <div id="product-img">
                    <img src="admin1/<?=$product['images']?>" />
                </div>
                <div id="product-info">
                    <h1><?=$product['ten']?></h1>
                    <label>Giá: </label><span class="product-price"><?= number_format($product['price'], 0, ",", ".") ?> VND</span><br/>
                    <p><h2>Hết hàng</h2></p>
                    <?php if(!empty($product['images'])){ ?>
                    <div id="gallery">
                        <ul>
                            <?php foreach($product['image'] as $img) { ?>
                                <li><img src="admin1/<?=$img['path']?>" /></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <?php } ?>
                </div>
                <div class="clear-both"></div>
                <?=$product['content']?>
            </div>
        </div>
		<?php } ?>
    </body>
</html>