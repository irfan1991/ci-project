<?php

$id = isset($user) ? $user->id : "";
$first_name = isset($user) ? $user->first_name : "";
$last_name = isset($user) ? $user->last_name : "";
$email = isset($user) ? $user->email : "";
$password = isset($user) ? $user->password : "";
$v = isset($v) ? "readonly" : "";
$btn = isset($user) ? "Ubah" : "Simpan";
?>
<!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">User Management</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo base_url('/hello'); ?>">Dashboard</a></li>
              <li class="breadcrumb-item">User Management</li>
              <li class="breadcrumb-item active" aria-current="page"><?php echo $arr; ?></li>
            </ol>
          </div>
       
       <div class="row">
            <div class="col-lg-12">
              <!-- Form Basic -->
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary"><?php echo $title; ?></h6>
                </div>
                <div class="card-body">
                  <form action="<?php echo site_url($urlmethod) ?>" method="post"  enctype="multipart/form-data">
                  <input type="hidden" name="id" value="<?php echo $id; ?>">  
                  <input type="hidden" name="passwordhint" value="<?php echo $password; ?>"> 
                  
                  <div class="form-group">
                      <label for="first_name">First Name</label>
                      <input type="text" class="form-control" id="first_name" name="first_name" aria-describedby="first_name"
                        placeholder="Enter First Name" value="<?php echo $first_name?>" <?php echo $v; ?> required>
                      <small id="first_name" class="form-text text-muted">Input first name  properly.</small>
                    </div>

                    <div class="form-group">
                      <label for="last_name">Last Name</label>
                      <input type="text" class="form-control" id="last_name" name="last_name" aria-describedby="last_name"
                        placeholder="Enter Last Name" value="<?php echo $last_name?>" <?php echo $v; ?> required>
                      <small id="first_name" class="form-text text-muted">Input last name  properly.</small>
                    </div>

                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" class="form-control" id="email" name="email" aria-describedby="email"
                        placeholder="Enter Email" value="<?php echo $email?>" <?php echo $v; ?> required>
                      <small id="email" class="form-text text-muted">Input email properly.</small>
                    </div>

                    <div class="form-group">
                      <label for="password">Password</label>
                      <input type="password" class="form-control" id="password" name="password" aria-describedby="password"
                        placeholder="Enter Password"  <?php echo $v; ?> required>
                      <small id="password" class="form-text text-muted">Input password properly.</small>
                    </div>


                    <div class="form-group">
                    <label for="select2Multiple">Role Akses</label>
                    <select class="select2-multiple form-control" name="roles[]" multiple="multiple"
                      id="select2Multiple">
                      <option value="">Select Role</option>
                      <option value="Aceh">Aceh</option>
                      </select>
                    </div>
                
                    <?php if ($v == "") { ?>
                      <button type="submit" class="btn btn-primary"><?php echo $btn; ?></button>
                    <?php }?>
                    <a href="/user" class="btn btn-primary" >Kembali</a>
                  </form>
                </div>
              </div>
            </div>
        </div>


  
