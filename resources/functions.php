<?php
require_once 'config.php';
	$upload_directory = "../resources/uploads";
	error_reporting(-1);
ini_set('display_errors','On');
set_error_handler("var_dump"); 

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function


//////////////PHPMailer Functions//////////////////////////////
/*use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception; */

/* Exception class. */
/* require '/home/swifftsh/public_html/PHPMailer/src/Exception.php';

/* The main PHPMailer class. */
/* require '/home/swifftsh/public_html/PHPMailer/src/PHPMailer.php';

/* SMTP class, needed if you want to use SMTP. */
/* require '/home/swifftsh/public_html/PHPMailer/src/SMTP.php'; */
//////////////XX////PHPMailer Functions///XXXXX///////////////


//HELPER FUNCTIONS
function last_id()
{
	global $connection;
	return mysqli_insert_id($connection);
}
function redirect($location)
{
	header("location:$location");
}

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
//Randome String generator
function randomStringGenerator($length){
	$result = "";
	$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$charsArray = str_split($chars);
	for ($i=0; $i < $length; $i++) { 
		$randItem = array_rand($charsArray);
		$result .= $charsArray[$randItem];
	}
	return $result;
}


//Order Numbers generator
function order_number_generator($length){
	$result = "";
	$chars = "0123456789";
	$charsArray = str_split($chars);
	for ($i=0; $i < $length; $i++) { 
		$randItem = array_rand($charsArray);
		$result .= $charsArray[$randItem];
	}
	return $result;
}
//Token Generator
function token_generator(){
	$token = $_SESSION['token']= md5(uniqid(mt_rand(),true));
	return $token;
}
function set_message($msg)
{
	if (!$msg) {
		$_SESSION['message'] = "";
	} else{
		$_SESSION['message'] = $msg;
	}
}
function display_message(){
	if (isset($_SESSION['message'])) {
		echo $_SESSION['message'];
		unset($_SESSION['message']);
	} else {
		$_SESSION['message'] = "";
        unset($_SESSION['message']);
	}
}

function get_row($check){
	return mysqli_num_rows($check);
}

//function to count all records
function count_all_records($table){
	$query = query("SELECT * FROM ".$table);
	confirm($query);
	return mysqli_num_rows($query);
}

 function view_counter(){
    $query = query("SELECT * FROM view_counter");
    confirm($query);
    $visitors = get_row($query);
     }
/***************************************Function to upload an image*********************************************************************/
function upload_image($photo){
		# Check if file was posted without any error
		if (isset($_FILES[$photo]) && $_FILES[$photo]['error'] == 0) {
		 	$allowed = array('jpg' => 'image/jpg','JPG' => 'image/JPG','JPEG' => 'image/JPEG','gif' => 'image/gif','png' => 'image/png','jpeg' => 'image/jpeg' );
		 	$imagename = time().'_'. $_FILES[$photo]['name'];
		 	$imagetype = $_FILES[$photo]['type'];
		 	$imagesize = $_FILES[$photo]['size'];
		 	$image_extension = pathinfo($imagename,PATHINFO_EXTENSION);
		 	$image_in_temp_location = $_FILES[$photo]['tmp_name'];

		 	if (!array_key_exists($image_extension, $allowed)) {
		 		die("Error: Please select a valid file format!");
		 	}

		 	//Verify Image size (5MB)
		 	$max_size = 5 * 1024 * 1024;
		 	if ($imagesize > $max_size) {
		 		die("Error: Image is too big!");
		 	}

		 	//Verify MIME type of the image
		 	if (in_array($imagetype, $allowed)) {
		 		# CHECK WHETHER THE IMAGE ALREADY EXISTS IN THE UPLOADS FOLDER
		 		if (file_exists("uploads/".$imagename)) {
		 			echo $imagename." alredy exists.";
		 		} else {
		 			 move_uploaded_file($image_in_temp_location, UPLOAD_DIRECTORY.DS.$imagename);
		 		}
		 	} else{
		 		echo "There was a problem uploading your file.";
		 	}
		 } else {
		 	echo "Error: ".$_FILES[$photo]['error'];
		 } 
		 return $imagename;
}
/*****************************XX***************Function to upload an image****************XXX***************************************/

/***************************************Function to upload profile Pic*********************************************************************/
function upload_profile($profile){
		# Check if file was posted without any error
		if (isset($_FILES[$profile]) && $_FILES[$profile]['error'] == 0) {
		 	$allowed = array('jpg' => 'image/jpg','JPG' => 'image/JPG','JPEG' => 'image/JPEG','gif' => 'image/gif','png' => 'image/png','jpeg' => 'image/jpeg' );
		 	$imagename = time().'_'. $_FILES[$profile]['name'];
		 	$imagetype = $_FILES[$profile]['type'];
		 	$imagesize = $_FILES[$profile]['size'];
		 	$image_extension = pathinfo($imagename,PATHINFO_EXTENSION);
		 	$image_in_temp_location = $_FILES[$profile]['tmp_name'];

		 	if (!array_key_exists($image_extension, $allowed)) {
		 		die("Error: Please select a valid file format!");
		 	}

		 	//Verify Image size (5MB)
		 	$max_size = 5 * 1024 * 1024;
		 	if ($imagesize > $max_size) {
		 		die("Error: Image is too big!");
		 	}

		 	//Verify MIME type of the image
		 	if (in_array($imagetype, $allowed)) {
		 		# CHECK WHETHER THE IMAGE ALREADY EXISTS IN THE UPLOADS FOLDER
		 		if (file_exists("uploads/profile_pictures".$imagename)) {
		 			echo $imagename." already exists.";
		 		} else {
		 			 move_uploaded_file($image_in_temp_location, UPLOAD_PP.DS.$imagename);
		 		}
		 	} else{
		 		echo "There was a problem uploading your Profile Picture.";
		 	}
		 } else {
		 	echo "Error: ".$_FILES[$profile]['error'];
		 } 
		 return $imagename;
}
/*****************************XX***************Function to upload profile Pic****************XXX***************************************/

/***************************************Function to upload logo*********************************************************************/
function upload_logo($photo){
		# Check if file was posted without any error
		if (isset($_FILES[$photo]) && $_FILES[$photo]['error'] == 0) {
		 	$allowed = array('jpg' => 'image/jpg','JPG' => 'image/JPG','JPEG' => 'image/JPEG','gif' => 'image/gif','png' => 'image/png','jpeg' => 'image/jpeg' );
		 	$imagename = time().'_'. $_FILES[$photo]['name'];
		 	$imagetype = $_FILES[$photo]['type'];
		 	$imagesize = $_FILES[$photo]['size'];
		 	$image_extension = pathinfo($imagename,PATHINFO_EXTENSION);
		 	$image_in_temp_location = $_FILES[$photo]['tmp_name'];

		 	if (!array_key_exists($image_extension, $allowed)) {
		 		die("Error: Please select a valid file format!");
		 	}

		 	//Verify Image size (5MB)
		 	$max_size = 5 * 1024 * 1024;
		 	if ($imagesize > $max_size) {
		 		die("Error: Image is too big!");
		 	}

		 	//Verify MIME type of the image
		 	if (in_array($imagetype, $allowed)) {
		 		# CHECK WHETHER THE IMAGE ALREADY EXISTS IN THE UPLOADS FOLDER
		 		if (file_exists("uploads/brand_logos".$imagename)) {
		 			echo $imagename." already exists.";
		 		} else {
		 			 move_uploaded_file($image_in_temp_location, UPLOAD_LOGO.DS.$imagename);
		 		}
		 	} else{
		 		echo "There was a problem uploading your Profile Picture.";
		 	}
		 } else {
		 	echo "Error: ".$_FILES[$photo]['error'];
		 } 
		 return $imagename;
}
/*****************************XX***************Function to upload logo****************XXX***************************************/

///////////////XXXXX/////////////////////////////Helper Functions///////////////////////////////////////XXXXXX////////////////////




/////////////////////////////////////////FRONT FUNCTIONS////////////////////////////////////////////////////////////////////

function get_suggestions(){
	$query = query("SELECT * FROM products WHERE quant_sold >=20 ");
	confirm($query);
	while($row = fetch_array($query)){
		$suggestions =<<<DELIMETER
		<div class="col-md-2 suggestions">
		<a href="single_product.php?id={$row['ID']}&c_id={$row['category_ID']}"> <img src="../resources/uploads/{$row['product_image']}" alt="{$row['Title']}" class="img-fluid" title="{$row['Title']}" style = "width:170px;height:170px; border-radius:5px"></a>
			<div class="bottomOverlay">
			<h4 style="font-family:serif">{$row['Title']}</h4>
			<sup>WAS</sup>
			<del><span>KES </span>{$row['Last_Price']}</del>
			<h6><span>KES </span>{$row['Price']}</h6>
			</div>
		</div>
DELIMETER;
		echo $suggestions;
	}
}


function get_similar_products(){
	if (isset($_GET["id"]) && isset($_GET["c_id"])) {
	$product_id = $_GET["id"];
	$category_id = $_GET["c_id"];
	$user_id = $_SESSION['ID'];
	$query = query("SELECT * FROM products WHERE Product_quantity > 1 AND category_ID='$category_id' AND ID != '$product_id' LIMIT 8");
	confirm($query);
	$num_rows = get_row($query);
	if ($num_rows == 0) {
		echo("<h5 align='center'>No Similar Products.</h5>");
	} else{
			while($row = fetch_array($query)){
				$p_id = $row['ID'];

				$sql = query("SELECT * FROM products WHERE ID = $p_id ");
		confirm($sql);
		while ($row2 = fetch_array($sql)) {
			$c_id = $row2["category_ID"];
		}

				//////////////////////View counter/////////////////////////
	    $query3 = query("SELECT * FROM view_counter WHERE product_id='$p_id'");
        confirm($query3);
        $result = get_row($query3);
        if ($result <= 999){
            $visitors = $result;
        } elseif ($result > 1000 && $result <= 999999){
            $visitors = floor($result/1000)."k";
        } elseif ($result > 1000000 && $result <= 999999999){
            $visitors = floor($result/1000000)."M";
        } else{
            $visitors = floor($result/1000000000)."B";
        }
        ///////////////////////XXXXXX/////////////View counter////////////XXX////////////

        /////////Check Product In Wish List////////////////////
		$sql2 = query("SELECT user_name FROM wishlist WHERE product_ID='$p_id' AND user_id='$user_id'");
	    confirm($sql2);
	    $result = get_row ($sql2);
	    if ($result > 0) {
	    	$icon = "fas fa-heart";
	    } else{
	    	$icon = "far fa-heart";
	    }
		////////////XXXX//Check product in wishlist///XXXX////////////
		$similar_product =<<<DELIMETER
		<div class="col-md-3 col-6 my-2">
					<a href="single_product.php?id={$row['ID']}&c_id={$row['category_ID']}"> <img src="../resources/uploads/{$row['product_image']}" alt="{$row['Title']}" class="img-fluid" title="{$row['Title']}" style = "width:170px;height:170px; border-radius:5px"></a>
					<div class="">
							<h4>{$row['Title']}</h4>
							<sup>WAS</sup>
							<del><span>KES </span>{$row['Last_Price']}</del>
							<h6><span>KES </span>{$row['Price']}</h6>
						<i class="fa fa-eye "><span> {$visitors}</span></i>
						<a title="Add to wish list" onclick="add_to_wishlist({$row['ID']})" ><i class="$icon" id="{$row['ID']}"></i> </a>
						<a onclick="add_to_cart_directly({$row['ID']})"><i class="fa fa-shopping-cart"></i> </a><br>
						<a href="single_product.php?id={$row['ID']}&c_id={$row['category_ID']}"><button class="btn btn-primary btn-main newArrivals-btn">Buy Now</button></a>	
					</div>
				</div>
DELIMETER;
		echo $similar_product;
	}
	}
} else{
	echo("<h5 align='center'>No Similar Products Found.</h5>");
}
}


function get_hotdeal_products(){
	$query = query("SELECT * FROM hotdeals");
	confirm($query);
	while($row = fetch_array($query)){
		$product_id = $row['product_ID'];
		$query2 = query("SELECT * FROM products WHERE ID ='$product_id'");
		confirm($query2);
		while($row2 =fetch_array($query2)){
			$c_id = $row2['category_ID'];
		}
		$user_ID = $_SESSION["ID"];
        $query3 = query("SELECT user_name FROM wishlist WHERE product_ID='$product_id' AND user_id='$user_ID'");
	    confirm($query3);
	    $result = get_row($query3);
	    if ($result > 0) {
	    	$icon = "fas fa-heart";
	    } else{
	    	$icon = "far fa-heart";
	    }

	    //////////////////////View counter/////////////////////////
	    $query3 = query("SELECT * FROM view_counter WHERE product_id='$product_id'");
        confirm($query3);
        $result = get_row($query3);
        if ($result <= 999){
            $visitors = $result;
        } elseif ($result > 1000 && $result <= 999999){
            $visitors = floor($result/1000)."k";
        } elseif ($result > 1000000 && $result <= 999999999){
            $visitors = floor($result/1000000)."M";
        } else{
            $visitors = floor($result/1000000000)."B";
        }
        ///////////////////////XXXXXX/////////////View counter////////////XXX////////////
	   /*******************************************Shopping Cart************************************************************/
		$cart = query("SELECT user_name FROM cart WHERE product_ID='$product_id' AND user_id='$user_ID'");
	    confirm($cart);
	    $res = get_row($cart);
	    if ($res > 0) {
	    	$cart_icon = "hide";
	    } else{
	    	$cart_icon = "";
	    }
	    /*************************************************XXX*******Shopping cart ****************************************************/
		$product =<<<DELIMETER
		<div class="col-md-3 col-6">
		<a href="single_product.php?id={$row['product_ID']}&c_id={$c_id}"><img src="../resources/uploads/{$row['product_image']}" alt="{$row['product_name']}" class="img-responsive hotdeal_images"  title="{$row['product_name']}" data-aos="flip-up" data-aos-delay = "200"></a>
		<div class="hotDeals-bottom-overlay">
				<h3 style="font-family:serif">{$row['product_name']}</h3>
				<sup>WAS</sup>
				<del><span>KES </span>{$row['last_price']}</del>
				<h6><span>KES </span>{$row['product_price']}</h6>
			<i class="fa fa-eye "><span>{$visitors}</span></i>
			<a title="Add to wish list" onclick="add_to_wishlist($product_id)" ><i class="$icon" id="$product_id"></i> </a>
			<a onclick="add_to_cart_directly($product_id)"><i class="fa fa-shopping-cart $cart_icon"></i> </a><br>
			<a href="single_product.php?id={$row['product_ID']}&c_id={$c_id}"><button class="btn btn-primary btn-main">Buy Now</button></a>	
		</div>
	</div>
DELIMETER;
		echo $product;
	}
}

//////////////////////////////////GET NEW ARRIVAL PRODUCTS//////////////////////////////////////////////////////////////////
function get_newarrivals(){
	$user_id = $_SESSION["ID"];
	$query = query("SELECT * FROM newarrivals WHERE product_quantity >=1 ");
	confirm($query);
	while ($row = fetch_array($query)) {
		$product_photo = display_photo($row['product_image']);
		$product_id = $row['Product_ID'];
		$query2 = query("SELECT user_name FROM wishlist WHERE product_ID='$product_id' AND user_id='$user_id'");
	    confirm($query2);
	    $result = get_row ($query2);
	    if ($result > 0) {
	    	$icon = "fas fa-heart";
	    } else{
	    	$icon = "far fa-heart";
	    }
	    /*******************************************Shopping Cart Icon*****************************************************************************/
		$query3 = query("SELECT user_name FROM cart WHERE product_ID='$product_id' AND user_ID='$user_id'");
	    confirm($query3);
	    $res = get_row($query3);
	    if ($res > 0) {
	    	$cart_icon = "hide";
	    } else{
	    	$cart_icon = "";
	    }
	    /*************************************************XXX*******Shopping cart icon**************XX******************************************************************/
	    //View counter
	    $query3 = query("SELECT * FROM view_counter WHERE product_id='$product_id'");
        confirm($query3);
        $result = get_row($query3);
        if ($result <= 999){
            $visitors = $result;
        } elseif ($result > 1000 && $result <= 999999){
            $visitors = floor($result/1000)."k";
        } elseif ($result > 1000000 && $result <= 999999999){
            $visitors = floor($result/1000000)."M";
        } else{
            $visitors = floor($result/1000000000)."B";
        }
		// i'll use heredoc to display the whole string
		$product = <<<DELIMETER
					<div class="col-6">
					<a href="single_product.php?id={$row['Product_ID']}&c_id={$row['category_ID']}"> <img src="{$product_photo}" alt="" class="img-fluid" title="{$row['Title']}" style = "width:170px;height:170px;"></a>
					</div>
					<div class="col-6">
						<h3 style="font-family:serif"><a href="single_product.php?id={$row['Product_ID']}"> {$row['Title']}</a> </h3>
						<sup>WAS</sup>
						<del>Ksh {$row['Last_Price']}</del><br>
						<h5>Ksh {$row['Price']}</h5>
						<i class="fa fa-eye "><span> {$visitors}</span></i>
						<a title="Add to wish list" onclick="add_to_wishlist($product_id)" ><i class="$icon" id="$product_id"></i> </a>
						<a onclick="add_to_cart_directly($product_id)"><i class="fa fa-shopping-cart $cart_icon"></i> </a><br>
						<a href="single_product.php?id={$row['Product_ID']}&c_id={$row['category_ID']}"><button class="btn btn-primary btn-main newArrivals-btn">Buy Now</button></a>	
						<hr>
					</div>
DELIMETER;
		echo $product;
	}
}

