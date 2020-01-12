<?php
    $open = "product";
    require __DIR__.'/../../autoload/autoload.php';

    $id = intval(getInput('id'));

    $DeleteProduct = $db->fetchID("product",$id);
    if(empty($DeleteProduct)){
        $_SESSION['error'] = "Dữ liệu không tồn tại";
        redirectAdmin("product");
    }

/*
    
*/

    $num = $db->delete("product",$id);
    if($num > 0){
        $_SESSION['success'] = "Xóa thành công";
        redirectAdmin("product");
    }else{
         $_SESSION['error'] = "Xóa thất bại";
         redirectAdmin("product");
     }
?>