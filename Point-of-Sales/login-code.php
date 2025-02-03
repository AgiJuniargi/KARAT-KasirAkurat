<?php

require 'config/function.php';

if(isset($_POST['loginBtn']))
{
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    
    if($email != '' && $password != '')
    {
        $query = "SELECT * FROM admins WHERE email='$email' LIMIT 1";
        $result = mysqli_query($conn, $query);
        if($result){

            if(mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_assoc($result);
                $hashPassword = $row['password'];
                if(!password_verify($password,$hashPassword)){
                    redirect('login.php','Password Tidak Valid.');
                }

                $_SESSION['loggedIn'] = true;
                $_SESSION['loggedInUser'] = [
                    'user_id' => $row['id'],
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'phone' => $row['phone'],
                ];

                redirect('admin/index.php','Login Sukses!');

            }else{
                redirect('login.php','Alamat Email Tidak Valid.');
            }

        }else{
            redirect('login.php','Ada Sesuatu yang Salah.');
        }
    }
    else
    {
        redirect('login.php','Semua Field Harus Diisi!');
    }
}

?>