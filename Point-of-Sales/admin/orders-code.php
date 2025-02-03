<?php

include('../config/function.php');

if(!isset($_SESSION['productItemIds'])){
    $_SESSION['productItemIds'] = [];
}
if(!isset($_SESSION['productItems'])){
    $_SESSION['productItems'] = [];
}

if(isset($_POST['addItem']))
{
    $productId = validate($_POST['product_id']);
    $quantity = validate($_POST['quantity']);

    $checkProduct = mysqli_query($conn, "SELECT * FROM products WHERE id='$productId' LIMIT 1");
    if($checkProduct){
        if(mysqli_num_rows($checkProduct) > 0){
            $row = mysqli_fetch_assoc($checkProduct);
            if($row['quantity'] < $quantity){
                redirect('order-create.php',$row['name'].' hanya ada ' .$row['quantity']);
            }
            $productData = [
                'product_id' => $row['id'],
                'name' => $row['name'],
                'image' => $row['image'],
                'price' => $row['price'],
                'quantity' => $quantity,
            ];

            if(!in_array($row['id'], $_SESSION['productItemIds'])){

                array_push($_SESSION['productItemIds'],$row['id']);
                array_push($_SESSION['productItems'],$productData);

            }else{

                foreach($_SESSION['productItems'] as $key => $prodSessionItem){
                    if($prodSessionItem['product_id'] == $row['id']){
                        $newQuantity = $prodSessionItem['quantity'] + $quantity;

                        $productData = [
                            'product_id' => $row['id'],
                            'name' => $row['name'],
                            'image' => $row['image'],
                            'price' => $row['price'],
                            'quantity' => $newQuantity,
                        ];
                        $_SESSION['productItems'][$key] = $productData;

                    }
                }

            }

            redirect('order-create.php',$row['name'].' dimasukkan ke pesanan.');

        }else{
            redirect('order-create.php','Produk yang dipilih tidak ada!');
        }
    }else{
        redirect('order-create.php','Ada Sesuatu Yang Salah :(');
    }
}

if(isset($_POST['productIncDec']))
{
    $productId = validate($_POST['product_id']);
    $quantity = validate($_POST['quantity']);

    $flag = false;
    foreach($_SESSION['productItems'] as $key => $item){
        if($item['product_id'] == $productId){
            $flag = true;
            $_SESSION['productItems'][$key]['quantity'] = $quantity;
        }
    }

    if($flag){
        jsonResponse(200, 'success', 'Jumlah diperbarui!');

    }else{
        jsonResponse(500, 'error', 'Ada yang tidak beres, mohon muat ulang web.');
    }

}

if(isset($_POST['confirmOrderBtn']))
{
    
    // Validasi input dari pengguna
    $customer_name = validate($_POST['customer_name']);
    $payment_method = validate($_POST['payment_method']);
    
    // Generate nomor invoice dan simpan ke sesi
    $_SESSION['invoice_no'] = "INV-" . rand(111111, 999999);
    $_SESSION['customer_name'] = $customer_name;
    $_SESSION['payment_method'] = $payment_method;

    jsonResponse(200, 'success', 'Berhasil dikonfirmasi!');

}

if(isset($_POST['saveOrder']))
{

    $customer_name = validate($_SESSION['customer_name']);
    $invoice_no = validate($_SESSION['invoice_no']);
    $payment_method = validate($_SESSION['payment_method']);
    $order_placed_by_id = $_SESSION['loggedInUser']['user_id'];

    if(!isset($_SESSION['productItems'])){
        jsonResponse(404, 'warning', 'Tidak ada barang disini.');
    }

    $sessionProducts = $_SESSION['productItems'];

    $totalAmount = 0;
    foreach($sessionProducts as $amtItem){
        $totalAmount += $amtItem['price'] * $amtItem['quantity'];
    }

    $data = [
        'customer_name' => $customer_name,
        'invoice_no' => $invoice_no,
        'total_amount' => $totalAmount,
        'order_date' => date('Y-m-d'),
        'payment_method' => $payment_method,
        'order_placed_by_id' => $order_placed_by_id
    ];
    $result = insert('orders', $data);
    $lastOrderId = mysqli_insert_id($conn);

    foreach($sessionProducts as $prodItem){
        $productId = $prodItem['product_id'];
        $price = $prodItem['price'];
        $quantity = $prodItem['quantity'];

        $dataOrderItem = [
            'order_id' => $lastOrderId,
            'product_id' => $productId,
            'price' => $price,
            'quantity' => $quantity,
        ];
        $OrderItemQuery = insert('order_items', $dataOrderItem);

        // fetching data quantity product
        $checkProductQuantityQuery = mysqli_query($conn, "SELECT * FROM products WHERE id='$productId'");
        $productQtyData = mysqli_fetch_assoc($checkProductQuantityQuery);
        $totalProductQuantity = $productQtyData['quantity'] - $quantity;

        $dataUpdate = [
            'quantity' => $totalProductQuantity
        ];
        $updateProductQty = update('products', $productId, $dataUpdate);
    }

    unset($_SESSION['productItemIds']);
    unset($_SESSION['productItems']);
    unset($_SESSION['customer_name']);
    unset($_SESSION['payment_method']);
    unset($_SESSION['invoice_no']);

    jsonResponse(200, "success", "Berhasil!");

}

?>