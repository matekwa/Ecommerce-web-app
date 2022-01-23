<?php require_once '../../resources/config.php';
        if (!isset($_sESSION['ID']) && $_SESSION['ID'] != 13 ) {
            redirect("../index.php");
        }
 ?>
<?php include (TEMPLATE_BACK."/header.php"); ?>
        <div id="page-wrapper">

            <div class="container-fluid">
                 <?php 
                 if ($_SERVER['REQUEST_URI'] == '/swifftshop/public/admin/' || $_SERVER['REQUEST_URI'] == '/swifftshop/public/admin/index.php') {
                     include (TEMPLATE_BACK."/admin_content.php");
                 }
                 if (isset($_GET['orders'])) {
                      include (TEMPLATE_BACK."/orders.php");
                 }
                 if (isset($_GET['reports'])) {
                      include (TEMPLATE_BACK."/reports.php");
                 }
                 if (isset($_GET['products'])) {
                       include (TEMPLATE_BACK."/products.php");
                 }
                 if (isset($_GET['add_product'])) {
                        include (TEMPLATE_BACK."/add_product.php");
                 }
                 if (isset($_GET['categories'])) {
                        include (TEMPLATE_BACK."/categories.php");
                 }
                  if (isset($_GET['brands'])) {
                        include (TEMPLATE_BACK."/brands.php");
                 }
                  if (isset($_GET['collection'])) {
                        include (TEMPLATE_BACK."/collection.php");
                 }
                 if (isset($_GET['users'])) {
                        include (TEMPLATE_BACK."/users.php");
                 }
                 if (isset($_GET['edit_product'])) {
                        include (TEMPLATE_BACK."/edit_product.php");
                 }
                  if (isset($_GET['add_user'])) {
                        include (TEMPLATE_BACK."/add_user.php");
                 }
                 if (isset($_GET['trending_products'])) {
                        include (TEMPLATE_BACK."/trending_products.php");
                 }
                 if (isset($_GET['newarrivals'])) {
                        include (TEMPLATE_BACK."/newarrivals.php");
                 }
                  if (isset($_GET['partnered_products'])) {
                        include (TEMPLATE_BACK."/partnered_products.php");
                 }
                  if (isset($_GET['featured_products'])) {
                        include (TEMPLATE_BACK."/featured_products.php");
                 }
                  if (isset($_GET['slides'])) {
                        include (TEMPLATE_BACK."/slides.php");
                 }
                 if (isset($_GET['bestsellers'])) {
                        include (TEMPLATE_BACK."/bestsellers.php");
                 }
                 if (isset($_GET['suppliers'])) {
                        include (TEMPLATE_BACK."/suppliers.php");
                 }
                ?>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

   <?php include (TEMPLATE_BACK."/footer.php"); ?>

</body>

</html>
