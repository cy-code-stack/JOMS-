@extends('../base')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/global.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/customerlist.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/sidenavigation.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/customer/dashboard.css')}}">
<!--<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/jobreq.css')}}">-->
<link rel="stylesheet" type="text/css" href="{{ asset('css/customer/jobreq.css')}}">


<link rel='stylesheet' href='https://unpkg.com/leaflet@1.8.0/dist/leaflet.css' crossorigin='' />

<style>

#map {
    padding: 20px;
    box-sizing: border-box;
    width: 100%;
    height: 200px;
    margin-bottom: 20px;
}
    
    img {
        max-height: 100%;
    }
   
    .my-leaflet-map-container img {
        max-height: none;   
    }
    
    .content-location-form {
        width: 100%;
    }
    
    .input-flex {
        display: flex;
    }
    .content-location-form input {
    width: 100%;
    height: 2.5rem;
    margin-bottom: 5px;
    padding: 10px;
    border: .8px solid rgb(189, 188, 188) !important;
    border-radius: 2px;
    }
    
    .input-flex div:nth-child(1) {
    width: 100%;
    margin-right: 10px;
}

.input-flex div:nth-child(2) {
    width: 100%;

}

.content-location-form textarea{
    height:100px;
}
    
}

  
</style>
@endsection

@section('navbar')
    @include('includes/sidenavigation')
@endsection

@section('content')

