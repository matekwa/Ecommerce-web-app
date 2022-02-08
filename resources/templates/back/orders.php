
        <div class="col-md-12">
                <div class="row">
                    <?php display_message(); ?>
                    <h1 class="page-header">
                    Orders
                    </h1>
                </div>

                <div class="row">
                        <table class="table table-hover table-responsive table-stripped table-bordered">
                            <thead>
                                <tr>
                                    <th>Customer</th>
                                    <th>Product</th>
                                    <th>Seller</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Amount</th>
                                    <th>Order Status</th>
                                    <th>Product Preview</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php display_orders(); ?>
                            </tbody>
                        </table>
                </div>
        </div>
        <!-- /.container-fluid -->