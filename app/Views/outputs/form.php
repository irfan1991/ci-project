<?php
$customer = isset($output) ? $output[0]['customer_name'] : "";
$time = isset($output) ? str_replace('`', '',$output[0]['waktu']) : "";
$v = isset($v) ? "readonly" : "";
$btn = isset($output) ? "Ubah" : "Simpan";
?>
<!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Transaction</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo base_url('/hello'); ?>">Dashboard</a></li>
              <li class="breadcrumb-item">Output</li>
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
                  <form action="<?php echo site_url($urlmethod) ?>" method="post"  enctype="multipart/form-data" id="my-form">
                   
                  <div class="form-group">
                      <label for="time">Time</label>
                      <input type="text" class="form-control" id="time"  aria-describedby="time"
                        value="<?php echo $time?>" readonly required>
                      <small id="time" class="form-text text-muted">Time data is updated.</small>
                    </div>

                  <div class="form-group">
                    <label for="select2Single">Customer</label>
                    <?php if ($v == "") { ?>

                      <select class="select2-single form-control"  name="customer_id"  
                      <?php echo $v; ?> required style="width:100%">
                        <option value="" selected>Choose Customer</option>
                          <?php  foreach ($customers as $row) { ?>
                            <option value="<?php echo $row["id"] ?>"><?php echo $row["customer_name"];  ?></option>
                          <?php }?>
                      </select>

                        <?php } else {?>

                      <p><?php echo $customer; ?></p>
                      
                    <?php } ?>
                  </div>

                  <div class="form-group">
                    <label for="tabledata">Products List</label>

                    <?php if ($v !== "") { ?>

                          <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                            <thead class="thead-light">
                              <tr>
                              <th>No</th>
                              <th>Product Name</th>
                              <th>Qty</th>
                              </tr>
                            </thead>
                            <tfoot>
                              <tr>
                              <th>No</th>
                              <th>Product Name</th>
                              <th>Qty</th>
                              </tr>
                            </tfoot>
                            <tbody>
                              
                              <?php 
                                $no = 1;
                                foreach ($output as $row) { ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $row['product_name']?></td>
                                        <td><?php echo $row['amount']?></td>
                                    </tr>
                                <?php }?>
                              
                          
                            </tbody>
                          </table>

                    <?php } else { ?>

                      <table class="table table-hover" id="databrg" required>
                          <thead>
                            <tr>
                              <th>Product Name</th>
                              <th>Qty</th>
                              <th><i class="fas fa-trash-o"></i></th>
                            </tr>
                          </thead>
                          <tbody></tbody>
                        </table>
                        <a class="btn btn-success" onClick="tambah()"><i class="fas fa-plus"></i> Tambah Baris</a>

                    <?php } ?>
                     
                        <br/>
                  </div>
                    <?php if ($v == "") { ?>
                      <button type="submit" class="btn btn-primary" ><?php echo $btn; ?></button>
                    <?php }?>
                    <a href="/output" class="btn btn-primary" >Kembali</a>
                  </form>
                </div>
              </div>
            </div>
        </div>

        <script>


          <?php if ($v === "") { ?>

              var products= <?= json_encode($products);?>;
              
              function tambah() {

                  var tbl = $('#databrg');
                  var lastRow = tbl.find("tr").length;
                  var idlast = lastRow -1;
                  var emptyrows = 0;
                       
                        for (i=idlast; i<lastRow; i++) {
                          if ($("#idbrg"+i).val() == '' || $("#qty"+i).val() == '' ) {
                            emptyrows += 1;
                          }
                        }

                
                        if (emptyrows == 0 ) {
                          
                          var opt = '';
                          var stock = parseInt($("#qty"+idlast).val());
                          var selectedBarang = parseInt($("#idbrg"+idlast).children("option:selected").attr('class'));
                         
                          $.each(products, function() {
                            opt += '<option value="' + this.product_id + '" id="myselect" class="'+this.product_stock+'">'+this.product_name+'</option>';
                          
                          });		

                          if( selectedBarang < stock ) {
                            
                              alert("Melebihi stok yang tersedia"); 

                            } else {
                                                    
                              var ddlBrg = '<select name="idbrg[]" id="idbrg'+lastRow+'" class="select2-single form-control " required>'+opt+'</select>';
                              var txtJml = '<input type="number" name="qty[]" class="form-control qty" id="qty'+lastRow+'" data-rule-required="true" data-rule-number="true"/>';
                              var trash = '<i class="fas fa-trash" onClick="hapus('+lastRow+')"></i>';
                              tbl.append("<tr id='tr"+lastRow+"'><td>"+ddlBrg+"</td><td align='right'>"+txtJml+"</td><td><center>"+trash+"</center></td></tr>");
                              var selectedVal = $('select[name="idbrg"] :selected').attr('class');
                              // var $select = $("#idbrg"+lastRow);
                              // var options = $select.data('select2');
                              // console.log($select);
                              // options.data = opt;
                              // $select.select2(options);
                              // var d = $("#idbrg"+lastRow).select2( {
                              //     placeholder: "Select",
                              //     allowClear: true
                              // } );

                             
                              $("#idbrg"+lastRow).change(function(){
                                var selectedBarang2 = parseInt($("#idbrg"+lastRow).children("option:selected").attr('class'));
                                  console.log(selectedBarang2);
                                    if (selectedBarang2 == 0) {
                                        alert("Stok Produk ini habis silahkan pilih yang lain");
                                        document.getElementById("qty"+lastRow).readOnly = true; 
                                    } else {
                                      document.getElementById("qty"+lastRow).readOnly = false;
                                        
                                    }
                                });

                            } 
                              
                        }  else  {
                            alert("Silahkan mengisi data pada baris yang tersedia terlebih dahulu, sebelum menambah baris");
                        }
                      
                  }
        
              function hapus(id){
                    $('#databrg #tr'+id).remove();
                  }	;
        
              document.getElementById('my-form').addEventListener("submit",function(e) {
                  
                    if ($('#databrg').find("td").length == 0) {
                      e.preventDefault(); 
                          alert(`Silahkan mengisi data produk`);
                              return false;
                        } else {
                              return true;
                    }
              });

        <?php } ?>
        
          
        </script>


  