<div class="main-content">
    <div class="top-nav">
        <div class="menu-wrapper">
            <label for="nav-toggle">
                <span class="la la-bars"></span>
            </label>
            <h4>Customer List</h4>
        </div>
        <div class="user-wrapper">
            @include('includes/profilepopup')          
        </div>
    </div>
   
    <div class="body-content">

  
        <!-- @if(Session::has('fail'))
            <div class="alert alert-danger">{{Session::get('fail')}}</div>
        @endif
        @if(Session::has('success'))
            <div class="alert alert-success">{{Session::get('success')}}</div>
        @endif -->
        <div class="main-table-content">
            <div class="table_header">
                <h2>Customer</h2>
                <div style="display: flex">
                    <input type='text' id="searchbar" placeholder="Search customer" style="margin-right:10px; padding:2px 5px; font-size:15px;"></input>
                    <button type="button" data-toggle="modal" data-target="#addCustomer" style="margin-right:10px">Add Customer</button>
                       <form method="POST" action="{{route('report-customer-info')}}">
                           @csrf
                            <button type="submit" >Generate PDF</button>
                     </form>
                </div>
            </div>
            <div class="table-body">
                <table class="table table-striped" width="100%">
                    <thead>
                        <tr>
                            <td scope="col">Account ID</td>
                            <td scope="col">Name</td>
                            <td scope="col">Address</td>
                            <td scope="col">Email</td>
                            <td scope="col">Customer Type</td>
                            <td scope="col">Status</td>
                            <td scope="col">Admin Created</td>
                            <td scope="col">Actions</td>
                        </tr>
                    </thead>
                    <tbody id="table-body" class="table-group-divider">
                        
                    @foreach ($customers as $customer)
                        <tr>
                            <td>{{ $customer->account_id }}</td>
                            <td>{{ $customer->first_name }} {{ $customer->last_name }}</td>
                            <td>{{ $customer->fullAdress }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->customerType }}</td>
                            <td> <div class="{{ $customer->verification }}">{{ $customer->verification }}</div></td>
                            <td>
                                @if($customer->adminCreated == 'Yes' )
                                    <p>Yes</p>
                                @else
                                    <p>No</p>
                                @endif
                            </td>
                            <td>
                                <div class="actions d-flex">                   
                                        <button type="button" data-toggle="modal" data-target="#viewjob-{{$customer->id}}"><span class="las la-eye"></span></button>      
                                    <form method="POST" id="form-{{$customer->id}}" action="{{ route('customer-delete', $customer->id) }}">
                                        @csrf 
                                        <button type="button" onclick="deleteConfirm(event)"><span class="las la-trash"></span></button>
                                    </form>  
                                    <div class="modal fade" id="viewjob-{{$customer->id}}" tabindex="-1" aria-hidden="true">
                                        <form method="POST" action="{{ route('customer-edit', $customer->id) }}">
                                        @csrf                      
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h3 class="modal-title">Customer Details</h3>
                                                   
                                                </div>                    
                                                <!-- Modal Body -->
                                                <div class="modal-body">
                                                
                                                    <div class="div-main-content">
                                                        <div class="div-content">
                                                            <p>Account:</p>
                                                        </div>
                                                        <div class="div-desc">
                                                            <p contenteditable="false">{{ $customer->account_id}}</p>
                                                        </div>
                                                    </div>
                                                    <div class="div-main-content">
                                                        <div class="div-content">
                                                            <p>Name:</p>
                                                        </div>
                                                        <div class="div-desc nameDesc">
                                                            <p  id="custFirstname" class="editable" contenteditable="false">{{$customer->first_name }}</p>
                                                            <p  id="custLastname" class="editable" contenteditable="false"> {{ $customer->last_name}}</p>
                                                        </div>
                                                    </div>
                                                    <div class="div-main-content">
                                                        <div class="div-content">
                                                            <p>Address:</p>
                                                        </div>
                                                        <div class="div-desc jobTypeClass">
                                                            <p id="custAddress" class="editable" contenteditable="false">{{$customer->fullAdress}}</p> 
                                                        </div>
                                                    </div>

                                                    <div class="div-main-content">
                                                        <div class="div-content">
                                                            <p>Email:</p>
                                                        </div>
                                                        <div class="div-desc">
                                                            <p id="custEmail" class="editable" contenteditable="false">{{$customer->email}}</p>
                                                        </div>
                                                    </div>
                                                    <div class="div-main-content">
                                                        <div class="div-content">
                                                            <p>Mobile:</p>
                                                        </div>
                                                        <div class="div-desc">
                                                            <p id="custMobile" class="editable" contenteditable="false">{{$customer->mobile_number}}</p>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="div-main-content forinputContent">
                                                        <div class="div-content">
                                                            <p id="custMobile" class="editable" contenteditable="false">Client Type :</p>
                                                        </div>
                                                        <div class="div-desc">
                                                            <p id="custTypeText" class="custTypeText">{{$customer->customerType}}</p>
                                                            <select name="custType" class="custType" id="custType" style="display:none" required> 
                                                                <option value="{{$customer->customerType}}" disabled selected>{{$customer->customerType}}</option>
                                                                <option value="Consignee">Consignee</option>
                                                                <option value="Subscriber">Subscriber</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="div-main-content">
                                                        <div class="div-content">
                                                            <p>Date Created:</p>
                                                        </div>
                                                        <div class="div-desc">
                                                            <p contenteditable="false">{{date('d-m-y h:i:s a',strtotime($customer->created_at))}}</p>
                                                        </div>
                                                    </div>                                               
                                                    <div class="cusInfo">
                                                        
                                                        <div class="div-main-content">
                                                            <div class="div-content">
                                                                <p>Status:</p>
                                                            </div>
                                                            <div class="div-desc">                                 
                                                                
                                                                    <p class="{{$customer->verification}}">{{$customer->verification}}</p>
                                                                
                                                            </div> 
                                                        </div>                                                         
                                                                                                                                        
                                                    </div>  
                                                </div>
                                                <div class="modal-footer footerEditClass"> 
                                                    @if($customer->verification == 'Unverified')
                                                    <a href="{{route('verify-customer' , ['id' => $customer->id])}}"><button type="button"  class="btn btn-primary edtBtn">Verify</button>   </a>                           
                                                    <button type="button" data-dismiss="modal" onclick="closeView(event)" class="btn btn-outline-secondary" >Close</button>                                                                                                                        
                                              
                                                    @else
                                                    <button type="button" onclick="toggleEditMode(event)" class="btn btn-primary edtBtn">Edit</button>      
                                                    <button style="width:80px" type="button" onclick="initMap('resetMapEdit',{{$customer->id}},{{$customer->lat}},{{$customer->lng}})" data-toggle="modal" data-target="#viewMapEdit" class="btn btn-primary edtBtn">Location</button>     
                                                    <button type="button" data-dismiss="modal" onclick="closeView(event)" class="btn btn-outline-secondary" >Close</button>                                                                                                                        
                                                    @endif
                                                </div>       
                                            </div>
                                        </div>
                                        </form> 
                                    </div>                                
                                </div>   
                            </td>
                        </tr>      
                    @endforeach        
                    </tbody>
                </table>
                <ul class="pagination">
                     {{$customers->links()}}
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

