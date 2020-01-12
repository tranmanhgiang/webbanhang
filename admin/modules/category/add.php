<?php
    $open = "category";
    require __DIR__.'/../../autoload/autoload.php';

    if($_SERVER["REQUEST_METHOD"] == "POST"){
       $data = 
       [
           "name" => postInput('name'),
           "slug" => to_slug(postInput("name"))
       ];

       $error = [];

       if(postInput('name') == ''){
           $error['name'] = "Mời bạn nhập đầy đủ tên danh mục";
       }

       if(empty($error)){
           $isset = $db->fetchOne("category"," name = '".$data['name']."' ");
           if(count($isset) > 0){
               $_SESSION['error'] = "Tên danh mục đã tồn tại";
            }else{
            $id_insert = $db->insert("category",$data);
            if($id_insert > 0){
                $_SESSION['success'] = "Thêm mới thành công";
                redirectAdmin("category");
             }else{
                // them that bai
                 $_SESSION['error'] = "Thêm mới thất bại";
                 }
             }
        }   
    }

?>

<?php require_once __DIR__."/../../layouts/header.php";  ?>
                    <!-- Page Heading -->
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">
                                Thêm mới danh mục 
                            </h1>
                            <ol class="breadcrumb">
                                <li>
                                    <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                                </li>
                                <li>
                                    </i>  <a href="index.html">Danh mục</a>
                                </li>
                                <li class="active">
                                    <i class="fa fa-file"></i> Thêm mới
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
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên danh mục </label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder = "Tên danh mục" name = "name">

                                    <?php if(isset($error['name'])):?>
                                        <p class = "text-danger"><?php echo $error['name'];?></p>
                                    <?php endif?>
                                   
                                </div>
                                
                                <button type="submit" class="btn btn-primary">Lưu</button>
                            </form>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                    <!-- /.row -->
<?php require_once __DIR__.'/../../layouts/footer.php';  ?>