<?php

require '../config/function.php';

$paramResult = checkParamId('index');
if(is_numeric($paramResult)){

    $indexValue = validate($paramResult);

    if(isset($_SESSION['productItems']) && isset($_SESSION['productItemIds'])){

        unset($_SESSION['productItems'][$indexValue]);
        unset($_SESSION['productItemIds'][$indexValue]);

        redirect('order-create.php', 'Barang berhasil dihapus!');
    }else{
        redirect('order-create.php', 'Tidak ada barang!');
    }
}else{
    redirect('order-create.php', 'Parameter bukan sebuah angka!');
}

?>