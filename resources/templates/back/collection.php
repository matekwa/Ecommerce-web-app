<?php add_collection();?>
    <h1 class="page-header">
    Collection
    </h1>
    <?php display_message(); ?>
    <div class="col-md-4">
        <form action="" method="post">
            <div class="form-group">
                <label for="Collection-title">Title</label>
                <input type="text" name="new_collection" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" name="add_collection" class="btn btn-primary" value="Add collection">
            </div>      
        </form>
    </div>
    <div class="col-md-8">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Collection ID</th>
                        <th>Title</th>
                    </tr>
                </thead>
                <tbody>
                   <?php show_collection_in_admin(); ?>
                </tbody>
            </table>
    </div>