//////////////////////////////////////////////END OF NEW ARRIVAL PRODUCTS//////////////////////////////////////////////

//////////////////////////////////GET FEATURED PRODUCTS//////////////////////////////////////////////////////////////////
function get_features(){
	$user_id = $_SESSION["ID"];
	$query = query("SELECT * FROM features WHERE product_quantity >=1 ");
	confirm($query);
	while ($row = fetch_array($query)) {
		$product_photo = display_photo($row['product_image']);
		$product_id = $row['product_ID'];
		$query2 = query("SELECT user_name FROM wishlist WHERE product_ID='$product_id' AND user_id='$user_id'");
	    confirm($query2);
	    $result = get_row ($query2);
	    if ($result > 0) {
	    	$icon = "fas fa-heart";
	    } else{
	    	$icon = "far fa-heart";
	    }
	    /*******************************************Shopping Cart Icon*****************************************************************************/
		$cart = query("SELECT user_name FROM cart WHERE product_ID='$product_id' AND user_ID='$user_id'");
	    confirm($cart);
	    $res = get_row($cart);
	    if ($res > 0) {
	    	$cart_icon = "hide";
	    } else{
	    	$cart_icon = "";
	    }
	    /*************************************************XXX*******Shopping cart icon**************XX******************************************************************/
	    //View counter
	    $query3 = query("SELECT * FROM view_counter WHERE product_id='$product_id'");
        confirm($query3);
        $result = get_row($query3);
        if ($result <= 999){
            $visitors = $result;
        } elseif ($result > 1000 && $result <= 999999){
            $visitors = floor($result/1000)."k";
        } elseif ($result > 1000000 && $result <= 999999999){
            $visitors = floor($result/1000000)."M";
        } else{
            $visitors = floor($result/1000000000)."B";
        }
		// i'll use heredoc to display the whole string
		$product = <<<DELIMETER
					<div class="col-6">
					<a href="single_product.php?id={$row['product_ID']}&c_id={$row['category_ID']}"> <img src="{$product_photo}" alt="" class="img-fluid" title="{$row['Title']}" style = "width:170px;height:170px;"></a>
					</div>
					<div class="col-6">
						<h3 style="font-family:serif"><a href="single_product.php?id={$row['product_ID']}"> {$row['Title']}</a> </h3>
						<sup>WAS</sup>
						<del>Ksh {$row['Last_Price']}</del><br>
						<h5>Ksh {$row['Price']}</h5>
						<i class="fa fa-eye "><span> {$visitors}</span></i>
						<a title="Add to wish list" onclick="add_to_wishlist($product_id)" ><i class="$icon" id="$product_id"></i> </a>
						<a onclick="add_to_cart_directly($product_id)"><i class="fa fa-shopping-cart $cart_icon"></i> </a><br>
						<a href="single_product.php?id={$row['product_ID']}&c_id={$row['category_ID']}"><button class="btn btn-primary btn-main newArrivals-btn">Buy Now</button></a>	
						<hr>
					</div>
DELIMETER;
		echo $product;
	}
}
//////////////////////////////////////////////END OF FEATURED PRODUCTS//////////////////////////////////////////////

//////////////////////////////////GET TRENDING PRODUCTS//////////////////////////////////////////////////////////////////
function get_trending_products(){
	$user_id = $_SESSION["ID"];
	$query = query("SELECT * FROM trending_products WHERE product_quantity >=1 ");
	confirm($query);
	while ($row = fetch_array($query)) {
		$product_photo = display_photo($row['product_image']);
		$product_id = $row['product_ID'];
		$query2 = query("SELECT user_name FROM wishlist WHERE product_ID='$product_id' AND user_id='$user_id'");
	    confirm($query2);
	    $result = get_row ($query2);
	    if ($result > 0) {
	    	$icon = "fas fa-heart";
	    } else{
	    	$icon = "far fa-heart";
	    }

	   	/*******************************************Shopping Cart Icon*****************************************************************************/
		$cart = query("SELECT user_name FROM cart WHERE product_ID='$product_id' AND user_ID='$user_id'");
	    confirm($cart);
	    $res = get_row($cart);
	    if ($res > 0) {
	    	$cart_icon = "hide";
	    } else{
	    	$cart_icon = "";
	    }
	    /*************************************************XXX*******Shopping cart icon**************XX******************************************************************/

	    //View counter
	    $query3 = query("SELECT * FROM view_counter WHERE product_id='$product_id'");
        confirm($query3);
        $result = get_row($query3);
        if ($result <= 999){
            $visitors = $result;
        } elseif ($result > 1000 && $result <= 999999){
            $visitors = floor($result/1000)."k";
        } elseif ($result > 1000000 && $result <= 999999999){
            $visitors = floor($result/1000000)."M";
        } else{
            $visitors = floor($result/1000000000)."B";
        }
		// i'll use heredoc to display the whole string
		$product = <<<DELIMETER
					<div class="col-6">
					<a href="single_product.php?id={$row['product_ID']}&c_id={$row['category_ID']}"> <img src="{$product_photo}" alt="" class="img-fluid" title="{$row['Title']}" style = "width:170px;height:170px;"></a>
					</div>
					<div class="col-6">
						<h3 style="font-family:serif"><a href="single_product.php?id={$row['product_ID']}"> {$row['Title']}</a> </h3>
						<sup>WAS</sup>
						<del>Ksh {$row['Last_Price']}</del><br>
						<h5>Ksh {$row['Price']}</h5>
						<i class="fa fa-eye "><span> {$visitors}</span></i>
						<a title="Add to wish list" onclick="add_to_wishlist($product_id)" ><i class="$icon" id="$product_id"></i> </a>
						<a onclick="add_to_cart_directly($product_id)"><i class="fa fa-shopping-cart $cart_icon"></i> </a><br>
						<a href="single_product.php?id={$row['product_ID']}&c_id={$row['category_ID']}"><button class="btn btn-primary btn-main newArrivals-btn">Buy Now</button></a>	
						<hr>
					</div>
DELIMETER;
		echo $product;
	}
}
//////////////////////////////////////////////END OF TRENDING PRODUCTS//////////////////////////////////////////////

//////////////////////////////////GET PARTNERED PRODUCTS//////////////////////////////////////////////////////////////////
function get_partnered_products(){
	$user_id = $_SESSION["ID"];
	$query = query("SELECT * FROM partnered_products WHERE product_quantity >=1 ");
	confirm($query);
	while ($row = fetch_array($query)) {
		$product_photo = display_photo($row['product_image']);
		$product_id = $row['product_ID'];
		$query2 = query("SELECT user_name FROM wishlist WHERE product_ID='$product_id' AND user_id='$user_id'");
	    confirm($query2);
	    $result = get_row ($query2);
	    if ($result > 0) {
	    	$icon = "fas fa-heart";
	    } else{
	    	$icon = "far fa-heart";
	    }
	   	/*******************************************Shopping Cart Icon*****************************************************************************/
		$cart = query("SELECT user_name FROM cart WHERE product_ID='$product_id' AND user_ID='$user_id'");
	    confirm($cart);
	    $res = get_row($cart);
	    if ($res > 0) {
	    	$cart_icon = "hide";
	    } else{
	    	$cart_icon = "";
	    }
	    /*************************************************XXX*******Shopping cart icon**************XX******************************************************************/
	    //View counter
	    $query3 = query("SELECT * FROM view_counter WHERE product_id='$product_id'");
        confirm($query3);
        $result = get_row($query3);
        if ($result <= 999){
            $visitors = $result;
        } elseif ($result > 1000 && $result <= 999999){
            $visitors = floor($result/1000)."k";
        } elseif ($result > 1000000 && $result <= 999999999){
            $visitors = floor($result/1000000)."M";
        } else{
            $visitors = floor($result/1000000000)."B";
        }
		// i'll use heredoc to display the whole string
		$product = <<<DELIMETER
					<div class="col-6">
					<a href="single_product.php?id={$row['product_ID']}&c_id={$row['category_ID']}"> <img src="{$product_photo}" alt="" class="img-fluid" title="{$row['Title']}" style = "width:170px;height:170px;"></a>
					</div>
					<div class="col-6">
						<h3 style="font-family:serif"><a href="single_product.php?id={$row['product_ID']}"> {$row['Title']}</a> </h3>
						<sup>WAS</sup>
						<del>Ksh {$row['Last_Price']}</del><br>
						<h5>Ksh {$row['Price']}</h5>
						<i class="fa fa-eye "><span> {$visitors}</span></i>
						<a title="Add to wish list" onclick="add_to_wishlist($product_id)" ><i class="$icon" id="$product_id"></i> </a>
						<a onclick="add_to_cart_directly($product_id)"><i class="fa fa-shopping-cart $cart_icon"></i> </a><br>
						<a href="single_product.php?id={$row['product_ID']}&c_id={$row['category_ID']}"><button class="btn btn-primary btn-main newArrivals-btn">Buy Now</button></a>	
						<hr>
					</div>
DELIMETER;
		echo $product;
	}
}
//////////////////////////////////////////////END OF TRENDING PRODUCTS//////////////////////////////////////////////


//////////////////////////////////GET PRODUCTS TO SINGLE PRODUCT PAGE FUNCTIONS///////////////////////////////

function product_slider()
{
	$visitor_ipaddress = $_SERVER['REMOTE_ADDR'];
	$product_id = escape_string($_GET['id']);
    $query = query("SELECT * FROM view_counter WHERE ip_address='$visitor_ipaddress' AND product_id='$product_id'");
    confirm($query);
    $result = get_row($query);
    if ($result < 1){
        $query = query("INSERT INTO view_counter(ip_address,product_id) VALUES('$visitor_ipaddress','$product_id')");
        confirm($query);
    }
	$query = query("SELECT * FROM products WHERE ID=".escape_string($_GET['id'])."");
	confirm($query);
	while ($row = fetch_array($query)) {
		$product_photo = display_photo($row['product_image']);
		$product_slider = <<<DELIMETER
				<div class="images">
					<div class="slider"><img src="$product_photo" class="img-responsive"></div>
					<div class="img-slider">
					<div class="imgs"><img src="$product_photo" class="img-responsive"></div>
					<div class="imgs"><img src="$product_photo" class="img-responsive"></div>
					<div class="imgs"><img src="$product_photo" class="img-responsive"></div>
					</div>
				</div>
DELIMETER;
		echo $product_slider;
	}
}

/////////////////////////////////FUNCTION TO GET PRODUCT DETAILS FROM THE DATABASE//////////////////////////////////////////////
if (isset($_POST['basic_info'])) {
	$product_id = $_POST["product_id"];
	$query = query("SELECT * FROM products WHERE ID='$product_id'");
	confirm($query);
	while ($row = fetch_array($query)) {
		$product_in_stock = $row['Product_quantity'];
		if ($product_in_stock >= 10) {
			$availability = "<strong style='color:green'>In Stock</strong>";
				} else{
						$availability = '<strong style="color:red"> Only ' .$product_in_stock .' remaining.</strong>';
				}
			$condition = $row['Product_condition'];
			$seller = $row['seller'];
			$basic_info=<<<DELIMETER
					<p><b>Availability:</b> $availability</p>
					<p><b>Condition:</b> {$condition}</p>
					<p><b>Seller:</b> <strong style="color:#9900ff">{$seller}</strong> </p>
DELIMETER;
	echo($basic_info);
	}
	
}

if (isset($_POST['get_description'])) {
	$product_id = $_POST["product_id"];
	$query = query("SELECT * FROM products WHERE ID='$product_id'");
	confirm($query);
	while ($row = fetch_array($query)) {
			$description = $row['Description'];
			$descr=<<<DELIMETER
					<p>$description</p>
DELIMETER;
	echo($descr);
	}
	
}
function product_details()
{
	if (isset($_GET["c_id"])) {
		$category_id = $_GET["c_id"];
	} else{
	$category_id = 0;
}
	$user_id = $_SESSION["ID"];
	$product_id = escape_string($_GET['id']);
	$visitor_ipaddress = $_SERVER['REMOTE_ADDR'];
/////////////////////////////////////////////Visit Counter//////////////////////////////
    $query = query("SELECT * FROM view_counter WHERE ip_address='$visitor_ipaddress' AND product_id='$product_id'");
    confirm($query);
    $result = get_row($query);
    if ($result < 1){
        $query = query("INSERT INTO view_counter(ip_address,product_id) VALUES('$visitor_ipaddress','$product_id')");
        confirm($query);
    }
 //////////////////////////////////XXX///////////Visit Counter//////////XXX////////////////////
	$query = query("SELECT * FROM products WHERE ID=".escape_string($_GET['id'])." ");
	confirm($query);
	while ($row = fetch_array($query)) {
		$brandname = query("SELECT brand FROM brands WHERE ID=".$row['brand_ID']);
		confirm($brandname);
		$result = fetch_array($brandname);
		$brand = $result['brand'];
		$product_photo = display_photo($row['product_image']);
		$sub_photo = display_photo($row['product_image']);
		$product_in_stock = $row['Product_quantity'];
		$size = $row['Sizes'];		
		if ($product_in_stock >= 10) {
			$availability = "<strong style='color:green'>In Stock</strong>";
				} else{
						$availability = '<strong style="color:red"> Only ' .$product_in_stock .' remaining.</strong>';
				}
			$condition = $row['Product_condition'];
			$seller = $row['seller'];
		////////////////////////Wish list icon/////////////////////////////////////////////////////////
		$wish = query("SELECT user_name FROM wishlist WHERE product_ID='$product_id' AND user_id='$user_id'");
	    confirm($wish);
	    $result = get_row ($wish);
	    if ($result > 0) {
	    	$icon = "fas fa-heart";
	    } else{
	    	$icon = "far fa-heart";
	    }
	//////////////////////////////////Geting rating star for a product///////////////////////
	$query2 = query("SELECT ID FROM product_rating WHERE product_id = '$product_id'");
	confirm($query2);
	$num_rows = get_row($query2);
	$query1 = query("SELECT SUM(user_rate) As total FROM product_rating WHERE product_id='$product_id'");
	confirm($query1);
	while ($row1 = fetch_array($query1)) {
		$total = $row1['total'];
	}
	$average = '';
	if($num_rows != 0){
		if(is_nan(round($total/$num_rows,1))){
			$average = 0;
		} else{
			$average = round($total/$num_rows,1);
		}
	} else{
		$average = 0;
	}
	$star_rate = $average*20;
	///////////////////////XXX///////////Geting rating star for a product///////////XXX////////////

	/////////////////////////////////////////Checking If the product is added to cart///////////////
	$cart = query("SELECT * FROM cart WHERE product_ID='$product_id' AND user_ID = '$user_id'");
	confirm($cart);
	$disButton = "";
	$res = get_row($cart);
	if ($res >= 1) {
		$disButton = "disabled";
	}
	//////////////////////////////////XXX///////Checking If the product is added to cart///////XX////
		$product_details = <<<DELIMETER
			<div id="container">
		<div id="card">
			<span class="like">
				<i class="{$icon}" aria-hidden="true"  onclick="add_to_wishlist($product_id)" id="$product_id"></i>
			</span>
			<div class="images">
				<div class="slider"><img src="{$product_photo}" id="main_image" alt="{$row['Title']}"></div>
				<div class="img-slider">
					<div class="imgs"><a><img onclick="change(this)" src="../resources/uploads/1609523560_vlonetee1.JPG"></a></div>
					<div class="imgs"><a><img onclick="change(this)" src="../resources/uploads/1609582885_vanshoodie.JPG"></a></div>
					<div class="imgs"><a><img onclick="change(this)" src="../resources/uploads/1608914524_IMG-20200611-WA0060.JPG"></a></div>
				</div>

									<!-- The Modal -->
					<div id="myModal" class="image_modal">

					  <!-- The Close Button -->
					  <span class="close" onclick="document.getElementById('myModal').style.display='none'">&times;</span>

					  <!-- Modal Content (The Image) -->
					  <img class="modal-content" id="img">

					  <!-- Modal Caption (Image Text) -->
					  <div id="caption"></div>
					</div>

			</div>
			<div class="infos">
				<h1>{$row['Title']}</h1>
				<div class="reviews">
					<div class="pdt-rate">
									<div class="pro-rating">
										<div class="clearfix rating mart8">
											<div class="rating-stars">
												<div class="grey-stars"></div>
												<div class="filled-stars" style="width:  {$star_rate}%"></div>
											</div>
										</div>
									</div>
								</div>
				</div>
				<div class="price">
					<h3><span class="currency">Ksh.&nbsp;</span>2500</h3>
					<h3><span class="currency">Ksh.&nbsp;</span>4000</h3>
				</div>
				<div class="size">
					<input type ="text" class="form-control" style="margin-bottom:5px; width:100px;" id="p_size" onchange="clear_size_error()" placeholder="Size">
					<small id="size_error" style="color:red"></small>
				</div>
				<div class="more-infos">
					<ul class="tab">
						<li><a href="#" class="tablinks" onclick="openInfo(event, 'description')">Description</a></li>
						<li><a href="#" class="tablinks" onclick="openInfo(event, 'more_info')">More Info</a></li>
					</ul>
				</div>
				
					<div class="tab_content info-content" id="description">
						<h3>Description</h3><hr>
  						<p>{$row['Description']}</p>
					</div>
					
					<div class="tab_content info-content" id="more_info">
						<h3>Product Information</h3><hr>
  						<b>Brand :</b> <span>{$brand}</span><br>
  						<b>Sizes :</b> <span>{$row['Sizes']}</span><br>
  						<b>Seller :</b> <span>{$seller}</span><br>
  						<b>Color :</b> <span>Supreme</span><br>
  						<b>Condition :</b> <span>{$condition}</span><br>
  						<b>Availability :</b> <span>{$availability}</span>
					</div><div id="status_message" style="color:green; font-weight:700;"></div>
				
				<div class="buttons">
					<button onclick="add_to_cart($product_id,$category_id)" id="{$product_id}" $disButton>Add to cart</button>
					<button onclick = "add_to_cart_to_buy($product_id,$category_id)">Buy Now</button>
				</div>
			</div>
		</div>
	</div>
DELIMETER;
		echo $product_details;
	}
}

