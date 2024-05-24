@extends('../base')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/global.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/navigation.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/footer.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/technician/technicianreports.css')}}">

<style>
    .techRowReports{
        width: 100%;
        display: flex;
        flex-direction: row;
        margin-bottom: 10px;
    }
    .rowIssueReport{
        display: flex;
        flex-direction: row;
        align-items: center;
        padding: 5px;
        min-width: 70%;
        border-radius: 10px;
        background: #FFF;
        box-shadow: 0px 2px 8px 0px rgba(0, 0, 0, 0.25);
        height: 65px;
        margin-right: 5px;
        color: #585858;
    }
    .rowAddInfo{
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 13%;
        border-radius: 10px;
        background: #EA6424;
        box-shadow: 0px 2px 8px 0px rgba(0, 0, 0, 0.25);
        height: 65px;
        margin-right: 5px;
        cursor: pointer;
    }
     .infoInputs h5{
         font-size: 15px;
         color: black;
         font-weight: 600;
         margin-bottom: 5px;
     }
     
     .replaceInfo{
         width: 100%;
     }
     .mainInputs{
         width: 100%;
         display: flex;
         flex-direction: row;
         padding: 5px;
         align-items: center;
     }
     .mainInputs label{
         color: black;
     }
     .mainInputs input{
         width: 100%;
         height: 40px;
         border: none;
         border-radius: 3px;
         box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.25);
         padding: 5px;
     }
     
     .inplace{
         width: 100%;
         margin-bottom: 10px;
     }
     .inplaceForms{
         width: 100%;
         display: flex;
         flex-direction: row;
         justify-content: center;
         align-items: center;
         margin-bottom: 5px;
     }
     .inplaceItem{
         display: flex;
         flex-direction: row;
         padding: 5px;
         align-items: center;
     }
     .inplaceItem label{
         color: black;
     }
     .inplaceItem input{
         width: 100%;
         height: 40px;
         border: none;
         border-radius: 3px;
         box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.25);
         padding: 5px;
     }
     
     .inplaceTotal{
         display: flex;
         flex-direction: row;
         padding: 5px;
         align-items: center;
     }
     
     .inplaceTotal label{
         color: black;
     }
     .inplaceTotal input{
         width: 90%;
         height: 40px;
         border: none;
         border-radius: 3px;
         box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.25);
         padding: 5px;
     }
     .addRemarks{
         display: flex;
         flex-direction: column;
         padding: 5px;
     }
     .addRemarks textarea{
         width: 100%;
         border: none;
         border-radius: 3px;
         box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.25);
         padding: 10px;
         resize: none;
     }
     
    .rowRemarks span{
      width:100%
    }

    .edit-form{
      width:100%
    }
    .rowPdf{
        display: flex;
        align-items: center;
        width: 180px;
        border-radius: 10px;
        background: #FFF;
        box-shadow: 0px 2px 8px 0px rgba(0, 0, 0, 0.25);
        height: 65px;
    }
    
     .rowPdf p{
         width:100%;
     }
     
     .rowPdf p{
         width:100%;
         padding: 5px;
     }
    .rowPdf span{
        font-size: 30px;
        color: white;
    }
    .btnAdd{
        border: none;
        border-radius: 2px;
        color: white;
    }
    .btnAdd:hover{
        background-color: #eb984e;
        transition: .5s;
    }
    .addReplace{
        border: none;
        border-radius: 2px;
        color: white;
        background-color: green;
    }
    
    .cancelReplace{
        border: none;
        border-radius: 2px;
        color: white;
        background-color: red;
    }
    
    .rowReplace:hover{
        background-color: #eb984e;
        transition: .5s;
    }
    .rowInplace:hover{
        background-color: #eb984e;
        transition: .5s;
    }
    
    
</style>
@endsection
@section('navbar')
    @include('includes/nav')
@endsection
@section('content')

