<input type="checkbox" name="" id="nav-toggle" hidden>
<div class="sidebar">
    <a class="navbar-brand" href="{{url('admin/dashboard')}}">
    <div class="sidebar-brand">
            <img id="logo-image" src="{{asset('img/gtechlogo.png')}}" alt="logo">
        </div>
    </a>

    <div class="sidebar-menu">
        @if($currActive == 'dashboard')
        <div class="bar-item active">
            <a href="{{url('admin/dashboard')}}">
                <div class="las la-igloo"></div>
                <p>Dashboard</p>
            </a>
        </div>
        @else
        <div class="bar-item">
            <a href="{{url('admin/dashboard')}}">
                <div class="las la-igloo"></div>
                <p>Dashboard</p>
            </a>
        </div>
        @endif

        @if($currActive == 'custList')
           <div class="bar-item active" >
                <a href="{{url('admin/customerlist')}}">
                    <div class="las la-users"></div>
                    <p>Customer List</p>
                </a>
            </div>
        @else
            <div class="bar-item" >
                <a href="{{url('admin/customerlist')}}">
                    <div class="las la-users"></div>
                    <p>Customer List</p>
                </a>
            </div>
        @endif

        @if($currActive == 'techList')         
            <div class="bar-item active">
                <a href="{{url('admin/technicianlist')}}">
                <div class="las la-clipboard-list"></div>
                <p>Technician List</p>
                </a>
            </div>
        @else          
            <div class="bar-item">
                <a href="{{url('admin/technicianlist')}}">
                <div class="las la-clipboard-list"></div>
                <p>Technician List</p>
                </a>
            </div>
        @endif

        @if($currActive == 'jobReq')
            <div class="bar-item active">
                <a href="{{url('admin/addjobreq')}}">
                <div class="las la-clipboard"></div>
                <p>Job Request</p>
                </a>
            </div>
        @else
         <div class="bar-item">
                <a href="{{url('admin/addjobreq')}}">
                <div class="las la-clipboard"></div>
                <p>Job Request</p>
                </a>
            </div>
        @endif
        @if($currActive == 'transaction report')
            <div class="bar-item active">
                <a href="{{url('admin/reports')}}">
                <div class="las la-clipboard-check"></div>
                <p>Accomplishment</p>
                </a>
            </div>
        @else
         <div class="bar-item">
                <a href="{{url('admin/reports')}}">
                <div class="las la-clipboard-check"></div>
                <p>Accomplishment</p>
                </a>
            </div>
        @endif
        @if($currActive == 'qoutation report')
            <div class="bar-item active">
                <a href="{{url('admin/quotation')}}">
                <div class="las la-clipboard-check"></div>
                <p>Quotation</p>
                </a>
            </div>
        @else
         <div class="bar-item">
                <a href="{{url('admin/quotation')}}">
                <div class="las la-clipboard-check"></div>
                <p>Quotation</p>
                </a>
            </div>
        @endif
        @if($currActive == 'location')
            <div class="bar-item active">
                <a href="{{url('admin/location')}}">
                <div class="las la-map-marker"></div>
                <p>Location</p>
                </a>
            </div>
        @else
         <div class="bar-item">
                <a href="{{url('admin/location')}}">
                <div class="las la-map-marker"></div>
                <p>Location</p>
                </a>
            </div>
        @endif
        
        
        
        

      
    </div>
</div>

<script>
  var navToggle = document.getElementById('nav-toggle');
  var sidebar = document.querySelector('.sidebar');
  var paragraphs = sidebar.querySelectorAll('p');
  var logoImage = document.getElementById('logo-image');
  var icon = document.querySelectorAll('la-igloo');

  navToggle.addEventListener('change', function() {
        if (navToggle.checked) {
            sidebar.classList.add('hideNavigation');
              // Set the desired width and height
                var newWidth = 50;
                var newHeight = 50;
                var newMargin = 15;
                
                // Change the width and height of the image
                logoImage.style.width = newWidth + 'px';
                logoImage.style.height = newHeight + 'px';
                logoImage.style.margin = newMargin + 'px';
                
            
            paragraphs.forEach(function(p) {
                p.style.display =  'none';
            });

        } else {
            sidebar.classList.remove('hideNavigation');

            var newWidth = 105;
            var newHeight = 80;
                
            // Change the width and height of the image
            logoImage.style.width = newWidth + 'px';
            logoImage.style.height = newHeight + 'px';
            
            paragraphs.forEach(function(p) {
                p.style.display =  'block';
            });
        }
  });


  var logoImage = document.getElementById('logo-image');
    
  

  


</script>