<?php
    require_once __DIR__.'/autoload/autoload.php';
    $user = $db->fetchID("users",intval($_SESSION['userid']));
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $data = [
            'amount' => $_SESSION['total'],
            'users_id' => $_SESSION['userid'],
            'note' => postInput('note')
        ];
        $idstran = $db->insert("transaction",$data);
        if($idstran > 0){
            foreach($_SESSION['cart'] as $key => $value){
                $data2 = [
                    'transaction_id' => $idstran,
                    'product_id' => $key,
                    'qty' => $value['qty'],
                    'price' => $value['price']
                ];
                $id_insert2 = $db->insert("orders",$data2);
            }
            
            $_SESSION['success'] = "Lưu thông tin đơn hàng thành công";
            header('location:thong-bao.php');
        }
    }
    
?>
<?php
    require_once __DIR__.'/layouts/header.php';
?>
<div class="col-md-9">
    <section class="box-main1">
        <h3 class="title-main" style="text-align: center;"><a href="javascript:void(0)"> Thanh toán đơn hàng </a> </h3>
        <!-- Nội dung -->
        <form action = "" method = "POST">
            <div class="form-group">
                <label for="user">Tên người dùng</label>
                <input type="text" readonly= "" class="form-control" id="user" name = "name" value = "<?php echo $user['name']; ?>">
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" readonly= "" class="form-control" id="email" name = "email" value = "<?php echo $user['email']; ?>">
            </div>
            <div class="form-group">
                <label for="phone">SĐT</label>
                <input type="number" readonly= "" class="form-control" name = "phone" id="phone" value = "<?php echo $user['phone']; ?>">
            </div>
            <div class="form-group">
                <label for="address">Địa chỉ</label>
                <input type="text" readonly= "" class="form-control" name = "address" id="address" value = "<?php echo $user['address']; ?>">
            </div>
            <div class="form-group">
                <label for="money">Số tiền</label>
                <input type="text" readonly= "" class="form-control" name = "money" id="money" value = "<?php echo formatPrice($_SESSION['total']); ?>">
            </div>
            <div class="form-group">
                <label for="note">Ghi chú</label>
                <textarea class="form-control" name = "note" id="note" ></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Thanh toán</button>
        </form>
    </section>
</div>
<?php
    require_once __DIR__.'/layouts/footer.php';
?>