<div class="main-container">
    
    <div class="textformobile">
        <h5>Rotate your phone for better experience...</h5>
    </div>

    <div class="main-table" style="">
        <div class="table_header">
            <h3 style="font-weight: 600;">Reports</h3>     
        </div>

        @foreach($jobs as $job)
          @if($job->job_status == 'Decline' || $job->job_status == 'Assigned' || $job->job_status == 'Aborted')
              @continue
          @endif
          <div class="techRowReports">
            
            <div class="rowIssueReport">
                <div style="min-width: 20%; display: flex; flex-direction: row; padding-left:10px">
                    <h5 style="font-weight: 600; font-size: 13px;">Issue ID: {{$job->id}}</h5>
                </div>
                <div style="min-width: 25%; display: flex; justify-content:center;">
                    <h5 style="font-weight: 600; font-size: 13px;">{{$job->customer->first_name}} {{$job->customer->last_name}}</h5>
                </div>
                <div style="min-width: 38%; display: flex; justify-content:center;">
                    <p style="font-weight: 550; font-size: 13px;">{{$job->job_type}}</p>
                </div>                        
                <div class="status">
                    <div class="{{$job->job_status}}"></div>
                    <p>{{ $job->job_status }}</p>
                </div>
            </div>   
            <div class="rowAddInfo"  data-toggle="modal" data-target="#modalForm{{$job->id}}">
                <div>
                    <p style="font-weight: 550; font-size: 13px; color: white;">Add Information</p>
                </div>
            </div>
            
            <form method="POST" action="{{route('report-generate-quotation', ['id' => $job->id])}} ">
            @csrf
             <input type="text" name="status" value="{{$job->generated}}" hidden>
              <div class="rowPdf " style="padding:10px;">
                       
                  <div style="max-width: 40px; height: 45px; background: #EA6424; border-radius: 5px; display: flex; align-items: center; justify-content: center;">
                
                      @if($job->job_status == "On-going" || $job->job_status == 'Verification' || $job->job_status == 'Complete')  
                        @if($job->generated == "")                                                                                                  
                          
                        <button type='submit' style="border:none;background: red; width:100%;height:100%; border-radius: 5px;" ><span><i class="las la-file-pdf"></i></span></button>
                    
                        @else
                            
                        <button type='submit'  style="border:none;  background: green; width:100%;height:100%; border-radius: 5px;" ><span><i class="las la-file-pdf"></i></span></button>
                  
                        @endif
                      @endif
                  </div>
                
                @if($job->job_status == 'Aborted')
                        <p style="color: red; font-weight: 550; font-size: 13px; text-align:center;">
                            Task Was Aborted
                        </p>
                @else
           
                  @if($job->generated == "True" || $job->generated == "Downloaded")                                                                                                  
                     
                    @if($job->created_By_Admin == 'Yes' )   
                            <p style="font-weight: 550; font-size: 13px; text-align:center;">
                          Waiting for Admin approval
                      </p>
                    @else
                      <p style="font-weight: 550; font-size: 13px; text-align:center;">
                          Waiting for Customer approval
                      </p>
                   @endif  
                  @elseif($job->generated == "Approved")  
                  
                    @if($job->job_status == 'Complete')
                        <p style="color: green; font-weight: 550; font-size: 13px; text-align:center;">
                            Task Completed
                        </p>
                    @endif
                    
                     @if($job->job_status == 'On-going')
                          @if($job->created_By_Admin == 'Yes')
                            <p style="color: green; font-weight: 550; font-size: 13px; text-align:center;">
                                Quotation Was Approved by Admin
                            </p>
                          @else
                            <p style="color: green; font-weight: 550; font-size: 13px; text-align:center;">
                                Quotation Was Approved by customer
                            </p>
                          @endif
                    @endif
                      
                    @elseif($job->generated == "QuotationDecline")  
                      <p style="color: red; font-weight: 550; font-size: 13px; text-align:center;">
                        Quotation Was Declined by customer
                      </p>
                  @elseif($job->generated == Null)  
                      <p style=" font-weight: 550; font-size: 13px; text-align:center;">
                          Please Generate
                      </p>
                  @endif
                @endif
              </div>
            </form>
        </div>

          
          <!--Add information modal-->
           <div class="modal fade" id="modalForm{{$job->id}}" tabindex="-1" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-lg">                                 
                <div class="modal-content">
                      <div class="modal-header">
                          <h4 class="modal-title">Add Necessary Information</h4>
                      </div>      
                                            
                      <div class="modal-body" id="del-modal-body">
                        <div class="infoInputs">
                            <div class="replaceInfo">
                                <h5>Replace</h5>
                                <div class="button-wrapper">
                                    <button type="button" class="btnAdd"  style="background-color:#dc7633;" onclick="addRow('replace','modalForm{{$job->id}}')">Add Row</button>
                                </div>
                           
                            
                                 @if($job->partsReplace )
                                    @foreach ($job->partsReplace as $part)
                                   
                                      <div class="input-main-wrapper replaceItemWrapper">
                                        <div class="input-wrapper mainInputs">
                                          <label for="">Replace: </label>
                                          <input type="text" name="item" value="{{ $part['item'] }}" placeholder="">
                                        </div>
                                      
                                    </div> 
                          
                                    @endforeach     
                                  @endif

                                  @if($job->partsReplace == null)
                                        <div class="input-main-wrapper replaceItemWrapper">
                                          <div class="input-wrapper mainInputs">
                                            <label for="">Replace: </label>
                                            <input type="text" name="item">
                                          </div>
                                        </div>  
                                 
                                  @endif                
                            <div class="input-container-replace"> 
                              
                            </div>
                           
                         </div>
                            <div class="inplace">
                                <h5>Inplace</h5>
                                 <div class="button-wrapper " style="justify-content: flex-end; margin-bottom:30px">
                        
                                <button type="button" class="btnAdd" style="background-color:#dc7633;" onclick="addRow('inplace','modalForm{{$job->id}}')">Add Row</button>
                              </div>
                
                                
                                 @if($job->partsInplace )
                                  <div class="input-container-original"> 
                                      @foreach ($job->partsInplace as $part)
                                  
                                            <div class="input-main-wrapper inplaceItemWrapper">
                                              <div class="input-wrapper inplaceItem">
                                                <label for="">Item:</label>
                                                <input type="text" name="item" value="{{ $part['item'] }}" placeholder="{{ $part['item'] }}">
                                              </div>
                                               <div class="input-wrapper inplaceItem">
                                                <label for="">Unit:</label>
                                                <input type="text" name="unit" value="{{ $part['unit'] }}" placeholder="{{ $part['unit'] }}">
                                              </div>
                                              <div class="input-wrapper inplaceItem">
                                                <label for="">Price:</label>
                                                <input style='margin-right:10px' type="text" name="price" value="{{ $part['price'] }}" placeholder="{{ $part['price'] }}" pattern="\d*" inputmode="numeric" oninput="inputChanged(this)">
                                              </div>
                                                <div class="input-wrapper inplaceItem">
                                                <label for="">Quantity</label>
                                                <input type="text" name="quantity" value="{{ $part['quantity'] }}" placeholder="{{ $part['quantity'] }}" inputmode="numeric" pattern="\d*" oninput="inputChanged(this)">
                                              </div>
                                          </div> 
                               
                                        @endforeach     
                                   </div> 
                                @endif

                                    @if($job->partsInplace == null)
                                      <div class="input-main-wrapper inplaceItemWrapper">
                                        <div class="input-wrapper inplaceItem">
                                          <label for="">Item</label>
                                          <input type="text" name="item">
                                        </div>
                                        <div class="input-wrapper inplaceItem">
                                            <label for="">Unit</label>
                                            <input type="text" name="" value="" placeholder="">
                                        </div>
                                        <div class="input-wrapper inplaceItem" style='margin-right:10px'>
                                          <label for="">Price:</label>
                                          <input type="text" name="price" oninput="inputChanged(this)"   pattern="\d*" inputmode="numeric">
                                        </div>
                                        <div class="input-wrapper inplaceItem">
                                        <label for="">Quantity</label>
                                        <input type="text" name="quantity" oninput="inputChanged(this)"  pattern="\d*" inputmode="numeric">
                                      </div>
                                    </div>  
                                        
                                    @endif  
                                  <div class="input-container-inplace"> 
                                    
                                  </div>
                                  
                                  
                                <div class="inplaceTotal">
                                    <label>Total: ₱</label>
                                    @if($job->partsInplace)
                                    @php
                                        $totalPrice = 0;
                                    @endphp
                                @foreach ($job->partsInplace as $part)
                                    @php
                                        $totalPrice += $part['price'] * $part['quantity']; 
                                    @endphp
                                @endforeach 
                          
                                 
                                        
                                            @php
                                    echo '<input class="totalField" type="text" placeholder="' . $totalPrice . '" disabled/>';
                                @endphp
                                                                                           
                                   
                            @else
                                  @php
                                      
                                        echo '<input  class="totalField" type="text" placeholder="0" disabled/> ';                                                                                                             @endphp
                            @endif        
                                    
                                </div>
                            </div>
                                         <form action="{{ route('report-add', $job->id) }}" method="POST" id="addForm{{$job->id}}">
                            @csrf     
                            <div class="addRemarks">
                                <h5>Remarks and Accomplishment</h5>
                                <textarea id="accomplishmentRemarks" name="accomplishmentRemarks" rows="5" cols="50" placeholder="Comment here..">{{ $job->remarksAndAccomplishment }}</textarea>
                            </div>
                             <input type="hidden" name="inplaceData" id="inplaceData{{$job->id}}"> 
                              <input type="hidden" name="replaceData" id="replaceData{{$job->id}}"> 
                          </div>
                      </div>         
                      <div class="modal-footer">
                          <div class="options d-flex">
                              <button type="button" class="cancelReplace" onclick="closeView(event)">Cancel</button>
                                <button type="button" class="addReplace" onclick="collectData('modalForm{{$job->id}}','{{$job->id}}')">Add</button>
                            </form>
                                        
                          </div>
                      </div> 

                  </div>
              </div>
          </div>
          

        @endforeach
  
    </div>