////////////////END OF GET ITEM TO SINGLE PRODUCT PAGE

function get_category(){
	$query = query("SELECT * FROM category ORDER BY Category_title ASC");
	confirm($query);
	while ($row = fetch_array($query)){
		$category = <<<DELIMETER
		<a href="category.php?id={$row['ID']}" class="dropdown-item" id="category">{$row['Category_title']}</a>
DELIMETER;
		echo $category;
	}
}
function get_product_to_category_page(){
	$query = query("SELECT * FROM products WHERE product_quantity >= 1 AND Category_ID = ".escape_string($_GET['id'])." "); //Query to get records from database(with specific category) with the id send to category page
	confirm($query);
	$exist = get_row($query);
	if ($exist == 0) {
		echo "<span style='color:#8585ad;font-weight:700;font-size:20px; margin:150px auto;font-family:serif;'>Not available at the moment.</span>";
	} else{
	$rows = get_row($query); //Query to count all rows(record) from the database
	if(isset($_GET['page'])){
		$page = preg_replace('#[^0-9]#', '', $_GET['page']); //Regular expreesion to get only number values when page is set and replaces non-number values to empty.
	} else{
		$page = 1;
	}
	$perpage = 12; //Number of products displayed on each page.
	$lastpage = ceil($rows/$perpage); //Expression to get last page(How many pages we got out of records we have in database).
	if ($page < 1) {
		$page = 1;
	} elseif ($page > $lastpage) {
		$page = $lastpage;
	}
	///SECTION FOR MIDDLE NUMBERS FOR PAGINATION
	$middleNumbers = '';
	$sub1 = $page - 1;
	$sub2 = $page - 2;
	$add1 = $page + 1;
	$add2 = $page + 2;
	if ($page == 1) {
		//If page is 1 we show 1 as current page with a 2 for the second page
		$middleNumbers .= '<li class="page-item active"><a class="page-link">'.$page.'</a></li>';
		$middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$add1.'&id='.escape_string($_GET['id']).'">'.$add1.'</a></li>';	
	} elseif ($page == $lastpage) {
		//We show 1 for the first page and 2 as the current page
		$middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$sub1.'&id='.escape_string($_GET['id']).'">'.$sub1.'</a></li>';
		$middleNumbers .= '<li class="page-item active"><a class="page-link">'.$page.'</a></li>';
	} elseif ($page > 2 && $page < ($lastpage - 1)) {
		//If there are more pages than 2 then middle numbers will show -2 for the first page, -1 for the second page,current page,+1 for forth page and +2 for fifth page
		$middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$sub2.'&id='.escape_string($_GET['id']).'">'.$sub2.'</a></li>';
		$middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$sub1.'&id='.escape_string($_GET['id']).'">'.$sub1.'</a></li>';
		$middleNumbers .= '<li class="page-item active"><a class="page-link">'.$page.'</a></li>';
		$middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$add1.'&id='.escape_string($_GET['id']).'">'.$add1.'</a></li>';
		$middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$add2.'&id='.escape_string($_GET['id']).'">'.$add2.'</a></li>';
	} elseif ($page > 1 && $page < $lastpage) {
		//Middle numbers will show -1 page,current page and +1 page
		$middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$sub1.'&id='.escape_string($_GET['id']).'">'.$sub1.'</a></li>';
		$middleNumbers .= '<li class="page-item"><a class="page-link">'.$page.'</a></li>';
		$middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$add1.'&id='.escape_string($_GET['id']).'">'.$add1.'</a></li>';
	}
	$limit = "LIMIT ".($page-1)*$perpage.','.$perpage;
	$query2 = query("SELECT * FROM products WHERE product_quantity >= 1 AND Category_ID = ".escape_string($_GET['id'])." {$limit}");
	confirm($query2);
	$outputPagination = "";

	if ($page != 1) {
		$prev = $page - 1;
		$outputPagination .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$prev.'&id='.escape_string($_GET['id']).'">Back</a></li>';
	}
		$outputPagination .= $middleNumbers;
	if ($page != $lastpage) {
		$next = $page+1;
		$outputPagination .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$next.'&id='.escape_string($_GET['id']).'">Next</a></li>';
	}
	while ($row = fetch_array($query2)) {
		$product_picture = display_photo($row['product_image']);
        $id = $row['ID'];
        $query = query("SELECT * FROM view_counter WHERE product_id='$id'");
        confirm($query);
        $result = get_row($query);
        if ($result <= 999){
            $visitors = $result;
        } elseif ($result > 1000 && $result <= 999999){
            $visitors = floor($result/1000)."k";
        } elseif ($result > 1000000 && $result <= 999999999){
            $visitors = floor($result/1000000)."M";
        } else{
            $visitors = floor($result/1000000000)."B";
        }
        $user_ID = $_SESSION["ID"];
        $product_id = $row['ID'];
        $query = query("SELECT user_name FROM wishlist WHERE product_ID='$product_id' AND user_id='$user_ID'");
	    confirm($query);
	    $result = get_row ($query);
	    if ($result > 0) {
	    	$icon = "fas fa-heart";
	    } else{
	    	$icon = "far fa-heart";
	    }
	    	    /*******************************************Shopping Cart Icon*****************************************************************************/
		$cart = query("SELECT user_name FROM cart WHERE product_ID='$product_id' AND user_id='$user_ID'");
	    confirm($cart);
	    $res = get_row($cart);
	    if ($res > 0) {
	    	$cart_icon = "hide";
	    } else{
	    	$cart_icon = "";
	    }
	    /*************************************************XXX*******Shopping cart icon**************XX******************************************************************/
		$category_product = <<<DELIMETER
			<div class="col-md-2 col-6">
			<a href="single_product.php?id={$row['ID']}&c_id={$row['category_ID']}"><img src="{$product_picture}" alt="{$row['Title']}" class="img-fluid"  title="{$row['Title']}"  style = "width:180px;height:180px;"></a>
				<div class="hotDeals-bottom-overlay">
						<h3 style="font-family:serif;padding:5px;" class="text-center">{$row['Title']}</h3>
						<sup>WAS</sup>
						<del>Ksh {$row['Last_Price']}</del>
						<h5>Ksh {$row['Price']}</h5>
					<i class="fa fa-eye "><span> {$visitors}</span></i>
					<a title="Add to wish list" onclick="add_to_wishlist($product_id)" ><i class="$icon" id="$product_id"></i> </a>
					<a onclick="add_to_cart_directly($product_id)"><i class="fa fa-shopping-cart $cart_icon"></i> </a><br>
					<a href="single_product.php?id={$row['ID']}&c_id={$row['category_ID']}"><button class="btn btn-primary btn-main">Buy Now</button></a>	
				</div>
			</div>
DELIMETER;
		echo $category_product;
	}
	echo "<div  class='text-center' style='margin-top:40px;'><ul class='pagination'>{$outputPagination}</ul></div>";
}
}

function get_category_title(){
	$query = query("SELECT * FROM category WHERE ID=".escape_string($_GET['id'])." ");
	confirm($query);
	while ($row = fetch_array($query)) {
		$title = <<<DELIMETER
	<label id="title"><h4 class="bestseller text-center">{$row['Category_title']}</h4></label>
DELIMETER;
	echo $title;
}
}

//SEND MESSAGES FROM CONTACT PAGE
function sendMessage()
{
	if (isset($_POST['submit'])) {
		$name = $_POST['name'];
		$fromEmail = $_POST['email'];
		$subject = $_POST['subject'];
		$message = $_POST['message'];

		$to = "info@swifftshop.com";
		$headers = "From: {$name} {$fromEmail}";
		$result = mail($to, $subject, $message, $headers);
		if (!$result) {
			set_message("<h3 class = 'alert alert-warning'>Email not sent,please try again</h3>");
			redirect("contact.php");
		} else {
			set_message("<h3 class = 'alert alert-success'>We received your message,we`ll get back to you shortly.");
		}

	}
}

//funtions for BRANDS

function get_brand(){
	$query = query("SELECT * FROM brands ORDER BY brand ASC");
	confirm($query);
	while ($row = fetch_array($query)){
		$brand = <<<DELIMETER
		<a href="brands.php?id={$row['ID']}" class="dropdown-item"><img src="../resources/uploads/brand_logos/{$row['icon']}" alt="{$row['brand']}"></a>
DELIMETER;
		echo $brand;
	}
}

function get_brand_name()
{
	$query = query("SELECT * FROM brands WHERE ID=".escape_string($_GET['id'])." ");
	confirm($query);
	while ($row = fetch_array($query)) {
		$brandname = <<<DELIMETER
	<label style="width:170px; height:40px; margin: 10px 22%;background:#fff; border-radius:10px; text-align:center;"><b>{$row['brand']}</b>&nbsp;&nbsp;<img src="../resources/uploads/brand_Logos/{$row['icon']}"></label>
DELIMETER;
	echo $brandname;	
}
}

function get_product_to_brands_page(){
	$query = query("SELECT * FROM products WHERE product_quantity >= 1 AND brand_ID = ".escape_string($_GET['id'])." "); //Query to get records from database(with specific category) with the id send to category page
	confirm($query);
	$exist = get_row($query);
	if ($exist == 0) {
		echo "<span style='color:#8585ad;font-weight:700;font-size:20px; margin:150px auto;font-family:serif;padding:10px;'>Not available at the moment.</span>";
	} else{ 
	$rows = get_row($query); //Query to count all rows(record) from the database
	if(isset($_GET['page'])){
		$page = preg_replace('#[^0-9]#', '', $_GET['page']); //Regular expreesion to get only number values when page is set and replaces non-number values to empty.
	} else{
		$page = 1;
	}
	$perpage = 12; //Number of products displayed on each page.
	$lastpage = ceil($rows/$perpage); //Expression to get last page(How many pages we got out of records we have in database).
	if ($page < 1) {
		$page = 1;
	} elseif ($page > $lastpage) {
		$page = $lastpage;
	}
	///SECTION FOR MIDDLE NUMBERS FOR PAGINATION
	$middleNumbers = '';
	$sub1 = $page - 1;
	$sub2 = $page - 2;
	$add1 = $page + 1;
	$add2 = $page + 2;
	if ($page == 1) {
		//If page is 1 we show 1 as current page with a 2 for the second page
		$middleNumbers .= '<li class="page-item active"><a class="page-link">'.$page.'</a></li>';
		$middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$add1.'&id='.escape_string($_GET['id']).'">'.$add1.'</a></li>';	
	} elseif ($page == $lastpage) {
		//We show 1 for the first page and 2 as the current page
		$middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$sub1.'&id='.escape_string($_GET['id']).'">'.$sub1.'</a></li>';
		$middleNumbers .= '<li class="page-item active"><a class="page-link">'.$page.'</a></li>';
	} elseif ($page > 2 && $page < ($lastpage - 1)) {
		//If there are more pages than 2 then middle numbers will show -2 for the first page, -1 for the second page,current page,+1 for forth page and +2 for fifth page
		$middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$sub2.'&id='.escape_string($_GET['id']).'">'.$sub2.'</a></li>';
		$middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$sub1.'&id='.escape_string($_GET['id']).'">'.$sub1.'</a></li>';
		$middleNumbers .= '<li class="page-item active"><a class="page-link">'.$page.'</a></li>';
		$middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$add1.'&id='.escape_string($_GET['id']).'">'.$add1.'</a></li>';
		$middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$add2.'&id='.escape_string($_GET['id']).'">'.$add2.'</a></li>';
	} elseif ($page > 1 && $page < $lastpage) {
		//Middle numbers will show -1 page,current page and +1 page
		$middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$sub1.'&id='.escape_string($_GET['id']).'">'.$sub1.'</a></li>';
		$middleNumbers .= '<li class="page-item"><a class="page-link">'.$page.'</a></li>';
		$middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$add1.'&id='.escape_string($_GET['id']).'">'.$add1.'</a></li>';
	}
	$limit = "LIMIT ".($page-1)*$perpage.','.$perpage;
	$query2 = query("SELECT * FROM products WHERE product_quantity >= 1 AND brand_ID = ".escape_string($_GET['id'])." {$limit}");
	confirm($query2);
	$outputPagination = "";

	if ($page != 1) {
		$prev = $page - 1;
		$outputPagination .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$prev.'&id='.escape_string($_GET['id']).'">Back</a></li>';
	}
		$outputPagination .= $middleNumbers;
	if ($page != $lastpage) {
		$next = $page+1;
		$outputPagination .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$next.'&id='.escape_string($_GET['id']).'">Next</a></li>';
	}
	while ($row = fetch_array($query2)) {
		$product_picture = display_photo($row['product_image']);
        $id = $row['ID'];
        $query = query("SELECT * FROM view_counter WHERE product_id='$id'");
        confirm($query);
        $result = get_row($query);
        if ($result <= 999){
            $visitors = $result;
        } elseif ($result > 1000 && $result <= 999999){
            $visitors = floor($result/1000)."k";
        } elseif ($result > 1000000 && $result <= 999999999){
            $visitors = floor($result/1000000)."M";
        } else{
            $visitors = floor($result/1000000000)."B";
        }
        $user_ID = $_SESSION["ID"];
        $product_id = $row['ID'];
        $query = query("SELECT user_name FROM wishlist WHERE product_ID='$product_id' AND user_id='$user_ID'");
	    confirm($query);
	    $result = get_row ($query);
	    if ($result > 0) {
	    	$icon = "fas fa-heart";
	    } else{
	    	$icon = "far fa-heart";
	    }
	   	/*******************************************Shopping Cart Icon*****************************************************************************/
		$cart = query("SELECT user_name FROM cart WHERE product_ID='$product_id' AND user_id='$user_ID'");
	    confirm($cart);
	    $res = get_row($cart);
	    if ($res > 0) {
	    	$cart_icon = "hide";
	    } else{
	    	$cart_icon = "";
	    }
	    /*************************************************XXX*******Shopping cart icon**************XX******************************************************************/
		$branded_product = <<<DELIMETER
			<div class="col-md-2 col-6">
			<a href="single_product.php?id={$row['ID']}&c_id={$row['category_ID']}"><img src="{$product_picture}" alt="{$row['Title']}" class="img-fluid"  title="{$row['Title']}"  style = "width:180px;height:180px;"></a>
				<div class="hotDeals-bottom-overlay">
						<h3 style="font-family:serif;padding:5px;" class="text-center">{$row['Title']}</h3>
						<sup>WAS</sup>
						<del>Ksh {$row['Last_Price']}</del>
						<h5>Ksh {$row['Price']}</h5>
					<i class="fa fa-eye "><span> {$visitors}</span></i>
					<a title="Add to wish list" onclick="add_to_wishlist($product_id)" ><i class="$icon" id="$product_id"></i> </a>
					<a onclick="add_to_cart_directly($product_id)"><i class="fa fa-shopping-cart $cart_icon"></i> </a><br>
					<a href="single_product.php?id={$row['ID']}&c_id={$row['category_ID']}"><button class="btn btn-primary btn-main">Buy Now</button></a>	
				</div>
			</div>
DELIMETER;
		echo $branded_product;
	}
	echo "<div  class='text-center' style='margin-top:40px;'><ul class='pagination'>{$outputPagination}</ul></div>";
}
}


function get_collection(){
	$query = query("SELECT * FROM collection ORDER BY collection_title ASC");
	confirm($query);
	while ($row = fetch_array($query)){
		$collection = <<<DELIMETER
		<a href="collectionpage.php?id={$row['ID']}" class="dropdown-item">{$row['collection_title']}</a>
DELIMETER;
		echo $collection;
	}
}

function get_collection_title()
{
	$query = query("SELECT * FROM collection WHERE ID=".escape_string($_GET['id'])." ");
	confirm($query);
	while ($row = fetch_array($query)) {
		$collection_title = <<<DELIMETER
	<label id="title"><h4 class="bestseller text-center">{$row['collection_title']}</h4></label>
DELIMETER;
	echo $collection_title;	
}
}

