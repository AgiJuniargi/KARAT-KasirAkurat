<?php

require '../config/function.php';

$paramResultId = checkParamId('id');
if(is_numeric($paramResultId)){

    $adminId = validate($paramResultId);
    
    $admin = getById('admins',$adminId);
    if($admin['status'] == 200)
    {
        $adminDelete = delete('admins',$adminId);
        if($adminDelete){
            redirect('admins.php','Admin Berhasil Dihapus!');
        }else{
            redirect('admins.php','Ada yang Tidak Beres :(');
        }
    }
    else
    {
        redirect('admins.php',$admin['message']);
    }

}else{
    redirect('admins.php','Ada yang Tidak Beres :(');
}

?>