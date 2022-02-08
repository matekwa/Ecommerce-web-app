<?php
session_start();
$connection = mysqli_connect("localhost","root","","swiftshop");
function query($sql){
    global $connection;
    return mysqli_query($connection,$sql);
}

function confirm($result){
    global $connection;
    if (!$result) {
        die("QUERY FAILED:" . mysqli_error($connection));
    }
}

function escape_string($string)
{
    global $connection;
    return mysqli_real_escape_string($connection,$string);
}

function fetch_array($result){
    return mysqli_fetch_array($result);
}

function get_row($check){
    return mysqli_num_rows($check);
}

if (isset($_POST['s'])){
    $searched_data = escape_string ($_POST['s']);
    $query = query ("SELECT * FROM products WHERE Title LIKE '%".$_POST["s"]."%'");
    confirm ($query);
    $result = get_row ($query);
    if ($result > 0){
        while ($row = fetch_array ($query)){
            $categoryID = $row['category_ID'];
            $query2 = query ("SELECT * FROM category WHERE ID=".escape_string ($row['category_ID'])."");
            confirm ($query2);
            while($row2 = fetch_array ($query2)){
                $category = $row2['Category_title'];
            }        
        }
        echo $categoryID;

    } else{
        echo "0";
    }
}

if(isset($_POST['add_wish_to_cart'])) {
    $product_id = $_POST['add_wish_to_cart'];
    $product_size = $_POST['product_size'];
    $user = $_SESSION['Username'];
    $user_id = $_SESSION['ID'];
    $query = query("SELECT * FROM products WHERE ID='$product_id' LIMIT 1");
    confirm ($query);
    while ($row = fetch_array($query)) {
            $product_name = $row['Title'];
            $quantity = 1;
            $product_price = $row['Price'];
            $product_photo = $row['product_image'];
            $total_price = $product_price * $quantity;
            $query1 = query("SELECT * FROM cart WHERE product_ID='$product_id' AND user_ID='$user_id'");
            confirm ($query1);
            $row_exist = get_row($query1);
            if ($row_exist == 0){
                $query2 = query ("INSERT INTO cart(product_ID,user_ID,product_photo,product_name,product_size,quantity,price,total_price,user_name) VALUES('{$product_id}','{$user_id}','{$product_photo}','{$product_name}','{$product_size}','$quantity','$product_price','$total_price','$user')");
                confirm($query2); 
            } else {
                $query3 = query("UPDATE cart SET product_size='$product_size' WHERE product_ID='$product_id' AND user_ID='$user_id'");
                confirm($query3);
            }
             $query4 = query("DELETE FROM wishlist WHERE product_ID='$product_id' AND user_id='$user_id'");
            confirm($query4);
    } 
    echo "added";
}

if (isset($_POST['modeOfPayment'])) {
        $mpesaRegisteredName = $_POST["mpesaRegisteredName"];
        $payment_method = $_POST["modeOfPayment"];
        $mpesa_phone_no = $_POST["mpesaPhoneNumber"];
        $account_name = $_POST["accountName"];
        $account_no = $_POST["accountNumber"];
        $bank = $_POST["bankName"];
        $busNo = $_SESSION['reg_no'];
        $query = query("SELECT * FROM suppliers WHERE business_reg_no = '$busNo'");
        confirm($query);
        $row_no = get_row($query);
        if ($row_no == 0) {
            echo("<small style='color:red;font-weight:600;'>Sorry,no supplier with this business number exists!</small>");
            exit();
        } else{
            $update_suppliers = query("UPDATE suppliers SET mpesa_reg_name = '$mpesaRegisteredName',payment_method = '$payment_method',mpesa_phone_no = '$mpesa_phone_no',account_name ='$account_name',account_no = '$account_no', bank = '$bank' where business_reg_no = '$busNo'");
            confirm($update_suppliers);
            echo("done");
        }
  }