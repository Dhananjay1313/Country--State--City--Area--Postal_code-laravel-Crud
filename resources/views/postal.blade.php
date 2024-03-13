<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Postal</title>

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

        <h1>Add Postal</h1>
<button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#modal">
    Add Postal
  </button>

  @extends('modal')
  
  @section('modal-postal')
  <div class="modal-header">
    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Postal</h1>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>
  <div class="modal-body">
    <form onsubmit="return false;" method="POST" id="form">
      <input type="hidden" name="hid" id="hid" value="">

      <div class="mt-3 mb-3">
        <label for="" class="mb-2">Country:</label>    
        <select class="form-select" name="country" id="countrySelect">
          <option value="" selected disabled>Select...</option>
          @foreach ($countries as $country)
              <option value="{{ $country->id }}">{{ $country->country }}</option>
          @endforeach
      </select>
    </div>

    <div>
      <label for="" class="mb-2">State:</label> 
      <select class="form-select" name="state" id="state">
        <option value="" selected disabled>Select...</option>
        @foreach ($states as $state)
            <option value="{{ $state->id }}">{{ $state->state }}</option>
        @endforeach
    </select>
    </div>

      <div>
          <label for="" class="mb-2">City:</label> 
          <select class="form-select" name="city" id="city">
            <option value="" selected disabled>Select...</option>
            @foreach ($citys as $city)
                <option value="{{ $city->id }}">{{ $city->city }}</option>
            @endforeach 
        </select> 
      </div>

      <div>
          <label for="" class="mb-2">Area:</label> 
          <select class="form-select" name="area" id="area">
            <option value="" selected disabled>Select...</option>
            @foreach ($areas as $area)
                <option value="{{ $area->id }}">{{ $area->area }}</option>
            @endforeach 
        </select> 
      </div>

      <div>
          <label for="" class="mb-2">Postal:</label>
          <input type="number" id="postal" name="postal" value="" class="form-control">
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
  @endsection
  
  {{-- <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Add Postal</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form onsubmit="return false;" method="POST" id="form">
            <input type="hidden" name="hid" id="hid" value="">

            <div class="mt-3 mb-3">
              <label for="" class="mb-2">Country:</label>    
              <select class="form-select" name="country" id="countrySelect">
                <option value="" selected disabled>Select...</option>
                @foreach ($countries as $country)
                    <option value="{{ $country->id }}">{{ $country->country }}</option>
                @endforeach
            </select>
          </div>

          <div>
            <label for="" class="mb-2">State:</label> 
            <select class="form-select" name="state" id="state">
              <option value="" selected disabled>Select...</option>
              @foreach ($states as $state)
                  <option value="{{ $state->id }}">{{ $state->state }}</option>
              @endforeach
          </select>
          </div>

            <div>
                <label for="" class="mb-2">City:</label> 
                <select class="form-select" name="city" id="city">
                  <option value="" selected disabled>Select...</option>
                  @foreach ($citys as $city)
                      <option value="{{ $city->id }}">{{ $city->city }}</option>
                  @endforeach 
              </select> 
            </div>

            <div>
                <label for="" class="mb-2">Area:</label> 
                <select class="form-select" name="area" id="area">
                  <option value="" selected disabled>Select...</option>
                  @foreach ($areas as $area)
                      <option value="{{ $area->id }}">{{ $area->area }}</option>
                  @endforeach 
              </select> 
            </div>

            <div>
                <label for="" class="mb-2">Postal:</label>
                <input type="number" id="postal" name="postal" value="" class="form-control">
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
      </div>
    </div>
  </div> --}}
<table class="table table-striped table-hover" id="table">
    <thead>
        <tr>
            <th>Country</th>
            <th>State</th>
            <th>City</th>
            <th>Area</th>
            <th>Postal</th>
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
                status:"required",
                postal:"required"   
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
                    required: "Please select area!"
                },
                status: {
                    required: "Please select status!"
                },
                postal: {
                    required: "Please Enter postal code!"
                }
            }
        });

        $("#form").submit(function(){
        $.ajax({
            type:'POST',
            url:'/addpostal',
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
                    url: '/listpostal'
                },
                columns: [{data: "country"},
                    {data: "state"},
                    {data: "city"},
                    {data: "area"},
                    {data: "postal"},
                    {data: "status"},
                    {data: "action",
                    "orderable": false}
                ]
        });

    $(document).on("click","#edit_id",function(){
        var id = $(this).data("id");
        $.ajax({
            method:"GET",
            url:'/editpostal',
            data:{id:id},
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(response){
            // console.log(response);
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
                            $("#city").val(response.city);
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });

                    $.ajax({
                        url: '/fetch-area',
                        type: 'GET',
                        data: { cityId: response.city },
                        dataType: 'json',
                        success: function(Response) {
                            $('#area').empty().append('<option value="" selected disabled>Select...</option>');
                            $.each(Response.areas, function(index, area) {
                                $('#area').append('<option value="' + area.id + '">' + area.area + '</option>');
                            });
                            $("#area").val(response.area);
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                $("#postal").val(response.postal);
                // $("#area").val(response.area);
                $("#status").val(response.status);
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
                    url:'/deletepostal',
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
                    $('#city').append('<option value="' + city.id + '">' + city.city +  '</option>');
                });
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });

    $('#city').change(function() {
        var selectAreaId = $(this).val();
        $.ajax({
            url: '/fetch-area',
            type: 'GET',
            data: { cityId: selectAreaId },
            dataType: 'json',
            success: function(response) {
                $('#area').empty().append('<option value="" selected disabled>Select...</option>');
                $.each(response.areas, function(index, area) {
                    $('#area').append('<option value="' + area.id + '">' + area.area + '</option>');
                });
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
});
    </script>
</body>
</html>