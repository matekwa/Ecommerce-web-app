<?php require_once '../resources/config.php';
$id = $_SESSION["ID"];
 $query = query("SELECT user_photo FROM newregisteredusers WHERE ID = '$id'");
 confirm($query);
 
 while ($row = fetch_array($query)) {
  if ($row['user_photo'] === "") {
   $user_photo = "placeholder.jpg";
  } else{
   $user_photo = $row['user_photo'];
    }
  }

$time = date("G");
if ($time >= 03 && $time < 12) {
    $greetings = "Good Morning";
} elseif ($time >= 12 && $time < 17) {
    $greetings = "Good Afternoon";
} elseif ($time >= 17 && $time < 20) {
   $greetings = "Good Evening";
} else{
   $greetings = "Good Night";
} 
?>
<header>
	<div class="container-fluid">
		 <div class="row">
            <div class="col-md-2 col-4">
                <a href="index.php" class="logo"><img src="../resources/uploads/company_logos/header_small.png"></a>
            </div>
              <div class="col-md-4 col-12">
                   <div class="wrapper">
                      <div class="search-input">
                        <input type="text" placeholder="What do you need?" id="data_clue" onkeyup="look_up()">
                        <div class="autocom-box" id="autocom-box"></div>
                        <div class="icon"><i class="fas fa-search"></i></div>
                      </div>
                   </div>
            </div>
            <div class="col-md-2 text-right help">
              <a href="contact.php">Need Help?</a>       
            </div>
            <div class="col-md-2 col-6 text-right wellcome_username">
                    <?php
                        if(isset($_SESSION["Username"])){
                          echo '<p class="welcome_text  user-action">'.$greetings.','.$_SESSION["Username"].'</p>';
                          }
                          else {
                            echo '<p class="welcome_text  user-action">Hello,Sign In</p>';
                          }
                    ?>
                  
             </div>
            <div class="col-1 basket-icon mt-3 text-right">
                <a href="../public/cart_page.php" class="nav-item nav-link messages"><i class="fa fa-shopping-cart fa-2x"><sup class="badge"><?php echo($_SESSION['cart_items']); ?></sup></i></a>
            </div>
    	</div>
	</div>
</header>
<div class="container-fluid p-0">
   <nav class="navbar navbar-expand-xl navbar-light bg-light">
  <a href="index.php" class="navbar-brand"><b>Home</b></a>
  <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
    <span class="navbar-toggler-icon"></span>
  </button>
  <!-- Collection of nav links, forms, and other content for toggling -->
  <div id="navbarCollapse" class="collapse navbar-collapse justify-content-start">
    <div class="navbar-nav">
      <div class="nav-item dropdown">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Category</a>
        <div class="dropdown-menu">
          <?php 
            get_category();
          ?>  
        </div>
      </div>
      <div class="nav-item dropdown">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Brand</a>
        <div class="dropdown-menu">
          <?php 
            get_brand();
          ?>  
        </div>
      </div>
      <div class="nav-item dropdown">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Collection</a>
        <div class="dropdown-menu">
          <?php 
            get_collection();
          ?>  
        </div>
      </div>
      
    </div>
    <div class="navbar-nav ml-auto account">
      <div class="nav-item dropdown">
        <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle user-action"><img src="../resources/uploads/profile_pictures/<?php echo($user_photo);?>" style="width: 40px;height: 40px;border-radius: 50%;border:2px solid var(--primary-color);" class="avatar" alt="<?php echo $_SESSION['Username'];?>"> <?php echo $_SESSION["Email"];?> <b class="caret"></b></a>
        <div class="dropdown-menu" style="height: auto !important;width: 100% !important; overflow-y: auto !important;" id="account_links">
           <a href="profile.php" class="dropdown-item"><i class="fa fa-user-o"></i> Profile</a>
            <a href="wishlistpage.php" class="dropdown-item"><i class="fa fa-calendar-o"></i> Wish List</a>
          <a href="logout.php" class="dropdown-item"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a>
        </div>
      </div>
    </div>
  </div>
</nav>
</div>