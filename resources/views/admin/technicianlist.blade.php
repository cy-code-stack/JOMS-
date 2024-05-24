@extends('../base')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/global.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/sidenavigation.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/customer/dashboard.css')}}">
@endsection

@section('navbar')
    @include('includes/sidenavigation')
@endsection

@section('content')

<style>
    .LORETOStyle{
        background-color:rgb(230, 120, 112);
        text-align:center;
        padding: 5px 0px;
        border-radius:10px;
        color:white;
    }
     .LAAKSTyle{
        background-color:rgb(87, 69, 66);
        text-align:center;
        padding: 5px 0px;
        border-radius:10px;
        color:white;
    }
     .TAGUMSTyle{
        background-color:rgb(135, 145, 26);
        text-align:center;
        padding: 5px 0px;
        border-radius:10px;
        color:white;
    }
     .BANAY2STyle{
        background-color:rgb(66, 54, 117);
        text-align:center;
        padding: 5px 0px;
        border-radius:10px;
        color:white;
    }
</style>
   <div class="main-content">
        <div class="top-nav">
            <div class="menu-wrapper">
                <label for="nav-toggle">
                    <span class="la la-bars"></span>
                </label>
                <h4>Technician List</h4>
            </div>
            <div class="user-wrapper">
                <div class="user-wrapper">
                    @include('includes/profilepopup')                
                </div>
            </div>
        </div>
          <div class="body-content">
                <div class="main-table-content">
                    <div class="table_header">
                        <h2>Technicians</h2>
                        <button type="button"  data-toggle="modal" data-target="#addTechnician">Add Technician</button>
                    </div>
                    <div class="table-body">
                        <table class="table table-striped" width="100%">
                            <thead>
                                <tr>
                                    <td scope="col">Name</td>
                                    <td scope="col">Email</td>
                                    <td scope="col">Area</td>
                                    <td scope="col">Status</td>
                                    <td scope="col">Actions</td>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                            @foreach ($technicians as $technician)
                          
                                <tr>
                                    <td>{{$technician->first_name }} {{ $technician->last_name }}</td>                   
                                    <td>{{$technician->email}}</td>
                                    <td>
                                  @php
                                            $area = $technician->area;
                                        @endphp
                                    <div class="{{$area}}Style">
                            
                                        <p >
                                            {{ $area }}
                                        </p>
                                      </div>
                                    </td>
                                    <td > <div class="status">
                                        @if($technician->log_status == 'true')
                                            <div class="available"></div>
                                            <p>Online</p>
                                        @else
                                            <div class="available" style="background-color:red;"></div>
                                            <p>Offline</p>
                                        @endif
                                            
                                        </div></td>
                                    <td>
                                        <div class="actions d-flex">                   
                                            <button type="button" data-toggle="modal" data-target="#viewjob-{{$technician->id}}"><span class="las la-eye"></span></button>      
                                        <form method="POST" action="{{ route('technician-delete', $technician->id) }}">
                                            @csrf 
                                            <button type="button" onclick="deleteConfirm(event)"><span class="las la-trash"></span></button>
                                        </form>  
                                        <div class="modal fade" id="viewjob-{{$technician->id}}" tabindex="-1" aria-hidden="true">
                                            <form method="POST" action="{{ route('technician-edit', $technician->id) }}">
                                            @csrf                      
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h3 class="modal-title">Technician Details</h3>
                                                    
                                                    </div>                    
                                                    <!-- Modal Body -->
                                                    <div class="modal-body">
                                        
                                                        <div class="div-main-content">
                                                            <div class="div-content">
                                                                <p>Name:</p>
                                                            </div>
                                                            <div class="div-desc nameDesc">
                                                                <p  id="firstname" class="editable" contenteditable="false">{{$technician->first_name }}</p>
                                                                <p  id="lastname" class="editable" contenteditable="false"> {{ $technician->last_name}}</p>
                                                            </div>
                                                        </div>
                                                        <div class="div-main-content">
                                                            <div class="div-content">
                                                                <p>Email:</p>
                                                            </div>
                                                            <div class="div-desc">
                                                                <p id="email" class="editable" contenteditable="false">{{$technician->email}}</p>
                                                            </div>
                                                        </div>
                                                        <div class="div-main-content">
                                                            <div class="div-content">
                                                                <p>Password:</p>
                                                            </div>
                                                            <div class="div-desc">
                                                                <p id="password" class="editable" contenteditable="false"><i>Press Edit to create new password</i></p>
                                                            </div>
                                                        </div>
                                                        
                                                          <div class="div-main-content forinputContent">
                                                            <div class="div-content">
                                                                <p id="custMobile" class="editable" contenteditable="false">Technician Area :</p>
                                                            </div>
                                                            <div class="div-desc">
                                                                <p id="techArea" class="custTypeText">{{$technician->area}}</p>
                                                                 <select name="area" id="" style="display:none" required > 
                                                                    <option value="N/A" disabled selected>Select Area</option>
                                                                    <option value="LAAK">LAAK</option>
                                                                <option value="LORETO">LORETO</option>
                                                                     <option value="TAGUM">TAGUM</option>
                                                                          <option value="BANAY2">BANAY2</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="div-main-content">
                                                            <div class="div-content">
                                                                <p>Date Created:</p>
                                                            </div>
                                                            <div class="div-desc">
                                                                <p contenteditable="false">{{$technician->created_at}}</p>
                                                            </div>
                                                        </div>                                               
                                                    </div>
                                                    <div class="modal-footer footerEditClass"> 
                                                        <button type="button" onclick="toggleEditMode(event)" class="btn btn-primary edtBtn">Edit</button>                              
                                                        <button type="button" data-dismiss="modal" onclick="closeView(event)" style="background-color: rgb(235, 187, 97);">Close</button>                                                                                                                        
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
                            {{$technicians->links()}}
                        </ul>
                        
                    </div>
                </div>

                </div>

                
                @endsection
                 

    <!-- Modal Add Technician -->
