<?php
    $open = "admin";
    require __DIR__.'/../../autoload/autoload.php';

    /*
        danh sách danh mục sản phẩm
    */
    $data = 
            [
                    "name" => postInput('name'),
                    "email" => postInput("email"),
                    "phone" => postInput("phone"),
                    "password" => MD5(postInput("password")),
                    "address" => postInput("address"),
                    "level" => postInput("level")
            ];

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        

        $error = [];

        if(postInput('name') == ''){
            $error['name'] = "Mời bạn nhập đầy đủ tên danh mục";
        }
        if(postInput('email') == ''){
            $error['email'] = "Mời bạn nhập email";
        }else{
            $is_check = $db->fetchOne("admin"," email = '".$data['email']."' ");
            if($is_check['email'] != NULL){
                $error['email'] = "Email đã tồn tại";
            }
        }
        if(postInput('phone') == ''){
            $error['phone'] = "Mời bạn nhập số điện thoại";
        }
        if(postInput('password') == ''){
            $error['password'] = "Mời bạn nhập mật khẩu";
        }
        if(postInput('address') == ''){
            $error['address'] = "Mời bạn nhập địa chỉ";
        }

        if($data['password'] != MD5(postInput("re_password"))){
            $error['password'] = "Mật khẩu không khớp";
        }

        if(empty($error)){
            $id_insert = $db->insert("admin",$data);
            if($id_insert){
                $_SESSION['success'] = "Thêm mới thành công";
                redirectAdmin("admin");
            }else{
                $_SESSION['error'] = "Thêm mới thất bại";
            }
        }   
    }

?>

<?php require_once __DIR__."/../../layouts/header.php";  ?>
                    <!-- Page Heading -->
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">
                                Thêm admin
                            </h1>
                            <ol class="breadcrumb">
                                <li>
                                    <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                                </li>
                                <li>
                                    </i>  <a href="index.html">Admin</a>
                                </li>
                                <li class="active">
                                    <i class="fa fa-file"></i> admin
                                </li>
                            </ol>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <!-- thong bao loi -->
                    <?php require_once __DIR__."/../../../partials/notification.php"; ?>
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                        <form action = "" method = "POST">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Họ và tên</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="inputEmail3" placeholder="Trần Mạnh Giang" name = "name" value = "<?php echo $data['name'] ?>">
                                    <?php if(isset($error['name'])):?>
                                        <p class = "text-danger"><?php echo $error['name'];?></p>
                                    <?php endif?>
                                </div>
                                
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-8">
                                    <input type="email" class="form-control" id="inputEmail3" name = "email" placeholder = "tranmanhgiang06051999@gmail.com" value = "<?php echo $data['email'] ?>">
                                    <?php if(isset($error['email'])):?>
                                        <p class = "text-danger"><?php echo $error['email'];?></p>
                                    <?php endif?>
                                </div>
                                
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Phone</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="inputEmail3" name = "phone" placeholder = "0395578355" value = "<?php echo $data['phone'] ?>">
                                    <?php if(isset($error['phone'])):?>
                                        <p class = "text-danger"><?php echo $error['phone'];?></p>
                                    <?php endif?>
                                </div>
                                
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" id="inputEmail3" name = "password" placeholder = "**********">
                                    <?php if(isset($error['password'])):?>
                                        <p class = "text-danger"><?php echo $error['password'];?></p>
                                    <?php endif?>
                                </div>
                                
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">ConfirmPassword</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" id="inputEmail3" name = "re_password" placeholder = "**********">
                                    <?php if(isset($error['re_password'])):?>
                                        <p class = "text-danger"><?php echo $error['re_password'];?></p>
                                    <?php endif?>
                                </div>
                                
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Address</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="inputEmail3" name = "address" placeholder = "Hà Nam" value = "<?php echo $data['address'] ?>">
                                    <?php if(isset($error['address'])):?>
                                        <p class = "text-danger"><?php echo $error['address'];?></p>
                                    <?php endif?>
                                </div>
                                
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Level</label>
                                <div class="col-sm-8">
                                    <select name="level" class="form-control">
                                        <option value="1" <?php echo isset($data['level']) && $data['level'] == 1 ? "selected = 'selected'" : '' ?>>CTV</option>
                                        <option value="2" <?php echo isset($data['level']) && $data['level'] == 2 ? "selected = 'selected'" : '' ?>>Admin</option>
                                    </select>
                                    <?php if(isset($error['level'])):?>
                                        <p class = "text-danger"><?php echo $error['level'];?></p>
                                    <?php endif?>
                                </div>
                                
                            </div>
                                <button type="submit" class="btn btn-primary">Lưu</button>
                            </form>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                    <!-- /.row -->
<?php require_once __DIR__.'/../../layouts/footer.php';  ?>