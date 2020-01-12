<?php
    $open = "category";
    require_once __DIR__.'/../../autoload/autoload.php';
    $category = $db->fetchAll("category");
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
                                Danh sách danh mục
                            </h1>
                            <a href="add.php" class = "btn btn-success">Thêm mới</a>
                            <ol class="breadcrumb">
                                <li>
                                    <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                                </li>
                                <li class="active">
                                    <i class="fa fa-file"></i> Danh mục
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
                                    <th>Slug</th>
                                    <th>Home</th>
                                    <th>Created</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $stt = 1; foreach($category as $item): ?>
                                    <tr>
                                        <td><?php echo $stt; ?></td>
                                        <td><?php echo $item['name']; ?></td>
                                        <td><?php echo $item['slug']; ?></td>
                                        <td>
                                            <a href="home.php?id=<?php echo $item['id']; ?>" class = "btn btn-xs <?php echo $item['home'] == 1 ? 'btn-info' : 'btn-default'; ?>">
                                                <?php echo $item['home'] == 1 ? 'Hiển thị' : 'Không'; ?>
                                            </a>
                                        </td>
                                        <td><?php echo $item['created_at']; ?></td>
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