function get_product_to_collection_page(){
	$query = query("SELECT * FROM products WHERE product_quantity >= 1 AND collection_ID = ".escape_string($_GET['id'])." "); //Query to get records from database(with specific category) with the id send to category page
	confirm($query);
	$exist = get_row($query);
	if ($exist == 0) {
		echo "<span style='color:#8585ad;font-weight:700;font-size:20px; margin:150px auto;font-family:serif;'>Not available at the moment.</span>";
	} else{
			$rows = get_row($query); //Query to count all rows(record) from the database
	if(isset($_GET['page'])){
		$page = preg_replace('#[^0-9]#', '', $_GET['page']); //Regular expreesion to get only number values when page is set and replaces non-number values to empty.
	} else{
		$page = 1;
	}
	$perpage = 12; //Number of products displayed on each page.
	$lastpage = ceil($rows/$perpage); //Expression to get last page(How many pages we got out of records we have in database).
	if ($page < 1) {
		$page = 1;
	} elseif ($page > $lastpage) {
		$page = $lastpage;
	}
	///SECTION FOR MIDDLE NUMBERS FOR PAGINATION
	$middleNumbers = '';
	$sub1 = $page - 1;
	$sub2 = $page - 2;
	$add1 = $page + 1;
	$add2 = $page + 2;
	if ($page == 1) {
		//If page is 1 we show 1 as current page with a 2 for the second page
		$middleNumbers .= '<li class="page-item active"><a class="page-link">'.$page.'</a></li>';
		$middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$add1.'&id='.escape_string($_GET['id']).'">'.$add1.'</a></li>';	
	} elseif ($page == $lastpage) {
		//We show 1 for the first page and 2 as the current page
		$middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$sub1.'&id='.escape_string($_GET['id']).'">'.$sub1.'</a></li>';
		$middleNumbers .= '<li class="page-item active"><a class="page-link">'.$page.'</a></li>';
	} elseif ($page > 2 && $page < ($lastpage - 1)) {
		//If there are more pages than 2 then middle numbers will show -2 for the first page, -1 for the second page,current page,+1 for forth page and +2 for fifth page
		$middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$sub2.'&id='.escape_string($_GET['id']).'">'.$sub2.'</a></li>';
		$middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$sub1.'&id='.escape_string($_GET['id']).'">'.$sub1.'</a></li>';
		$middleNumbers .= '<li class="page-item active"><a class="page-link">'.$page.'</a></li>';
		$middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$add1.'&id='.escape_string($_GET['id']).'">'.$add1.'</a></li>';
		$middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$add2.'&id='.escape_string($_GET['id']).'">'.$add2.'</a></li>';
	} elseif ($page > 1 && $page < $lastpage) {
		//Middle numbers will show -1 page,current page and +1 page
		$middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$sub1.'&id='.escape_string($_GET['id']).'">'.$sub1.'</a></li>';
		$middleNumbers .= '<li class="page-item"><a class="page-link">'.$page.'</a></li>';
		$middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$add1.'&id='.escape_string($_GET['id']).'">'.$add1.'</a></li>';
	}
	$limit = "LIMIT ".($page-1)*$perpage.','.$perpage;
	$query2 = query("SELECT * FROM products WHERE product_quantity >= 1 AND collection_ID = ".escape_string($_GET['id'])." {$limit}");
	confirm($query2);
	$outputPagination = "";

	if ($page != 1) {
		$prev = $page - 1;
		$outputPagination .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$prev.'&id='.escape_string($_GET['id']).'">Back</a></li>';
	}
		$outputPagination .= $middleNumbers;
	if ($page != $lastpage) {
		$next = $page+1;
		$outputPagination .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$next.'&id='.escape_string($_GET['id']).'">Next</a></li>';
	}
	while ($row = fetch_array($query2)) {
		$product_picture = display_photo($row['product_image']);
        $id = $row['ID'];
        $query = query("SELECT * FROM view_counter WHERE product_id='$id'");
        confirm($query);
        $result = get_row($query);
        if ($result <= 999){
            $visitors = $result;
        } elseif ($result > 1000 && $result <= 999999){
            $visitors = floor($result/1000)."k";
        } elseif ($result > 1000000 && $result <= 999999999){
            $visitors = floor($result/1000000)."M";
        } else{
            $visitors = floor($result/1000000000)."B";
        }
        $user_ID = $_SESSION["ID"];
        $product_id = $row['ID'];
        $query = query("SELECT user_name FROM wishlist WHERE product_ID='$product_id' AND user_id='$user_ID'");
	    confirm($query);
	    $result = get_row ($query);
	    if ($result > 0) {
	    	$icon = "fas fa-heart";
	    } else{
	    	$icon = "far fa-heart";
	    }
	   	/*******************************************Shopping Cart Icon*****************************************************************************/
		$cart = query("SELECT user_name FROM cart WHERE product_ID='$product_id' AND user_id='$user_ID'");
	    confirm($cart);
	    $res = get_row($cart);
	    if ($res > 0) {
	    	$cart_icon = "hide";
	    } else{
	    	$cart_icon = "";
	    }
	    /*************************************************XXX*******Shopping cart icon**************XX******************************************************************/
		$collection_products = <<<DELIMETER
			<div class="col-md-2 col-6">
			<a href="single_product.php?id={$row['ID']}&c_id={$row['category_ID']}"><img src="{$product_picture}" alt="{$row['Title']}" class="img-fluid"  title="{$row['Title']}"  style = "width:180px;height:180px;"></a>
				<div class="hotDeals-bottom-overlay">
						<h3 style="font-family:serif;padding:5px;" class="text-center">{$row['Title']}</h3>
						<sup>WAS</sup>
						<del>Ksh {$row['Last_Price']}</del>
						<h5>Ksh {$row['Price']}</h5>
					<i class="fa fa-eye "><span> {$visitors}</span></i>
					<a title="Add to wish list" onclick="add_to_wishlist($product_id)" ><i class="$icon" id="$product_id"></i> </a>
					<a onclick="add_to_cart_directly($product_id)"><i class="fa fa-shopping-cart $cart_icon"></i> </a><br>
					<a href="single_product.php?id={$row['ID']}&c_id={$row['category_ID']}"><button class="btn btn-primary btn-main">Buy Now</button></a>	
				</div>
			</div>
DELIMETER;
		echo $collection_products;
	}
	echo "<div  class='text-center' style='margin-top:40px;'><ul class='pagination'>{$outputPagination}</ul></div>";
	}
}


//////////////////////////////////////////////////////////////BACK FUNCTIONS/////////////////////////////////////////////////////////////
function display_suppliers()
{
	$query = query("SELECT * FROM suppliers");
	confirm($query);
	while ($row = fetch_array($query)) {
		$shop_location = $row['shop_location'];
		$name = $row["shop_name"];
		$region = $row['region'];
		$town = $row['town'];
		$supplyCategory = $row['supply_category'];
		$payment_method = $row['payment_method'];
		$phone_number = $row['mpesa_phone_no'];
		$account_number = $row['account_no'];
		$bank = $row['bank'];
		$suppliers = <<<DELIMETER
				<tr>
	                <td>{$name}</td>
	                <td>{$shop_location}</td>
	                <td>{$region}</td>
	                <td>{$town}</td>
	                <td>{$supplyCategory}</td>
	                <td>{$payment_method}</td>
	                <td>{$phone_number}</td>
	                <td>{$account_number}</td>
	                <td>{$bank}</td>
	                <td>{$shop_location}</td>
	                <td><a class="btn btn-danger" href="../../resources/templates/back/delete_supplier.php?id={$row['ID']}"><span class="glyphicon glyphicon-remove"></span></a></td>
				</tr>
DELIMETER;
		echo $suppliers;
	}
}


function display_orders()
{
	$query = query("SELECT * FROM orders");
	confirm($query);
	while ($row = fetch_array($query)) {
		$status = $row['order_status'];
		$id = $row["product_id"];
		$u_id = $row["user_id"];
		$order_status = "";
		if ($status == 1) {
			$order_status = "<p>Received</p>";
		} elseif ($status == 2) {
			$order_status = "<p>Processing</p>";
		}elseif ($status == 3) {
			$order_status = "<p>Shipping</p>";
		} else{
			$order_status = "<p>Delivered</p>";
		}
		$review = $row['product_review'];
		if ($review == 0 && $status == 4) {
			$product_review = "<p style = 'background:orange;color:white;text-align:center;width:80%; border-radius:2px;padding:3px; font-size:12px;font-weight:600;'>Not Reviewed</p>";
		} else if($review == 1 && $status == 4){
			$product_review = "<p style = 'background:green;color:white;text-align:center;width:80%; border-radius:2px;padding:3px; font-size:12px;font-weight:600;'>Reviewed</p>";
		} else{
			$product_review = "<p style = 'background:red;color:white;text-align:center;width:80%; border-radius:2px;padding:3px; font-size:12px;font-weight:600;'>Not Delivered</p>";
		}
		$orders = <<<DELIMETER
				<tr>
	                <td>{$row['user_name']}<br>
	                <small style="color:blue;">{$row['order_date']}</small>
	                </td>
	                <td><b>{$row['product_name']}</b><br>
	                	<img src="../../resources/uploads/{$row['product_photo']}" alt="{$row['product_name']}" style="width:50px; height:50px;"><br>
	                	<small style="color:green;">Order #: {$row['order_number']}</small><br>
	                </td>
	                <td style="color:red;font-weight:bold;">{$row['seller']}</td>
	                <td>{$row['email']}</td>
	                <td>{$row['phone']}</td>
	                <td>{$row['delivery_address']}</td>
	                <td>{$row['amount_to_pay']}</td>
	                <td>
	                	<div class="form-group">
	                		<label for="Sellect">Select Status:</label>
	                		<select onchange="update_order_status($id,$u_id)" class="form-control" id="$id">
	                			<option value="">{$order_status}</option>
	                			<option value="1">Received</option>
	                			<option value="2">Processing</option>
	                			<option value="3">Shipping</option>
	                			<option value="4">Delivered</option>
	                		</select>
	                	</div>
	                </td>
	                <td>{$product_review}</td>
	                <td><a class="btn btn-danger" href="../../resources/templates/back/delete_order.php?id={$row['ID']}"><span class="glyphicon glyphicon-remove"></span></a></td>
				</tr>
DELIMETER;
		echo $orders;
	}
}

/***********************************************ADMIN PRODUCTS***************************************************************/
function display_photo($photo)
{
	global $upload_directory;
	return $upload_directory.DS.$photo;
}

function get_products_to_admin(){

	$query = query("SELECT * FROM products");
	confirm($query);
	while ($row = fetch_array($query)) {
		$category_title = show_category_title_to_admin_products_page($row['category_ID']);
		$product_picture = display_photo($row['product_image']);
		$brand_title = show_brand_title_to_admin_products_page($row['brand_ID']);
		$collection_title = show_collection_title_to_admin_products_page($row['collection_ID']);
		// i'll use heredoc to display the whole string
		$product = <<<DELIMETER
		<tr>
		<td>{$row['ID']}</td>
                    <td><b>{$row['Title']}</b><br>
                         <a href="../../public/admin/index.php?edit_product&id={$row['ID']}" title="Edit Product"><img src="../{$product_picture}" style="width:100px;height:62px;" alt=""></a>
                    </td>
                    <td>{$category_title}</td>
                    <td>{$brand_title}</td>
                    <td>{$collection_title}</td>
                    <td>{$row['Product_quantity']}</td>
                     <td>{$row['quant_sold']}</td>
                    <td>{$row['Price']}</td>
                    <td><a class="btn btn-danger" href="../../resources/templates/back/delete_product.php?id={$row['ID']}"><span class="glyphicon glyphicon-remove"></span></a></td>
         </tr>
DELIMETER;
		echo $product;
	}
}

/*******************************************ADD PRODUCTS****************************************************************************************/

function add_product(){
	if (isset($_POST['publish'])) {
	$title = escape_string($_POST['product_title']);
	$category = escape_string($_POST['product_category']);
	$brand = escape_string($_POST['product_brand']);
	$collection = escape_string($_POST['product_collection']);
	$price = escape_string($_POST['product_price']);
	$last_price = escape_string($_POST['last_product_price']);
	$description = escape_string($_POST['product_description']);
	$product_color = escape_string($_POST['product_color']);
	$product_condition = escape_string($_POST['product_condition']);
	$product_quantity = escape_string($_POST['product_quantity']);
	$product_size = escape_string($_POST['product_size']);
	$seller = escape_string($_POST['seller']);
	if (empty($title) && empty($category) && empty($brand) && empty($collection) && empty($price) && empty($last_price) && empty($description) && empty($product_color) && empty($product_condition) && empty($product_quantity) && empty($product_size) && empty($seller)){
		echo("<div class='alert alert-danger text-center'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Please Enter All The Data First!</div>");
	} else{
		$main_photo = upload_image('main_photo');
		$sub_photo_1 = upload_image('sub_photo_1');
		$sub_photo_2 = upload_image('sub_photo_2');
		$sub_photo_3 = upload_image('sub_photo_3');
		$query = query("INSERT INTO products(Title,category_ID,brand_ID,collection_ID,Price,Last_Price,Description,Color,Product_condition,Product_quantity,Sizes,product_image,sub_image_1,sub_image_2,sub_image_3,seller) VALUES('{$title}','{$category}','{$brand}','{$collection}','{$price}','{$last_price}','{$description}','{$product_color}','{$product_condition}','{$product_quantity}','{$product_size}','{$main_photo}','{$sub_photo_1}','{$sub_photo_2}','{$sub_photo_3}','{$seller}')");
	$last_id = last_id();
	confirm($query);
	set_message("<h4 class='alert alert-success'>New Product with ID {$last_id} was posted successfully!</h4>");
	redirect("index.php?products");
		}
	}
}

function show_category_on_add_product_page(){
	$query = query("SELECT * FROM category");
	confirm($query);
	while ($row = fetch_array($query)){
		$category_option = <<<DELIMETER
		 <option value="{$row['ID']}">{$row['Category_title']}</option>
DELIMETER;
		echo $category_option;
	}
}

function show_brand_on_add_product_page(){
	$query = query("SELECT * FROM brands");
	confirm($query);
	while ($row = fetch_array($query)){
		$brand_option = <<<DELIMETER
		 <option value="{$row['ID']}">{$row['brand']}</option>
DELIMETER;
		echo $brand_option;
	}
}

function show_collection_on_add_product_page(){
	$query = query("SELECT * FROM collection");
	confirm($query);
	while ($row = fetch_array($query)){
		$collection_option = <<<DELIMETER
		 <option value="{$row['ID']}">{$row['collection_title']}</option>
DELIMETER;
		echo $collection_option;
	}
}


///////////////////////////////////////////////////SHOW TITLES FOR CATEGORY,BRAND AND COLLECTION//////////////////////////////////////////////////////////////////
function show_category_title_to_admin_products_page($id){
	$query = query("SELECT * FROM category WHERE ID=".$id);
	confirm($query);
	while ($category_row = fetch_array($query)) {
		return $category_row['Category_title'];
	}
}

function show_brand_title_to_admin_products_page($id){
	$query = query("SELECT * FROM brands WHERE ID=".$id);
	confirm($query);
	while ($brand_row = fetch_array($query)) {
		return $brand_row['brand'];
	}
}

function show_collection_title_to_admin_products_page($id){
	$query = query("SELECT * FROM collection WHERE ID=".$id);
	confirm($query);
	while ($collection_row = fetch_array($query)) {
		return $collection_row['collection_title'];
	}
}


################################################### CODE FOR UPDATING A PRODUCT ###########################################################

