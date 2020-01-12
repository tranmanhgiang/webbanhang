<?php
    $open = "product";
    require __DIR__.'/../../autoload/autoload.php';

    /*
        danh sách danh mục sản phẩm
    */
    $id = intval(getInput('id'));

    $EditProduct = $db->fetchID("product",$id);
    if(empty($EditProduct)){
        $_SESSION['error'] = "Dữ liệu không tồn tại";
        redirectAdmin("product");
    }

    $category = $db->fetchAll("category");

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $data = 
        [
             "name" => postInput('name'),
             "slug" => to_slug(postInput("name")),
             "category_id" => postInput('category_id'),
             "price" => postInput("price"),
             "sale" => postInput("sale"),
             "number" => postInput("number"),
             "content" => postInput("content")
        ];

        $error = [];

        if(postInput('name') == ''){
            $error['name'] = "Mời bạn nhập đầy đủ tên danh mục";
        }
        if(postInput('category_id') == ''){
                $error['category_id'] = "Mời bạn chọn tên danh mục";
        }
        if(postInput('price') == ''){
            $error['price'] = "Mời bạn nhập giá sản phẩm";
        }
        if(postInput('number') == ''){
            $error['number'] = "Mời bạn nhập số lượng sản phẩm";
        }
        if(postInput('content') == ''){
            $error['content'] = "Mời bạn nhập nội dung sản phẩm";
        }
        if(!isset($_FILES['thunbar'])){
            $error['thunbar'] = "Mời bạn chọn hình ảnh";
        }

        if(empty($error)){
            if(isset($_FILES['thunbar'])){
                $file_name = $_FILES['thunbar']['name'];
                $file_tmp = $_FILES['thunbar']['tmp_name'];
                $file_type = $_FILES['thunbar']['type'];
                $file_erro = $_FILES['thunbar']['error'];

                if($file_erro == 0){
                    $part = ROOT ."product/";
                    $data['thunbar'] = $file_name;
                }
            }
            $update = $db->update("product",$data,array("id"=>$id));
            if($update > 0){
                move_uploaded_file($file_tmp,$part.$file_name);
                $_SESSION['success'] = "Cập nhật thành công";
                redirectAdmin("product"); 
            }else{
                $_SESSION['error'] = "Cập nhật thất bại";
                redirectAdmin("product");
            }
        }   
    }

?>

<?php require_once __DIR__."/../../layouts/header.php";  ?>
                    <!-- Page Heading -->
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">
                                Thêm mới sản phẩm
                            </h1>
                            <ol class="breadcrumb">
                                <li>
                                    <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                                </li>
                                <li>
                                    </i>  <a href="index.html">Sản phẩm</a>
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
                            <form action = "" method = "POST" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Danh mục sản phẩm</label>
                                <div class="col-sm-8">
                                    <select name="category_id" id="" class = "form-control col-md-8">
                                        <option value="">- Mời bạn chọn danh mục sản phẩm -</option>
                                        <?php foreach($category as $item): ?>
                                            <option value="<?php echo $item['id'] ?>" <?php echo $EditProduct['category_id'] == $item['id'] ? "selected = 'selected'" : ''?>><?php echo $item['name'] ?></option>
                                        <?php endforeach?>
                                    </select>
                                </div>
                                <?php if(isset($error['name'])):?>
                                    <p class = "text-danger"><?php echo $error['name'];?></p>
                                <?php endif?>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Tên sản phẩm</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="inputEmail3" placeholder="Tên sản phẩm" name = "name" value = "<?php echo $EditProduct['name']; ?>">
                                </div>
                                <?php if(isset($error['name'])):?>
                                    <p class = "text-danger"><?php echo $error['name'];?></p>
                                <?php endif?>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Gía sản phẩm</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" id="inputEmail3" placeholder="9.000.000" name = "price" value = "<?php echo $EditProduct['price']; ?>">
                                </div>
                                <?php if(isset($error['price'])):?>
                                    <p class = "text-danger"><?php echo $error['price'];?></p>
                                <?php endif?>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Số lượng sản phẩm</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" id="inputEmail3" name = "number" value = "<?php echo $EditProduct['number']; ?>">
                                </div>
                                <?php if(isset($error['price'])):?>
                                    <p class = "text-danger"><?php echo $error['price'];?></p>
                                <?php endif?>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Giảm giá</label>
                                <div class="col-sm-3">
                                    <input type="number" class="form-control" id="inputEmail3" placeholder="10%" name = "sale" value = "<?php echo $EditProduct['sale']; ?>">
                                </div>
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Hình ảnh</label>
                                <div class="col-sm-3">
                                    <input type="file" class="form-control" id="inputEmail3" name = "thunbar">
                                </div>
                                <?php if(isset($error['thunbar'])):?>
                                    <p class = "text-danger"><?php echo $error['thunbar'];?></p>
                                <?php endif?>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Nội dung</label>
                                <div class="col-sm-8">
                                    <textarea class = "form-control" name="content" rows="4" ><?php echo $EditProduct['content']; ?></textarea>
                                </div>
                                <?php if(isset($error['content'])):?>
                                    <p class = "text-danger"><?php echo $error['content'];?></p>
                                <?php endif?>
                            </div>
                                <button type="submit" class="btn btn-primary">Lưu</button>
                            </form>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                    <!-- /.row -->
<?php require_once __DIR__.'/../../layouts/footer.php';  ?>