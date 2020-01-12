<?php
    require_once __DIR__.'/autoload/autoload.php';
    $sqlHomeCate = "SELECT name ,id FROM category WHERE home = 1 ORDER BY updated_at";
    $CategoryHome = $db->fetchsql($sqlHomeCate);
    $data = [];
    foreach($CategoryHome as $item){
        $cateId = intval($item['id']);
        $sql = "SELECT * FROM product WHERE category_id = $cateId";
        $ProductHome = $db->fetchsql($sql);
        $data[$item['name']] = $ProductHome;
    }
?>
<?php
    require_once __DIR__.'/layouts/header.php';
?>
<div class="col-md-9 bor">
    <section id="slide" class="text-center" >
        <img src="public/frontend/images/banner1.png" class="img-thumbnail">
    </section>
    <section class="box-main1">

        <?php foreach($data as $key => $value) : ?>
            <h3 class="title-main" style="text-align: left;"><a href=""> <?php echo $key; ?> </a> </h3>
            <div class="showitem">
                <?php foreach($value as $item): ?>
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
                            <p><a href="addcart.php?id=<?php echo $item['id']; ?>"><i class="fa fa-shopping-basket"></i></a></p>
                        </div>
                    </div>
                <?php endforeach;?>
            </div>
        <?php endforeach; ?>
        
    </section>
</div>
<?php
    require_once __DIR__.'/layouts/footer.php';
?>