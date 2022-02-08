
<h1 class="page-header">Partnered Products</h1>
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
                    <?php get_partnered_products_to_admin(); ?>
    </tbody> 
    <form method="POST">
        <?php add_partnered_product(); ?>
         <input type="submit" name="add_partnered_product" value="Add New Partnered Product" class="btn btn-info">
    </form>
    
</table>

