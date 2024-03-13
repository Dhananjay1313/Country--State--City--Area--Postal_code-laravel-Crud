<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Country</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/jquery.dataTables.min.css"
    integrity="sha512-1k7mWiTNoyx2XtmI96o+hdjP8nn0f3Z2N4oF/9ZZRgijyV4omsKOXEnqL1gKQNPy2MTSP9rIEWGcH/CInulptA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.2/dist/jquery.min.js"></script>

</head>
<style>
.error{
    color: red;
}
</style>
<body>
    <div class="container mt-5">

        <a href="/" class="btn btn-warning">Main Page</a>
        <a href="/country" class="btn btn-warning">Country</a>
        <a href="/state" class="btn btn-warning">State</a>
        <a href="/city" class="btn btn-warning">City</a>
        <a href="/area" class="btn btn-warning">Area</a>
        <a href="/postal" class="btn btn-warning">Postal</a>

        <h1>Add Country</h1>
        

    <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#modal">
        Add Country
    </button>

    

        <?php $__env->startSection('modal-content'); ?>
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Country</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form onsubmit="return false;" method="POST" id="form" >
              <input type="hidden" id="hid" name="hid" value="">
          
              <div class="mt-3 mb-3">
                  <label for="" class="mb-2">Country:</label>    
                  <input type="text" name="country" id="country" value="" class="form-control">
  
              </div>
  
              <div>
                  <label for="" class="mb-2">Status:</label> 
                  <select class="form-select" id="status" name="status" aria-label="Default select example">
                      <option selected disabled>select...</option>
                      <option value="Active">Active</option>
                      <option value="Inactive">Inactive</option>
                    </select>
              </div>
          
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" onclick="sendValue()">Submit</button>
          </div>
      </form>
        <?php $__env->stopSection(); ?>
  
<table class="table table-striped  table-hover" id="table">
    <thead>
        <tr>
            <th>Country</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
    </div>

    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>

$(document).ready(function(){

    $('#form').validate({
            rules: {
                country:"required",
                status:"required"   
            }, 
            messages: {
                country: {
                    required: "Please select country!"
                },
                status: {
                    required: "Please select status!"
                }
            }
    });
    
    $("#form").submit(function(){
        var formData = new FormData(this);
        var data = {country: $('#country').val()};

        // Merge the two objects
        Object.keys(data).forEach(function(key) {
            formData.append(key, data[key]);
        });
        $.ajax({
            type:'POST',
            url:'/addcountry',
            cache: false,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:formData,
            success:function(data){
                if (data.status == "1") {
                      Swal.fire({
                        text: data.message,
                        icon: "success",
                        confirmButtonColor: "#00FFFF"
                      });
                      } else {
                        Swal.fire({
                          title: data.message,
                          icon: "error"
                        });
                      }
                $("#modal").modal('hide');
                $('#form').trigger("reset");
                $('#table').DataTable().ajax.reload();
                $("#hid").val("");

            }
        });
    });

    $("#modal").on("hidden.bs.modal", function() {
            $('#form').trigger("reset");
            $('#form').validate().resetForm();
            $('#form').find('.error').removeClass('error');
            $('#form').find('.is-invalid').removeClass('is-invalid');
            $('#form').find('.valid').removeClass('valid');
            $('#form').find('.is-valid').removeClass('is-valid');
            // $(this).off('hidden.bs.modal');
            // $('#form').validator('destroy');
    });
    
    $('#table').DataTable({
                destroy: true,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                ajax: {
                    url: '/listcountry'
                },
                columns: [{data: "country"},
                    {data: "status"},
                    {data: "action",
                    "orderable": false}
                ]
            });
            
    $(document).on("click","#edit_id",function(){
        var id = $(this).data("id");
        $.ajax({
            method:"GET",
            url:'/editcountry',
            data:{id:id},
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            success:function(response){
                console.log(response);
                $("#modal").modal('show');
                $("#hid").val(response.id);
                $("#country").val(response.country);
                $("#status").val(response.status);
                // $("#status").append("<option value='-1'>Delete</option>");
                // $("#status").html("<option value='-1'>Delete</option>");
                // if (!document.getElementById("status").querySelector("option[value='-1']")) {
                //     // Create a new option element
                //     var option = document.createElement("option");

                //     // Set the value and text of the option
                //     option.value = "-1";
                //     option.text = "Delete";

                //     // Add the option to the select element
                //     document.getElementById("status").add(option);
                // }
            }
        });
    });

    $(document).on("click","#delete_id",function(){
        var id = $(this).data("id");
        Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to get this back!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#000080",
                cancelButtonColor: "#DC143C",
                confirmButtonText: "Yes, remove it!"
              }).then((result) => {
                if (result.isConfirmed) {
                $.ajax({
                    method:"POST",
                    url:'/deletecountry',
                    data:{id:id},
                    headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                    success:function(response){
                        console.log(response);
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success"
                        });
                        $('#table').DataTable().ajax.reload();
                    }
                });
                }
              });
        
    });
        });

    function sendValue() {
        var countryValue = $('#country').val();
        $.ajax({
            url: "<?php echo e(route('storeCountry')); ?>",
            method: 'POST',
            data: { country: countryValue, _token: '<?php echo e(csrf_token()); ?>' },
            success: function(response) {
                console.log(response);
            },
        });
    }
    </script>
</body>
</html>
<?php echo $__env->make('modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\country_code\resources\views/country.blade.php ENDPATH**/ ?>