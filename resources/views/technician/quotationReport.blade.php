
<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
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

    </style>
</head>
<body>  
<div class="img-logo">
            <div class="main-image" style="display: flex; justify-content: center; text-align: center;">
    <img src="{{ 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('img/gtechlogo.png'))) }}" style="margin: auto;">
</div>

        </div>
        <div class="company-info">
            <div class="main-info">
              <p>Osmeña St., Cariagas Building, Tagum City</p>
            <!--<p><b>TEL :</b> (084) 218 5770 ; (084) 807-2601</p>-->
            <p><b>CEL :</b> 09357113586</p>
            <p>E-mail : ctechhomecctvsolar@gmail.com</p>  
            </div>
        </div>
        <h2>PRICE QUOTATION</h2>
<table id="customers">
        <tr>
            <th class="item-th">ITEM</th>
            <th class="qty-th">QTY</th>
            <th class="unit-th">UNIT</th>
            <th class="desc">DESCRIPTION</th>
            <th class="unit-th">UNIT PRICE</th>
            <th class="unit-th">TOTAL PRICE</th>
        </tr>
             @php
                $total = 0;
                $overallTotal = 0
            @endphp

          @foreach (json_decode($details->partsInplace) as $index => $part))
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{$part->quantity}}</td>
                <td>{{$part->unit}}</td>
                <td>{{$part->item}}</td>
               @php
                    $itemTotal = $part->price * $part->quantity;
                    $total += $itemTotal;
                @endphp
                <td>{{$part->price}}</td>
                <td>{{ $total }}</td>
            </tr>
            {{$overallTotal +=  $total}}
            {{$total = 0;}}
        @endforeach  

    </table>

    <div class="total">
        <div class="final-total">
            <p>Total: {{ $overallTotal }}</p>
        </div>
    </div>

    <div class="terms">
        <h3>Terms and Condition</h3>
        <div class="terms-content">
            <p>Covered with 12 months warranty from the date of purchased. Warranty does not cover defects cause by
                abuse, misuse or such defect on the products as a result of voltage surges, blackouts, lightning, fire,
                earthquakes, human disaster or other acts of human & God.</p>
            <p>50% Downpayment. 50% after Commissioning.</p>
        </div>
    </div>

    <div class="prepared">
        <div class="semi-title">
            <p>Prepared by: </p>
        </div>
        <div class="assNames">
            <p>{{$details->techList->first_name}} {{$details->techList->last_name}}</td> 
            <p>IT/TECHNICIAN</p>
        </div>

        <div class="semi-title">
            <p>Noted by: </p>
        </div>
        <div class="assNames">
            <p>INGRID SOLIS</p>
            <p>STORE ASSOCIATE</p>
        </div>

        <div class="semi-title">
            <p>Recieve by: </p>
        </div>
        <div class="assNames">
            <p>{{strtoupper($details->customer->first_name)}} {{strtoupper($details->customer->last_name)}}</td> 
           
        </div>
    </div>
</body>
</html>