function update_product(){
	if (isset($_POST['update'])) {
	$title = escape_string($_POST['product_title']);
	$category = escape_string($_POST['product_category']);
	$brand = escape_string($_POST['product_brand']);
	$collection = escape_string($_POST['product_collection']);
	$price = escape_string($_POST['product_price']);
	$last_price = escape_string($_POST['last_product_price']);
	$description = escape_string($_POST['product_description']);
	$product_color = escape_string($_POST['product_color']);
	$product_condition = escape_string($_POST['product_condition']);
	$seller = escape_string($_POST['seller']);
	$product_quantity = escape_string($_POST['product_quantity']);
	$product_size = escape_string($_POST['product_size']);
	$product_image = upload_image($_POST['name']);
	$product_ID = escape_string($_GET['id']);

		if (empty($product_image)) {
			$picture = query("SELECT product_image FROM products WHERE ID =".escape_string($_GET['id'])." ");
			confirm($picture);
			while ($row = fetch_array($picture)) {
				$product_image = $row['product_image'];
			}
		}
	$query = "UPDATE products SET ";
	$query .= "Title   			 = '{$title}', ";
	$query .= "category_ID 	 	 = '{$category}', ";
	$query .= "brand_ID   		 = '{$brand}', ";
	$query .= "collection_ID   	 = '{$collection}', ";
	$query .= "Price   			 = '{$price}', ";
	$query .= "Last_Price   	 = '{$last_price}', ";
	$query .= "Description   	 = '{$description}', ";
	$query .= "Color   			 = '{$product_color}', ";
	$query .= "Product_condition = '{$product_condition}', ";
	$query .= "Product_quantity  = '{$product_quantity}', ";
	$query .= "Sizes   			 = '{$product_size}', ";
	$query .= "product_image   	 = '{$product_image}', ";
	$query .= "seller   	 	 = '{$seller}' ";
	$query .= "WHERE ID=". escape_string($_GET['id']);
	$send_query = query($query);
	confirm($send_query);
	$check_newarrivals = query("SELECT * FROM newarrivals WHERE Product_ID='$product_ID'");
	confirm($check_newarrivals);
	$check_features = query("SELECT * FROM features WHERE Product_ID='$product_ID'");
	confirm($check_features);
	$check_trending = query("SELECT * FROM trending_products WHERE product_ID='$product_ID'");
	confirm($check_trending);
	$check_partner_products = query("SELECT * FROM partnered_products WHERE product_ID='$product_ID'");
	confirm($check_partner_products);
	if (get_row($check_newarrivals) > 0) {
		$update_newarrivals = query("UPDATE newarrivals SET product_quantity = '$product_quantity' WHERE Product_ID='$product_ID'");
		confirm($update_newarrivals);
	} else if (get_row($check_features) > 0){
		$update_features = query("UPDATE features SET product_quantity = '$product_quantity' WHERE product_ID='$product_ID'");
		confirm($update_features);
		} elseif (get_row($check_trending) > 0) {
			$update_trending = query("UPDATE trending_products SET product_quantity = '$product_quantity' WHERE product_ID='$product_ID'");
			confirm($update_trending);
		} elseif (get_row($check_partner_products) > 0) {
			$update_partnered_products = query("UPDATE partnered_products SET product_quantity = '$product_quantity' WHERE product_ID='$product_ID'");
			confirm($update_partnered_products);
		}
	set_message("<h4 class='alert alert-success'>Product updated successfully!</h4>");

	if (escape_string($_POST['newarrivals']) == true) {
		//Check if the product already exist in newarrivals table
		$check = query("SELECT * FROM newarrivals WHERE Product_ID='$product_ID'");
		confirm($check);
		if (get_row($check) > 0) {
			set_message("<h4 class='alert alert-info'><strong>Product is already in New Arrivals Table!</strong></h4>");
		} else {
		$query = query("INSERT INTO newarrivals(Product_ID,Title,category_ID,brand_ID,collection_ID,Price,Last_Price,Description,Color,product_condition,product_quantity,Sizes,product_image) VALUES('{$product_ID}','{$title}','{$category}','{$brand}','{$collection}','{$price}','{$last_price}','{$description}','{$product_color}','{$product_condition}','{$product_quantity}','{$product_size}','{$product_image}')");
		confirm($query);
	}
	}
	if (escape_string($_POST['features']) == true) {
		//Check if the product already exist in features table
		$check = query("SELECT * FROM features WHERE product_ID='$product_ID'");
		confirm($check);
		if (get_row($check) > 0) {
			set_message("<h4 class='alert alert-info'><strong>Product is already in Features Table!</strong></h4>");
		} else {
		$query = query("INSERT INTO features(product_ID,Title,category_ID,brand_ID,collection_ID,Price,Last_Price,Description,Color,product_condition,product_quantity,Sizes,product_image) VALUES('{$product_ID}','{$title}','{$category}','{$brand}','{$collection}','{$price}','{$last_price}','{$description}','{$product_color}','{$product_condition}','{$product_quantity}','{$product_size}','{$product_image}')");
		confirm($query);
	}
	}
	if (escape_string($_POST['trending']) == true) {
		//Check if the product already exist in trending table
		$check = query("SELECT * FROM trending_products WHERE product_ID='$product_ID'");
		confirm($check);
		if (get_row($check) > 0) {
			set_message("<h4 class='alert alert-info'><strong>Product is already in Trendind Table!</strong></h4>");
		} else {
		$query = query("INSERT INTO trending_products(product_ID,Title,category_ID,brand_ID,collection_ID,Price,Last_Price,Description,Color,product_condition,product_quantity,Sizes,product_image) VALUES('{$product_ID}','{$title}','{$category}','{$brand}','{$collection}','{$price}','{$last_price}','{$description}','{$product_color}','{$product_condition}','{$product_quantity}','{$product_size}','{$product_image}')");
		confirm($query);
	}
	}
	if (escape_string($_POST['partners']) == true) {
		//Check if the product already exist in partners table
		$check = query("SELECT * FROM partnered_products WHERE product_ID='$product_ID'");
		confirm($check);
		if (get_row($check) > 0) {
			set_message("<h4 class='alert alert-info'><strong>Product is already in Partners Table!</strong></h4>");
		} else {
		$query = query("INSERT INTO partnered_products(product_ID,Title,category_ID,brand_ID,collection_ID,Price,Last_Price,Description,Color,product_condition,product_quantity,Sizes,product_image) VALUES('{$product_ID}','{$title}','{$category}','{$brand}','{$collection}','{$price}','{$last_price}','{$description}','{$product_color}','{$product_condition}','{$product_quantity}','{$product_size}','{$product_image}')");
		confirm($query);
	}
	}
	if (escape_string($_POST['hotdeal']) == true) {
		//Check if the product already exist in partners table
		$check = query("SELECT * FROM hotdeals WHERE product_ID='$product_ID'");
		confirm($check);
		if (get_row($check) > 0) {
			set_message("<h4 class='alert alert-info'><strong>It seems product alredy exists in hot deals table!</strong></h4>");
		} else {
		$query = query("INSERT INTO hotdeals(product_ID,product_name,product_price,last_price,product_image) VALUES('{$product_ID}','{$title}','{$price}','{$last_price}','{$product_image}')");
		confirm($query);
	}
	}
	//Redirect to admin dashboard after update_product function finishes running
	redirect("index.php?products");
	}
}
////////////////////////////////////////////////CATEGORIES IN ADMIN/////////////////////////////////////////////////
function show_categories_in_admin(){
	$query = query("SELECT * FROM category");
	confirm($query);
	while ($row = fetch_array($query)) {
		$category =<<<DELIMETER
			<tr>
				<td>{$row['ID']}</td>
				<td>{$row['Category_title']}</td>
				<td><a href="../../resources/templates/back/delete_category.php?delete={$row['ID']}"><span class="btn btn-warning">DELETE</span></a></td>
			</tr>
DELIMETER;
		echo $category;
	}
}

function add_category(){
	if (isset($_POST['add_category'])){
		$new_category = escape_string($_POST['new_category']);
		if (empty($new_category) || $new_category == " ") {
			set_message("<h4 class='alert alert-warning'><strong>Put Category!</strong></h4>");
		} else {
		$check = query("SELECT * FROM category WHERE Category_title='$new_category'");
		confirm($check);
		if (get_row($check) > 0) {
			set_message("<h4 class='alert alert-info'><strong>Category '{$new_category}' Exists! Please check to confirm.</strong></h4>");
		} else {
		$query = query("INSERT INTO category(Category_title) VALUES('{$new_category}')");
		confirm($query);
		set_message("<h4 class='alert alert-success'>Category added!</h4>");
	}
	}
	}
}

//////////////////////////////////////////////////////BRANDS IN ADMIN/////////////////////////////////////////////////////////////
function show_brands_in_admin(){
	$query = query("SELECT * FROM brands");
	confirm($query);
	while ($row = fetch_array($query)) {
		$brand =<<<DELIMETER
			<tr>
				<td>{$row['ID']}</td>
				<td>{$row['brand']}<br>
					<img src="../../resources/uploads/brand_logos/{$row['icon']}">
				</td>
				<td><a href="../../resources/templates/back/delete_brand.php?delete={$row['ID']}"><span class="btn btn-warning">DELETE</span></a></td>
			</tr>
DELIMETER;
		echo $brand;
	}
}

function add_brand(){
	if (isset($_POST['add_brand'])){
		$new_brand = escape_string($_POST['new_brand']);
		if (empty($new_brand) || $new_brand == " ") {
			set_message("<h4 class='alert alert-warning'><strong>Put Brand!</strong></h4>");
		} else {
		$logo = upload_logo('brand_icon');
		$check = query("SELECT * FROM brands WHERE brand='$new_brand'");
		confirm($check);
		if (get_row($check) > 0) {
			set_message("<h4 class='alert alert-info'><strong>Brand '{$new_brand}' Exists! Please check to confirm.</strong></h4>");
		} else {
		$query = query("INSERT INTO brands(brand,icon) VALUES('{$new_brand}','{$logo}')");
		confirm($query);
		set_message("<h4 class='alert alert-success'>Brand added!</h4>");
	}
	}
	}
}

//////////////////////////////////////////////////////COLLECTION IN ADMIN/////////////////////////////////////////////////////////////
function show_collection_in_admin(){
	$query = query("SELECT * FROM collection");
	confirm($query);
	while ($row = fetch_array($query)) {
		$collection =<<<DELIMETER
			<tr>
				<td>{$row['ID']}</td>
				<td>{$row['collection_title']}</td>
				<td><a href="../../resources/templates/back/delete_collection.php?delete={$row['ID']}"><span class="btn btn-warning">DELETE</span></a></td>
			</tr>
DELIMETER;
		echo $collection;
	}
}

function add_collection(){
	if (isset($_POST['add_collection'])){
		$new_collection = escape_string($_POST['new_collection']);
		if (empty($new_collection) || $new_collection == " ") {
			set_message("<h4 class='alert alert-warning'><strong>Please Enter collection</strong></h4>");
		} else {
		$check = query("SELECT * FROM collection WHERE collection_title='$new_collection'");
		confirm($check);
		if (get_row($check) > 0) {
			set_message("<h4 class='alert alert-info'><strong>Collection '{$new_collection}' Exists! Please check to confirm.</strong></h4>");
		} else {
		$query = query("INSERT INTO collection(collection_title) VALUES('{$new_collection}')");
		confirm($query);
		set_message("<h4 class='alert alert-success'>'{$new_collection}' added in Collections successfully!</h4>");
	}
	}
	}
}

/***************************************************DISPLAY USERS IN ADMIN**************************************************************************************/


function get_users_to_admin(){
	$query = query("SELECT * FROM newregisteredusers");
	confirm($query);
	while ($row = fetch_array($query)) {
		$id = escape_string($row['ID']);
		$username = escape_string($row['Username']);
		$email = escape_string($row['Email']);
		$gender = escape_string($row['Gender']);
		$country= escape_string($row['County']);

		if (escape_string($row['user_photo']) === "") {
			$user_photo = "placeholder.jpg";
		} else{
			$user_photo = escape_string($row['user_photo']);
		}
		// i'll use heredoc to display the whole string
		$user = <<<DELIMETER
				<tr>
				    <td>{$id}</td>
				    <td><img src="../../resources/uploads/profile_pictures/{$user_photo}" alt="" width="80" height = "70"></td>
				    <td><strong>{$username}</strong></td>
				    <td>{$gender}</td>
				    <td>{$email}</td>
				    <td>{$country}</td>
				    <td><a href="../../resources/templates/back/delete_user.php?delete={$row['ID']}" title="Delete"><span class="glyphicon glyphicon-remove"></span></a></td>
				</tr>
DELIMETER;
		echo $user;
	}
}


function addUser()
{
	if (isset($_POST['add_user'])) {
		$username = escape_string($_POST['username']);
		$email = escape_string($_POST['email']);
		$password = escape_string($_POST['password']);
		$gender = escape_string($_POST['gender']);
		$country = escape_string($_POST['country']);
		$active_status = escape_string($_POST['active_status']);
		$photo = upload_image();
		$p_hash = md5($password);

		$query = query("INSERT INTO `newregisteredusers`(`Email`, `Username`,`user_photo`, `Password`, `Gender`, `Country`, `Validation Code`, `Active`, `IPAddress`, `Last_Login`, `Notescheck`) VALUES ('{$email}','{$username}','{$photo}','$p_hash','$gender','$country','','{$active_status}','',now(),now())");
		confirm($query);
		set_message("<h4 class='alert alert-success'>{$username} Added successfully!</h4>");
		redirect("index.php?users");
	}
}

///////////////////////////////////////////////////////////GET REPORTS TO THE ADMIN FUNCTION/////////////////////////////////////////////////////////////////////////////////////
/***********************Reports of orders made*********************************/
function get_reports_to_admin(){
	$query = query("SELECT * FROM products WHERE quant_sold >= 1");
	confirm($query);
	while ($row = fetch_array($query)) {
		$product_title = escape_string($row['Title']);
		$product_price = escape_string($row['Price']);
		$Product_quantity = escape_string($row['Product_quantity']);
		$sold = escape_string($row['quant_sold']);
		$photo = escape_string($row['product_image']);
		$status = "";
		// i'll use heredoc to display the whole string
		if ($Product_quantity > 50) {
			$status = "<p style = 'background:green;color:white;text-align:center;width:40%; border-radius:2px;padding:3px; font-size:12px;font-weight:600;'>Stock OK</p>>Good</p>";
		} elseif ($Product_quantity > 16 && $Product_quantity <= 50) {
			$status = "<p style = 'background:blue;color:white;text-align:center;width:40%; border-radius:2px;padding:3px;font-size:12px; font-weight:600;'>Stock Quiet OK</p>";
		} elseif ($Product_quantity > 5 && $Product_quantity <= 15) {
			$status = "<p style = 'background:orange;color:white;text-align:center;width:50%; border-radius:2px;padding:3px; font-size:12px;font-weight:600;'>Needs Restocking</p>";
		}elseif ($Product_quantity >= 1 && $Product_quantity <= 5) {
			$status = "<p style = 'background:red;color:white;text-align:center;width:40%; border-radius:2px;padding:3px; font-size:12px; font-weight:600;'>Out of stock</p>";
		} elseif ($Product_quantity == 0) {
			$status = "<p style = 'background:red;color:black;text-align:center;width:40%; border-radius:2px;padding:3px; font-size:12px; font-weight:600;'>Out of stock</p>";
		}
		$report = <<<DELIMETER
			<tr>
			    <td>{$product_title}<br>
			    	<img src="../../resources/uploads/$photo" alt ="{$product_price}" style="width:50px;height:50px;">
			    </td>
			    <td>{$product_price}</td>
			    <td>{$sold}</td>
			    <td>{$Product_quantity}</td>
			    <td>{$status}</td>
			</tr>
DELIMETER;
		echo $report;
	}
}


///////////////////////////////////////FUNCTION TO GET TRENDING PRODUCTS TO ADMIN////////////////////////////////////////////
function get_trending_products_to_admin(){
	$query = query("SELECT * FROM trending_products");
	confirm($query);
	while ($row = fetch_array($query)) {
		$category_title = show_category_title_to_admin_products_page($row['category_ID']);
		$product_picture = display_photo($row['product_image']);
		$brand_title = show_brand_title_to_admin_products_page($row['brand_ID']);
		$collection_title = show_collection_title_to_admin_products_page($row['collection_ID']);
		// i'll use heredoc to display the whole string
		$product = <<<DELIMETER
		<tr>
		<td>{$row['trending_product_ID']}</td>
                    <td><b>{$row['Title']}</b><br>
                         <a href="../../public/admin/index.php?edit_product&id={$row['product_ID']}" title="Edit Product"><img src="../{$product_picture}" style="width:100px;height:62px;" alt=""></a>
                    </td>
                    <td>{$category_title}</td>
                    <td>{$brand_title}</td>
                    <td>{$collection_title}</td>
                    <td>{$row['product_quantity']}</td>
                    <td>{$row['Price']}</td>
                    <td><a class="btn btn-danger" href="../../resources/templates/back/delete_trending_product.php?id={$row['trending_product_ID']}"><span class="glyphicon glyphicon-remove"></span></a></td>
         </tr>
DELIMETER;
		echo $product;
	}
}

function add_trending_product()
{
	if (isset($_POST['add_trending_product'])) {
		redirect("index.php?products");
	}
}


///////////////////////////////////////FUNCTION TO GET New arrival PRODUCTS TO ADMIN////////////////////////////////////////////
function get_newarrival_products_to_admin(){
	$query = query("SELECT * FROM newarrivals");
	confirm($query);
	while ($row = fetch_array($query)) {
		$category_title = show_category_title_to_admin_products_page($row['category_ID']);
		$product_picture = display_photo($row['product_image']);
		$brand_title = show_brand_title_to_admin_products_page($row['brand_ID']);
		$collection_title = show_collection_title_to_admin_products_page($row['collection_ID']);
		// i'll use heredoc to display the whole string
		$product = <<<DELIMETER
		<tr>
		<td>{$row['newarrival_ID']}</td>
                    <td><b>{$row['Title']}</b><br>
                         <a href="../../public/admin/index.php?edit_product&id={$row['Product_ID']}" title="Edit Product"><img src="../{$product_picture}" style="width:100px;height:62px;" alt=""></a>
                    </td>
                    <td>{$category_title}</td>
                    <td>{$brand_title}</td>
                    <td>{$collection_title}</td>
                    <td>{$row['product_quantity']}</td>
                    <td>{$row['Price']}</td>
                    <td><a class="btn btn-danger" href="../../resources/templates/back/delete_newarrival.php?id={$row['newarrival_ID']}"><span class="glyphicon glyphicon-remove"></span></a></td>
         </tr>
DELIMETER;
		echo $product;
	}
}

function add_newarrival_product()
{
	if (isset($_POST['add_newarrival_product'])) {
		redirect("index.php?products");
	}
}