<div class="modal fade" id="addCustomer"  tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Customer</h4>
             
            </div>
            
            @if($errors->count() > 0)
                <div class="alert alert-danger">{{$errors->first()}}</div>       
            @endif
            @if(Session::has('fail'))
                <div class="alert alert-danger">{{Session::get('fail')}}</div>
            @endif
            
            <div class="modal-body">
                <form method="POST" id="addUserForm" action="{{ route('customer-add')}}">
                    @csrf
                    <input type="text" class="form-control" name="password" value="Ctech1234" hidden>
                    <input type="text" class="form-control" name="account_id" value="{{$id}}" hidden>
                    <div class="form-group-generated">
                        <label for="Account id">Account id <br>{{$id}}</label>
                        <label for="password">Password <br>Ctech1234</label>
                        <!-- <input type="text" class="form-control" id="Account id"> -->
                    </div>
                    <div class="form-group">
                        <label for="name">First name</label>
                        <input type="text" class="form-control" value="" name="firstname" placeholder="Enter first name">
                    </div>
                    <div class="form-group">
                        <label for="name">Last name</label>
                        <input type="text" class="form-control" value="" name="lastname" placeholder="Enter last name">
                    </div>
                    <!--<div class="form-group">-->
                    <!--    <label for="Address">Address</label>-->
                    <!--    <input type="text" class="form-control" value="" name="fullAddress" placeholder="Enter address">-->
                    <!--</div>-->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" value="" name="email" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="mobile">Mobile Number</label>
                        <input type="text" class="form-control" value="" name="mobile" placeholder="Enter mobile number">
                    </div>
                    <div class="issue-cat" >
                        <label for="mobile">Client Type</label>
                        <select name="custType" id="" required > 
                            <option value="" disabled selected>Either Consignee or Subscriber</option>
                            <option value="Consignee">Consignee</option>
                            <option value="Subscriber">Subscriber</option>
                        </select>
                    </div>
                    <input type="text" class="form-control" id="inputForlat" name="lat" hidden>
                    <input type="text" class="form-control" id="inputForlng" name="lng" hidden>
                    <input type="text" class="form-control" id="inputAddress" name="fullAddress" hidden>
                    
                    <!-- Modal Footer -->
                    <div class="modal-footer footerEditClass">
                        <button type="button" id="btnSubmit" onclick="initMap('resetMapAdd',null,0,0)" data-toggle="modal" data-target="#viewMap" class="btn btn-primary">Add</button>
                         
                        <div class="actions">
                            <button  type="button"  data-dismiss="modal">Close</button>
                        </div>
                        
                    </div>
                
                </form>
            </div>
        </div>
    </div>
</div>