<div class="modal fade" id="addTechnician" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">Add Technician</h4>
           
        </div>
        
        <!-- Modal Body -->
         
            @if($errors->count() > 0)
                <div class="alert alert-danger">{{$errors->first()}}</div>       
            @endif
            @if(Session::has('fail'))
                <div class="alert alert-danger">{{Session::get('fail')}}</div>
            @endif
        <div class="modal-body">
            <form method="POST" action="{{ route('technician-add')}}">
                    @csrf
            <input type="text" class="form-control" name="password" value="{{$password}}" hidden>
            <div class="form-group">
                <label for="name">First name</label>
                <input type="text" class="form-control" name="firstname" placeholder="Enter first name">
            </div>
            <div class="form-group">
                <label for="name">Last name</label>
                <input type="text" class="form-control" name="lastname" placeholder="Enter last name">
            </div>
            <div class="form-group">
                <label for="Address">Address</label>
                <input type="text" class="form-control" name="address" placeholder="Enter address">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" placeholder="Enter email">
            </div>
             <div class="issue-cat" >
                <label for="mobile">Tech Area</label>
                <select name="area" id="" required > 
                    <option value="N/A" disabled selected>Select Area</option>
                    <option value="LAAK">LAAK</option>
                    <option value="LORETO">LORETO</option>
                         <option value="TAGUM">TAGUM</option>
                              <option value="BANAY2">BANAY2</option>
                </select>
            </div><br>
            <div class="form-group">
                <label for="password">Password: {{$password}}</label>
                <!-- <input type="password" class="form-control" id="password"> -->
            </div>
            
        </div>    
        <!-- Modal Footer -->
            <div class="modal-footer footerEditClass">
                    <button type="submit" id="btnSubmit" onclick="addCustomer()" class="btn btn-primary addBtn">Add</button>
                    <button type="button"  onclick="closeView(event)" style="background-color: rgb(235, 187, 97);">Close</button>
            </div>
        </form>
        </div>
    </div>
</div>

<!-- Modal end -->
        


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

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

@if($errors->count() > 0)
    <script>
        $(document).ready(function() {
            $('#addTechnician').modal('show');
        });
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
  // console.log(e.target.closest('div').parentNode.querySelector('select'))
         e.target.closest('div').parentNode.querySelector('select').style.display="block"
         e.target.closest('div').parentNode.querySelector('select').closest('div').querySelector('p').style.display="none"
          
        $('.editable').each(function(){  
     
            if (this.contentEditable === 'true') {
                this.contentEditable = 'false';
                       
                footer.innerHTML = ''+
                '<button type="button" onclick="toggleEditMode()" class="btn btn-primary edtBtn">Edit</button> ' +
                '<button type="button" onclick="closeView(event)" style="background-color: rgb(235, 187, 97);" data-dismiss="modal">Close</button>  '; 

            } else {
                this.contentEditable = 'true';

                footer.innerHTML =  ''+      
                '<button type="button"  onclick="saveEdit(event)" class="btn btn-primary saveBtn">Save</button> ' +
                '<button type="button" onclick="closeView(event)" style="background-color: rgb(235, 187, 97);" data-dismiss="modal">Close</button>  ';                                                                                                                                                                 
            }         
        });

    }

    function closeView(e){
        console.log('close');
        var footer = e.target.closest('.footerEditClass');
        var modal = e.target.closest('.modal')
        $('.editable').each(function(){        
                this.contentEditable = 'false';
            
                footer.innerHTML = ''+
                '<button type="button" onclick="toggleEditMode(event)" class="btn btn-primary edtBtn">Edit</button> ' +
                '<button type="button" onclick="closeView(event)" style="background-color: rgb(235, 187, 97);" data-dismiss="modal">Close</button>  ';         
        });
       
        $(modal).hide();
        $('.modal-backdrop').remove();

    }


    function saveEdit(e){
        var form = e.target.closest('form')
      
        var firstname = e.target.closest('.modal-content').querySelector('#firstname').textContent;   
        var lastname = e.target.closest('.modal-content').querySelector('#lastname').textContent;  ;
        var password = e.target.closest('.modal-content').querySelector('#password').textContent;  
        var email = e.target.closest('.modal-content').querySelector('#email').textContent;  ;
        var area = e.target.closest('.modal-content').querySelector('#techArea').textContent;   
             
        form.action =  form.action + '?firstname=' + encodeURIComponent(firstname) +
                  '&lastname=' + encodeURIComponent(lastname)+
              
                  '&email=' + encodeURIComponent(email)+
          
                  '&password=' + encodeURIComponent(password) +
                   '&area=' + encodeURIComponent(area); 

   
        form.submit()
    
      
    }

</script>



