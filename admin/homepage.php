<?php
session_start();
include '../config.php';
include '../functions.php';

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Homepage</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../css/w3.css">

	<style type="text/css">

		.navbar{
		display: flex;
		align-items: center;
		justify-content: space-between;
		padding: 0.7rem 2rem;
		
		z-index: 1;
		width: 100%;
		top: 0;
		border-bottom: solid 1px teal;
		opacity: 0.9;
	}

	header h1{
		font-size: 20px;

	}

	header h1 a{

		text-decoration: none;
	}

	header ul{
		list-style: none;
		display: flex;

	}

	header ul a{
		color: wheat;
		box-shadow: 2px 1px 3px teal;
		padding: 0.25rem;
		margin: 0 0.25rem;
		text-decoration: none;
	}

	header ul a:hover{
		color: teal;
		border-bottom: 2px solid teal;
		
	}

	@media(max-width: 668px){
		.navbar{
		padding: 0.3rem 1rem;
		
		}

		header h1{
		font-size: 16px;

	}
	}

		
		.search select{
			margin-top: 12px;
			border: 1px solid gray;
			outline: none;
			border-radius: 20%;
			padding: .4rem .7rem;
			width: 98%;
	}

	.search option{
			width: 51%;
			background: inherit;
			font-weight: bold;
	}

	.badge{
		background: black;
		border-radius: 50%;
		padding: 2px 3px;
		color: wheat;
		margin-right: -8px;
	}

	.a{
		color: teal;
		text-decoration: none;
		margin-left: 4px;
	}




	</style>
</head>

<body class="w3-serif" style="scroll-behavior:smooth;">

	

<header class="navbar w3-black">
	<h1 style="font-weight: bolder;font-size: 32px;">
			<a href="index.php">
			<span class="w3-cursive">B</span><span class="w3-text-orange w3-cursive" style="margin-left:-7px;">G</span><span class="w3-cursive w3-medium">Souvenirs</span>
			</a>
		</h1>

	<ul>
		<li><a href="index.php">Dashboard</a></li>
	</ul>
</header>

	<div class="search w3-row-padding w3-leftbar w3-rightbar w3-border-black">

		<div class="w3-col l10 m9 s8">
			<select id="classID" class="w3-text-dark-grey">
			  <option value="">--Search by categories--</option>
			  <option value="cup">Cups</option>
			  <option value="tumblers">Tumblers</option>
			  <option value="plates">Plates</option>
			  <option value="trays">Trays</option>
			  <option value="bags">Bags</option>
			  <option value="feeding_bottles">Feeding Bottles</option>
			</select>
		</div>

		<?php 

			$i = '';

		if (isset($_SESSION['user'])) {
		 		$user_data = check_login($conn);
		 		$phone = $user_data['phone'];

			
				 $sql = "SELECT * FROM cart WHERE phone = '$phone'" ;
	       $query = mysqli_query($conn, $sql);

	       if ($query) {
	       	$i= mysqli_num_rows($query);
	       }
		 } 

       
		?>
		<div class="w3-col l2 m3 s4 w3-small w3-center w3-padding-16">
			<span class="badge w3-tiny"><?=$i?></span>
			<a href="cart.php" class="">
				<img src="img/basket_cart.png" width="20px" height="20px" style="filter: invert(10%);">
			</a>

				<?php

					if (isset($_SESSION['user'])) {
						?>
						<a href="logout.php" class="a">Logout</a></li>

						<?php
					}else{

						?>
						<a href="login.php" class="a">Login</a></li>
						
						<?php
							}
					?>
		</div>

	</div>


		<?php

		include '../showcase.php';

	?>


