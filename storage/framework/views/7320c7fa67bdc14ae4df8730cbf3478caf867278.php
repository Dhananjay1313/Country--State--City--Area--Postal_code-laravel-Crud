<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Area</title>

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

        <h1>Add Area</h1>
        <!-- Button trigger modal -->
<button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#modal">
    Add Area
  </button>
  
  
  
  <?php $__env->startSection('modal-area'); ?>
  <div class="modal-header">
    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Area</h1>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>
  <div class="modal-body">
    <form onsubmit="return false;" method="POST" id="form">
      <input type="hidden" name="hid" id="hid" value="">

      

      <div class="mt-3 mb-3">
        <label for="" class="mb-2">Country:</label>    
        <select class="form-select" name="country" id="countrySelect">
          <option value="" selected disabled>Select...</option>
          <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($country->id); ?>"><?php echo e($country->country); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select>
    </div>

    <div>
      <label for="" class="mb-2">State:</label> 
      <select class="form-select" name="state" id="state">
        <option value="" selected disabled>Select...</option>
        <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($state->id); ?>"><?php echo e($state->state); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    </div>

      <div>
          <label for="" class="mb-2">City:</label> 
          <select class="form-select" name="city" id="city">
            <option value="" selected disabled>Select...</option>
            <?php $__currentLoopData = $citys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($city->id); ?>"><?php echo e($city->city); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
        </select> 
      </div>

      <div>
        <label for="" class="mb-2">Area:</label> 
        <input type="text" name="area" id="area" value="" class="form-control">
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
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>
  <?php $__env->stopSection(); ?>

  <!-- Modal -->
  

