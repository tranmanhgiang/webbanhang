<?php
    require_once __DIR__.'/autoload/autoload.php';
    $data = [
        'email' => postInput('email'),
        'password' => postInput('password')
    ];
    $error = [];

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if($data['email'] == ''){
            $error['email'] = "Mời bạn điền email";
        } 
        if($data['password'] == ''){
            $error['password'] = "Mời bạn điền password";
        } 
    }

    if(empty($error) && $_SERVER['REQUEST_METHOD'] == 'POST'){
        $is_check = $db->fetchOne("users"," email = '".$data['email']."' AND password = '".MD5($data['password'])."'");
        if($is_check != NULL){
            $_SESSION['username'] = $is_check['name'];
            $_SESSION['userid'] = $is_check['id'];
            echo "<script>alert('Đăng nhập thành công'); location.href='index.php'</script>";
        }else{
            $_SESSION['error'] = "Email hoặc mật khẩu không chính xác";
        }
    }


?>
<?php
    require_once __DIR__.'/layouts/header.php';
?>
        
<div class="col-md-9 bor">
    <section class="box-main1">
        <h3 class="title-main" style="text-align: center;"><a href="javascript:void(0)"> Đăng nhập </a> </h3>
        <!-- Nội dung -->
        <div class="clearfix"></div>
        <!-- thong bao loi -->
        <?php require_once __DIR__."/partials/notification.php";  ?>
        <form action = "" method = "POST">
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name = "email" aria-describedby="emailHelp" placeholder="Enter email">
                <?php if(isset($error['email'])):?>
                    <p class = "text-danger"><?php echo $error['email'];?></p>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name = "password" placeholder="Password">
                <?php if(isset($error['password'])):?>
                    <p class = "text-danger"><?php echo $error['password'];?></p>
                <?php endif; ?>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" class="btn btn-primary">Đăng nhập</button>
        </form>
        <div class="clearfix"></div>
        <!-- thong bao loi -->
        <?php require_once __DIR__."/partials/notification.php";  ?>
    </section>
</div>
<?php
    require_once __DIR__.'/layouts/footer.php';
?>