<div class="wrapper">


		<!-- Commerce SECTION -->

			<!-- SELECTING ALL CATEGORIES -->

			<div id="msg" class="">

				<div class="w3-center w3-serif w3-padding-16">
					<h3 class="w3-tag">OUR PRODUCTS</h3>
				</div>

				<?php 

				$sql = "SELECT * FROM products";
				$query = mysqli_query($conn, $sql);
				if (mysqli_num_rows($query) > 0) {

					while ($result = mysqli_fetch_assoc($query)) {
						$id=$result['id'];
						$title=$result['title'];
						$description=$result['description'];
						$price=$result['price'];
						$img = $result['img'];

				
				?>
		<section class="examples w3-hide-medium w3-hide-large">
			<div class="container">
				<div class="sample">
					<h1><?=$title?></h1>
					<div class="content-2 w3-center">
						<img src="<?=$img?>"/>
						<p><?=$description?></p>
					</div>

					<h4>Price:	&nbsp;<span class="newPrice">&#8358;<?=$price?>.00</span> &nbsp;<!--<span class="oldPrice">&#8358;3,400,000.00</span>--></h4>

					<div class="myBtn">
						<button name="submit" class="buyNow"><a href="">Buy Now</a></button>
						<button name="submit" class="addToCart"><a href="">Add to Cart</a></button>
					</div>
				</div>
			</div>
		</section>


			<!-- DISPLAYING IN LARGE SCREEN -->
		<section class="examples w3-hide-small">
			<div class="container w3-third">
				<div class="sample">
					<h1><?=$title?></h1>
					<div class="content-2 w3-center">
						<img src="<?=$img?>"/>
						<p><?=$description?></p>
					</div>

					<h4>Price:	&nbsp;<span class="newPrice">&#8358;<?=$price?>.00</span> &nbsp;<!--<span class="oldPrice">&#8358;3,400,000.00</span>--></h4>

					<div class="myBtn">
						<button name="submit" class="buyNow"><a href="">Buy Now</a></button>
						<button name="submit" class="addToCart"><a href="">Add to Cart</a></button>
					</div>
				</div>
			</div>
		</section>
				<!--<div class="w3-row-padding w3-center w3-card-2 w3-margin">

				<div class="w3-half w3-padding-large">
					<img src="" class="w3-image w3-circle" height="200px" width="80%">
				</div>

				<div class="w3-half w3-padding-16">
					<ul class="w3-ul">
						<li class="w3-xlarge"></li>
						<li></li>


						<li>
							<span class="">&#8358;.00</span>
							<span></span>
						</li>



						<li class="w3-margin-top">

							<button class="w3-btn w3-text-light-grey w3-teal w3-large w3-round-large">Buy now</button>
						

							<button class="w3-btn w3-text-light-grey w3-teal w3-large w3-round-large">Add to cart</button>

						</li>

					</ul>
				</div>

			</div>-->

			<?php

				}

				}else{

			?>

				<div class="w3-row-padding w3-center w3-card-2 w3-margin">

					<div class="w3-half w3-text-red w3-padding-large">
						<h2>No goods to display for now, check again later.</h2>
					</div>

				</div>

				<?php

					}

				?>
			</div>
		</div>

		<!-- SELECTING ALL CATEGORIES  ENDS-->

		

		<!-- SELECTING CUPS CATEGORIES -->

			 <div id="showCUPS" class=""  style="display: none;">
			   <h2 class="w3-center w3-text-white w3-large w3-padding-16">Cup Souvenirs</h2>
			   <div class="">
			    	
			    		<?php 

			    		$sql = "SELECT * FROM products WHERE category ='cup' ";
			    		$query = mysqli_query($conn, $sql);
			    		if (mysqli_num_rows($query) > 0) {

			    			while ($result = mysqli_fetch_assoc($query)) {
			    				$id=$result['id'];
			    				$title=$result['title'];
			    				$description=$result['description'];
			    				$price=$result['price'];
			    				$img = $result['img'];

			    		
			    		?>
			    	<div class="w3-row-padding w3-center w3-card-2 w3-margin">

			    		<div class="w3-half w3-padding-large">
			    			<img src="<?=$img?>" class="w3-image w3-circle" height="200px" width="80%">
			    		</div>

			    		<div class="w3-half w3-padding-16">
			    			<ul class="w3-ul">
			    				<li class="w3-xlarge"><?=$title?></li>
			    				<li><?=$description?></li>


			    				<li>
			    					<span class="">&#8358;<?=$price?>.00</span>
			    					<span></span>
			    				</li>



			    				<li class="w3-margin-top">

			    					<button class="w3-btn w3-text-light-grey w3-teal w3-large w3-round-large">Buy now</button>
						

										<button class="w3-btn w3-text-light-grey w3-teal w3-large w3-round-large">Add to cart</button>

			    				</li>

			    			</ul>
			    		</div>

			    	</div>

			    	<?php

			    		}
			    	}else{

			    		?>

			    		<div class="w3-row-padding w3-center w3-card-2 w3-margin">

			    			<div class="w3-half w3-text-red w3-padding-large">
			    				<h2>No goods to display for now, check again later.</h2>
			    			</div>

			    		</div>

			    		<?php

			    	}

			    	?>
			   </div>
			</div>

			<!-- SELECTING CUPS CATEGORIES ENDS -->

		<!--=======
				Commerce ENDS===
					=========-->


		<?php

		include '../foot.php';

	?>






					<!-- modal-->
					<div class="modal" id="myModal">
						<div class="modal-content w3-animate-top w3-round-large w3-text-black">
							<span class="close">&times;</span>

							
						</div>
					</div>
				</div>

<!--<script type="text/javascript">
	var myIndex = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}    
  x[myIndex-1].style.display = "block";  
  setTimeout(carousel, 6000); // Change image every 5 seconds
}

</script>




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

</script>-->
<script type="text/javascript" src="../jsfile.js"></script>

</body>
</html>










