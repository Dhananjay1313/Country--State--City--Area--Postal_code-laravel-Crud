<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>State</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/jquery.dataTables.min.css"
    integrity="sha512-1k7mWiTNoyx2XtmI96o+hdjP8nn0f3Z2N4oF/9ZZRgijyV4omsKOXEnqL1gKQNPy2MTSP9rIEWGcH/CInulptA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.2/dist/jquery.min.js"></script>

</head>
<style>
    .error {
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

        <h1>Add State</h1>
        <!-- Button trigger modal -->
<button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#modal">
    Add State
  </button>

  
  
  <?php $__env->startSection('modal-state'); ?>
  <div class="modal-header">
    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Country</h1>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>
  <div class="modal-body">
    <form onsubmit="return false;" method="POST" id="form" >
      <input type="hidden" id="hid" name="hid" value="">
  
      <div class="mt-3 mb-3">
          <label for="" class="mb-2">Country:</label>    
          <select class="form-select" name="country" id="countrySelect">
            <option value="" selected disabled>Select...</option>
            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($country->id); ?>"><?php echo e($country->country); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
      </div>

      <div >
          <label for="">State:</label>
          <input type="text" name="state" id="state" class="form-control">
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

  
  
<table class="table table-striped table-hover" id="tabledata">
    <thead>
        <tr>
            <th>Country</th>
            <th>State</th>
            <th>status</th>
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
                state:"required",
                status:"required"   
            }, 
            messages: {
                country: {
                    required: "Please select country!"
                },
                state: {
                    required: "Please Enter state!"
                },
                status: {
                    required: "Please select status!"
                }
            }
        });

        $("#form").submit(function(){

        $.ajax({
            type:'POST',
            url:'/addstate',
            cache: false,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: new FormData(this),
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
                $('#tabledata').DataTable().ajax.reload();
                $("#hid").val("");
            }
            });
        });

        $("#modal").on("hidden.bs.modal", function() {
            $('#form').trigger("reset");
            $('#form').validate().resetForm();
            // Remove validation rules and error messages
            $('#form').find('.error').removeClass('error');
            $('#form').find('.is-invalid').removeClass('is-invalid');
            $('#form').find('.valid').removeClass('valid');
            $('#form').find('.is-valid').removeClass('is-valid');
    });

        $('#tabledata').DataTable({
                destroy: true,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                ajax: {
                    url: '/liststate'
                },
                columns: [{data: "country"},
                    {data: "state"},
                    {data: "status"},
                    {data: "action",
                    "orderable": false}
                ]
        });

    $(document).on("click","#edit_id",function(){
        var id = $(this).data("id");
        $.ajax({
            method:"GET",
            url:'/editstate',
            data:{id:id},
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(response){
                $("#modal").modal('show');
                $("#hid").val(response.id);
                $("#countrySelect").val(response.country);
                $("#status").val(response.status);
                $('#state').val(response.state);
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
            url:'/deletestate',
            data:{id:id},
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            success:function(response){
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success"
                        });
                $('#tabledata').DataTable().ajax.reload();
                }
            });
        }
    });
});



});

//    var countries = <?php echo json_encode($countries); ?>;

//     function changecat(value) {
//         if (value.length == 0) {
//             $("#countrySelect").html("<option></option>");
//     } else {
//             var catOptions = "<option value='' disabled selected>Select</option>";
//             for (categoryId in countries[value]) {
//                 catOptions += "<option>" + countries[value][categoryId] + "</option>";
//             }
// $("#countrySelect").html("");

//             $("#countrySelect").html(catOptions);
//         }
//     }

// function changecat(value) {
// var countries = <?php echo json_encode($countries); ?>;
// console.log(countries);
// }

function sendValue() {
        var state = $('#state').val();
        var countryValue = $('#country').val();
        
        // AJAX request to send the country value to the server
        $.ajax({
            url: "<?php echo e(route('storeState')); ?>",
            method: 'POST',
            data: { state: state,
                country: countryValue, _token: '<?php echo e(csrf_token()); ?>' },
            success: function(response) {
            },
        });
}
    </script>
</body>
</html>
<?php echo $__env->make('modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\country_code\resources\views/state.blade.php ENDPATH**/ ?>