 <!-- Container Fluid-->
 <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Products</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo base_url('/hello'); ?>">Dashboard</a></li>
              <li class="breadcrumb-item">Category</li>
              <li class="breadcrumb-item active" aria-current="page"><?php echo $arr; ?></li>
            </ol>
          </div>

          <!-- Row -->
          <div class="row">
            <!-- DataTable with Hover -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary"><?php echo $title; ?></h6>
                  <a href="/category/add" class="btn btn-success pull-right"> Add Data</a>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                      <th>No</th>
                      <th>Category Name</th>
                      <th>Status</th>
                      <th>Action</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                      <th>No</th>
                      <th>Category Name</th>
                      <th>Status</th>
                      <th>Action</th>
                      </tr>
                    </tfoot>
                    <tbody>
                      
                      <?php 
                        $no = 1;
                        foreach ($categories as $row) { ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $row['category_name']?></td>
                                <td><?php echo ($row['category_status'] == 'Active' ) ? 'Active' : 'Inactive' ?></td>
                                <td><a class="btn btn-warning" href="/category/edit/<?php echo $row['id'] ?>"><i class="fas fa-pen"></i></a>
                                    <a  class="btn btn-info" href="/category/view/<?php echo $row['id'] ?>"><i class="fas fa-eye"></i></a>
                                    <button  class="btn btn-danger remove" id="<?php echo $row['id']?>" type="submit" value="<?php echo $row['id']?>">
                                    <i class="fas fa-trash"></i> </button>
                                </td>
                            </tr>
                        <?php }?>
                      
                   
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!--Row-->

        </div>
        <!---Container Fluid-->
      </div>

      

<script type="text/javascript">

$(".remove").click(function(){

  var id = $(this).val();
console.log(id);

   swal({ title: "Are you sure?",
            text: "You will not be able to recover this imaginary file!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: true,
            closeOnCancel: true

  },

  function(isConfirm) {
    if (isConfirm) {

      $.ajax({
        url: '/category/delete/'+id,
        type: 'POST',
        error: function() {

            alert('Something is wrong');

         },

         success: function(data) {

            console.log(data);
            swal({ title: "Deleted!", text: "Your data has been deleted.", type: "success" }, function(){ location.reload(); });

         }});

    } else {
            swal("Cancelled", "Your imaginary file is safe :)", "error");

    }

  });

});



</script>