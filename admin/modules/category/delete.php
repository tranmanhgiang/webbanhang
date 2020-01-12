<?php
    $open = "category";
    require __DIR__.'/../../autoload/autoload.php';

    $id = intval(getInput('id'));

    $DeleteCategory = $db->fetchID("category",$id);
    if(empty($DeleteCategory)){
        $_SESSION['error'] = "Dữ liệu không tồn tại";
        redirectAdmin("category");
    }

/*
  Kiểm tra xem danh mục đã có sản phẩm chưa  
*/
    $is_product = $db->fetchOne("product","category_id = '$id'");
    if($is_product == NULL){
        $num = $db->delete("category",$id);
        if($num > 0){
            $_SESSION['success'] = "Xóa thành công";
            redirectAdmin("category");
        }else{
            $_SESSION['error'] = "Xóa thất bại";
            redirectAdmin("category");
        }
    }else{
        $_SESSION['error'] = "Danh mục có sản phẩm! Bạn không thể xóa";
        redirectAdmin("category");
    }


?>