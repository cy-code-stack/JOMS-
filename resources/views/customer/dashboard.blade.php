@extends('../base')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/global.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/customer/dashboard.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/navigation.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/footer.css')}}">
<link rel='stylesheet' href='https://unpkg.com/leaflet@1.8.0/dist/leaflet.css' crossorigin='' />

<style>
#map {
    padding: 20px;
    box-sizing: border-box;
    width: 100%;
    height: 100%;
  
}

.input-container {
    padding: 10px 20px;
    box-sizing: border-box;
    display: flex;
    flex-direction: column;
    justify-content: space-between
}



.content-location-form {
    width: 100%;

}

.input-flex {
    display: flex;
    margin-bottom: 15px;
}

h2 {
    margin-bottom: 10px;
}

.input-flex div:nth-child(1) {
    width: 100%;
    margin-right: 10px;
}

.input-flex div:nth-child(2) {
    width: 100%;
}

.content-location-form input {
    width: 100%;
    height: 2.5rem;
    margin-bottom: 5px;
    padding: 10px;
    border: .8px solid rgb(189, 188, 188) !important;
    border-radius: 2px;
}
textarea {
    width: 100%;
    padding: 10px;
    border: .8px solid rgb(189, 188, 188) !important;
}

.my-leaflet-map-container img {
    max-height: none;
}


.global-container{
    height: calc(100vh - 150px);
    padding: 20px 20px;
}
.serviceCont{
    display: flex; 
    flex-direction: column; 
    width:50%; 
    height: 100%;
}
.mainMap{
    background-color: var(--dominant-color); 
    box-shadow: 0px 1px 1px 1px rgba(130, 130, 130, 0.6); 
    border-radius: 10px; 
    width: 70%; 
    height: 100%; 
    display: flex; 
    flex-direction: column; 
    padding: 15px 30px; 
    margin-left:10px;
}
footer{
        display: none;
    }
@media (min-width: 320px) and (max-width: 545px){
    .global-container{
        width: 100%;
        height: calc(100vh - 100px);
        overflow: scroll;
        display: inline-block;
        padding: 20px;
    }
    .serviceCont{
        display: flex;
        flex-direction: column;
        width: 100%;
        margin: 0px;
        padding: 0px;
    }
    .mainMap{
        width: 100%;
        height: 100%;
        margin-left: 0px;
        z-index: 9999;
        margin-top: 10px;
        padding: 20px;
    }
    .serviceDivider{
        width: 2%;
    }
    .form-control{
        height: 100%;
    }
    footer{
        display: none;
    }
   
}
</style>
@endsection
@section('navbar')
    @include('includes/nav')
@endsection

@section('content')

