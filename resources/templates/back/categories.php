<?php add_category();?>
    <h1 class="page-header">
    Categories
    </h1>
    <?php display_message(); ?>
    <div class="col-md-4">
        <form action="" method="post">
            <div class="form-group">
                <label for="category-title">Title</label>
                <input type="text" name="new_category" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" name="add_category" class="btn btn-primary" value="Add Category">
            </div>      
        </form>
    </div>
    <div class="col-md-8">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Category ID</th>
                        <th>Title</th>
                    </tr>
                </thead>
                <tbody>
                   <?php show_categories_in_admin(); ?>
                </tbody>
            </table>
    </div>
