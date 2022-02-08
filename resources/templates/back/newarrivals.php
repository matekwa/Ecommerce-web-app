
<h1 class="page-header">New Arrivals</h1>
<?php display_message(); ?>
<table class="table table-hover">
        <thead>
        <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Category</th>
        <th>Brand</th>
        <th>Collection</th>
        <th>Quantity</th>
        <th>Price</th>
        </tr>
        </thead>
    <tbody>
                    <?php get_newarrival_products_to_admin(); ?>
    </tbody> 
    <form method="POST">
        <?php add_newarrival_product(); ?>
         <input type="submit" name="add_newarrival_product" value="Add New Arrival" class="btn btn-info">
    </form>
    
</table>

