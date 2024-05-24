<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>-->
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">-->
    <!--<link rel="stylesheet"-->
    <!--    href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">-->
    <title>Transaction</title>
    <style>
        * {
            padding: 0;
            margin: 0;
        }
        .table-title {
            text-align: center;

        }

        #customers {
            /*font-family: Arial, Helvetica, sans-serif;*/
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
        <h3 class="table-title">C-Tech Accomplishment Report</h3>
        <div class="report-btns-actions">
              <p style="margin-bottom: 10px;">Date: <?php echo date('m/d/y'); ?></p>

        </div>
        <div class="reports-table">
            <table class="table table-bordered" id="customers">
                 <thead>
                    <tr>
                        <th>Job ID</th>
                        <th>Services</th>
                        <th>Account Number</th>
                        <th>Client name</th>
                        <th>Technician name</th>
                        <th>Address</th>
                        <th>Date Created</th>
                        <th>Date Assigned</th>
                        <th>Date Completed</th>
                        <!--<th>Coordinates</th>-->
                        <th>Customer Rating</th>
                    
                    </tr>
                </thead>
                <tbody>
                    @foreach($details as $job)
                    <tr>
                        <td>{{$job->job_id}}</td>
                        <td>{{$job->jobReq->job_type}}</td>
                        <td>{{$job->jobReq->customer_id}}</td>
                        <td>{{$job->client_name}}</td>  
                        <td>{{$job->jobReq->techList->first_name}} {{$job->jobReq->techList->last_name}}</td>
                        <td>{{$job->jobReq->address}}</td>
                        <td>{{$job->jobReq->created_at}}</td>
                        <td>{{$job->jobReq->assigned_at}}</td>
                        <td>{{$job->jobReq->completed_at}}</td>
                        <!--<td>longitude: (x){{$job->jobReq->customer->lng}} <br>latitude(y): {{$job->jobReq->customer->lat}}</td>-->
                        <!-- <td>-->
                        <!--      <span class="cell-content">{{ $job->coordinate }}</span>-->
                         
                        <!--  </td>-->
                        <!--<td>-->
                        <!--      <span class="cell-content">{{ $job->complaintsDescription }}</span>-->
                              
                        <!--  </td>-->
                                                  <td>
                          {{$job->jobReq->rating}}
                          </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>