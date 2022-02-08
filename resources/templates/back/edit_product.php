<?php 
    if (isset($_GET['id'])) {
        $query = query("SELECT * FROM products WHERE ID = ".escape_string($_GET['id'])." ");
        confirm($query);
        while ($row = fetch_array($query)){
            $title = escape_string($row['Title']);
            $category = escape_string($row['category_ID']);
            $brand = escape_string($row['brand_ID']);
            $collection = escape_string($row['collection_ID']);
            $price = escape_string($row['Price']);
            $last_price = escape_string($row['Last_Price']);
            $description = escape_string($row['Description']);
            $product_color = escape_string($row['Color']);
            $product_condition = escape_string($row['Product_condition']);
            $seller = escape_string($row['seller']);
            $product_quantity = escape_string($row['Product_quantity']);
            $product_size = escape_string($row['Sizes']);
            $image_name = escape_string($row['product_image']);
            $product_image = display_photo($image_name);
        }
         update_product(); 
    }

   
?>
        <div class="col-md-12">
            <div class="row">
                <h1 class="page-header">
                Edit Product
                </h1>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                    <div class="col-md-8">
                            <div class="form-group">
                                <label for="product-title">Product Title </label>
                                <input type="text" name="product_title" class="form-control" value="<?php echo($title); ?>">
                            </div>
                            <div class="form-group">
                                <label for="product-title">Product Description</label>
                                <textarea name="product_description" id="" cols="30" rows="10" class="form-control" ><?php echo($description); ?></textarea>
                            </div>
                            <div class="form-group row">
                                <div class="col-xs-3">
                                <label for="product-price">Current Price</label>
                                <input type="number" name="product_price" class="form-control" size="60" value="<?php echo($price); ?>">
                                </div>
                            </div>
                             <div class="form-group row">
                                <div class="col-xs-3">
                                <label for="product-price">Last Price</label>
                                <input type="number" name="last_product_price" class="form-control" size="60" value="<?php echo($last_price); ?>">
                                </div>
                            </div>
                        <div class="form-group">
                            <label for="product-color">Product Size</label>
                            <input type="text" name="product_size" class="form-control" placeholder="e.g L or 42..." value="<?php echo($product_size); ?>">
                        </div>

                            <div class="card my-auto">
                                <div class="checkbox"> <label><input type = "checkbox" name="newarrivals">New Arrival</label> </div>
                                <div class="checkbox"> <label><input type = "checkbox" name="features">Features</label> </div>
                                <div class="checkbox"> <label><input type = "checkbox" name="trending">Trending</label> </div>
                                <div class="checkbox"> <label><input type = "checkbox" name="partners">Partners</label> </div>
                                <div class="checkbox"> <label><input type = "checkbox" name="hotdeal">Add Hotdeal</label> </div>
                            </div>
                    </div>
                    <!--Main Content-->
                    <!-- SIDEBAR-->
                    <aside id="admin_sidebar" class="col-md-4">
                        <div class="form-group">
                            <input type="submit" name="draft" class="btn btn-warning btn-lg" value="Draft">
                            <input type="submit" name="update" class="btn btn-primary btn-lg" value="Update">
                        </div>
                        <!-- Product Categories-->
                        <div class="form-group">
                            <label for="product-Category">Product Category</label>
                            <hr>
                            <select name="product_category" id="" class="form-control">
                            <option value="<?php echo($category); ?>"><?php echo show_category_title_to_admin_products_page($category); ?></option>
                            <?php show_category_on_add_product_page(); ?>
                            </select>
                        </div>
                        <!-- Product Brands-->
                        <div class="form-group">
                                <label for="product-Brand">Product Brand</label>
                                <select name="product_brand" id="" class="form-control">
                                <option value="<?php echo($brand); ?>"><?php echo show_brand_title_to_admin_products_page($brand); ?></option>
                                 <?php show_brand_on_add_product_page(); ?>
                                </select>
                        </div>
                        <!-- Product collection-->
                        <div class="form-group">
                                <label for="product-collection">Product Collection</label>
                                <select name="product_collection" id="" class="form-control">
                                <option value="<?php echo($collection); ?>"><?php echo show_collection_title_to_admin_products_page($collection); ?></option>
                                 <?php show_collection_on_add_product_page(); ?>
                                </select>
                        </div>
                        <div class="form-group">
                            <label for="product-color">Product Color</label>
                            <input type="text" name="product_color" class="form-control" placeholder="e.g blue..." value="<?php echo($product_color); ?>">
                        </div>
                        <div class="form-group">
                            <label for="product-condition">Product Condition</label>
                            <input type="text" name="product_condition" class="form-control" placeholder="e.g Fresh from box.." value="<?php echo($product_condition); ?>">
                        </div>
                        <div class="form-group">
                            <label for="product-condition">Product Availability</label>
                            <input type="text" name="seller" class="form-control" value="<?php echo($seller); ?>">
                        </div>
                        <div class="form-group">
                            <label for="product-condition">Product Quantity</label>
                            <input type="number" name="product_quantity" class="form-control" placeholder="e.g 2" value="<?php echo($product_quantity); ?>">
                        </div>
                        <!-- Product Image -->
                        <div class="form-group">
                            <label for="product-image">Product Image</label>
                            <input type="file" name="photo" id="" > <br>
                            <img width = "150" src="../../resources/<?php echo($product_image); ?>">
                        </div>
                    </aside><!--SIDEBAR-->
            </form>
        </div>
        <!-- /.container-fluid -->
