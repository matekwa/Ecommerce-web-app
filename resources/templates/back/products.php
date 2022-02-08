
<h1 class="page-header">
All Products
</h1>
<?php display_message(); ?>
<table class="table table-hover">
        <thead>
        <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Category</th>
        <th>Brand</th>
        <th>Collection</th>
        <th>Stock Qty.</th>
        <th>Qty. Out</th>
        <th>Price</th>
        </tr>
        </thead>
    <tbody>
                    <?php get_products_to_admin(); ?>
    </tbody>
</table>
