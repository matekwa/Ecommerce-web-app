<?php 
    require_once '../resources/config.php';
     if(!isset($_SESSION["ID"]) || !isset($_GET['u_id'])) redirect("login.php");
     $_SESSION['ID'] = $_GET['u_id'];
?>
<!DOCTYPE html>
<html lang="en">
  <title>SwiftShop.com</title>
  <?php require_once(TEMPLATE_FRONT.DS."metadata.php"); ?>
    <!-- Page Content -->
<?php require_once(TEMPLATE_FRONT.DS."simple_header.php"); ?>
  <body>
        <div class="container">
          <h3 class="text-center">Choose a Profile Picture for your Account</h3>
         <form  method="post" action="" enctype="multipart/form-data" id="myform">
            <div class="pp_wrapper">
                <div class="image">
                  <img src="" alt="" id="img" name="profile_picture">
                </div>
                <div class="content">
                  <div class="icon"> <i class="fas fa-cloud-upload-alt"></i></div>
                  <div class="text">No file chosen, yet!</div>
                </div>
                <div id="cancel-btn"><i class="fas fa-times"></i></div>
                <div class="file-name">File name here</div>
            </div>

             
            <input type="file" id="default-btn" hidden="hidden"  name="file" onchange="clear_warning()">
            <small class="text-center" id="warning" style="color: #002b80;font-weight: 600;font-size:15px;"></small>
          </form>
          <button onclick="defaultBtnActive()" id="custom-btn">Choose a picture</button>
          <button onclick="save_pp()" id="continue">Continue&nbsp;<i class='fa fa-arrow-right' style="color: white;"></i></button>
        </div>
</body>
<script src="../resources/templates/front/jquery/jquery.js"></script>
<script type="text/javascript">
  const pp_wrapper = document.querySelector('.pp_wrapper');
  const fileName = document.querySelector('.file-name');
  const defaultBtn = document.querySelector('#default-btn');
  const cancelBtn = document.querySelector('#cancel-btn');
  const customeBtn = document.querySelector('#custome-btn');
  const img = document.querySelector("#img");
  let regExpr = /[0-9a-zA-Z\^\&\`\@\{\}\[\]\,\$\=\!\-\#\(\)\.\%\+\~\_ ]+$/;
  function defaultBtnActive() {
      defaultBtn.click()
  }
  defaultBtn.addEventListener("change",function(){
    const file = this.files[0];
   if (file) {
      const reader = new FileReader();
      reader.onload = function(){
      const result = reader.result;
      img.src = result;
      pp_wrapper.classList.add("active");
    }
      cancelBtn.addEventListener("click",function(){
        img.src = "";
        pp_wrapper.classList.remove("active");
      });
      reader.readAsDataURL(file);
   }
   if (this.value) {
    let valueStore = this.value.match(regExpr);
    fileName.textContent = valueStore;
   }
  
  });
  function save_pp(){
    let photo = document.getElementById('img').value;
    if (photo === "") {
      document.getElementById('custom-btn').innerText="Select a photo!";
    }
  }
</script>
<script type="text/javascript">
  function clear_warning(){
      document.getElementById("warning").innerHTML = "";
  }

        $(document).ready(function(){

            $("#continue").click(function(){

                var fd = new FormData();

                var files = $('#default-btn')[0].files;

                // Check file selected or not
                if(files.length > 0 ){

                    fd.append('file',files[0]);

                    $.ajax({
                        url:'../resources/upload.php',
                        type:'post',
                        data:fd,
                        contentType: false,
                        processData: false,
                        success:function(response){
                            if(response == 1){
                                $("#img").attr("src","../resources/".response);
                                document.getElementById("warning").innerHTML = "";
                                window.location = "login.php";
                            }else{
                               document.getElementById("warning").innerHTML = response;
                            }
                        }
                    });
                }else{
                    document.getElementById("warning").innerHTML = "Please Choose a File!";
                }
            });
        });
</script>
</html>
