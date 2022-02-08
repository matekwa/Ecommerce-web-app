<?php addUser(); ?>
 <div class="row">
          <div class="col-md-12">
            <form action="" method="post" enctype="multipart/form-data">
                   <div class="card ">
                       <div class="card-title mt-5">
                        <h2 class="text-white text-center">Add New User</h2>
                        </div>
                        <?php display_message(); ?>
                       <div class="card-body">
                        <div class="form-group">
                             <label for="Username">Username</label>
                           <input type="text" name="username" class="form-control">
                        </div>
                        <div class="form-group">
                             <label for="Email">Email</label>
                           <input type="email" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                             <label for="Username">Password</label>
                           <input type="Password" name="password" class="form-control">
                        </div>
                        <div class="form-group">
                             <label for="Gender">Gender</label>
                           <select class="form-control" name="gender">
                               <option value="">Male</option>
                               <option value="">Female</option>
                               <option value="">Other</option>
                           </select>
                        </div>
                         <div class="form-group">
                             <label for="Country">Country</label>
                           <input type="text" name="country" class="form-control">
                        </div>
                         <div class="form-group">
                             <label for="Active Status">Active Status</label>
                           <input type="number" name="active_status" class="form-control">
                        </div>
                         <div class="form-group">
                             <label for="user photo">User Photo</label>
                           <input type="file" name="photo" class="form-control">
                        </div>
                        <input type="submit" name="add_user" value="Add User" class="btn btn-info">
                       </div>
                   </div> 
            </form>
        </div>
</div>
 <!-- /.container-fluid -->
