<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Area</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/jquery.dataTables.min.css"
    integrity="sha512-1k7mWiTNoyx2XtmI96o+hdjP8nn0f3Z2N4oF/9ZZRgijyV4omsKOXEnqL1gKQNPy2MTSP9rIEWGcH/CInulptA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.2/dist/jquery.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <a href="/country" class="btn btn-warning">Country</a>
        <a href="/state" class="btn btn-warning">State</a>
        <a href="/city" class="btn btn-warning">City</a>
        <a href="/area" class="btn btn-warning">Area</a>

        {{-- <h1>Add Data</h1>
        <!-- Button trigger modal -->
<button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#modal">
    Add Data
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Add Data</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form onsubmit="return false;" method="POST" id="form">
            <input type="hidden" name="hid" id="hid" value="">

            <div class="mt-3 mb-3">
              <label for="" class="mb-2">Country:</label>    
              <select class="form-select" name="country" id="country" onChange="changecat(this.value);">
                <option selected disabled>Select...</option>
                <option value="India">India</option>
                <option value="US">US</option>
                <option value="UK">UK</option>
              </select>
          </div>

          <div>
            <label for="" class="mb-2">State:</label> 
            <select class="form-select" name="state" id="state" onChange="changestate(this.value);">
                    <option value="" disabled selected>Select</option>
                  </select>
          </div>

            <div>
                <label for="" class="mb-2">City:</label> 
                <select class="form-select" name="city" id="city" onChange="changearea(this.value);">
                  <option value="" disabled selected>Select</option>
                </select>
            </div>

            <div>
              <label for="" class="mb-2">Area:</label> 
              <select class="form-select" name="area" id="area">
                <option value="" disabled selected>Select</option>
              </select>
            </div>

            <div>
                <label for="" class="mb-2">Status:</label> 
                <select class="form-select" id="status" name="status" aria-label="Default select example">
                    <option selected disabled>select...</option>
                    <option value="0">Active</option>
                    <option value="1">Inactive</option>
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
  </div>
<table class="table table-striped table-hover" id="table">
    <thead>
        <tr>
            <th>Country</th>
            <th>State</th>
            <th>City</th>
            <th>Area</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table> --}}
    </div>
    {{-- <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>

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
                $("#modal").modal('hide');
                $('#form').trigger("reset");
                $('#table').DataTable().ajax.reload();
                $("#hid").val("");
            }
            });
        });

        $("#modal").on("hidden.bs.modal", function() {
                $('#form').trigger("reset");
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
                    // {data: "status"},
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
                $("#country").val(response.country);
                $("#status").val(response.status);
                changecat(document.getElementById("country").value);
                $('#state').val(response.state); 
                changestate(document.getElementById("state").value)
                $("#city").val(response.city);
                $("#area").val(response.area);
            }
        });
    });
  

    $(document).on("click","#delete",function(){
      
        var id = $(this).data("id");
        $.ajax({
            method:"POST",
            url:'/deletearea',
            data:{id:id},
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            success:function(response){
                console.log(response);
                $('#table').DataTable().ajax.reload();
            }
        });
    });

});

    var mealsByCategory = {
        India: ["Gujarat", "Maharastra", "UP", "MP"],
        US: ["Florida", "Alaska", "Iowa", "New_Mexico"],
    UK: ["England", "Scotland", "Cornwall", "Devon", "Essex"]
    }

    function changecat(value) {
        if (value.length == 0) {
            document.getElementById("state").innerHTML = "<option></option>";
    } else {
            var catOptions = "<option value='' disabled selected>Select</option>";
            for (categoryId in mealsByCategory[value]) {
                catOptions += "<option>" + mealsByCategory[value][categoryId] + "</option>";
            }
            $("#state").html("");
            document.getElementById("state").innerHTML = catOptions;
        }
    }

    var state ={
      Gujarat :["Surendranagar","Vadodara","Bhavnagar","Ahmedabad"],
      Maharastra :["Pune","Nagpur","Mumbai","Thane"],
      UP :["Lucknow","Varanasi","Agra","Delhi"],
      MP :["Bhopal","Indore","Jabalpur","Ujjain"],
      Florida :["Key_West","Miami","Tampa","Orlando"],
      Alaska :["Anchorage","Fairbanks","Juneau","Nome"],
      Iowa:["Des_Moines","Iowa_City",],
      New_Mexico :["Albuquerque","Roswell","Las_Cruces","Rio_Rancho"],
      England :["London","Manchester","Leeds","Birmingham"],
      Scotland :["Glasgow","Edinburgh","Dundee","Aberdeen"],
      Cornwall:["Newquay, Penzance & St Ives"],
      Devon:["Exeter","Plymouth","Torbay","Cornwall"],
      Essex:["Chelmsford","Colchester","Hartlepool","Walthamstow"]
    }
    function changestate(value) {
        if (value.length == 0) {
            document.getElementById("city").innerHTML = "<option></option>";
    } else {
            var catOptions = "<option value='' disabled selected>Select</option>";
            for (categoryId in state[value]) {
                catOptions += "<option>" + state[value][categoryId] + "</option>";
            }
            $("#city").html("");
            document.getElementById("city").innerHTML = catOptions;
        }
    }

    var area = {
      Surendranagar = ["Limbdi","Patdi","Chotila"],
      Vadodara = ["Ampad","Bakrol","Dodka"],
      Bhavnagar = ["Akwada","Bhojpara","Kamlej"],
      Ahmedabad = ["Bopal","Maninagar","Satelete"],
      Pune = ["Gondhale Nagar","Viman Nagar"],
      Nagpur = ["Dattawadi","Dawlameti","Midc Nagpur"],
      Mumbai = ["Agripada","Andheri","Colaba"],
      Thane = ["Dahisar","Diwa","Kausa"],
      Lucknow = ["Alamnagar","Amausi","Kakori"],
      Varanasi = ["39 Gtd","Balua","Daipur"],
      Agra = ["C.o.d.","Deori","Gutila"],
      Delhi = ["Hauz Qazi","Jama Masjid"],
      Bhopal = ["Bagroda","Basai","Fanda"],
      Indore = ["Dudhia","Kampel","Jhalaria"],
      Jabalpur = ["Baghwan","Palash","Shikarpur"],
      Ujjain = ["Badoda","Baroda","Indore"],
      Key_West = ["Fleming key","New Town","Stock Island"],
      Miami = ["Rayado","Cimarron","Colfax"],
      Tampa = ["Downtown Tampa","St. Petersburg","Seminole Heights"],
      Orlando = ["RV Park","Lawnview Cemetery","McGuire Cemetery"],
      Anchorage = ["Hillside","Green Acres","Dimond"],
      Fairbanks = ["Aurora","Lemeta","Totem Park"],
      Juneau = ["Douglas Island","Mansfield Peninsula","Admiralty Island"],
      Nome = ["Katmia","Bristal bay","Kodiak"],
      Des_Moines = ["Le Mars","Storm Lake","Spencser"],
      Iowa_City = ["Mason City","waverly","waterloo"],
      Albuquerque = ["Eastside","Westside","Alemeda"],
      Roswell = ["Carlsbad","Ruidoso","Artisea"],
      Las_Cruces =  ["Northwest","Central New Mexico","Southwest"],
      Rio_Rancho =  ["Los Alamos","El Paso","Valencia"],
      London =  ["Camden","Peckham","Willesden"],
      Manchester  =  ["Old Trafford","Oxford Road","George Best"],
      Leeds =   ["Heathrow Terminal 2","Whitchurch","Holbeck"],
      Birmingham  =["Solihull Moors","St Andrews","Aston Villa"],

    }
    </script> --}}
</body>
</html>