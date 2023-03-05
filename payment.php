<?php
session_start();
include 'config.php';
include 'functions.php';
$user_data = check_login($conn);
$msg='';


if ($_POST['id'] && $_POST['title'] && $_POST['amt'] || $_POST['describe'] && $_POST['price'] && $_POST['img'] ) {
  //Collect product data..
  $amount=$_POST['amt'];
  $id = $_POST['id'];
  $title = $_POST['title'];
  $description = $_POST['describe'];
  $price = $_POST['price'];
  $img = $_POST['img'];

  //Collect customer data
  $customer_name = $user_data['name'];
  $customer_id = $user_data['id'];
  $customer_email = $user_data['email'];
  $customer_phone = $user_data['phone'];
  $customer_address = $user_data['address'];

  
  $sql = "INSERT INTO orders (name,phone,product_title,img,description,price,quantity) VALUES ('$customer_name','$customer_phone','$title','$img','$description','$price','$amount')";
  $query = mysqli_query($conn, $sql);

  if ($query) {

    $msg = "

          <h2 class='w3-padding w3-xxlarge w3-padding-16 w3-center w3-margin'>Thanks for your purchase!<br><span class='w3-xlarge'>Your Order has been recieved successfully.</span></h2>

         <div class='w3-margin-top w3-padding w3-center'>

       

          <a href='cart.php' class='w3-btn w3-block w3-margin-bottom w3-text-light-grey w3-teal w3-large w3-round-large'>Back to cart</a>

          <a href='purchase_history.php' class='w3-btn w3-block w3-margin-bottom w3-text-light-grey w3-blue-gray w3-large w3-round-large'>View purchase history</a>

        </div>


        ";
  
  }else{

    $msg =  "<h4 class='w3-red'>it didnt work, something went wrong, the product was not added to cart.</h4>";
  }
}

?>



<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Order Checkout</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/w3.css">
  <style type="text/css">
    .box {
      margin: auto;
      padding: 0px;
      border: .5px solid #fff;
      width: 90%;
     
    }

    .box h1{
      color: darkgrey;
    }
    .title-img{
      display: flex;
      align-items: center;
      justify-content: space-around;
    }

  </style>

</head>

<body class="w3-serif body">

  <?php

    include 'header.php';

  ?>
  <div class="box w3-card-4" style="background-color:rgba(0, 0, 0, 0.95);color: antiquewhite;">
    <?=$msg?>
  </div>

</body>
</html>
