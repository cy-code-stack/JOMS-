@extends('base')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/global.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/navigation.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/technician/location.css')}}">
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
        <div class="customer-container">
            <div class="table-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td scope="col">Name</td>
                            <td scope="col">Issue</td>
                            <td scope="col">Status</td>
                            <td scope="col">Actions</td>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                    @foreach($jobs as $job)
                        @if($job->job_status == 'Decline')
                            @continue
                        @endif
                            <tr>
                                <td>{{$job->customer->first_name}} {{$job->customer->last_name}}</td>
                                <td>{{$job->job_type}}</td>
                                <td>
                                    <div class="status">
                                        <div class="{{$job->job_status}}"></div>
                                        <p>{{ $job->job_status }}</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="actions d-flex">
                                        <button type="button" onclick="generateMarker({{$job->customer->lat}},{{$job->customer->lng}},'{{$job->customer->first_name}} {{$job->customer->last_name}}','{{$job->job_status}}','{{$job->customer->fullAdress}}')"><span class="las la-map-marker"></button>
                                        </form>  
                                    </div>
                                </td>
                            </tr>                      
                        @endforeach                   
                    </tbody>
                </table> 
            </div>
        </div>
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

       // Check if initial values for lat and lng are provided
        const initialLat = {{$lat}};  // Provide your initial latitude value here
        const initialLng = {{$lng}};  // Provide your initial longitude value here

        if (initialLat !== 0 || initialLng !== 0) {
            // Use the provided initial values
            marker = L.marker([initialLat, initialLng], {
                draggable: true
            })
            .addTo(map)
            .on('dragend', markerDragEnd);
    
            const popupContent = `<b>Name:</b> {{$name}}<br><b>Status:</b> {{$status}}<br><b>Address:</b> {{$address}}`;
            marker.bindPopup(popupContent).openPopup();
            map.setView([initialLat, initialLng], 17); 
        } else {
            // Use default values for the Philippines   
            marker = L.marker([12.8797, 121.7740], {
                draggable: true
            })
            .addTo(map)
            .on('dragend', markerDragEnd);
        }

   
    }

  
    function generateMarker(lat, lng, name, status,address) {
        if (marker) {
            map.removeLayer(marker);
        }
         marker = L.marker([lat, lng], {
            draggable: true
        }).addTo(map);

        const popupContent = `<b>Name:</b> ${name}<br><b>Status:</b> ${status}<br><b>Address:</b> ${address}<br><b>Long(x):</b> ${lat}<br><b>Lang(y):</b> ${lng}`;
        marker.bindPopup(popupContent).openPopup();

        // You can add more customization or logic here if needed
        map.setView([lat, lng], 17);
        updateMarkerPosition(lat, lng);
       
    }

    

    function markerDragEnd(event, index) {
        const { lat, lng } = event.target.getLatLng();
        getAddress(lat, lng);
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

@endsection