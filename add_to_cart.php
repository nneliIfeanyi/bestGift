<?php
session_start();
include 'config.php';
include 'functions.php';

	$id = $_GET['product_id'] ?? null;

	$user_data = check_login($conn);

	if (!$id) {
		
		if ($_SERVER['REQUEST_METHOD'] == "POST" ) {

			$id = mysqli_real_escape_string($conn, htmlspecialchars($_POST['id'], ENT_QUOTES, 'utf-8'));
			$title = mysqli_real_escape_string($conn, htmlspecialchars($_POST['title'], ENT_QUOTES, 'utf-8'));
			$description = mysqli_real_escape_string($conn, htmlspecialchars($_POST['describe'], ENT_QUOTES, 'utf-8'));
			$price = mysqli_real_escape_string($conn, htmlspecialchars($_POST['price'], ENT_QUOTES, 'utf-8'));
			$quantity = mysqli_real_escape_string($conn, htmlspecialchars($_POST['quantity'], ENT_QUOTES, 'utf-8'));
			$img = mysqli_real_escape_string($conn, htmlspecialchars($_POST['image'], ENT_QUOTES, 'utf-8'));
			?>

			<meta http-equiv="refresh" content=".01; added_to_cart.php?amt=<?=$quantity?>&id=<?=$id?>&title=<?=$title?>&describe=<?=$description?>&price=<?=$price?>&img=<?=$img?>">

			<?php


		}

	}else{

		$sql = "SELECT * FROM products WHERE id = '$id' ";
		$query = mysqli_query($conn, $sql);

		if (mysqli_num_rows($query) > 0) {
			
			$result = mysqli_fetch_assoc($query);

			$title=$result['title'];
			$description=$result['description'];
			$price=$result['price'];
			$img = $result['img'];
			$stock = $result['in_stock'];
			
		}
	}



?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add to cart</title>
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
			color: antiquewhite;
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
	<div class="box w3-card-4 w3-margin-top" style="background-color:rgba(0, 0, 0, 0.95);color: antiquewhite;">

		<p class="w3-large w3-text-orange w3-center"><i>Select the quantity you would like to add your shopping cart then proceed.</i></p>

		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data"> 
	          

			<div class="w3-row-padding">

				<div class="title-img w3-padding-16">
					<input type="hidden" name="title" value="<?=$title?>">
					<p class="w3-xlarge"><?=$title?></p>

					<input type="hidden" name="image" value="<?=$img?>">
					<img src="admin/<?=$img?>" class="w3-circle" height="100px" width="50%">
				</div>

				
				<input type="hidden" name="describe" value="<?=$description?>">
				<p class="w3-center"><?=$description?></p>

				<div class="w3-third w3-center">
						<h1 class="w3-xlarge">Available stock : </h1>

						<span class="w3-text-orange"><?=$stock?></span>

					<!--<h1 class="w3-xlarge">Choose Size</h1>

					<input type="radio" name="size" value="small" id="small"><label class="w3-margin-right w3-text-dark-grey" for="small">Small</label>
					<input type="radio" name="size" value="medium" id="medium"><label class= "w3-margin-right w3-text-dark-grey" for="medium">Medium</label>
					<input type="radio" name="size" value="large" id="large"><label class= "w3-margin-right w3-text-dark-grey" for="large">Large</label>-->

				</div>

				<div class="w3-third w3-center">

					<h1 class="w3-xlarge w3-text-orange">Select quantity</h1>

					<input type="number" id="quantity" name="quantity" style="width: 16%; border: none;outline: none;" value="1" min="1" class="w3-large w3-round w3-grey">

				</div>

				<div class="w3-third w3-center">

					<h1 class="w3-xlarge">Price</h1>
					<input type="hidden" name="price" value="<?=$price?>">
					<label class="w3-large w3-text-light-grey">&#8358;<?=$price?>.00<span class="w3-tiny w3-text-orange">each</span></label><br>

				</div>

				<div class="w3-col l12 m12 s12 w3-margin-top w3-center">
					<input type="hidden" name="id" value="<?=$id?>">
					<input type="submit" name="add_to_cart"  value="Proceed" class="w3-btn w3-text-dark-grey w3-teal 	w3-large w3-round-large">

				</div>

			</div>
		</form>

	</div>

</body>
</html>