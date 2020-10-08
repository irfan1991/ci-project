
<!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Entity</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo base_url('/hello'); ?>">Dashboard</a></li>
              <li class="breadcrumb-item">Customer</li>
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
                    <div class="form-group">
                    <label class="custom-file-label" for="customFile" id="setFile">Choose file For Excel</label>
                        <input type="file" class="custom-file-input" id="customFile" name="trx_file" onchange="ValidateSingleInput(this);" 
                        aria-describedby="lati">
                        <button type="submit" class="btn btn-primary">Import</button>
                    <a href="/customer" class="btn btn-primary" >Kembali</a>
                    </div>
                      
                  </form>
                </div>
              </div>
            </div>
        </div>

        <script>
    var _validFileExtentions = [".xls",".xlsx"];
    function ValidateSingleInput(params) {
      $('#setFile').text(params.value);
        if (params.type == "file") {
            var sFileName = params.value;
            if (sFileName.length > 0) {
              
        console.log(params.value);
                var blnValid = false;
                for (let index = 0; index < _validFileExtentions.length; index++) {
                    const element = _validFileExtentions[index];
                    if (sFileName.substr(sFileName.length - element.length , element.length).toLowerCase() 
                    ==  element.toLowerCase()) 
                    {
                        blnValid = true;
                        break;    
                    }
                }
            } 

            if (!blnValid) {
                alert("Sorry, "+ sFileName + "that's extention is not allowed: "+ 
                _validFileExtentions.join(", "));
                params.value = "";
                return false;
            }
        }

        
    }
    </script>