///////////////////////////////////////FUNCTION TO GET PARTNERED PRODUCTS TO ADMIN////////////////////////////////////////////
function get_partnered_products_to_admin(){
	$query = query("SELECT * FROM partnered_products");
	confirm($query);
	while ($row = fetch_array($query)) {
		$category_title = show_category_title_to_admin_products_page($row['category_ID']);
		$product_picture = display_photo($row['product_image']);
		$brand_title = show_brand_title_to_admin_products_page($row['brand_ID']);
		$collection_title = show_collection_title_to_admin_products_page($row['collection_ID']);
		// i'll use heredoc to display the whole string
		$product = <<<DELIMETER
		<tr>
		<td>{$row['partnered_product_ID']}</td>
                    <td><b>{$row['Title']}</b><br>
                         <a href="../../public/admin/index.php?edit_product&id={$row['product_ID']}" title="Edit Product"><img src="../{$product_picture}" style="width:100px;height:62px;" alt=""></a>
                    </td>
                    <td>{$category_title}</td>
                    <td>{$brand_title}</td>
                    <td>{$collection_title}</td>
                    <td>{$row['product_quantity']}</td>
                    <td>{$row['Price']}</td>
                    <td><a class="btn btn-danger" href="../../resources/templates/back/delete_partnered_product.php?id={$row['partnered_product_ID']}"><span class="glyphicon glyphicon-remove"></span></a></td>
         </tr>
DELIMETER;
		echo $product;
	}
}

function add_partnered_product()
{
	if (isset($_POST['add_partnered_product'])) {
		redirect("index.php?products");
	}
}


///////////////////////////////////////FUNCTION TO GET FEATURED PRODUCTS TO ADMIN////////////////////////////////////////////
function get_featured_products_to_admin(){
	$query = query("SELECT * FROM features");
	confirm($query);
	while ($row = fetch_array($query)) {
		$category_title = show_category_title_to_admin_products_page($row['category_ID']);
		$product_picture = display_photo($row['product_image']);
		$brand_title = show_brand_title_to_admin_products_page($row['brand_ID']);
		$collection_title = show_collection_title_to_admin_products_page($row['collection_ID']);
		// i'll use heredoc to display the whole string
		$product = <<<DELIMETER
		<tr>
		<td>{$row['feature_ID']}</td>
                    <td><b>{$row['Title']}</b><br>
                         <a href="../../public/admin/index.php?edit_product&id={$row['product_ID']}" title="Edit Product"><img src="../{$product_picture}" style="width:100px;height:62px;" alt=""></a>
                    </td>
                    <td>{$category_title}</td>
                    <td>{$brand_title}</td>
                    <td>{$collection_title}</td>
                    <td>{$row['product_quantity']}</td>
                    <td>{$row['Price']}</td>
                    <td><a class="btn btn-danger" href="../../resources/templates/back/delete_partnered_product.php?id={$row['feature_ID']}"><span class="glyphicon glyphicon-remove"></span></a></td>
         </tr>
DELIMETER;
		echo $product;
	}
}

function add_featured_product()
{
	if (isset($_POST['add_featured_product'])) {
		redirect("index.php?products");
	}
}

function get_bestselling_brands()
{
	$query = query("SELECT * FROM products WHERE Product_quantity>1 AND quant_sold>5 ORDER BY quant_sold DESC");
	confirm($query);
	while ($row = fetch_array($query)) {
		$product_name = $row['Title'];
		$brand_id = $row['brand_ID'];
		$product_image = $row['product_image'];
		$bestseller=<<<DELIMETER
		<div class="col-md-2 bestselling_product pt-md-5 pt-4">
			<img src="../resources/uploads/{$row['product_image']}" alt="{$product_name}" style="width:80%;height:84%;" class="img-responsive">
			<a href="brands.php?id={$brand_id}" style="text-decoration:none"><span class="border product-btn btn-span">{$product_name}</span></a>
		</div>
DELIMETER;
		echo $bestseller;
	}
}

function get_bestselling_to_admin()
{
	$query = query("SELECT * FROM products WHERE Product_quantity>1 AND quant_sold>5 ORDER BY quant_sold ASC LIMIT 6");
	confirm($query);
	while ($row = fetch_array($query)) {
		$product_name = $row['Title'];
		$brand_id = $row['brand_ID'];
		$product_image = $row['product_image'];
		$product_in_stock = $row['Product_quantity'];
		$sold = $row['quant_sold'];
		$bestseller=<<<DELIMETER
				<tr>
                    <td><b>{$product_name}</b><br>
                         <img src="../../resources/uploads/{$product_image}" style="width:100px;height:62px;" alt="{$product_name}">
                    </td>
                    <td>{$product_in_stock}</td>
                    <td>{$sold}</td>
                    <td><a class="btn btn-danger" href="../../resources/templates/back/del_product.php?id={$row['ID']}"><span class="glyphicon glyphicon-remove"></span></a></td>
         		</tr>
DELIMETER;
		echo $bestseller;
	}
}

 function get_slides()
 {
 	$query = query("SELECT * FROM slides");
 	confirm($query);
 	while ($row = fetch_array($query)) {
 		$slide = display_photo($row['slide_image']);
 		$slides=<<<DELIMETER
		<div class="carousel-item" data-bs-interval="3000">
		 <img src="{$slide}" class="d-block w-100" alt="{$row['slide_title']}">
		</div>

DELIMETER;
 		echo $slides;
 	}
 }

function get_active_slide()
 {
 	$query = query("SELECT * FROM slides ORDER BY slide_ID LIMIT 1");
 	confirm($query);
 	while ($row = fetch_array($query)) {
 		$slide = display_photo($row['slide_image']);
 		$slides=<<<DELIMETER
		<div class="carousel-item active" data-bs-interval="4000">
		  <img src="{$slide}" class="d-block w-100" alt="{$row['slide_title']}">
		</div>
DELIMETER;
 		echo $slides;
 	}
 }

 //FUNCTION TO ADD BANNER
 function add_banner(){
 	if (isset($_POST['add_banner'])) {
 		$banner_title = escape_string($_POST['banner_title']);
 		if (empty($banner_title)) {
 			set_message("<h4 class='alert alert-warning'>Select Banner!</h4>");
 		} else {
 			$banner_image = upload_image('banner');
 			$query = query("INSERT INTO slides(slide_title, slide_image) VALUES ('{$banner_title}','{$banner_image}')");
 			confirm($query);
 			redirect("index.php?slides");
 			set_message("<h4 class='alert alert-success'>Banner Added!</h4>");
 		}
 	}
 }

 function get_banners_to_admin()
 {
 	$query = query("SELECT * FROM slides");
 	confirm($query);
 	while ($row = fetch_array($query)) {
 		$slides=<<<DELIMETER
		<div>
		  <img src="../../resources/uploads/{$row['slide_image']}" class="d-block w-100" alt="{$row['slide_title']}">
		</div>
DELIMETER;
 		echo $slides;
 	}
 }

//FUNCTION TO GET CURRENT BANNER
 function get_current_banner_in_admin(){
 	$query = query("SELECT * FROM slides ORDER BY slide_ID DESC LIMIT 1");
 	confirm($query);
 	 	while ($row = fetch_array($query)) {
 	 	$current_slide = display_photo($row['slide_image']);
 		$current_slide=<<<DELIMETER
		  <img src="../{$current_slide}" class="img-responsive" alt="{$row['slide_title']}">
DELIMETER;
 		echo $current_slide;
 	}
 }

 //FUNCTION TO GET THUMBNAILS
 function get_banner_thumbnails_to_admin(){
 	$query = query("SELECT * FROM slides");
 	confirm($query);
 	 	while ($row = fetch_array($query)) {
 	 	$slides = display_photo($row['slide_image']);
 		$banners =<<<DELIMETER
    <div class="col-xs-6 col-md-3 image_container">
	    <a href="../../resources/templates/back/delete_slide.php?delete_slide={$row['slide_ID']}">
		    <img class="img-responsive" src="../{$slides}" alt="{$row['slide_title']}" title="Delete">
		</a>

		<div class="caption">
			<p>{$row['slide_title']}</p>
		</div>
	</div>
DELIMETER;
 		echo $banners;
 	}
 }


if(isset($_POST["slider_update"])) {
	$query2 = query("SELECT * FROM products WHERE quant_sold>5");
	confirm($query2);
	while ($row2 = fetch_array($query2)) {
		$product_id = $row2['ID'];
		$brand_id = $row2['brand_ID'];
		$product_image = $row2['product_image'];
		$sold = $row2['quant_sold'];
		$query3 = query("SELECT * FROM brands WHERE ID='$brand_id'");
		while ($row3 = fetch_array($query3)) {
			$brand = $row3['brand'];
		}
		$query4 = query("INSERT INTO bestsellingbrands(product_ID,brand_ID,brand,product_image,sold) VALUES('{$product_id}','{$brand_id}','{$brand}','{$product_image}','{$sold}')");
		confirm($query4);
	}
}



///////////////////////////////////////////////////////////////CREATE ACCOUNT////////////////////////////////////////////////////////////////////////////////////////////////////////
//Email checking
if (isset($_POST['email'])) {
    //$conn = mysqli_connect("localhost","swifftsh_ronald","MatekwaRonald37016568","swifftsh_swifftshop");
    $conn = mysqli_connect("localhost","root","","swiftshop");
    $email = $_POST['email'];
    $sql = "SELECT ID FROM newregisteredusers WHERE email = '$email'";
    $query = mysqli_query($conn,$sql);
    $emailCheck = get_row($query);
    if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        echo 'wrong_format';
        exit();
    } else if ($emailCheck>0) {
        echo 'exist';
        exit();
    }
}

//////////////////Username Checking///////////////////////////////////////////////////////////////////////////
if (isset($_POST["username_to_register"])){
   //$conn = mysqli_connect("localhost","swifftsh_ronald","MatekwaRonald37016568","swifftsh_swifftshop");
	$conn = mysqli_connect("localhost","root","","swiftshop");
    $username = $_POST['username_to_register'];
    $sql = "SELECT ID FROM newregisteredusers WHERE Username = '$username'";
    $query = mysqli_query($conn,$sql);
    $result = get_row($query);
	if (strlen($username) == 0) {
        echo 'Required!';
        exit();
    }
    if (strlen($username) < 3 || strlen($username) > 16) {
        echo '3-16 characters required!';
        exit();
    }
    if (!preg_match("/^[a-zA-Z0-9._]*$/", $username)) {
        echo 'You can only use letters,numbers and special characters like . and _ for Username!';
        exit();
    }
    if (is_numeric($username[0])) {
        echo 'Username must begin with a letter!';
        exit();
    }
    if ($result == 0) {
        echo "ok";
		exit();
    } else {
        echo 'Username in use by other account!';
        exit();
    }

}


if (isset($_POST["passwordVerify"])) {
    $passcode = $_POST['passwordVerify'];
    if (strlen($passcode) <= 3) {
        echo 'Poor';
        exit();
    } if (strlen($passcode) <= 6) {
        echo 'Good';
		exit();
    } else {
        echo 'ok';
		exit();
    }
}


/////////////////////////////////////////Reseting user details///////////////////////////////////////////////////
if (isset($_POST["edited_password"]) || isset($_POST['edited_gender']) || isset( $_POST['edited_county']) || isset($_POST['phone_number'])) {
    $gender = $_POST['edited_gender'];
    $county = $_POST['edited_county'];
    $phone_number = $_POST['phone_number'];
    $ip = preg_replace('#[^0-9.]#i', '', getenv('REMOTE_ADDR'));
    $user_id = $_SESSION["ID"];
    ///get user password from the database
    	$query2 = query("UPDATE newregisteredusers SET Gender = '$gender',Country='$county',phone_number = '$phone_number',IPAddress = '$ip' WHERE ID ='$user_id' LIMIT 1");
    	confirm($query2);
    	echo "<div class='alert alert-success text-center'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Details Saved</strong> successfully!</div>";
    	exit();
}

if (isset($_POST["edited_password"]) || isset($_POST['new_password'])) {
	$old_password = md5($_POST['old_password']);
    $new_password = md5($_POST['edited_password']);
    $ip = preg_replace('#[^0-9.]#i', '', getenv('REMOTE_ADDR'));
    $user_id = $_SESSION["ID"];
    ///get user password from the database
    $query1 = query("SELECT * FROM newregisteredusers WHERE ID = '$user_id'");
    confirm($query1);
    while ($row = fetch_array($query1)) {
    	$db_pass = $row['Password'];
    }
    if ($db_pass != $old_password) {
    	echo "<div class='alert alert-danger text-center'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Your Old Password Is Incorrect!</div>";
    	exit();
    } else{
    	$query2 = query("UPDATE newregisteredusers SET Password = '$new_password',IPAddress = '$ip' WHERE ID ='$user_id' LIMIT 1");
    	confirm($query2);
    	echo "<div class='alert alert-success text-center'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Password Changed!</strong> successfully!</div>";
    	exit();
    }
}
//////////////////////////////XXXXXX///////////Reseting user details///////////////////XXXXXXX////////////////////////////////

if (isset($_POST['u'])){
    //Request data to be stored into local variables
    $email = $_POST['e'];
    $username = $_POST['u'];
    $password1 = $_POST['p1'];
    $password2 = $_POST['p2'];
    $gender = $_POST['g'];
    $county = $_POST['c'];
    $p_hash = md5($password2);
    $phone_number = $_POST['p_n'];
    $validation_code =  md5($username.microtime());
    $ip = preg_replace('#[^0-9.]#i', '', getenv('REMOTE_ADDR'));
    //DUPLICATE DATA CHECK
   //$conn = mysqli_connect("localhost","swifftsh_ronald","MatekwaRonald37016568","swifftsh_swifftshop");
   $conn = mysqli_connect("localhost","root","","swiftshop");
    $sql = "SELECT * FROM newregisteredusers WHERE Email = '$email'";
    $query = mysqli_query($conn,$sql);
    $emailCheck = get_row($query);
    $sql = "SELECT ID FROM newregisteredusers WHERE Username = '$username'";
    $query = mysqli_query($conn,$sql);
    $userNameCheck = get_row($query);
    if($password1 !== $password2){
    	echo '<div style ="color:#F00; font-weight: bold" class="alert alert-warning">Please re-check your passwords. The do not match!</div>';
        exit();
    } else if ($email == "" || $username == ""||$password1 == "" ||$county == ""|| $gender == "" || $phone_number == "" || $password2 == "") {
        echo '<div style ="color:#F00; font-weight: bold" class="alert alert-warning">Please Fill In All The Data Above First!</div>';
        exit();
    } else if ($userNameCheck>0) {
        echo '<div style ="color:#F00; font-weight: bold" class="alert alert-warning">The Username You Entered Is Taken!</div>';
        exit();
    } else if ($emailCheck>0) {
        echo '<div style ="color:#F00; font-weight: bold" class="alert alert-warning">The E-mail You Entered Is Already In Use By Another Account!</div>';
        exit();
    } else if (strlen($username)<3 || strlen($username)>16) {
        echo '<div style ="color:#F00; font-weight: bold" class="alert alert-warning">Username Should Have 3-16 Characters!</div>';
        exit();
    } else if (is_numeric($username[0])) {
        echo '<div style ="color:#F00; font-weight: bold" class="alert alert-warning">Username Should Begin With a Letter!</div>';
        exit();
    } else {
        $sql = "INSERT INTO newregisteredusers(`Email`, `Username`,`user_photo`, `Password`, `Gender`, `County`, `validation_code`, `Active`, `IPAddress`, `Last_Login`,`phone_number`) VALUES ('$email','$username','placeholder.JPG','$p_hash','$gender','$county','$validation_code','0','$ip',now(),'$phone_number')";
        $query = mysqli_query($conn,$sql);
        $uid = mysqli_insert_id($conn);
        /////////////////////////////////////MAILING SYSTEM WITH PHPMailer////////////////////////////////
        ob_start();
                //Instantiation and passing `true` enables exceptions
                    $mail = new PHPMailer(true);
                    $to = "$email";
                    $subject = "swifftshop Account Activation";
                    $message = '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>Account Activation</title></head><body style="margin:0px; font-family:Tahoma, Geneva, sans-serif;"><div style="padding:20px; background:#45ccb8; font-size:30px; color:yellow;"></a>Account Activation</div><div style="padding:24px; font-size:17px;">Hello '.$username.',<br/><br />Click the link below to activate your account when ready:<br /><br /><a href="www.swifftshop.com/activation.php?id='.$uid.'&u='.$username.'&e='.$email.'&p='.$p_hash.'&v='.$validation_code.'">Click here to activate your account now!</a><br /><br />Login after successful activation using your:<br />* E-mail Address:<br> <b>'.$email.'</b><br><br>Thank you for your support,we value you so much.<br>We are looking forward to bring you the best products in the market.<br>We are available 24/7,contact us anytime at your convenience.<br><br>Email: support@swifftshop.com | Or Call: 0745481760<br>Website: www.swifftshop.com<br><br><hr><br>Happy Shopping!<br>Swifftshop Team<br></div></body></html>';
                    try {
                                //Server settings
                                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                                $mail->isSMTP();                                            //Send using SMTP
                                $mail->Host       = 'fin104.truehost.cloud';                     //Set the SMTP server to send through
                                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                                $mail->Username   = 'support@swifftshop.com';                     //SMTP username
                                $mail->Password   = 'customer37016568';                               //SMTP password
                                $mail->SMTPSecure = 'tls';         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                                $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
                            
                                //Recipients
                                $mail->setFrom('support@swifftshop.com', 'swifftshop.com');
                                $mail->addAddress($to);               //Name is optional
                            
                            
                               
                                //Content
                                $mail->isHTML(true);                                  //Set email format to HTML
                                $mail->Subject = $subject;
                                $mail->Body    = $message;
                            
                                $mail->send();
                                ob_get_clean();
                            if ($uid > 0) {
                                echo "signup_success";
                                } else{
                                    echo '<div style ="color:#F00; font-weight: bold" class="alert alert-info">Oops! Something went wrong,please try again later!</div>';
                                    exit();
                                }
                            } catch (Exception $e) {
                                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                                 exit();
                            } 
        /////////////////////////////////////XXXX////////END OF MAILING SYSTEM///////////////////////////////XXXXX////////
    }
    echo "signup_success";
    exit();
}


