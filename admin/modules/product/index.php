<?php
    $open = "product";
    require_once __DIR__.'/../../autoload/autoload.php';
    $product = $db->fetchAll("product");
?>
<script>
    function confirmation(){
        var x = confirm("Bạn có chắc chắn muốn xóa?");
        if (x)
            return true;
        else
            return false;
    }
</script>
<?php require_once __DIR__."/../../layouts/header.php";  ?>
                    <!-- Page Heading -->
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">
                                Danh sách sản phẩm
                            </h1>
                            <a href="add.php" class = "btn btn-success">Thêm mới</a>
                            <ol class="breadcrumb">
                                <li>
                                    <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                                </li>
                                <li class="active">
                                    <i class="fa fa-file"></i> Sản phẩm
                                </li>
                            </ol>
                            <div class="clearfix"></div>
                            <!-- thong bao loi -->
                            <?php require_once __DIR__."/../../../partials/notification.php";  ?>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Slug</th>
                                    <th>Thunbar</th>
                                    <th>Info</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $stt = 1; foreach($product as $item): ?>
                                    <tr>
                                        <td><?php echo $stt; ?></td>
                                        <td><?php echo $item['name']; ?></td>
                                        <td><?php echo $item['category_id'];?></td>
                                        <td><?php echo $item['slug']; ?></td>
                                        <td>
                                            <img src="<?php echo uploads() ?>product/<?php echo $item['thunbar'] ?>" width = "80px" height = "80px">
                                        </td>
                                        <td>
                                            <ul>
                                                <li>Giá: <?php echo $item['price']; ?></li>
                                                <li>Số lượng: <?php echo $item['number']; ?></li>
                                            </ul>
                                        </td>
                                        <?php $stt++; ?>
                                        <td>
                                            <a class = "btn btn-xs btn-info" href="edit.php?id=<?php echo $item['id']?>"><i class = "fa fa-edit"></i>Sửa</a>
                                            <a class = "btn btn-xs btn-danger" href="delete.php?id=<?php echo $item['id']?>" onclick = "confirmation()"> <i class = "fa fa-times"></i> Xóa</a>
                                        </td>
                                        
                                    </tr>
                                    
                                <?php endforeach ?>
                            </tbody>
                        </table>

                        <div class="pull-right">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    </div>
                    <!-- /.row -->
<?php require_once __DIR__.'/../../layouts/footer.php';  ?>