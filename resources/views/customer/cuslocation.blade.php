@extends('base')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/global.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/navigation.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/location.css')}}">
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />

@endsection
@section('navbar')
    @include('includes/nav')
@endsection

@section('content')
<style>
        #map {
            width: '100%';
            height: 400px;
        }
    </style>
    <link rel='stylesheet' href='https://unpkg.com/leaflet@1.8.0/dist/leaflet.css' crossorigin='' />

<div class="main-container">

 
    <div class="main-map-container">
        <div id="map">
            
        </div>
        <form class="input-container" method="POST" action="{{ route('location-edit', $user->id) }}">
        @csrf                         
            <div class="content-location-form">
                <h2>Details</h2>
                <div class="input-flex">
                    <div>
                        <label for="">Country</label><br>
                        <input type="text" class="editable " id="country_tag" name='country_val' value="{{$user->country}}" ><br>
                    </div>
                    <div>
                        <label for="">Region</label><br>
                        <input type="text" class="editable " id="region_tag" name='region_val' value="{{$user->region}}" ><br>
                    </div>
                </div>
                <label for="">Full Address</label><br>
                <textarea name="fulladdress" id="fulladd_tag" cols="30" rows="4">{{$user->fullAdress}}</textarea>
                <input type="text" id='lat' name='lat' value="{{$user->lat}}" hidden>
                <input type="text" id='lng' name='lng' value="{{$user->lng}}" hidden>
            </div> 
            <div class="btn-save-container">
                <button type="submit" style="background-color:#eb984e;">Save</button>
            </div> 
        </form>
    </div>
        
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

<script src='https://unpkg.com/leaflet@1.8.0/dist/leaflet.js' crossorigin=''></script>
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>




<script>
    let map, markers 

    function initMap() {
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
        const initialLat = {{$user->lat}};  // Provide your initial latitude value here
        const initialLng = {{$user->lng}};  // Provide your initial longitude value here

        if (initialLat !== 0 || initialLng !== 0) {
            // Use the provided initial values
            marker = L.marker([initialLat, initialLng], {
                draggable: true
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
            .on('dragend', markerDragEnd);
        }

        map.on('click', mapClicked);
      
    }

    function initMarkers() {
        // Add initial markers if needed
    }

    function generateMarker(data, index) {
        return L.marker(data.position, {
            draggable: data.draggable
        })
        .on('click', (event) => markerClicked(event, index))
        .on('dragend', (event) => markerDragEnd(event, index));
    }

    function mapClicked(event) {
        const { lat, lng } = event.latlng;
        updateMarkerPosition(lat, lng);
        getAddress(lat, lng);
    }

    function markerClicked(event, index) {
        const { lat, lng } = event.latlng;
        getAddress(lat, lng);
    }

    function markerDragEnd(event, index) {
        const { lat, lng } = event.target.getLatLng();
        getAddress(lat, lng);
    }

    function getAddress(lat, lng) {
        // Using OpenStreetMap Nominatim API for reverse geocoding
        const apiUrl = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&addressdetails=1`;

        fetch(apiUrl)
            .then(response => response.json())
            .then(data => {
                const address = data.display_name;
                const country = data.address.country ?? 'Unknown Country';
                const region = data.address.region ?? 'Unknown State';
           

                document.getElementById('country_tag').value = country;
                document.getElementById('region_tag').value = region;
                document.getElementById('fulladd_tag').value = address;
                document.getElementById('lat').value = lat;
                document.getElementById('lng').value = lng;

                console.log(data);
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

    initMap();
    
  


</script>

@if($user->fullAdress == NULL && !(isset($location)))
    <script>
        Swal.fire({
          text: "Get your current Location",
          confirmButtonText: "Get",
          allowOutsideClick: false
        }).then((result) => {
          if (result.isConfirmed) {
             if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
              } else { 
                alert("Geolocation is not supported by this browser.");
              }
          } 
        });
        
        function showPosition(position) {
            updateMarkerPosition(position.coords.latitude, position.coords.longitude);
            getAddress(position.coords.latitude, position.coords.longitude);
            map.setView([position.coords.latitude, position.coords.longitude], 17); 
            
           
            Swal.fire({
                icon: 'success',  
                text: "Address set, If the address is incorrect you can set it manualy by clicking the map",
            })
           
  
        }
    </script>
@endif

 

@endsection