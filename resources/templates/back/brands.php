<?php add_brand();?>
    <h1 class="page-header">
    Brands
    </h1>
    <?php display_message(); ?>
    <div class="col-md-4">
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="brand-title">Brands</label>
                <input type="text" name="new_brand" class="form-control">
            </div>
           <div class="form-group">
                <label for="product-image">Main Product Image</label>
                <input type="file" name="brand_icon">
            </div><hr>
            <div class="form-group">
                <input type="submit" name="add_brand" class="btn btn-primary" value="Add Brand">
            </div>      
        </form>
    </div>
    <div class="col-md-8">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Brand ID</th>
                        <th>Title</th>
                    </tr>
                </thead>
                <tbody>
                   <?php show_brands_in_admin(); ?>
                </tbody>
            </table>
    </div>
