<div class="col-lg-12">
        <h1 class="page-header">
        Users
        </h1>
            <p class="bg-success"></p>
        <a href="../../public/admin/index.php?add_user" class="btn btn-primary">Add User</a>
        <div class="col-md-12">
            <table class="table table-hover">
                     <thead>
                        <tr>
                            <th>Id</th>
                            <th>Photo</th>
                            <th>Username</th>
                            <th>Gender</th>
                            <th>Email</th>
                            <th>Country</th>
                        </tr>
                    </thead>
                    <tbody>
                   <?php get_users_to_admin();?>
                </tbody>
            </table> <!--End of Table-->
        </div>
</div>
