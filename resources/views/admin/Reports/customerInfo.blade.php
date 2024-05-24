
<!DOCTYPE html>
<html>
<head>
    <title>Customer Reports</title>
    <style>
        * {
    padding: 0;
    margin: 0;
}

#customers {
    font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
    padding: 10px;
}

#customers td,
#customers th {
    border: 1px solid #ddd;
    padding: 4px;
    text-align: center;
    font-size: 12px;
}

#customers tr:nth-child(even) {
    background-color: #f2f2f2;
}

#customers tr:hover {
    background-color: #ddd;
}

#customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: center;
    color: black;
    font-size: 12px;
}

.terms {
    width: 60%;
    margin: auto;
    margin-top: 20px;
}

.terms h3 {
    text-align: center;
    font-size: 15px;
}

.terms-content p {
    text-align: center;
    font-size: 12px;
}

.prepared {
    display: flex;
    justify-content: space-evenly;
    margin: 20px;
}
.semi-title{
    margin-bottom: 5px;
}

.assNames {
    display: block;
    font-size: 12px;
    margin-bottom: 20px;
}


.total {
    width: 100%;
}
.final-total {
   display: flex;
   justify-content: space-around;
}
.final-total p{
    font-size: 12px;
    font-weight: 500;
    float: right;
    margin-right: 80px;
}
h2{
    font-size: 20px;
    margin: 15px;
}
.item-th,
.qty-th,
.unit-th {
    max-width: 20px;
}
.company-info {
            display: flex;
            justify-content: center;
            width: 100%;
        }

.company-info .main-info {
    display: block;
    justify-content: center;
    text-align: center;
    margin-bottom: 10px;
}
.img-logo {
    display: flex;
    justify-content: center;
    width: 100%;
    margin-bottom: 5px;
    margin-top: 10px;
}
.img-logo img {
    max-width: 200px;
    min-height: 130px;
}

    </style>
</head>
<body>  
<div class="main-container">
        <div class="img-logo">
            <div class="main-image" style="display: flex; justify-content: center; text-align: center;">
    <img src="{{ 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('img/gtechlogo.png'))) }}" style="margin: auto;">
</div>

        </div>
        <div class="company-info">
            <div class="main-info">
              <p>Osmeña St., Cariagas Building, Tagum City</p>
            <!--<p><b>TEL :</b> (084) 218 5770 ; (084) 807-2601</p>-->
            <p><b>CEL :</b>  09357113586</p>
            <p>E-mail : ctechhomecctvsolar@gmail.com</p>  
            </div>
        </div>
        
<table id="customers">
        <tr>
            <th class="item-th">Account No.</th>
            <th class="qty-th">Client Name</th>
            <th class="unit-th">Email</th>
            <th class="desc">Address</th>
            <th class="unit-th">Contact No.</th>
            <th class="unit-th">Status</th>
        </tr>
         @foreach($details as $customer)
            <tr>
                <td>{{$customer->account_id}}</td>
                <td>{{$customer->first_name}} {{$customer->last_name}}</td>
                <td>{{$customer->email}}</td>
                <td>{{$customer->fullAdress}}</td>
                <td>{{$customer->mobile_number}}</td>
                <td>{{$customer->verification}}</td>
            </tr>
          @endforeach
    </table>

</body>
</html>