/////////////////////////////////////////////////////////////////////LOGIN FUNCTIONS/////////////////////////////////////////////////////////////////////////////////////////////////////
if (isset($_POST["pass_to_log_in"])) {
	$conn = mysqli_connect("localhost","root","","swiftshop");
    //$conn = mysqli_connect("localhost","swifftsh_ronald","MatekwaRonald37016568","swifftsh_swifftshop");
    //GATHER POSTED DATA AND PUT THEM IN LOCAL VARIABLES then SANITIZED
    $email = $_POST["email_to_login"];
    $password = md5($_POST["pass_to_log_in"]);
    //GET USER IP ADDRESS
    $ip = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));
    //FORM DATA ERROR HANDLING
    if ($email == "" || $password == "") {
        echo "login_failed";
        exit();
    } else {
        $sql = "SELECT * FROM newregisteredusers WHERE Email = '$email' AND Active = '1' LIMIT 1";
        $query = mysqli_query($conn,$sql);
        $num_rows = mysqli_num_rows($query);
        if ($num_rows === 0) {
            echo "wrong_email";
            exit();
        } else {
        	while ($row = fetch_array($query)) {
        		$db_id = $row['ID'];
            	$db_username = $row['Username'];
            	$db_password = $row['Password'];
            	$db_email = $row['Email'];
        	}  
        }
        if($password != $db_password) {
            echo "password_mismatch";
            exit();
        } else {
            //CREATE THEIR SESSIONS AND COOKIES
            $_SESSION["ID"] = $db_id;
            $_SESSION["Username"] = $db_username;
            $_SESSION["Password"] = $db_password;
            $_SESSION["Email"] = $db_email;
            setcookie("ID",$db_id,strtotime('+30 days'),"/","","",TRUE);
            setcookie("Username",$db_username,strtotime('+30 days'),"/","","",TRUE);
            setcookie("Password",$db_password,strtotime('+30 days'),"/","","",TRUE);
            setcookie("Email",$db_email,strtotime('+30 days'),"/","","",TRUE);
            //UPDATE THEIR IP AND LAST LOG IN FIELDS
            $sql = "UPDATE newregisteredusers SET IPAddress = '$ip',Last_Login = now() WHERE Username = '$db_username' LIMIT 1 ";
            $query = mysqli_query($conn,$sql);
            echo $db_username;
            exit();
        }
    }
}


if (isset($_POST['s'])){
    $searched_data = escape_string ($_POST['s']);
    $output = '';
    $query = query ("SELECT * FROM products WHERE Title LIKE '%".$_POST["s"]."%'");
    confirm ($query);
    $result = get_row ($query);
    if ($result > 0){
        $output .= '<div class="table-responsive">
                    <table class="table table-bordered">
                    <tr>
                    <th>Item name:</th>
                    </tr>';
        while ($row = fetch_array ($query)){
            $query2 = query ("SELECT * FROM category WHERE ID=".escape_string ($row['category_ID'])."");
            confirm ($query2);
            while($row2 = fetch_array ($query2)){
                $category = $row2['Category_title'];
            }
            $output .= '<tr>
                             <td><a href="category.php?id='.$row['category_ID'].'"><span>'.$row["Title"].'</span></a> in <span style="color: green;font-weight: bold">'.$category.'</span></td>
                        </tr>';
        }
        echo $output;

    } else{
        echo "<div style='color:green'>Item not found</div>";
    }
}

if(isset($_POST['add_to_cart'])) {
    $product_id = $_POST['add_to_cart'];
    $product_size = $_POST['product_size'];
    $user = $_SESSION['Username'];
    $user_id = $_SESSION['ID'];
    $query = query ("SELECT * FROM products WHERE ID='$product_id' LIMIT 1");
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
                confirm ($query2);
                echo "Added!";
                
            } else {
            	$query3 = query("UPDATE cart SET product_size='$product_size' WHERE product_ID='$product_id' AND user_ID='$user_id'");
            	confirm($query3);
                echo "Cart Updated!";
            }
    }
}



####################################Add to wish list functions#################################
if (isset($_POST['wish'])){
    $product_id = $_POST['wish'];
    $user = $_SESSION['Username'];
    $user_id = $_SESSION["ID"];
    $query = query("SELECT * FROM products WHERE ID='$product_id'");
    confirm($query);
    while ($row = fetch_array($query)) {
        $product_name = $row['Title'];
    }
    $query = query("SELECT * FROM wishlist WHERE product_ID='$product_id' AND user_id='$user_id'");
    confirm($query);
    $result = get_row ($query);
    if ($result == 0) {
        $query = query ("INSERT INTO wishlist(product_ID,user_id,product_name,user_name) VALUES('{$product_id}','{$user_id}','{$product_name}','{$user}')");
        confirm ($query);
        echo "<div class='alert alert-success text-center'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Successfully</strong> added to Wishlist.</div>";
    }
}

####################################Remove from wish list functions#################################
if (isset($_POST['remove_from_wishlist'])){
    $product_id = $_POST['remove_from_wishlist'];
    $user = $_SESSION['Username'];
    $user_id = $_SESSION["ID"];
    $query = query("DELETE FROM wishlist WHERE product_ID='$product_id' AND user_id='$user_id' LIMIT 1");
    confirm($query);
    echo "<div class='alert alert-danger text-center'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Successfully</strong> removed from Wishlist.</div>";
}



/////////////////////////Recover password/////////////////////////////////////////////////////////////////////////////
	if (isset($_POST['token'])) {
		if (isset($_SESSION['token']) && $_POST['token'] == $_SESSION['token']) {
			$email = escape_string($_POST['email_to_be_recovered']);
			if (empty($email)) {
				 echo "Enter Email!";
				 exit();
			} else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
				echo "Wrong E-mail Format!";
				exit();
			} else{
			$query = query("SELECT ID FROM newregisteredusers WHERE Email = '$email'");
			confirm($query);
			$num_row = get_row($query);
			if ($num_row === 0) {
				 echo "No Account Exists With This E-mail";
			} else{
				$code = order_number_generator(6);
				setcookie('temp_code',$code,time()+300,"/");
				$query = query("UPDATE newregisteredusers SET validation_code = '$code' WHERE Email = '$email'");
				confirm($query);
			////////////////////////////Mailing System/////////////////////////////////////////
				 ob_start();
              	    $mail = new PHPMailer(true);
                    $to = "$email";
                    $subject = "Password Re-set";
                    $message = '<!DOCTYPE html><html lang="eng"><head><meta charset="UTF-8"><title>Password Recovery</title></head><body style="margin:0px; font-family:Tahoma, Geneva, sans-serif;"><div style="padding:10px; background:#45ccb8; font-size:24px; color:yellow;">Account Recovery</div><div style="padding:24px; font-size:17px;">Hello,<br>Click the link below to reset your password<br><br><a href="www.swifftshop.com/code.php?Email=$email&code=$code">Reset Password</a><br><br>And use the code <b>".$code."</b> <br /></div></body></html>';
                    try {
                                //Server settings
                                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                                $mail->isSMTP();                                            //Send using SMTP
                                $mail->Host       = 'fin104.truehost.cloud';                     //Set the SMTP server to send through
                                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                                $mail->Username   = 'support@swifftshop.com';                     //SMTP username
                                $mail->Password   = 'customer37016568';                               //SMTP password
                                $mail->SMTPSecure = 'tls';         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                                $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
                            
                                //Recipients
                                $mail->setFrom('support@swifftshop.com', 'swifftshop.com');
                                $mail->addAddress($to);               //Name is optional
                            
                            
                               
                                //Content
                                $mail->isHTML(true);                                  //Set email format to HTML
                                $mail->Subject = $subject;
                                $mail->Body    = $message;
                            
                                $mail->send();
                                ob_get_clean();
                            } catch (Exception $e) {
                                echo "We couldn't send an E-mail at the moment,Try again later.";
                                 exit();
                            } 
           		///////////////////////XXX/////Mailing System///////////////XX//////////////////////////
               echo "<span style='color:green;'>We sent a link to your E-mail, Kindly Check...<span>";
			}
			   }
		} else{
			echo "Something happened,Try again later.";
		}
	}


/////////////////////////////////Code validation function////////////////////////////////////////////////////////////////
function code_validation(){
	if (isset($_COOKIE['temp_code'])) {
		if (!isset($_GET['Email']) && !isset($_GET['code'])) {
			 redirect("recover.php");
		} elseif (empty($_GET['Email']) && empty($_GET['code'])) {
			set_message("<div class='alert alert-danger text-center'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>No parameters received.</div>");
			redirect("recover.php");
		} else{
			if (isset($_POST['recovery-code'])) {
				$code = $_POST['recovery-code'];
				$email = $_GET['Email'];
				$query = query("SELECT * FROM newregisteredusers WHERE validation_code = '$code' AND Email = '$email'");
				confirm($query);
				$row = get_row($query);
				if ($row > 0) {
					setcookie('temp_code',$code,time()+300,"/");
					redirect("reset.php?Email=$email&v_code=$code");
				} else{
					set_message("<div class='alert alert-danger text-center'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Wrong Code!</div>");
				}
			}
		}
	} else{
		set_message("<div class='alert alert-danger text-center'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Sorry,Your code has expired.</div>");
		redirect("recover.php");
	}
}

///////////////////////////////////////////////////Reset password function//////////////////////////////////////////////////////
function reset_password(){
	if (isset($_COOKIE['temp_code'])) {
		if (isset($_GET['Email']) && isset($_GET['v_code'])) {
			 if (isset($_SESSION['token']) && isset($_POST['token2'])) {
			 		if ($_SESSION['token'] == $_POST['token2']) {
			 			if ($_POST['newPassword1'] === $_POST['newPassword2']) {
			 				$new_password = md5($_POST['newPassword2']);
			 				$email = $_GET['Email'];
			 				$query = query("UPDATE newregisteredusers SET Password = '$new_password',validation_code = '0' WHERE Email = '$email'");
			 				confirm($query);
			 				if ($query) {
			 					redirect("login.php?message=success");
			 				} else{
			 					set_message("<div class='alert alert-warning text-center'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;<s/a>Something went wrong :(</div>");
			 				}
			 			} else{
			 				set_message("<div class='alert alert-warning text-center'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Passwords Do Not Match.</div>");
			 			}
			 		} else{
			 			set_message("<div class='alert alert-danger text-center'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>No token received.</div>");
			 		}
			 }
		} else{
			set_message("<div class='alert alert-danger text-center'><a href=''#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>No parameters received.</div>");
		}
	} else{
		set_message("<div class='alert alert-danger text-center'><a href=''#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Your Time Period Has Expired.</div>");
	}
}

///////////////////////////FUNCTION TO GET ORDERS TO PROFILE PAGE///////////////////////////////////////
function get_orders_to_profile_page(){
	$profile_id = $_SESSION["ID"];
	$query = query("SELECT * FROM orders WHERE user_id = '$profile_id'");
	confirm($query);
	$result = get_row($query);
	if ($result == 0) {
		echo "No Orders made";
	} else{
		while ($row = fetch_array($query)) {
			$picture = $row["product_photo"];
			$product_name = $row["product_name"];
			$order_date = $row["order_date"];
			$order_number = $row["order_number"];
			$order_status_code = $row["order_status"];

			if ($order_status_code == 1) {
			$order_status = "<div style='background:red;padding:5px;color:#fff;text-align:center;border:1px solid red;'>"."Received"."</div>";
		} elseif ($order_status_code == 2) {
			$order_status = "<div style='background:orange;padding:5px;color:#fff;text-align:center;border:1px solid orange;'>"."Processing"."</div>";
		} elseif ($order_status_code == 3) {
			$order_status = "<div style='background:blue;padding:5px;color:#fff;text-align:center;border:1px solid blue;'>"."Shipping"."</div>";
		}else {
			$order_status = "<div style='background:green;padding:5px;color:#fff;text-align:center;border:1px solid green;'>"."Delivered"."</div>";
		}
			$orders =<<<DELIMETER
		 <tr>
	            <td>
	              <div class="cart-info">
	                  <img src="../resources/uploads/{$picture}" style="width:100px;height:100px; padding:5px">
	                  <div style="margin:auto;">
	                    <p><strong>{$product_name}</strong></p>
	                    <small style="color:#a64dff;font-weight:600;">Date: {$order_date}</small>
	                  </div>
	              </div>
	            </td>
	             <td>#{$order_number}</td>
	              <td>{$order_status}</td>
	     </tr>
DELIMETER;
	echo $orders;
		}
	}
}

function get_pending_reviews(){
	$user_id = $_SESSION["ID"];
	$query = query("SELECT * FROM orders WHERE user_id = '$user_id' AND product_review = 0");
	confirm($query);
		$result = get_row($query);
		if ($result == 0) {
			echo("No Pending Reviews.");
		}else{
			while ($row = fetch_array($query)) {
				$product_id = $row["product_id"];
				$product_photo = $row["product_photo"];
				$product_name = $row["product_name"];
				$order_number = $row["order_number"];
				$order_date = $row["order_date"];
			$pending_reviews =<<<DELIMETER
						<tr>
						<td>
						  <div class="cart-info">
						      <img src="../resources/uploads/{$product_photo}" style="width:100px; height:100px; padding:5px;">
						      <div style="text-align:left;padding:5px;margin:auto 0;">
						        <p><strong>{$product_name}</strong></p>
						        <small><strong>Order No:</strong> #{$order_number}</small><br>
						        <small><strong>Date:</strong> {$order_date}</small>
						      </div>
						  </div>
						</td>
						  <td class="td">
						  		<div class="rrb" style="margin-top:40px; padding:5px;">
									<button class="rbtn opmd">Add Review</button>
								</div>
							</td>
						</tr>
							<div class="review-modal" style="display: none;">
										<div class="review-bg"></div>
										<div class="rmp">
											<div class="rpc">
												<span><i class="fa fa-times"></i></span>
											</div>
											<div class="rps" align="center">
												<i class="fa fa-star" data-index="0" style="display: none;"></i>
												<i class="fa fa-star" data-index="1"></i>
												<i class="fa fa-star" data-index="2"></i>
												<i class="fa fa-star" data-index="3"></i>
												<i class="fa fa-star" data-index="4"></i>
												<i class="fa fa-star" data-index="5"></i>
											</div>
											<input type="hidden" value="" class="starRateV">
											<input type="hidden" value="<?php {$order_date} ?>" class="rateDate">
											<input type="hidden" value="<?php {$product_id} ?>" class="productId">
											<div class="rptf" align="center">
												<input type="text" class="raterName" placeholder="Enter your name">
											</div>
											<div class="rptf" align="center">
												<textarea class="rateMsg" id="rate-field" placeholder="Describe your Experience..."></textarea>
											</div>
											<div class="rate-error" align="center"></div>
											<div class="rpsb" align="center">
												<button class="rpbtn">Post Review</button>
											</div>
										</div>
								</div>		
DELIMETER;
	echo($pending_reviews);
		}
	}
}

if (isset($_POST['sub_email'])) {
	$sub_email = $_POST['sub_email'];
    $sql = query("SELECT id FROM newsletter_emails WHERE emails = '$sub_email'");
    confirm($query);
    $emailCheck = get_row($sql);
    if (!filter_var($sub_email,FILTER_VALIDATE_EMAIL)) {
        echo "<div style='color:#ff9999;font-weight:600;'>Wrong E-mail Format</div>";
        exit();
    } else if ($emailCheck>0) {
        echo "<div style='color:#ff9999;font-weight:600;'>Email already used!</div>";
        exit();
    } else{
    	$insert = query("INSERT INTO newsletter_emails(emails) VALUES('$sub_email')");
    	confirm($insert);
    	echo("<div style='color:#339933;font-weight:600;'>Subscribed!</div>");
    }

}

