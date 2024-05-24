@extends('../base')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/global.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/reports.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/sidenavigation.css')}}">

@endsection

@section('content')

@if($reportType == 'accomplishment')
        <!-- <p>Transaction Report</p> -->
        <table class="table table-bordered">
            <thead>
                <tr>
                <th>Name:</th>
                <th>Address:</th>
                </tr>
                <tr>
                <th>Email Address:</th>
                <th>Contact Number:</th>
                </tr>
                <tr>
                    <th>Transaction Report</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <td>John</td>
                <td>Doe</td>
                </tr>
                <tr>
                <td>Mary</td>
                <td>Moe</td>
                </tr>
                <tr>
                <td>July</td>
                <td>Dooley</td>   
                </tr>
            </tbody>
        </table>
    @elseif($reportType == 'cusInfo')
        <p>Cutomer Information</p>
    @elseif($reportType == 'jobOrder')
        <p>Job Order</p>
    @elseif($reportType == 'billing')
        <p>Billing Invoice</p>
    @endif
@endsection