<!--Map for editing-->
<div class="modal fade" id="viewMapEdit" tabindex="-1" aria-hidden="true">                        
    <div class="modal-dialog">
        <div class="modal-content">
                <!-- Modal Header -->
            <div class="modal-header">
                <h3 id="selectMapTitle" class="modal-title">Select Customer Location </h3>                                                           
            </div>                    
                <!-- Modal Body -->
                
           <form method="POST" action="{{ route('customer-edit-location')}}">
            @csrf
             
            <div class="modal-body">
                
                <div class="">
                
                <div class='resetMapEdit'>
                    
                </div>
                
                </div>
               
                <div class="content-location-form">
                    <h2>Details</h2>
                    <div class="input-flex ">
                        <div >
                            <label for="">Country</label><br>
                            <input type="text" class="editable disable" id="country_tag_edit" name='country_val' value="" disabled><br>
                        </div>
                        <div >
                            <label for="">Region</label><br>
                            <input type="text" class="editable disable" id="region_tag_edit" name='region_val' value="" disabled><br>
                        </div>
                    </div>
                    <label for="">Full Address</label><br>
                    <textarea  class="disable" id="fulladd_tag_edit" cols="30" rows="4" disabled></textarea>
                    <input type="text" class="form-control" id="inputForlatEdit" name="lat" hidden>
                    <input type="text" class="form-control" id="inputForlngEdit" name="lng" hidden>
                    <input type="text" class="form-control" id="user_id" name="userID" hidden>
                     <input type="text" class="form-control" id="fulladd_tag_edit_input" name="fulladdress" hidden>
                </div> 
            </div>
           
            <div class="modal-footer footerEditClass">                               
                <button type="submit">Submit</button>   
                <button type="button" data-dismiss="modal" onclick="closeMapFOrEdit()">close</button>     
            </div>
                        </form>

        </div>
    </div>                                        
</div>

<!--Map for adding -->
<div class="modal fade" id="viewMap" tabindex="-1" aria-hidden="true">                        
    <div class="modal-dialog">
        <div class="modal-content">
                <!-- Modal Header -->
            <div class="modal-header">
                <h3 id="selectMapTitle" class="modal-title">Select Customer Location </h3>                                                           
            </div>                    
                <!-- Modal Body -->
            <div class="modal-body">
                
                <div class="">
                
                 <div class='resetMapAdd'>
                    
                </div>
                
                </div>
               
                <div class="content-location-form">
                    <h2>Details</h2>
                    <div class="input-flex ">
                        <div >
                            <label for="">Country</label><br>
                            <input type="text" class="editable disable" id="country_tag" name='country_val' value="" disabled><br>
                        </div>
                        <div >
                            <label for="">Region</label><br>
                            <input type="text" class="editable disable" id="region_tag" name='region_val' value="" disabled><br>
                        </div>
                    </div>
                    <label for="">Full Address</label><br>
                    <textarea name="fulladdress" class="disable" id="fulladd_tag" cols="30" rows="4" disabled></textarea>
                    
                </div> 
            </div>
            <div class="modal-footer footerEditClass">                               
                <button type="button"  onclick="submitNewUSer()">Submit</button>   
                <button type="button" data-dismiss="modal" onclick="closeMap(event)">close</button>     
            </div>       
        </div>
    </div>                                        
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<script src='https://unpkg.com/leaflet@1.8.0/dist/leaflet.js' crossorigin=''></script>
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