</div>

<script>
    // JavaScript function to handle input changes
    function inputChanged(inputElement) {
        
        inputElement.value = inputElement.value.replace(/\D/g, '');
        // Find the closest modal by traversing up the DOM hierarchy
        var modalBody = inputElement.closest('.modal');

        var inputMainWrappers = modalBody.querySelectorAll('.inplaceItemWrapper');
        var totalText = modalBody.querySelectorAll('.totalField')[0];
        // Clear the formData array before collecting new data
        var total = 0;
        // Iterate over each input-main-wrapper
        
        console.log(inputMainWrappers)
        inputMainWrappers.forEach(function (inputMainWrapper) {
            // Get the item and price values from the current input-main-wrapper
           
            var priceInput = inputMainWrapper.querySelector('input[name="price"]');
            var quantityInput = inputMainWrapper.querySelector('input[name="quantity"]');
            
            priceInput = priceInput ? parseFloat(priceInput.value) : 0;
            quantityInput = quantityInput ? parseFloat(quantityInput.value) : 0;
            
            console.log(priceInput);
            console.log(quantityInput);
            
            total += priceInput * quantityInput;
            
            console.log(total)
        });
         totalText.placeholder = total;
         var total = 0
    }
    
    
    function isNumber(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
</script>

<script>
  function toggleField(cell) {
        console.log('s');

  
        var cell = event.currentTarget; // Use currentTarget to get the element that the event listener is attached to
        var cellContent = cell.querySelector('.cell-content');
        var editForm = cell.querySelector('.edit-form');

        cellContent.style.display = 'none';
        editForm.style.display = 'block';

        // Focus on the input field for better user experience
        var inputField = editForm.querySelector('input[name="accomplishmentRemarks"]');
        inputField.focus();

        editForm.addEventListener('submit', function (event) {
           
              editForm.submit();
        });
    }

 
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(Session::has('success'))
    <!-- Modal View -->
    <script>
        Swal.fire({
            icon: 'success',  
            text: "{{ Session::get('success') }}",
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




@if(Session::has('fail'))
    <!-- Modal View -->
    <script>
        Swal.fire({
            icon: 'error',  
            text: "{{Session::get('fail')}}",
        })
        </script>
@endif


<script>
    function addRow(type,modalId) {
      console.log('s');
    
          var modal = document.getElementById(modalId)
        
        console.log(modal)
        var newRow = document.createElement('div');
        newRow.classList.add('input-main-wrapper');
        // Create two input-wrapper elements for item and price
        var itemWrapper = document.createElement('div');
        itemWrapper.classList.add('input-wrapper');
        itemWrapper.classList.add('inplaceItem');
         
      if(type == "replace"){
        itemWrapper.innerHTML = '<label for="">Replace:</label><input type="text" name="item">';
        newRow.appendChild(itemWrapper);
        var container_toAdd = modal.getElementsByClassName('input-container-replace')[0];
      
          newRow.classList.add('replaceItemWrapper');
      }
        
        if(type != "replace"){
            newRow.classList.add('inplaceItemWrapper');
            itemWrapper.innerHTML = '<label for="">Item:</label><input type="text" name="item">';
            newRow.appendChild(itemWrapper);
            
          var unitWrapper = document.createElement('div');
          unitWrapper.classList.add('input-wrapper');
          unitWrapper.classList.add('inplaceItem');
          unitWrapper.innerHTML = '<label for="">Unit</label><input type="text"  name="Unit"  >';
          newRow.appendChild(unitWrapper);
  
          var priceWrapper = document.createElement('div');
          priceWrapper.classList.add('input-wrapper');
          priceWrapper.classList.add('mainInputs');
          priceWrapper.style.marginRight = '10px';
          
          priceWrapper.innerHTML = '<label for="">Price</label><input type="text"  name="price" onkeypress="return isNumber(event)" oninput="inputChanged(this)">';
          newRow.appendChild(priceWrapper);
           var quantityWrapper = document.createElement('div');
          quantityWrapper.classList.add('input-wrapper');
          quantityWrapper.classList.add('inplaceItem');
          quantityWrapper.innerHTML = '<label for="">Quantity</label><input type="text"  name="quantity" oninput="inputChanged(this)">';
          newRow.appendChild(quantityWrapper);
          
          var container_toAdd = modal.getElementsByClassName('input-container-inplace')[0];
        }
        
        // Append the new row to the specific modal's input-container
        
          

      

        console.log(container_toAdd);
        // Append the new row if the input-container exists
   
        container_toAdd.appendChild(newRow);
     

      }

    
    var formDataInplace = [];
    var formDataReplace = [];
    function collectData(modalId,id) {
        // Get all the input fields within the modal body
        var modalBody = document.getElementById(modalId).getElementsByClassName('modal-body')[0];
        var replaceItemWrapper = modalBody ? modalBody.querySelectorAll('.replaceItemWrapper') : [];
        var inplaceItemWrapper = modalBody ? modalBody.querySelectorAll('.inplaceItemWrapper') : [];

        // Clear the formData array before collecting new data
        var formDataInplace = [];
        var formDataReplace = [];
       
        // Iterate over each input-main-wrapper
        
        inplaceItemWrapper.forEach(function (inplaceItemWrapper) {
            // Get the item and price values from the current input-main-wrapper
            var itemInput = inplaceItemWrapper.querySelector('input[name="item"]');
            var priceInput = inplaceItemWrapper.querySelector('input[name="price"]');
            var quantityInput = inplaceItemWrapper.querySelector('input[name="quantity"]');
            var unitInput = inplaceItemWrapper.querySelector('input[name="unit"]');
            console.log(itemInput);
            // Check if the input fields are found before accessing their values
            var item = (itemInput && itemInput.value.trim() !== '') ? itemInput.value : null;
            var price = (priceInput && priceInput.value.trim() !== '') ? priceInput.value : 0;
            var quantity = (quantityInput && quantityInput.value.trim() !== '') ? quantityInput.value : 0;
            var unit = (unitInput && unitInput.value.trim() !== '') ? unitInput.value : 0;


         
              if (item !== null ) {
                formDataInplace.push({
                      item: item,
                      price: price,
                      quantity: quantity,
                       unit: unit
                  });
              }else{
                 Swal.fire({
                    icon: 'error',  
                            text: "Please Input value on Inplace",
                    })
                    
                    exit
                    
           
              }
           
        });
        
        
          replaceItemWrapper.forEach(function (replaceItemWrapper) {
            // Get the item and price values from the current input-main-wrapper
            var itemInput = replaceItemWrapper.querySelector('input[name="item"]');
          
            console.log(itemInput);
            // Check if the input fields are found before accessing their values
            var item = (itemInput && itemInput.value.trim() !== '') ? itemInput.value : null;
         
         
               if (item !== null) {
                formDataReplace.push({
                      item: item,    
                  });
             
              }
           
        });
        
        
        
        
       

        // var dataArray = [];

        // if(type == 'inplace'){
        //   formData.forEach(function (data) {
        //       dataArray.push({
        //           item: data.item,
        //           price: data.price,
        //               quantity: data.quantity
        //       });
        //   });
        // }else if(type == 'replace'){
        //   formData.forEach(function (data) {
        //     dataArray.push({
        //           item: data.item,

        //       });
        //   });
        // }

      

        console.log(formDataReplace);
        console.log(formDataInplace);
        document.getElementById('replaceData'+id).value = JSON.stringify(formDataReplace);
        document.getElementById('inplaceData'+id).value = JSON.stringify(formDataInplace);
        // Log or send the formData as needed
         document.getElementById('addForm'+id).submit();
        // You can send the formData to the server or perform any other actions here
    }

    function closeView(e) {
          var modal = e.target.closest('.modal');
          var modalBody = modal.getElementsByClassName('modal-body')[0];
      var inputContainer = modalBody ? modalBody.getElementsByClassName('input-container-inplace')[0] : null;
      inputContainer.innerHTML = '';
      console.log('close');
      
         var inputContainer = modalBody ? modalBody.getElementsByClassName('input-container-replace')[0] : null;
      inputContainer.innerHTML = '';
      console.log('close');
  
      $(modal).removeClass('show');
      $('body').removeClass('modal-open');
      $(modal).css('display', 'none');
      $('.modal-backdrop').remove();
     }

    
    
    
     

 
</script>
@endsection
