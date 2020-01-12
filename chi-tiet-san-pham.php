<?php
    require_once __DIR__.'/autoload/autoload.php';
    $id = intval(getInput('id'));
    $product = $db->fetchID("product",$id);

    $cateid = intval($product['category_id']);
    $sql = "SELECT * FROM product WHERE category_id = $cateid ORDER BY ID DESC LIMIT 4;";
    $attached_products = $db->fetchsql($sql);
?>
<?php
    require_once __DIR__.'/layouts/header.php';
?>
<div class="col-md-9 bor">
<section class="box-main1" >
                            <div class="col-md-6 text-center">
                                <img src="<?php echo uploads() ?>product/<?php echo $product['thunbar']; ?>" class="img-responsive bor" id="imgmain" width="100%" height="370" data-zoom-image="images/16-270x270.png">
                                
                                <ul class="text-center bor clearfix" id="imgdetail">
                                
                                    <li>
                                        <img src="<?php echo base_url() ?>public/frontend/images/16-270x270.png" class="img-responsive pull-left" width="80" height="80">
                                    </li>
                                    <li>
                                        <img src="<?php echo base_url() ?>public/frontend/images/16-270x270.png" class="img-responsive pull-left" width="80" height="80">
                                    </li>
                                    <li>
                                        <img src="<?php echo base_url() ?>public/frontend/images/16-270x270.png" class="img-responsive pull-left" width="80" height="80">
                                    </li>
                                    <li>
                                        <img src="<?php echo base_url() ?>public/frontend/images/16-270x270.png" class="img-responsive pull-left" width="80" height="80">
                                    </li>
                                   
                                </ul>
                            </div>
                            <div class="col-md-6 bor" style="margin-top: 20px;padding: 30px;">
                               <ul id="right">
                                    <li><h3> <?php echo $product['name']; ?> </h3></li>
                                    <li><p><?php echo $product['sale'] != 0 ? "Khuyễn mãi" : ''; ?></p></li>
                                    <li><p><strike class="sale"><?php echo $product['sale'] != 0 ? formatPrice($product['price']) : ''; ?> </strike> <b class="price"><?php echo formatPrice($product['price'] * (1-$product['sale']/100)); ?> </b</li>
                                    <li><a href="" class="btn btn-default"> <i class="fa fa-shopping-basket"></i>Add TO Cart</a></li>
                               </ul>
                            </div>

                        </section>
                        <div class="col-md-12" id="tabdetail">
                            <div class="row">
                                    
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#home">Mô tả sản phẩm </a></li>
                                    <li><a data-toggle="tab" href="#menu1">Thông tin khác </a></li>
                                    <li><a data-toggle="tab" href="#menu2">Menu 2</a></li>
                                    <li><a data-toggle="tab" href="#menu3">Menu 3</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="home" class="tab-pane fade in active">
                                        <p><?php echo $product['content']; ?></p>
                                    </div>
                                    <div id="menu1" class="tab-pane fade">
                                        <h3>Sản phẩm gợi ý</h3>
                                        <p>
                                            <div class="col-md-12">
                                                <div class="showitem">
                                                    <?php foreach($attached_products as $item): ?>
                                                    <div class="col-md-3  item-product bor">
                                                        <a href="chi-tiet-san-pham.php?id=<?php echo $item['id']; ?>">
                                                        <img src="<?php echo uploads() ?>product/<?php echo $item['thunbar'] ?>" class="" width="100%" height="180">
                                                        </a>
                                                        <div class="info-item">
                                                            <a href="chi-tiet-san-pham.php?id=<?php echo $item['id']; ?>"><?php echo $item['name']; ?></a>
                                                            <p><strike class="sale"><?php echo formatPrice($item['price']); ?> đ</strike> <b class="price"><?php echo formatPrice($item['price'] * (1-$item['sale']/100)); ?> đ</b></p>
                                                        </div>
                                                        <div class="hidenitem">
                                                            <p><a href=""><i class="fa fa-search"></i></a></p>
                                                            <p><a href=""><i class="fa fa-heart"></i></a></p>
                                                            <p><a href=""><i class="fa fa-shopping-basket"></i></a></p>
                                                        </div>
                                                    </div>
                                                    <?php endforeach;?>
                                                </div>
                                            </div>
                                        </p>
                                    </div>
                                    <div id="menu2" class="tab-pane fade">
                                        <h3>Menu 2</h3>
                                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                                    </div>
                                    <div id="menu3" class="tab-pane fade">
                                        <h3>Menu 3</h3>
                                        <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
</div>
<?php
    require_once __DIR__.'/layouts/footer.php';
?>