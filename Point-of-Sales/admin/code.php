<?php

include('../config/function.php');

if(isset($_POST['saveAdmin']))
{
    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $phone = validate($_POST['phone']);

    if($name != '' && $email != '' && $password != '')
    {
        $emailCheck = mysqli_query($conn, "SELECT * FROM admins WHERE email='$email'");
        if($emailCheck)
        {
            if(mysqli_num_rows($emailCheck) > 0){
                redirect('admins-create.php','Email ini telah digunakan oleh pengguna lain.');
            }
        }

        $bcrypt_password = password_hash($password, PASSWORD_BCRYPT);

        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $bcrypt_password,
            'phone' => $phone
        ];

        $result = insert('admins', $data);
        if($result){
            redirect('admins.php','Admin Berhasil Ditambahkan!');
        }else{
            redirect('admins-create.php','Ada yang Tidak Beres :(');
        }

    }else{
        redirect('admins-create.php','Harap Isi Field yang Kosong!');
    }
}

if(isset($_POST['updateAdmin']))
{
    $adminId = validate($_POST['adminId']);

    $adminData = getById('admins', $adminId);
    if($adminData['status'] != 200){
        redirect('admins-edit.php?id='.$adminId,'Harap Isi Field yang Wajib Diisi!');
    }

    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $phone = validate($_POST['phone']);

    $EmailCheckQuery = "SELECT * FROM admins WHERE email='$email' AND id!='$adminId'";
    $checkResult = mysqli_query($conn, $EmailCheckQuery);
    if($checkResult){
        if(mysqli_num_rows($checkResult) > 0){
            redirect('admins-edit.php?id='.$adminId,'Email Ini Telah Digunakan Oleh Pengguna Lain!');
        }
    }

    if($password != ''){
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    }else{
        $hashedPassword = $adminData['data']['password'];
    }

    if($name != '' && $email != '')
    {
        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $hashedPassword,
            'phone' => $phone
        ];

        $result = update('admins', $adminId, $data);

        if($result){
            redirect('admins-edit.php?id='.$adminId,'Admin Berhasil Diubah!');
        }else{
            redirect('admins-edit.php?id='.$adminId,'Ada yang Tidak Beres :(');
        }

    }else{
        redirect('admins-edit.php','Harap Isi Field yang Wajib Diisi!');
    }
}

if(isset($_POST['saveCategory']))
{
    $name = validate($_POST['name']);
    $description = validate($_POST['description']);
    $status = isset($_POST['status']) ? 1 : 0; // 1 jika dicentang, 0 jika tidak
    
    $data = [
        'name' => $name,
        'description' => $description,
        'status' => $status
    ];
    $result = insert('categories', $data);

    if($result){
        redirect('categories.php','Kategori Berhasil Ditambahkan!');
    }else{
        redirect('categories-create.php','Ada yang Tidak Beres :(');
    }
}

if(isset($_POST['updateCategory']))
{
    $categoryId = validate($_POST['categoryId']);

    $name = validate($_POST['name']);
    $description = validate($_POST['description']);
    $status = isset($_POST['status']) ? 1 : 0; // 1 jika dicentang, 0 jika tidak
    
    $data = [
        'name' => $name,
        'description' => $description,
        'status' => $status
    ];
    $result = update('categories', $categoryId, $data);

    if($result){
        redirect('categories.php','Kategori Berhasil Diubah!');
    }else{
        redirect('categories.php','Ada yang Tidak Beres :(');
    }    
}

if(isset($_POST['saveProduct']))
{
    $category_id = validate($_POST['category_id']);
    $name = validate($_POST['name']);
    $description = validate($_POST['description']);
    $price = validate($_POST['price']);
    $quantity = validate($_POST['quantity']);
    $status = isset($_POST['status']) ? 1 : 0;
    
    if($_FILES['image']['size'] > 0)
    {
        $path = "../assets/uploads/products";
        $image_ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

        $filename = time().'.'.$image_ext;

        move_uploaded_file($_FILES['image']['tmp_name'], $path."/".$filename);
        // if (!move_uploaded_file($_FILES['image']['tmp_name'], $path . "/" . $filename)) {
        //     die('Error: Gagal mengunggah file. Pastikan folder memiliki izin.');
        // }
        $finalImage = "assets/uploads/products/".$filename;
    }

    $data = [
        'category_id' => $category_id,
        'name' => $name,
        'description' => $description,
        'price' => $price,
        'quantity' => $quantity,
        'image' => $finalImage,
        'status' => $status
    ];
    $result = insert('products', $data);

    if($result){
        redirect('products.php','Produk Berhasil Ditambahkan!');
    }else{
        redirect('products-create.php','Ada yang Tidak Beres :(');
    }
}

if(isset($_POST['updateProduct']))
{
    $product_id = validate($_POST['product_id']);

    $productData = getById('products',$product_id);
    if(!$productData){
        redirect('products.php','Produk tidak ditemukan.');
    }
    
    $category_id = validate($_POST['category_id']);
    $name = validate($_POST['name']);
    $description = validate($_POST['description']);
    $price = validate($_POST['price']);
    $quantity = validate($_POST['quantity']);
    $status = isset($_POST['status']) ? 1 : 0;
    
    if($_FILES['image']['size'] > 0)
    {
        $path = "../assets/uploads/products";
        $image_ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

        $filename = time().'.'.$image_ext;

        move_uploaded_file($_FILES['image']['tmp_name'], $path."/".$filename);
        $finalImage = "assets/uploads/products/".$filename;

        $deleteImage = "../".$productData['data']['image'];
        if(file_exists($deleteImage)){
            unlink($deleteImage);
        }
    }
    else
    {
        $finalImage = $productData['data']['image'];
    }

    $data = [
        'category_id' => $category_id,
        'name' => $name,
        'description' => $description,
        'price' => $price,
        'quantity' => $quantity,
        'image' => $finalImage,
        'status' => $status
    ];
    $result = update('products', $product_id, $data);

    if($result){
        redirect('products.php','Produk Berhasil Diubah!');
    }else{
        redirect('products-edit.php','Ada yang Tidak Beres :(');
    }
}

?>