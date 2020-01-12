<?php
    require_once __DIR__.'/autoload/autoload.php';
    if(isset($_SESSION['username'])){
        echo "<script>alert('Vui lòng đăng xuất'); location.href='index.php'</script>";
    }

    $data = [
        'name' => postInput('name'),
        'email' => postInput('email'),
        'password' => MD5(postInput('password')),
        'address' => postInput('address'),
        'phone' => postInput('phone')
    ];
    $error = [];
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if($data['name'] == ''){
            $error['name'] = "Tên không được để trống";
        }
        if($data['email'] == ''){
            $error['email'] = "Email không được để trống";
        }
        if($data['password'] == ''){
            $error['password'] = "Mật khẩu không được để trống";
        }
        if($data['address'] == ''){
            $error['address'] = "Địa chỉ không được để trống";
        }
        if($data['phone'] == ''){
            $error['phone'] = "SĐT không được để trống";
        }
    }
    if(empty($error) && $_SERVER['REQUEST_METHOD'] == "POST"){
        $isset = $db->fetchOne("users"," email = '".$data['email']."' ");
            if($isset != NULL){
                $_SESSION['error'] = "Email đã tồn tại";
            }else{
                $idinsert = $db->insert("users",$data);
                if($idinsert){
                    $_SESSION['success'] = "Đăng ký thành công! Mời bạn đăng nhập";
                    header('location: login.php');
                }else{
                    $_SESSION['error'] = "Đăng ký thất bại";
                }
            }
    }
?>
<?php
    require_once __DIR__.'/layouts/header.php';
?>
<div class="col-md-9 bor">
    <section class="box-main1">
        <h3 class="title-main" style="text-align: center;">Đăng ký thành viên </h3>
        <form action = "" method = "POST">
            <div class="form-group">
                <label for="user">Tên người dùng</label>
                <input type="text" class="form-control" id="user" name = "name" placeholder="Enter username" value = "<?php echo $data['name']; ?>">
                <?php if(isset($error['name'])):?>
                    <p class = "text-danger"><?php echo $error['name'];?></p>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name = "email" placeholder="Enter email" value = "<?php echo $data['email']; ?>">
                <?php if(isset($error['email'])) : ?>
                    <p class = "text-danger"><?php echo $error['email'] ?></p>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name = "password" id="password" placeholder = "Enter password">
                <?php if(isset($error['password'])) : ?>
                    <p class = "text-danger"><?php echo $error['password'] ?></p>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="phone">SĐT</label>
                <input type="number" class="form-control" name = "phone" id="phone" placeholder="0395578355" value = "<?php echo $data['phone']; ?>">
                <?php if(isset($error['phone'])) : ?>
                    <p class = "text-danger"><?php echo $error['phone'] ?></p>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="address">Địa chỉ</label>
                <input type="text" class="form-control" name = "address" id="address" placeholder="Hà Nam" value = "<?php echo $data['address']; ?>">
                <?php if(isset($error['address'])) : ?>
                    <p class = "text-danger"><?php echo $error['address'] ?></p>
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary">Đăng ký</button>
        </form>
                
    </section>
</div>
<?php
    require_once __DIR__.'/layouts/footer.php';
?>