/************************************Order Details****************************************************************************/
  function order_details()
  {
  $delivery_fee = 0;
   $user_ID = $_SESSION['ID'];
   $grand_total = 0;
   $allItems = '';
   $item_quatity = 0;
   $items = array();
   $query = query("SELECT * FROM cart WHERE user_ID = '$user_ID'");
   confirm($query);
   while($row = fetch_array($query)) {
     $grand_total += $row['total_price'];
     $product_id = $row['product_ID'];
     $product_name = $row["product_name"];
     $item_quatity = $row['quantity'];
     $product_photo = $row['product_photo'];
     $product_size = $row['product_size'];
   /*  switch ($item_quatity) {
       case '1':
         $delivery_fee = 200;
         break;
       case '2':
          $delivery_fee = 190;
         break;
        case '3':
           $delivery_fee = 180;
          break;
        case '4':
           $delivery_fee = 160;
          break;
          case '5':
            $delivery_fee = 150;
            break;
          case '6':
             $delivery_fee = 140;
            break;
       default:
               $delivery_fee = 0;
         break;
     } */
   }
   
   $order_details = <<<DELIMETER
   <tr>
   		<td>{$product_name}</td>
   		<td>{$item_quatity}</td>
   		<td>{$product_size}</td>
   </tr>
 DELIMETER;
   echo $order_details;
  $logistics = $item_quatity*$delivery_fee;
  $amount_payable = $grand_total+$logistics;
  }
  /************************************XXX*********************Order Details*********************************************XXXX******************************/
  /********************************************************Business Info**************************************************************************/
  if (isset($_POST['shop_location'])) {
  		$shop_location = $_POST["shop_location"];
  		$businessName = $_POST["businessName"];
  		$address = $_POST["address"];
  		$postalCode = $_POST["postalCode"];
  		$region = $_POST["region"];
  		$town = $_POST["town"];
  		$VATRegistered = $_POST["vat_registered"];
  		$businessRegNumber = $_POST["businessRegNumber"];
  		$supplyCategory = $_POST["supplyCategory"];

  		$query = query("SELECT * FROM suppliers WHERE business_reg_no = '$businessRegNumber'");
  		confirm($query);
  		if (get_row($query) >= 1) {
  			echo("<small style='color:red;font-weight:600;'>Sorry, a supplier with this details already exists in our system</small>");
  			exit();
  		} else{
  			$query2 = query("INSERT INTO suppliers(shop_location,shop_name,address,postal_code,region,town,VAT_registered,business_reg_no,supply_category,mpesa_reg_name,payment_method,mpesa_phone_no,account_name,account_no,bank)VALUES('$shop_location','$businessName','$address','$postalCode','$region','$town','$VATRegistered','$businessRegNumber','$supplyCategory','Pending','Pending','Pending','Pending','Pending','Pending')");
  			confirm($query2);
  			echo("posted");
  			exit();
  		}
  }

  
  /*******************************Business Info*******************XX*******************************************************/


if (isset($_POST['starRate'])) {
	$starRate = escape_string($_POST['starRate']);
	$user_message = escape_string($_POST['user_message']);
	$user_name = escape_string($_POST['user_name']);
	$date_review = $_POST['date_review'];
	$product_id = escape_string($_POST['productId']);
	$user_id = $_SESSION["ID"];

	$query = query("SELECT ID FROM product_rating WHERE product_id = '$product_id' AND user_id = '$user_id'");
	confirm($query);
	$row_exist = get_row($query);
	if ($row_exist == 0) {
		$insert = query("INSERT INTO product_rating(product_id,user_id,user_name,user_message,date_reviewed,user_rate) VALUES('{$product_id}','{$user_id}','{$user_name}','{$user_message}','$date_review','{$starRate}')");
		confirm($insert);
		echo("inserted");
	} else{
		$update = query("UPDATE product_rating SET user_message='$user_message',date_reviewed='$date_review',user_rate='$starRate' WHERE user_id = '$user_id' AND product_id = '$product_id' LIMIT 1");
		confirm($update);
		echo("updated");
	}
		$product_review = query("UPDATE orders SET product_review = 1 WHERE user_id = '$user_id' AND product_id = '$product_id'");
		confirm($product_review);
}

if (isset($_POST['order_status'])) {
	$order_status = $_POST['order_status'];
	$product_id = $_POST['id'];
	$user_id = $_POST['u_id'];
	$query = query("UPDATE orders set order_status = '$order_status' WHERE product_id='$product_id' AND user_id = '$user_id'");
	confirm($query);
	echo "updated";
}
?>

<script>
    function toggle_color() {
        const btn = document.getElementById($id);
        if (btn.classList.contains("far")){
            btn.classList.remove("far");
            btn.classList.add("fas");
        } else{
            btn.classList.remove("fas");
            btn.classList.add("far");
        }
    }
	
function myAjax(method, url) {
    let x;
    try{
	//For Opera 8.0+,Firefox,Safari and chrome
	x = new XMLHttpRequest();
} catch(e){
	try{
		//For Internet Explore Browsers
	x = new ActiveXObject('Msxml2.XMLHTTP');
	} catch{
		try{
		x = new ActiveXObject("Microsoft.XMLHTTP");
			} catch(e){
				//Browser doesn't support AJAX object
				alert("Browser doesn't support JavaScript please get an updated browser.");
			}
	}
}
x.open(method,url,true);
x.setRequestHeader("Content-type","application/x-www-form-urlencoded");
return x;
}

function ajaxStatus(x) {
	if (x.readyState == 4 && x.status == 200) {
		return true;
	}
}


function clearPasswordStatus() {
	document.getElementById("passwordStatus").innerHTML = "";
}
function isChecked() {
    let checked = document.getElementById("terms").checked;
    if (checked) {
		return true;
	} else {
		return false;
	}
}

function edit_user_details(){
        let edited_gender = document.getElementById("gender").value;
        let edited_county = document.getElementById("county").value;
        let phone_number = document.getElementById("phone_number").value;
         if (edited_gender.length == 0 || edited_county.length == 0 || phone_number.length == 0) {
            document.getElementById("error_messages").innerHTML = '<div style ="color:#F00; font-weight: bold" class="alert alert-info"> Please Fill all the Fields! </div>';
            return false;
        } else{
        	document.getElementById("save_edits_btn").style.display = "Saving...";
            let edit_info = myAjax("POST", "../resources/functions.php");
            edit_info.onreadystatechange = function()
            {
                if (ajaxStatus(edit_info) == true){
                 	document.getElementById("error_messages").innerHTML = edit_info.responseText;
                 	document.getElementById("save_edits_btn").style.display = "block";
                }
            }
            edit_info.send("edited_gender="+edited_gender+"&edited_county="+edited_county+"&phone_number="+phone_number);
        }
}

function edit_user_password(){
        let old_password = document.getElementById("old_password").value;
        let new_password1 = document.getElementById("userPassword1").value;
        let new_password2 = document.getElementById("userPassword2").value;
        if (old_password.length == 0 || old_password1.length == 0 || old_password2.length == 0) {
        	 document.getElementById("error_messages").innerHTML = '<div style ="color:#F00; font-weight: bold" class="alert alert-info"> Please Fill all the Password Fields! </div>';
            return false;
        } else if (new_password1 != new_password2) {
            document.getElementById("error_messages").innerHTML = '<div style ="color:#F00; font-weight: bold" class="alert alert-info"> New Passwords do not match! </div>';
            return false;
        } else{
        	document.getElementById("save_edits_btn").style.display = "Saving...";
            let edit_info = myAjax("POST", "../resources/functions.php");
            edit_info.onreadystatechange = function()
            {
                if (ajaxStatus(edit_info) == true){
                 	document.getElementById("error_messages").innerHTML = edit_info.responseText;
                 	document.getElementById("save_edits_btn").style.display = "block";
                }
            }
            edit_info.send("old_password="+old_password+"&edited_password="+new_password2);
        }
}
    /////////////Function to search for data
    function look_up(){
    const searchWrapper = document.querySelector(".search-input");
    const inputBox = searchWrapper.querySelector("input");
    const suggBox = searchWrapper.querySelector(".autocom-box");
        let search_data = document.getElementById("data_clue").value;
        if (search_data != ""){
        	 searchWrapper.classList.add("active");
            let search_result = myAjax("POST", "../resources/functions.php");
            search_result.onreadystatechange = function()
            {
                if (ajaxStatus(search_result) == true){
                    document.getElementById("autocom-box").innerHTML = search_result.responseText;
                }
            }
            search_result.send("s="+search_data);
        } else{
        	searchWrapper.classList.remove("active");
        }
    }

    //Cart functions
 function add_to_cart_directly(product_id){
 			
				$(document).on('click','.fa-shopping-cart',function(){
				$(this).addClass("hide");
				});
			let cart_product = myAjax("POST", "../resources/functions.php");
        	cart_product.onreadystatechange = function()
        		{
          /* if (ajaxStatus(cart_product) == true){
                document.getElementById("status").innerHTML = '<i class="fas fa-check"></i>';
            } else{
                document.getElementById("status").innerHTML = '<div style ="color:#F00; font-weight: bold" class="alert alert-info"> Something went wrong </div>';
            } */
        }
        cart_product.send("add_to_cart="+product_id+"&product_size="+"Empty");
		
    }

     function add_wish_to_cart(product_id){
			let wish_product = myAjax("POST", "../resources/search.php");
        	wish_product.onreadystatechange = function(){
           if (ajaxStatus(wish_product) == true){
           		if (wish_product.responseText == "added") {
           			location.reload();
           			document.getElementById("message").innerHTML = "<div class='alert alert-success text-center'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Added successfully!</div>";
           		} else{
           			location.reload();
           			document.getElementById("message").innerHTML = "<div class='alert alert-danger text-center'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Something happened! Try again</div>";
           		}
            } 
        }
        wish_product.send("add_wish_to_cart="+product_id+"&product_size="+"Empty");
    }

	    //For products added to cart directly

		function add_to_cart(product_id,c_id){
		let product_size = document.getElementById('p_size').value;
		if (product_size == "") {
			document.getElementById('size_error').innerHTML = "Select Size!";
			return false;
		} else{
			let cart_product = myAjax("POST", "../resources/functions.php");
        	cart_product.onreadystatechange = function()
        {
           if (ajaxStatus(cart_product) == true){
                document.getElementById("status_message").innerHTML = cart_product.responseText;
               location.reload();
            } else{
                document.getElementById("status_message").innerHTML = '<div style ="color:#ff0000; font-weight: bold" class="alert alert-info"> Something went wrong </div>';
            } 
        }
        cart_product.send("add_to_cart="+product_id+"&product_size="+product_size);
		}
        
    }


    //////Buy Now Button
    	function add_to_cart_to_buy(product_id,c_id){
		let product_size = document.getElementById('p_size').value;
		if (product_size == "") {
			document.getElementById('size_error').innerHTML = "Select Size!";
			return false;
		} else{
			let buy_product = myAjax("POST", "../resources/functions.php");
        	buy_product.onreadystatechange = function()
        {
           if (ajaxStatus(buy_product) == true){
               window.location = "cart_page.php";
            }
        }
        buy_product.send("add_to_cart="+product_id+"&product_size="+product_size);
		}
        
    }

    function clear_size_error() {
    	document.getElementById('size_error').innerHTML = " ";
    }


    //Add to wish list function
    function add_to_wishlist(product_id) {
        let btn = document.getElementById(product_id);
        if (btn.classList.contains("far")) {
            btn.classList.remove("far");
            btn.classList.add("fas");

        let add_to_wish = myAjax("POST", "../resources/functions.php");
        add_to_wish.onreadystatechange = function () {
          /*  if (ajaxStatus(add_to_wish) == true) {
                document.getElementById("message").innerHTML = add_to_wish.responseText;
            } else {
                document.getElementById("message").innerHTML = '<div style ="color:#F00; font-weight: bold" class="alert alert-info"> Something went wrong </div>';
            } */
        }
        add_to_wish.send("wish=" + product_id);
    } else{
            btn.classList.remove("fas");
            btn.classList.add("far");
            let remove_from_wish = myAjax("POST", "../resources/functions.php");
            remove_from_wish.onreadystatechange = function () {
               /*if (ajaxStatus(remove_from_wish) == true) {
                    document.getElementById("message").innerHTML = remove_from_wish.responseText;
                } else {
                    document.getElementById("message").innerHTML = '<div style ="color:#F00; font-weight: bold" class="alert alert-info"> Something went wrong </div>';
                } */
            }
            remove_from_wish.send("remove_from_wishlist=" + product_id);
        }
    }

    //Function to change product quantity
    function change_quantity(product_id){
    	let new_qty = document.getElementById(product_id).value;
    	  let qty = myAjax("POST", "../resources/cart.php");
    	   qty.onreadystatechange = function()
            {
                if (ajaxStatus(qty) == true){
                    //document.getElementById("message").innerHTML = qty.responseText;
                     location.reload();
                }
            }
            qty.send("value="+new_qty+"&product_id="+product_id);
    }

   ///////////////////Function to aubscribe users for promotional emails
   function subscribe() {
   		let email = document.getElementById('subscr_email').value;
   		if (email == "") {
   			document.getElementById('sent').innerHTML = "<div style='color:#ff9999;font-weight:600;'>You have not entered any E-mail!</div>";
   		} else{
    	  let ajax = myAjax("POST", "../resources/functions.php");
    	  ajax.onreadystatechange = function()
            {
                if (ajaxStatus(ajax) == true){
                    document.getElementById("sent").innerHTML = ajax.responseText;
                }
            }
            ajax.send("sub_email="+email);
   		}
   }

   function cancel(){
   	window.location = "index.php";
   }

  
   function buss_Info(){
   		let shop_location = document.getElementById("shopLocation").value;
   		let businessName = document.getElementById("businessName").value;
   		let address = document.getElementById("address").value;
   		let postalCode = document.getElementById("postalCode").value;
   		let region = document.getElementById("region").value;
   		let town = document.getElementById("town").value;
   		let vat_registered = document.getElementById("VATregistered").value;
   		let businessRegNumber = document.getElementById("businessRegNumber").value;
   		let supplyCategory = document.getElementById("supplyCategory").value;

   		if (shop_location.length == 0 || businessName.length == 0 || region.length == 0 || town.length == 0 ||  vat_registered.length == 0 || businessRegNumber.length == 0 || supplyCategory.length == 0) {
   			document.getElementById('seller_message').innerHTML = "<small style='color:red;'>Please Fill the required fields!</small>";
   			return false;
   		} else{
   			document.getElementById('busInfo').style.display = "none";
             document.getElementById("seller_message").innerHTML = '<div style="color:#fff;font-weight:bold;background:green;padding:5px;border:1px solid black;border-radius:5px;">Processing...</div>';
            let ajax = myAjax("POST", "../resources/functions.php");
            ajax.onreadystatechange = function(){
                if (ajaxStatus(ajax) == true){
                    if ((ajax.responseText.replace(/^\s+|\s+$/g, "")) == "posted"){
                    	 window.location = "../public/bankAccountInformation.php?reg_no="+businessRegNumber;
                    } else {
                    	document.getElementById('busInfo').style.display = "block";
                        document.getElementById("seller_message").innerHTML = ajax.responseText;
                        return false;
                    }
                }
            }
            ajax.send("shop_location="+shop_location+"&businessName="+businessName+"&address="+address+"&postalCode="+postalCode+"&region="+region+"&town="+town+"&vat_registered="+vat_registered+"&supplyCategory="+supplyCategory+"&businessRegNumber="+businessRegNumber);
   		}
   }


function bank_info() {
	let mpesaRegisteredName = document.getElementById("mpesaRegisteredName").value;
	let modeOfPayment = document.getElementById("modeOfPayment").value;
	let mpesaPhoneNumber = document.getElementById("mpesaPhoneNumber").value;
	let accountName = document.getElementById("accountName").value;
	let accountNumber = document.getElementById("accountNumber").value;
	let bankName = document.getElementById("bankName").value;

	if (mpesaRegisteredName.length == 0 || modeOfPayment.length == 0 || mpesaPhoneNumber.length == 0 || accountName.length == 0 ||  accountNumber.length == 0 || bankName.length == 0) {
   			document.getElementById('seller_message').innerHTML = "<small style='color:red;'>Please Fill the required fields!</small>";
   			return false;
   		} else{
   			document.getElementById('submitBankInfo').style.display = "none";
            document.getElementById("seller_message").innerHTML = '<div class="alert alert-success text-center" style="color:#fff;font-weight:bold">Processing...</div>';
            let ajx = myAjax("POST", "../resources/search.php");
            ajx.onreadystatechange = function(){
                if (ajaxStatus(ajx) == true){
                    if ((ajx.responseText.replace(/^\s+|\s+$/g, "")) == "done"){
                    	window.scrollTo(0,0);
                        document.getElementById("bank_account_info").innerHTML = '<div class="jumbotron text-center"><img src="../resources/uploads/brand_logos/success.PNG"></img><p>We received your request.<br>Thank you for your interest to be our supplier. <br>We are looking forward to work with you! We`ll review your request and contact you once we are done. <br> Thanks once again! <br><br> <span style="font-style:italic">-Swifftshop Team</span></p><a href="index.php">Continue Shopping</a></div>';
                    } else {
                    	document.getElementById('submitBankInfo').style.display = "block";
                        document.getElementById("seller_message").innerHTML = ajx.responseText;
                        return false;
                    }
                }
            }
            ajx.send("mpesaRegisteredName="+mpesaRegisteredName+"&modeOfPayment="+modeOfPayment+"&mpesaPhoneNumber="+mpesaPhoneNumber+"&accountName="+accountName+"&accountNumber="+accountNumber+"&bankName="+bankName);
   		}	
}

   function update_order_status(product_id,user_id) {
   		let status = document.getElementById(product_id).value;
   		 let ajax = myAjax("POST", "../../resources/functions.php");
            ajax.onreadystatechange = function(){
                if (ajaxStatus(ajax) == true){
                	location.reload();
                }
            }
            ajax.send("order_status="+status+"&id="+product_id+"&u_id="+user_id);
   }
</script>