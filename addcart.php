<?php
    require_once __DIR__.'/autoload/autoload.php';
    if(!isset($_SESSION['userid'])){
        echo "<script>alert('bạn phải đăng nhập mới thực hiện được chức năng này'); location.href='index.php'</script>";
    }

    $id = intval(getInput('id'));
    $product = $db->fetchID("product",$id);

    


?>