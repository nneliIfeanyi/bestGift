<?php
session_start();
include '../config.php';
include '../functions.php';


if (isset($_SESSION['user'])) {
    
    $user = $_SESSION['user'];

    $sql = "SELECT * FROM custumers WHERE phone = '$user'";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        
        $user_data = mysqli_fetch_assoc($query);
        $name = $user_data['name'];    

    }

}else{

    //redirect to login

    header("location:../login.php");
}






?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>My Customers</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../css/w3.css">
</head>

<body class="w3-serif body">

	<?php

		include 'header.php';

	?>



	<section class="w3-padding-small" style="background: rgba(0, 0, 0, 0.6);">
	    <div class="w3-row">
	      <div class="w3-col m12 l12 s12">
	    <div style="height: auto;overflow-y: scroll;" class="">
	      <h2 class="w3-center my-font w3-text-white w3-large w3-padding-16">ALL ORDERS</h2>
	      <div class="">
	        <table class="w3-table-all">
	          <thead>
	            <tr class="w3-text-black">
	              <th><b>S/N</b></th>
	              <th><b>Name</b></th>
	              <th><b>Phone</b></th>
	               <th><b>Product</b></th>
	              <th><b>Picture</b></th>
	              <th><b>Description</b></th>
	              <th><b>Quantity</b></th>
	              <th><b>Price</b></th>
	              <th><b>Date</b></th>
	              <th><b>Time</b></th>
	            </tr>
	          </thead>

	          <tbody>
	            <?php 
	           

	              $sql = "SELECT * FROM orders ORDER BY id DESC" ;
	              $query = mysqli_query($conn, $sql);
	              $i = 1;
	              if ($query) {
	              	
	              	while($result = mysqli_fetch_array($query)){

	              	
	              	  $name = $result['name'];
	              	  $phone = $result['phone'];
	              	  $title = $result['product_title'];
	              	  $image = $result['img'];
	              	  $desc = $result['description'];
	              	  $qty = $result['quantity'];
	              	  $price = $result['price'];
	              	  $date = $result['date'];
	              	  $time = $result['time'];

	              
	            ?>
	            <tr class="w3-text-dark-grey">
	              <td><?php echo $i; ?></td>
	              <td><?php  echo $name; ?></td>
	              <td><?php  echo $phone; ?></td>
	              <td><?php  echo $title; ?></td>
	              <td><img src="<?php  echo $image; ?>" width="60px" height="60px"></td>
	               <td><?php  echo $desc; ?></td>
	              <td><?php  echo $qty; ?></td>
	               <td>&#8358;<?php  echo $price; ?>.00</td>
	              <td><?php  echo $date; ?></td>
	                <td><?php  echo $time; ?></td>
	            </tr>

	            <?php

	              $i++;

	              }

	          }else{

	          	?>

	          		<tr class="w3-text-red w3-large">
	          		  <td colspan="11">No purchase made yet.</td></tr>
	          		<tr class="w3-text-dark-grey"><td colspan="11">Why not consider advertising your business to create awareness of your online presence.</td>
	          		</tr>

	          	<?php


	          }

	            ?>
	          </tbody>
	        </table>
	      </div>
	   </div>

	    </div>
	    <?php

	    include 'menu.php';

	     ?>
	  </div>
	</section>