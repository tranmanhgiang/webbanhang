<?php
    require_once __DIR__.'/autoload/autoload.php';
    $sum = 0;
    if(!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0){
        echo "<script>alert('Không có sản phẩm trong giỏ hàng'); location.href='index.php'</script>";
    }
?>
<?php
    require_once __DIR__.'/layouts/header.php';
?>
<div class="col-md-9 bor">
    <!-- thong bao loi -->
    <?php require_once __DIR__."/partials/notification.php";  ?>
    <section class="box-main1">
        <h3 class="title-main" style="text-align: center;"><a href="javascript:void(0)"> Giỏ hàng </a> </h3>
        <!-- Nội dung -->
        <table class="table">
            <tdead>
            <tr>
                <th>STT</th>
                <th>Tên sản phẩm</th>
                <th>Hình ảnh</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Tổng tiền</th>
                <th>Action</th>
            </tr>
            </tdead>
            <tbody>
            <?php $stt = 1; foreach($_SESSION['cart'] as $key => $value): ?>
                    <tr>
                        <td><?php echo $stt; ?></td>
                        <td><?php echo $value['name'] ?></td>
                        <td>
                            <img src="<?php echo uploads() ?>product/<?php echo $value['thunbar']; ?>"  height = "80px" width = "80px">
                        </td>
                        <td style = 'width:70px;'>
                            <input type="number" min = 0 value = "<?php echo $value['qty'] ?>" class = 'form-control qty' id = "qty">
                        </td>
                        <td><?php echo formatPrice($value['price']); ?></td>
                        <td><?php echo formatPrice($value['price'] * $value['qty']); ?></td>
                        <td>
                            <a class = "btn btn-xs btn-info updatecart" data-key = <?php echo $key; ?> href="#"><i class = "fa fa-refresh"></i>Cập nhât</a>
                            <a class = "btn btn-xs btn-danger" href="remove.php?key=<?php echo $key; ?>"><i class = "fa fa-times"></i>Xóa</a>
                        </td>
                        <?php $sum +=  $value['price'] * $value['qty']; $_SESSION['tongtien'] = $sum;?>
                    </tr>
            <?php $stt++; endforeach; ?>
            </tbody>
        </table>
                <div class="col-md-5 pull-right">
                    <ul class="list-group">
                        <li class="list-group-item active"><h3>Thông tin giỏ hàng</h3></li>
                        <li class="list-group-item">
                            Số tiền: 
                            <span><?php echo formatPrice($_SESSION['tongtien']); ?></span>
                        </li>
                        <li class="list-group-item">Thuế VAT: 10 %</li>
                        <li class="list-group-item">
                            Tổng tiền thanh toán: 
                            <?php 
                                $_SESSION['total'] = ($_SESSION['tongtien']*110/100); 
                                echo formatPrice($_SESSION['total']);
                            ?>
                        </li>
                        <li class="list-group-item">
                            <a class = "btn btn-info" href="index.php">Tiếp tục mua hàng</a>
                            <a class = "btn btn-success" href="payment.php">Thanh toán</a>
                        </li>
                    </ul>
                </div>
    </section>
</div>
<?php
    require_once __DIR__.'/layouts/footer.php';
?>