<table class="table table-striped table-hover" id="table">
    <thead>
        <tr>
            <th>Country</th>
            <th>State</th>
            <th>City</th>
            <th>Area</th>
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
                state:"required",
                city:"required",
                area:"required",
                status:"required"   
            }, 
            messages: {
                country: {
                    required: "Please select country!"
                },
                state: {
                    required: "Please select state!"
                },
                city: {
                    required: "Please select city!"
                },
                area: {
                    required: "Please Enter area!"
                },
                status: {
                    required: "Please select status!"
                }
            }
        });

        $("#form").submit(function(){
        $.ajax({
            type:'POST',
            url:'/addarea',
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
                $('#table').DataTable().ajax.reload();
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

        $('#table').DataTable({
                destroy: true,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                ajax: {
                    url: '/listarea'
                },
                columns: [{data: "country"},
                    {data: "state"},
                    {data: "city"},
                    {data: "area"},
                    {data: "status"},
                    {data: "action",
                    "orderable": false}
                ]
        });

    $(document).on("click","#edit",function(){
        var id = $(this).data("id");
        $.ajax({
            method:"GET",
            url:'/editarea',
            data:{id:id},
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(response){
                console.log(response);
                $("#modal").modal('show');
                $("#hid").val(response.id);
                $("#countrySelect").val(response.country);
            
                $.ajax({
                url: '/fetch-states',
                type: 'GET',
                data: { countryId: response.country },
                dataType: 'json',
                success: function(statesResponse) {
                    $('#state').empty().append('<option value="" selected disabled>Select...</option>');
                    $.each(statesResponse.states, function(index, state) {
                        $('#state').append('<option value="' + state.id + '">' + state.state + '</option>');
                    });
                    // Set the value of #state after populating the dropdown
                    $("#state").val(response.state);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });

            $.ajax({
                url: '/fetch-city',
                type: 'GET',
                data: { stateId: response.state },
                dataType: 'json',
                success: function(Response) {
                    $('#city').empty().append('<option value="" selected disabled>Select...</option>');
                    $.each(Response.citys, function(index, city) {
                        $('#city').append('<option value="' + city.id + '">' + city.city + '</option>');
                    });
                    // Set the value of #state after populating the dropdown
                    $("#city").val(response.city);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
                $("#area").val(response.area);
                $("#status").val(response.status);
            }
        });
    });
  

    $(document).on("click","#delete",function(){
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
            url:'/deletearea',
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
                console.log(response);
                $('#table').DataTable().ajax.reload();
            }
        });
                }
    });
  });

  $('#countrySelect').change(function() {
        var selectedCountryId = $(this).val();
        $.ajax({
            url: '/fetch-states',
            type: 'GET',
            data: { countryId: selectedCountryId },
            dataType: 'json',
            success: function(response) {
                $('#state').empty().append('<option value="" selected disabled>Select...</option>');
                $.each(response.states, function(index, state) {
                    $('#state').append('<option value="' + state.id + '">' + state.state + '</option>');
                });
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });

    $('#state').change(function() {
        var selectStateId = $(this).val();
        $.ajax({
            url: '/fetch-city',
            type: 'GET',
            data: { stateId: selectStateId },
            dataType: 'json',
            success: function(response) {
                $('#city').empty().append('<option value="" selected disabled>Select...</option>');
                $.each(response.citys, function(index, city) {
                    $('#city').append('<option value="' + city.id + '">' + city.city + '</option>');
                });
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });

});

function sendValue() {
        var state = $('#state').val();
        var countryValue = $('#country').val();
        var city = $("#city").val();
        var area = $("#area").val();
        // AJAX request to send the country value to the server
        $.ajax({
            url: "<?php echo e(route('storeArea')); ?>",
            method: 'POST',
            data: { state: state, city:city, area:area,
                country: countryValue, _token: '<?php echo e(csrf_token()); ?>' },
            success: function(response) {

            },
        });
    }

    // var mealsByCategory = {
    //     India: ["Gujarat", "Maharastra", "UP", "MP"],
    //     US: ["Florida", "Alaska", "Iowa", "New_Mexico"],
    // UK: ["England", "Scotland", "Cornwall", "Devon", "Essex"]
    // }

    // function changecat(value) {
    //     if (value.length == 0) {
    //         document.getElementById("state").innerHTML = "<option></option>";
    // } else {
    //         var catOptions = "<option value='' disabled selected>Select</option>";
    //         for (categoryId in mealsByCategory[value]) {
    //             catOptions += "<option>" + mealsByCategory[value][categoryId] + "</option>";
    //         }
    //         $("#state").html("");
    //         document.getElementById("state").innerHTML = catOptions;
    //     }
    // }

    // var state ={
    //   Gujarat :["Surendranagar","Vadodara","Bhavnagar","Ahmedabad"],
    //   Maharastra :["Pune","Nagpur","Mumbai","Thane"],
    //   UP :["Lucknow","Varanasi","Agra","Delhi"],
    //   MP :["Bhopal","Indore","Jabalpur","Ujjain"],
    //   Florida :["Key West","Miami","Tampa","Orlando"],
    //   Alaska :["Anchorage","Fairbanks","Juneau","Nome"],
    //   Iowa:["Des Moines","Iowa City",],
    //   New_Mexico :["Albuquerque","Roswell","Las_Cruces","Rio_Rancho"],
    //   England :["London","Manchester","Leeds","Birmingham"],
    //   Scotland :["Glasgow","Edinburgh","Dundee","Aberdeen"],
    //   Cornwall:["Newquay, Penzance & St Ives"],
    //   Devon:["Exeter","Plymouth","Torbay","Cornwall"],
    //   Essex:["Chelmsford","Colchester","Hartlepool","Walthamstow"]
    // }
    // function changestate(value) {
    //     if (value.length == 0) {
    //         document.getElementById("city").innerHTML = "<option></option>";
    // } else {
    //         var catOptions = "<option value='' disabled selected>Select</option>";
    //         for (categoryId in state[value]) {
    //             catOptions += "<option>" + state[value][categoryId] + "</option>";
    //         }
    //         $("#city").html("");
    //         document.getElementById("city").innerHTML = catOptions;
    //     }
    // }

//     function changecat(value) {
// var states = <?php echo json_encode($states); ?>;
//     }

//     function changecat(value) {
// var countries = <?php echo json_encode($countries); ?>;
//     }
    </script>
</body>
</html>
<?php echo $__env->make('modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\country_code\resources\views/area.blade.php ENDPATH**/ ?>