<script>

    function closeMap(){
         $('#viewMap').hide();
         $('#addCustomer').show();
    }
    
     function closeMapFOrEdit(){
         $('#viewMapEdit').hide();
           $('.modal-backdrop').remove();
    }
    
    function submitNewUSer(){
         let latVal =  document.getElementById('inputForlat').value;
         let lngVal =  document.getElementById('inputForlng').value;
         let selectMapTitle =  document.getElementById('selectMapTitle');
         let addUserForm =  document.getElementById('addUserForm');
         selectMapTitle
         
         if(latVal=='' || lngVal==''){
            selectMapTitle.innerHTML = 'Select Customer Location <span style="margin-right:5px; color:red">- Please Select a location</span>'
         }else{
             addUserForm.submit()
         }
    }
    
    
    let map, markers 
    function initMap(mapType,id,lat,lng) {
  
        $('#addCustomer').hide();
        $('#viewjob-'+id).hide();
        
        var elements = document.querySelector("."+mapType);
       
            elements.innerHTML ='<div id="map"></div>';
        
     
        map = L.map('map', {
            center: {
                lat: 12.8797,
                lng: 121.7740,
            },
            zoom: 6
        });
        

       L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap'
        }).addTo(map);
        
            // Add search box using Leaflet Control Geocoder
        L.Control.geocoder({
            defaultMarkGeocode: false, // Prevent auto-adding a marker for the default location
        })
        .on('markgeocode', function (event) {
            const { center } = event.geocode;

            // Remove existing marker if present
            if (marker) {
                map.removeLayer(marker);
            }

            // Create a new marker at the selected location
            marker = L.marker(center, {
                draggable: true
            })
            .addTo(map)
            .on('dragend', function (event) {
                const { lat, lng } = event.target.getLatLng();
                updateMarkerPosition(lat, lng);
                getAddress(lat, lng);
            });

            // Set the view to the selected location
            map.setView(center, 17);

            // Update the address and coordinates
            getAddress(center.lat, center.lng);
            updateMarkerPosition(center.lat, center.lng);
        })
        .addTo(map);

        // Check if initial values for lat and lng are provided
        const initialLat = lat;  // Provide your initial latitude value here
        const initialLng = lng;  // Provide your initial longitude value here

        if (initialLat !== 0 || initialLng !== 0) {
            // Use the provided initial values
            marker = L.marker([initialLat, initialLng], {
                draggable: true,
                 
            })
            .addTo(map)
             .on('dragend', markerDragEnd);
            map.setView([initialLat, initialLng], 17);
        } else {
            // Use default values for the Philippines
            marker = L.marker([12.8797, 121.7740], {
                draggable: true
            })
            .addTo(map)
        }

         $('#viewMap').on('shown.bs.modal', function () {
            setTimeout(function () {
                map.invalidateSize();
            }, 1000);
        });
        
          $('#viewMapEdit').on('shown.bs.modal', function () {
            setTimeout(function () {
                map.invalidateSize();
            }, 1000);
        });


        // Set the desired width for the modal content
        var modalContent = document.querySelector('#viewMap').getElementsByClassName('modal-content')[0];
        console.log(modalContent)
        modalContent.style.width = '95%';
        
        var modalContentEdit = document.querySelector('#viewMapEdit').getElementsByClassName('modal-content')[0];
        console.log(modalContent)
        modalContentEdit.style.width = '95%';
        
        
         getAddress(lat,lng);
         map.on('click', function(event) {
                mapClicked(event, mapType,id);
        });
    }
    

    function generateMarker(data, index) {
        return L.marker(data.position, {
            draggable: data.draggable
        })
        .on('click', (event) => markerClicked(event, index))
        .on('dragend', (event) => markerDragEnd(event, index));
    }

    function mapClicked(event,mapType,id) {
        const { lat, lng } = event.latlng;
        updateMarkerPosition(lat, lng);
        getAddress(lat, lng,mapType,id);
    }

    function markerClicked(event, index) {
        const { lat, lng } = event.latlng;
        getAddress(lat, lng);
    }

    function markerDragEnd(event, index) {
        const { lat, lng } = event.target.getLatLng();
        getAddress(lat, lng);
    }

    function getAddress(lat, lng,mapType,id) {
        // Using OpenStreetMap Nominatim API for reverse geocoding
        const apiUrl = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&addressdetails=1`;

        fetch(apiUrl)
            .then(response => response.json())
            .then(data => {
                const address = data.display_name;
                const country = data.address.country ?? 'Unknown Country';
                const region = data.address.region ?? 'Unknown State';
                
                
                console.log('testss')
                
                if(mapType == 'resetMapAdd'){
                    document.getElementById('country_tag').value = country;
                    document.getElementById('region_tag').value = region;
                    document.getElementById('fulladd_tag').value = address;
                    document.getElementById('inputForlat').value = lat;
                    document.getElementById('inputForlng').value = lng;
                    document.getElementById('inputAddress').value = address;
                }else{
                    document.getElementById('country_tag_edit').value = country;
                    document.getElementById('region_tag_edit').value = region;
                    document.getElementById('fulladd_tag_edit').value = address;
                    document.getElementById('user_id').value = id;
                    document.getElementById('inputForlatEdit').value = lat;
                    document.getElementById('inputForlngEdit').value = lng;
                    document.getElementById('fulladd_tag_edit_input').value = address
                }
           

            })
            .catch(error => console.error('Error:', error));
    }

    function addMarker(position) {
        const marker = L.marker(position, {
            draggable: true
        })
        .addTo(map)
        .on('click', (event) => markerClicked(event, markers.length))
        .on('dragend', (event) => markerDragEnd(event, markers.length));

        markers.push(marker);
    }

    function updateMarkerPosition(lat, lng) {
        marker.setLatLng([lat, lng]);
    }



</script>

@if($errors->count() > 0)
    <script>
        $(document).ready(function() {
            $('#addCustomer').modal('show');
            console.log('ss');
            setTimeout(function() {
                $(".alert-danger").fadeOut();
       
            }, 1000);
        });

    </script>    
@endif

@if(Session::has('pdfSuccess'))
    <!-- Modal View -->
    <script>
        // Open PDF in a new tab using JavaScript
        window.open("{{ url('/download-pdf/' . session('filename')) }}", '_blank');
    </script>
@endif


@if(Session::has('success'))
    <!-- Modal View -->
    <script>
        Swal.fire({
            icon: 'success',  
            text: "{{Session::get('success')}}",
        })
    </script>
@endif

@if(Session::has('fail'))
    <!-- Modal View -->
    <script>
        Swal.fire({
            icon: 'error',  
            text: "{{Session::get('fail')}}",    
        })
    </script>
@endif

   <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<style>  
    .div-desc p[contenteditable="true"] {
        border: 1px solid #ccc;
        padding: 4px;
        background-color: #fff;
        outline: none;
        border-radius: 4px;
        box-shadow: 0 0 4px rgba(0, 0, 0, 0.1);

    }

    .div-desc p[contenteditable="true"]:focus {
        border-color: #6c757d;
        box-shadow: 0 0 4px rgba(108, 117, 125, 0.5);
    }
</style>




<script>

  
    function deleteConfirm(e){
        var form = e.target.closest('form');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'

            }).then((result) => {
            if (result.isConfirmed) {
                form.submit()
            }
        })
    }

   
    function toggleEditMode(e) {
        var footer = e.target.closest('.footerEditClass');
        var custType =document.querySelector('.custType')
        var custTypeText =document.querySelector('.custTypeText')
        
        // console.log(e.target.closest('div').parentNode.querySelector('select'))
         e.target.closest('div').parentNode.querySelector('select').style.display="block"
         e.target.closest('div').parentNode.querySelector('select').closest('div').querySelector('p').style.display="none"
          
      
        $('.editable').each(function(){  
     
            if (this.contentEditable === 'true') {
                this.contentEditable = 'false';
                
                  
                       
                footer.innerHTML = ''+
                '<button type="button" onclick="toggleEditMode()" class="btn btn-primary edtBtn">Edit</button> ' +
                '<button type="button" onclick="closeView(event)" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>  '; 

            } else {
                this.contentEditable = 'true';
                footer.innerHTML =  ''+      
                '<button type="button"  onclick="saveEdit(event)" class="btn btn-primary saveBtn">Save</button> ' +
                '<button type="button" onclick="closeView(event)" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>  ';                                                                                                                                                                 
            }         
        });

    }

    function closeView(e){
        console.log('close');
        var footer = e.target.closest('.footerEditClass');
        var modal = e.target.closest('.modal')
        
         e.target.closest('div').parentNode.querySelector('select').style.display="block"
         e.target.closest('div').parentNode.querySelector('select').closest('div').querySelector('p').style.display="none"
          
      
        $('.editable').each(function(){        
                this.contentEditable = 'false';
            
                footer.innerHTML = ''+
                '<button type="button" onclick="toggleEditMode(event)" class="btn btn-primary edtBtn">Edit</button> ' +
                '<button type="button" onclick="closeView(event)" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>  ';         
        });
       
        $(modal).hide();
        $('.modal-backdrop').remove();

    }


    function saveEdit(e){
        var form = e.target.closest('form')
      
        var firstname = e.target.closest('.modal-content').querySelector('#custFirstname').textContent;   
        var lastname = e.target.closest('.modal-content').querySelector('#custLastname').textContent;  ;
        var address = e.target.closest('.modal-content').querySelector('#custAddress').textContent;   
        var email = e.target.closest('.modal-content').querySelector('#custEmail').textContent;  
        var mobile = e.target.closest('.modal-content').querySelector('#custMobile').textContent;   
        // var password = e.target.closest('.modal-content').querySelector('#custPassword').textContent;
         var custType = e.target.closest('.modal-content').querySelector('#custType').value;  

         
        form.action =  form.action + '?firstname=' + encodeURIComponent(firstname) +
                  '&lastname=' + encodeURIComponent(lastname)+
                  '&address=' + encodeURIComponent(address)+
                  '&email=' + encodeURIComponent(email)+
                  '&mobile=' + encodeURIComponent(mobile)+
                //   '&password=' + encodeURIComponent(password)+
                    '&custType=' + encodeURIComponent(custType);
        
        console.log(form)
        form.submit()
    
       
    }
    

    
    document.addEventListener('DOMContentLoaded', function() {
     const searchbar = document.querySelector('#searchbar')
            searchbar.addEventListener('input', function (e) {
            // console.log(searchbar.value)
                axios.post("/admin/customerlist/search", {
                      searched: searchbar.value,
                  }, {
                    headers: {'Content-Type': 'application/json'}
                  }).then(function(response) {
              
                    renderData(response.data.customers);
                  }).catch(function(error) {
                    console.log(error.response);
                  })
                
            
            })
});
    
  
    
    function renderData(data){
        const table = document.querySelector('#table-body')
        table.innerHTML = '';
        let customers = data.data
        
         customers.forEach(function (cus) {
         
                // let statusCss = (data.t_status == 1) ? 'status-btn-approved' : (data.t_status == 2) ? 'status-btn-pending' : 'status-btn-declined'
                // let statusText = (data.t_status == 1) ? 'Approved' : (data.t_status == 2) ? 'Pending' : 'Declined'
                let row = document.createElement('tr');
                let id = cus.id
                
                row.innerHTML = `
                    <tr>
                        <td>`+cus.account_id+`</td>
                        <td> `+cus.first_name+` `+cus.last_name+`</td>
                        <td>`+cus.fullAdress+`</td>
                        <td>`+cus.email+`</td>
                        <td>`+cus.customerType+`</td>
                        <td><div class="`+cus.verification+`">`+cus.verification+`</div></td>
                        <td>
                             ${cus.adminCreated === 'Yes' ? '<p>Yes</p>' : '<p>No</p>'}
                        </td>
                        <td>
                            <div class="actions d-flex">                   
                                <button type="button" data-toggle="modal" data-target="#viewjob-`+cus.id+`"><span class="las la-eye"></span></button>      
                                <form method="POST" action="https://myctech.online/admin/customerlist/delete/`+cus.id+`">
                                    @csrf 
                                    <button type="button" onclick="deleteConfirm(event)"><span class="las la-trash"></span></button>
                                </form>  
                                <div class="modal fade" id="viewjob-`+cus.id+`" tabindex="-1" aria-hidden="true">
                                    <form method="POST" action="https://myctech.online/admin/customerlist/edit/`+cus.id+`">
                                    @csrf                      
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h3 class="modal-title">Customer Details</h3>
                                            </div>                    
                                            <!-- Modal Body -->
                                            <div class="modal-body">
                                                <div class="div-main-content">
                                                    <div class="div-content">
                                                        <p>Account:</p>
                                                    </div>
                                                    <div class="div-desc">
                                                        <p contenteditable="false">`+cus.account_id+`</p>
                                                    </div>
                                                </div>
                                                <div class="div-main-content">
                                                    <div class="div-content">
                                                        <p>Name:</p>
                                                    </div>
                                                    <div class="div-desc nameDesc">
                                                        <p  id="custFirstname" class="editable" contenteditable="false">`+cus.first_name+`</p>
                                                        <p  id="custLastname" class="editable" contenteditable="false">`+cus.last_name+`</p>
                                                    </div>
                                                </div>
                                                <div class="div-main-content">
                                                    <div class="div-content">
                                                        <p>Address:</p>
                                                    </div>
                                                    <div class="div-desc jobTypeClass">
                                                        <p id="custAddress" class="editable" contenteditable="false">`+cus.fullAdress+`</p> 
                                                    </div>
                                                </div>
                                                <div class="div-main-content">
                                                    <div class="div-content">
                                                        <p>Email:</p>
                                                    </div>
                                                    <div class="div-desc">
                                                        <p id="custEmail" class="editable" contenteditable="false">`+cus.email+`</p>
                                                    </div>
                                                </div>
                                                <div class="div-main-content">
                                                    <div class="div-content">
                                                        <p>Mobile:</p>
                                                    </div>
                                                    <div class="div-desc">
                                                        <p id="custMobile" class="editable" contenteditable="false">`+cus.mobile_number+`</p>
                                                    </div>
                                                </div>
                                                <div class="div-main-content">
                                                    <div class="div-content">
                                                        <p id="custMobile" class="editable" contenteditable="false">Client Type :</p>
                                                    </div>
                                                    <div class="div-desc">
                                                        <p id="custTypeText" class="custTypeText">`+cus.customerType+`</p>
                                                        <select name="custType" class="custType" id="custType" required style="display:none"> 
                                                            <option value="`+cus.customerType+`" disabled selected>`+cus.customerType+`</option>
                                                            <option value="Consignee">Consignee</option>
                                                            <option value="Subscriber">Subscriber</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="div-main-content">
                                                    <div class="div-content">
                                                        <p>Date Created:</p>
                                                    </div>
                                                    <div class="div-desc">
                                                        <p contenteditable="false">{{date('d-m-y h:i:s a',strtotime(`+cus.created_at+`))}}</p>
                                                    </div>
                                                </div>
                                                <div class="cusInfo">
                                                    <div class="div-main-content">
                                                        <div class="div-content">
                                                            <p>Status:</p>
                                                        </div>
                                                        <div class="div-desc">                                 
                                                            <p class="`+cus.verification+`">`+cus.verification+`</p>
                                                        </div> 
                                                    </div>                                                         
                                                </div>  
                                            </div>
                                            <div class="modal-footer footerEditClass"> 

                                                  ${cus.verification === 'Unverified' ? 
                                                        `<a href="{{ route('verify-customer', ['id' => '`cus.id`']) }}"><button type="button"  class="btn btn-primary edtBtn">Verify</button>   </a><button type="button" data-dismiss="modal" onclick="closeView(event)" class="btn btn-outline-secondary" >Close</button>                             ` 
                                                        :
                                                        `<button type="button" onclick="toggleEditMode(event)" class="btn btn-primary edtBtn">Edit</button>
                                                        <button style="width:80px" type="button" onclick="initMap('resetMapEdit',`+cus.id+`)" data-toggle="modal" data-target="#viewMapEdit" class="btn btn-primary edtBtn">Location</button>     

                                                        <button type="button" data-dismiss="modal" onclick="closeView(event)" class="btn btn-outline-secondary">Close</button>`
                                                    }
                                            </div>       
                                        </div>
                                    </div>
                                    </form> 
                                </div>                                
                            </div>   
                        </td>
                    </tr>
                    `;

                table.appendChild(row);
            });
            
        

    }
    

    
    
</script>




