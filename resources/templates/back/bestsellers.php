
<h1 class="page-header">Best Selling</h1>
	<?php display_message(); ?>
   <table class="table table-hover">
        <thead>
        <tr>
        <th>Product</th>
        <th>Current Stock</th>
         <th>Sold</th>
        </tr>
        </thead>
    <tbody>
                    <?php get_bestselling_to_admin(); ?>
    </tbody>
</table>
</table>