<div class="global-container">
    <div class="serviceCont">
            <div class="tech-issue">
                <h2>Services</h2>
                <div class="issue-cat">
                    <form action="{{route('customer-requestJob')}}" method="POST" enctype="multipart/form-data" style="height:fit-content;">
                        @csrf
                        <label for="">Choose an service</label>
                        <div style = "display: flex; width: 100%">
                            <select onclick="handleSelectChange()" name="jobType" id="issueSelect" required> 
                                <option value="" disabled selected>Select here...</option>
                                <option value="Cctv Installation">Cctv Installation</option>
                                <option value="Solar Installation">Solar Installation</option>
                                <option value="Internet Installation">Internet Installation</option>
                                <option value="Repair and Installation">Repair and Installation</option>
                                <option value="Others">Others</option>
                            </select>
                            <button type="button" data-toggle="modal" data-target="#imageModal" style = "padding: 2px 3px; width:100px; color: #fff;  font-size:10px; background-color: #eb984e; border:none; border-radius:5px; margin: 1px 1px; height: 30px;">Insert Image</button> 
                        </div>
                        <div class="custom-button">
                            <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg" style="max-width: 700px">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Insert Image</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div id="image-issue" class="image-issue">
                                                <div id="image-slider" class="image-slider" >
                                                  <img id="image-preview" src="{{asset('img/logo-filled.jpg') }}" alt="Image Issue" style="width:100%">
                                                </div>

                                            </div>
                                              <a class="prev" onclick="plusSlides(-1)">❮</a>
                                                <a class="next" onclick="plusSlides(1)">❯</a>
                                        </div>
                                    
                                        <div class="modal-footer">
                                              <label for="issueimage" class="custom-file-upload">
                                                    <input class="inputImage" type="file" name="issueimage[]" id="issueimage" accept="image/*" onchange="previewImage(this)" placeholder="ss" multiple>
                                                    Browse
                                             </label>
                                              <button type="button" style="background: #eb984e; " data-dismiss="modal">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input class="otherOption hide" name="otherSelected" placeholder="State the issue type" type="text">
                        <textarea class="form-control" id="textAreaExample6" rows="3" name="jobDescription" placeholder="Describe (Optional)"></textarea>
                        <input type="text" name="customerID" value="{{Session::get('loginId')}}" hidden>
                        <input type="text" name="customerAddress" value="{{$user->fullAdress}}" hidden>
                        <div class="submit-issue">
                            <button type="submit">Submit</button> 
                        </div>
                    </form>
                </div>
        </div>
        <div class="serviceDivider" style="height:2%;"></div>
        <div style="display: flex; background-color: var(--dominant-color); box-shadow: 0px 1px 1px 1px rgba(130, 130, 130, 0.6); border-radius: 10px; width: 100%; height:49%; flex-direction: column; padding: 15px 30px;">
                <h2>Location</h2>
                <div style = "display: flex; width: 100%; justify_content: space-between;">
                    <div>
                        <label>Country</label>
                        <input type="text" name="country"  style="padding: 3px; border-radius: 5px; width: 90%; border: 1px solid #6b6a6a;" placeholder="{{$user->country}}" disabled/> 
                    </div>
                    <div>
                        <label>Region</label>
                        <input type="text" name="region" style="padding: 3px; border-radius: 5px; width: 95%; border: 1px solid #6b6a6a;"  placeholder="{{$user->region}}" disabled/> 
                    </div>
                </div>
                <div style="margin-top: 10px;"></div>
                <label>Full Address
                    <textarea class="form-control" id="" rows="3" name="" style="resize: none;" disabled>{{$user->fullAdress}}</textarea>   
                </label>
        </div>
    </div>
    <div class="mainMap">
        <div class="mapDivider" style="width: 100%; height: 100%; ">
                 <div id='map' class='resetMap'>
                    
                    </div>
        </div>
        <div style="display: flex; justify-content: flex-end; width:100%; padding: 10px;">
            <a class="" href="{{url('/customer/location')}}">
            <button type="submit" style = "padding: 2px 3px; width:100px; color: #fff;  font-size:10px; background-color: #eb984e; border:none; border-radius:5px; height: 30px;">Change Location</button>
            </a>
        </div>
    </div>
</div>


 <div class="modal fade" id="viewMap" tabindex="-1" aria-hidden="true">                        
    <div class="modal-dialog">
        <div class="modal-content">
                <!-- Modal Header -->
            <div class="modal-header">
                <h3 class="modal-title">Map Details</h3>                                                           
            </div>                    
                <!-- Modal Body -->
            <div class="modal-body">
                <div id='map' class='resetMap'>
                    
                    </div>
                <div class="content-location-form">
                    <h2>Details</h2>
                    <div class="input-flex">
                        <div>
                            <label for="">Country</label><br>
                            <input type="text" class="editable disable" id="country_tag" name='country_val' value="{{$user->country}}" ><br>
                        </div>
                        <div>
                            <label for="">Region</label><br>
                            <input type="text" class="editable disable" id="region_tag" name='region_val' value="{{$user->region}}" ><br>
                        </div>
                    </div>
                    <label for="">Full Address</label><br>
                    <textarea name="fulladdress" class="disable" id="fulladd_tag" cols="30" rows="4">{{$user->fullAdress}}</textarea>
                    
                </div> 
            </div>
            <div class="modal-footer footerEditClass">                               
                <button type="button" data-dismiss="modal" onclick="closeMap(event)" class="btn btn-outline-secondary" >Close</button>                                                                                                                        
            </div>       
        </div>
    </div> 
 </div>
<footer> 
    <p class="centered-text" style="margin-top: 20px;">Copyright © 2023 XYZ Technologies. All rights reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // function previewImage(input) {
    //     if (input.files && input.files[0]) {
    //         var reader = new FileReader();

    //         reader.onload = function(e) {
    //             document.getElementById('image-preview').src = e.target.result;
    //         }

    //         reader.readAsDataURL(input.files[0]);
    //     }
    // }
    
    
   function previewImage(input) {
    if (input.files && input.files.length > 0) {
        // Create a single image-slider container
        document.getElementById('image-issue').innerHTML = '';
    var readersFinished = 0;
        for (var i = 0; i < input.files.length; i++) {
            var reader = new FileReader();
           
    
            // Use a closure to capture the value of i for each iteration
            (function (index) {
                reader.onload = function (e) {
                    // Create a new image element for each preview
                  
                    var img = document.createElement('img');
                    var image_slider_wrapper = document.createElement('div');
                    image_slider_wrapper.classList.add('image-slider');
                    img.id = 'image-preview' + (index + 1);
                    img.src = e.target.result;
    
                    // Append the new image element to the image-slider container
                    image_slider_wrapper.appendChild(img);
                    document.getElementById('image-issue').appendChild(image_slider_wrapper);
                    
                    
                    readersFinished++;
                    if (readersFinished === input.files.length) {
                        plusSlides(1);
                    }
                };
            })(i);
    
            reader.readAsDataURL(input.files[i]);
        }
        
    }
    
    

}

