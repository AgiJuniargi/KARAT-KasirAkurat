<?php

require '../config/function.php';

$paramResultId = checkParamId('id');
if(is_numeric($paramResultId)){

    $categoryId = validate($paramResultId);
    
    $category = getById('categories',$categoryId);
    if($category['status'] == 200)
    {
        $response = delete('categories',$categoryId);
        if($response){
            redirect('categories.php','Kategori Berhasil Dihapus!');
        }else{
            redirect('categories.php','Ada yang Tidak Beres :(');
        }
    }
    else
    {
        redirect('categories.php',$category['message']);
    }

}else{
    redirect('categories.php','Ada yang Tidak Beres :(');
}

?>