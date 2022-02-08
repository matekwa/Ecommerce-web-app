
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
                                    <th>Name</th>
                                    <th>Location</th>
                                    <th>Region</th>
                                    <th>Town</th>
                                    <th>Supply Category</th>
                                    <th>Payment Method</th>
                                    <th>Phone number</th>
                                    <th>Account Number</th>
                                    <th>Bank</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php display_suppliers(); ?>
                            </tbody>
                        </table>
                </div>
        </div>
        <!-- /.container-fluid -->