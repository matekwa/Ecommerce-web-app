                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Dashboard <small>Statistics Overview</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                 <!-- FIRST ROW WITH PANELS -->

                <!-- /.row -->
                <div class="row">

                     <div class="col-lg-4 col-md-6">
                        <div class="panel panel-skyblue">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-shopping-cart fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo count_all_records('orders'); ?></div>
                                        <div>New Orders!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="index.php?orders">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>


                    <div class="col-lg-2 col-md-6">
                        <div class="panel panel-yellowgreen">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-support fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo count_all_records('trending_products'); ?></div>
                                        <div>Trending Products!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="index.php?trending_products">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
          
                    <div class="col-lg-2 col-md-6">
                        <div class="panel panel-purple">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-tasks fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo count_all_records('newarrivals'); ?></div>
                                        <div>New Arrival Products!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="index.php?newarrivals">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-6">
                        <div class="panel panel-stealblue">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-tasks fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo count_all_records('partnered_products'); ?></div>
                                        <div>Partnered Products!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="index.php?partnered_products">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
            
                    
                    <div class="col-lg-2 col-md-6">
                        <div class="panel panel-firebrick">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-tasks fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo count_all_records('features'); ?></div>
                                        <div>Featured Products</div>
                                    </div>
                                </div>
                            </div>
                            <a href="index.php?featured_products">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>


                </div>
        
                <!-- /.row -->


                <!-- SECOND ROW WITH TABLES-->

                <div class="row">
                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Transactions Panel</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Order #</th>
                                                <th>Order Date</th>
                                                <th>Order Time</th>
                                                <th>Amount (KES)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $query = query("SELECT * FROM orders");
                                                confirm($query);
                                                while ($row = fetch_array($query)) {
                                                    $amount_paid = number_format($row["amount_to_pay"],2);
                                                    $o_number = $row["order_number"];
                                                    $o_status = $row['order_status'];

                                                    if ($o_status == 1) {
                                                        $order_number = "<span style='background:red;color:white;padding:5px'>".$o_number."</span>";
                                                    } else if ($o_status == 2){
                                                        $order_number = "<span style='background:orange;color:white;padding:5px'>".$o_number."</span>";
                                                    }else if ($o_status == 3){
                                                        $order_number = "<span style='background:blue;color:white;padding:5px'>".$o_number."</span>";
                                                    } else{
                                                         $order_number = "<span style='background:green;color:white;padding:5px'>".$o_number."</span>";
                                                    }
                                                    $order=<<<DELIMETER
                                                        <tr>
                                                            <td>{$order_number}</td>
                                                            <td>{$row["order_date"]}</td>
                                                            <td>{$row["order_time"]}</td>
                                                            <td>{$row["amount_to_pay"]}</td>
                                                        </tr>
                                                    DELIMETER;
                                                    echo $order;
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-right">
                                    <a href="#">View All Transactions <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>







                     <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Transactions Panel</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Order #</th>
                                                <th>Order Date</th>
                                                <th>Order Time</th>
                                                <th>Amount (KES)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $query = query("SELECT * FROM orders");
                                                confirm($query);
                                                while ($row = fetch_array($query)) {
                                                    $amount_paid = number_format($row["amount_to_pay"],2);
                                                    $order=<<<DELIMETER
                                                        <tr>
                                                            <td>{$row["order_number"]}</td>
                                                            <td>{$row["order_date"]}</td>
                                                            <td>{$row["order_time"]}</td>
                                                            <td>{$row["amount_to_pay"]}</td>
                                                        </tr>
                                                    DELIMETER;
                                                    echo $order;
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-right">
                                    <a href="#">View All Transactions <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
