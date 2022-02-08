<?php add_product(); ?>
        <div class="col-md-12">
            <div class="row">
                <h1 class="page-header">
                Add Product
                </h1>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                    <div class="col-md-8">
                            <div class="form-group">
                                <label for="product-title">Product Title </label>
                                <input type="text" name="product_title" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="product-title">Product Description</label>
                                <textarea name="product_description" id="" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                            <div class="form-group row">
                                <div class="col-xs-3">
                                <label for="product-price">Current Price</label>
                                <input type="number" name="product_price" class="form-control" size="60">
                                </div>
                            </div>
                             <div class="form-group row">
                                <div class="col-xs-3">
                                <label for="product-price">Last Price</label>
                                <input type="number" name="last_product_price" class="form-control" size="60">
                                </div>
                            </div>
                        <div class="form-group">
                            <label for="product-color">Product Size</label>
                            <input type="text" name="product_size" class="form-control" placeholder="e.g L or 42...">
                        </div>
                    </div>
                    <!--Main Content-->
                    <!-- SIDEBAR-->
                    <aside id="admin_sidebar" class="col-md-4">
                        <div class="form-group">
                            <input type="submit" name="draft" class="btn btn-warning btn-lg" value="Draft">
                            <input type="submit" name="publish" class="btn btn-primary btn-lg" value="Publish">
                        </div>
                        <!-- Product Categories-->
                        <div class="form-group">
                            <label for="product-Category">Product Category</label>
                            <hr>
                            <select name="product_category" id="" class="form-control">
                            <option value="">Select Category</option>
                            <?php show_category_on_add_product_page(); ?>
                            </select>
                        </div>
                        <!-- Product Brands-->
                        <div class="form-group">
                                <label for="product-Brand">Product Brand</label>
                                <select name="product_brand" id="" class="form-control">
                                <option value="">Select a brand</option>
                                 <?php show_brand_on_add_product_page(); ?>
                                </select>
                        </div>
                        <!-- Product collection-->
                        <div class="form-group">
                                <label for="product-collection">Product Collection</label>
                                <select name="product_collection" id="" class="form-control">
                                <option value="">Select a Collection</option>
                                 <?php show_collection_on_add_product_page(); ?>
                                </select>
                        </div>
                        <div class="form-group">
                            <label for="product-color">Product Color</label>
                            <input type="text" name="product_color" class="form-control" placeholder="e.g blue...">
                        </div>
                        <div class="form-group">
                            <label for="product-condition">Product Condition</label>
                            <input type="text" name="product_condition" class="form-control" placeholder="e.g Fresh from box..">
                        </div>
                        <div class="form-group">
                            <label for="product-condition">Seller</label>
                            <input type="text" name="seller" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="product-condition">Product Quantity</label>
                            <input type="number" name="product_quantity" class="form-control" placeholder="e.g 2">
                        </div>
                        <!-- Product Image -->
                        <div class="form-group">
                            <label for="product-image">Main Product Image</label>
                            <input type="file" name="main_photo">
                        </div><hr>
                        <div class="form-group">
                            <label for="product-image">Sub-image 1</label>
                            <input type="file" name="sub_photo_1">
                        </div><hr>
                        <div class="form-group">
                            <label for="product-image">Sub-image 2</label>
                            <input type="file" name="sub_photo_2">
                        </div><hr>
                        <div class="form-group">
                            <label for="product-image">Sub-image 3</label>
                            <input type="file" name="sub_photo_3">
                        </div>
                    </aside><!--SIDEBAR-->
            </form>
        </div>
        <!-- /.container-fluid -->
