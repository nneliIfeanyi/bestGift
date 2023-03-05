<?php
session_start();
include 'config.php';
include 'functions.php';

if (isset($_SESSION['user'])){

$user_data = check_login($conn);
$id = $user_data['id'];

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Shipping Details</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/w3.css">
</head>

<body class="w3-serif body">

	<?php

		include 'header.php';

	?>


	<!-- Commerce SECTION -->


	<section class="commerce w3-padding">

		
			<?php 

			$sql = "SELECT * FROM custumers WHERE id = '$id'";
			$query = mysqli_query($conn, $sql);
			if (mysqli_num_rows($query) > 0) {

				while ($result = mysqli_fetch_assoc($query)) {
					$id=$result['id'];
					$name=$result['name'];
					$phone=$result['phone'];
					$email=$result['email'];
					$address = $result['address'];


					$sql = "SELECT * FROM cart WHERE user_id = '$id'";
					$query = mysqli_query($conn, $sql);
					if (mysqli_num_rows($query) > 0) {

					$result = mysqli_fetch_assoc($query);
					$cartid=$result['id'];
					$qty = $result['quantity'];
					$title = $result['product_title'];
					$desc = $result['description'];
					$img = $result['image'];
					$price = $result['price'];

			
			?>
		<div class="w3-row-padding w3-border" style="background-color:rgba(0, 0, 0, 0.95);color: antiquewhite;">

			<div class="w3-center w3-block w3-tag w3-text-light-grey">
				<h3>Comfirm Shipping Details</h3>
			</div>


			<div class="">
				
				<div class="w3-padding-16 w3-padding-small w3-blue-grey">Kindly comfirm if the info provided below corresponds with your real identity.</div>
				<ul class="w3-ul w3-col w3-small l6 m6 s6">	
					<li><b>Name</b></li>
					<li><b>Phone</b></li>
					<li><b>Email</b></li>
					<li><b>Address</b></li>
				</ul>
				<ul class="w3-ul w3-small w3-text-blue-grey w3-col l6 m6 s6">	
					<li><?=$name?></li>
					<li><?=$phone?></li>
					<li><?=$email?></li>
					<li><?=$address?></li>
				</ul>

				<div class="w3-col l12 m12 s12 w3-margin-top w3-topbar w3-padding-16 w3-center">

					<form action="payment.php" method="POST" enctype="multipart/form-data"> 
						<input type="hidden" name="id" value="<?php echo $cartid; ?>">
						<input type="hidden" name="amt" value="<?php echo $qty; ?>"> 
						<input type="hidden" name="title" value="<?php echo $title; ?>"> 
						<input type="hidden" name="describe" value="<?php echo $desc; ?>"> 
						<input type="hidden" name="img" value="<?php echo $img; ?>"> 
						<input type="hidden" name="price" value="<?php echo $price; ?>">


						<button type="submit" name="pay_now" id="pay-now" title="Pay now" class="w3-btn w3-blue-grey w3-margin-bottom w3-large w3-round-large">Yes it's me</button>
					</form>

					<a href="edit.php" class="w3-btn w3-text-red w3-blue-grey w3-large w3-round-large">No there's a mistake</a>

				</div>

			</div>

		</div>

		<?php

			}
			}

		}

		?>

	</section>

	<!--=======
			Commerce ENDS===
				=========-->
				<!-- modal-->
				<div class="modal" id="myModal">
					<div class="modal-content w3-animate-top w3-round-large w3-text-black">
						<span class="close">&times;</span>

						
					</div>
				</div>


<script>
		// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

</script>

</body>
</html>
<?php

}else{

	?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Shipping Details</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/w3.css">
</head>

<body class="w3-serif">
	<div class="w3-padding-32 w3-padding-large w3-margin w3-card-4 w3-light-grey">

		<h1 class="w3-center w3-wide w3-red">MESSAGE!</h1>
		
		<h2 class="w3-text-green">You must register and login to your account before making a purchase.</h2>

		<p>Click <a href="login.php" class="w3-text-teal"><b>here</b></a> to Login to your account.</p>

		<meta http-equiv="refresh" content="7; index.php">
	</div>




</body>

<?php

}