</script>
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
            icon: 'fail',  
            text: "{{Session::get('fail')}}",    
        })
    </script>
@endif

@if(Session::has('pdfSuccess'))
    <!-- Modal View -->
<script>
        // Trigger download using JavaScript
        const downloadLink = document.createElement('a');
        downloadLink.href = "{{ url('/download-pdf/' . session('filename')) }}";
        downloadLink.download = 'your_file_name.pdf';
        document.body.appendChild(downloadLink);
        downloadLink.click();
        document.body.removeChild(downloadLink);
    </script>
@endif


@if($user->fullAdress == NULL)
    <script>
        Swal.fire({
          text: "Please Set your address",
          confirmButtonText: "Set",
          allowOutsideClick: false
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
            window.location = "/customer/location";
          } 
        });
    </script>
@endif

@if(isset($quotationGenerated) && $quotationGenerated > 0 || isset($forVerificationJob) && $forVerificationJob > 0)

    @if($quotationGenerated > 0 && $forVerificationJob > 0)
        <script>
            Swal.fire({
                text: "Waiting for Verification: {{$forVerificationJob}} |  Quotation Generated: {{$quotationGenerated}} ",
                icon: "info",
                confirmButtonText: "OK"
            });
        </script>
    @elseif($quotationGenerated > 0 )
   
        <script>
            Swal.fire({
                text: "Quotation Generated: {{$quotationGenerated}} ",
                icon: "info",
                confirmButtonText: "OK"
            });
        </script>
    
    @elseif($forVerificationJob > 0 )
        <script>
            Swal.fire({
                text: "Waiting for Verification: {{$forVerificationJob}} ",
                icon: "info",
                confirmButtonText: "OK"
            });
        </script>
    @endif
@endif


<script>
    function handleSelectChange() {
        var selectElement = document.getElementById("issueSelect");
        var inputElement = document.querySelector(".otherOption");

            if (selectElement.value === "Others") {
                inputElement.classList.remove("hide");
            } else {
                inputElement.classList.add("hide");
            }
    }
</script>


<script src='https://unpkg.com/leaflet@1.8.0/dist/leaflet.js' crossorigin=''></script>
<script>
setTimeout(function () {
    window.dispatchEvent(new Event('resize'));
}, 1000);
    let map, markers 

    function initMap() {
       
  
      
      
        map = L.map('map', {
            center: {
                lat: 12.8797,
                lng: 121.7740,
            },
            zoom: 4,
            dragging: false,
            zoomControl: false
        });
        

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap'
        }).addTo(map);

       // Check if initial values for lat and lng are provided
        const initialLat = {{$user->lat}};  // Provide your initial latitude value here
        const initialLng = {{$user->lng}};   // Provide your initial longitude value here

        if (initialLat !== 0 || initialLng !== 0) {
            // Use the provided initial values
            marker = L.marker([initialLat, initialLng], {
                draggable: false,
                  iconAnchor: [16, 37],   // Adjust the icon anchor for centering
                    popupAnchor: [0, -28] 
            })
            .addTo(map)
            
            map.setView([initialLat, initialLng], 15); 
        } else {
            // Use default values for the Philippines
            marker = L.marker([12.8797, 121.7740], {
                draggable: false
            })
            .addTo(map)
            
        }
    }
    
    initMap()
</script>

<script>
    let slideIndex = 1;
    showSlides(slideIndex);
    
    function plusSlides(n) {
      showSlides(slideIndex += n);
    }
    
    function currentSlide(n) {
      showSlides(slideIndex = n);
    }
    
    function showSlides(n) {
      let i;
      let slides = document.getElementsByClassName("image-slider");
      console.log(slides)
      let dots = document.getElementsByClassName("dot");
      if (n > slides.length) {slideIndex = 1}    
      if (n < 1) {slideIndex = slides.length}
      for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";  
      }
     
      slides[slideIndex-1].style.display = "block";  
     
    }
    </script>
@endsection