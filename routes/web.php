<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authentication;
use App\Http\Controllers\Recovery;
use App\Http\Controllers\LandingView;

// Admin 
use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\admin\AdminCustomerlistController;
use App\Http\Controllers\admin\AdminTechnicianController;
use App\Http\Controllers\admin\AdminJobrequestController;
use App\Http\Controllers\admin\AdminProfileController;
use App\Http\Controllers\admin\AdminReportsController;
use App\Http\Controllers\admin\AdminLocationController;
use App\Http\Controllers\admin\AdminQuotationController;
use App\Http\Controllers\admin\AdminCustReportController;


// Customer 
use App\Http\Controllers\customer\CustomerDashboardController;
use App\Http\Controllers\customer\CustomerJobreqController;
use App\Http\Controllers\customer\CustomerProfileController;
use App\Http\Controllers\customer\CustomerLocationController;

// Technician 
use App\Http\Controllers\technician\TechnicianTaskController;
use App\Http\Controllers\technician\TechnicianProfileController;
use App\Http\Controllers\technician\TechnicianLocationController;
use App\Http\Controllers\technician\TechnicianDailyReports;

use App\Http\Controllers\ImageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//Landing Views

Route::get('/', function (){ return view('landing/homepage', ['navigation'=>'homepage','section' => 'homepage','noBurger']);});
Route::get('/user-option',[LandingView::Class, 'useroption'])->middleware('alreadyLoggedIn');


//Authentication Section
Route::get('/login/{usertype}', [Authentication::Class, 'login'])->name('user-option.type')->middleware('alreadyLoggedIn');
Route::get('/register', [Authentication::Class, 'register'])->name('register');
Route::post('/register/submit/', [Authentication::Class, 'registerSubmit'])->name('register-submit');
Route::post('/login-user', [Authentication::Class, 'loginUser'])->name('login-user');
Route::get('/recovery', [Recovery::Class, 'recover']);
    Route::post('/recovery/submit', [Recovery::Class, 'recoverSubmit'])->name('recovery-account');
Route::get('/logout', [Authentication::Class, 'logout']);

//Admin Section

Route::get('admin/dashboard', [AdminDashboardController::Class, 'dashboardView'])->middleware('isLoggedIn');
    Route::post('admin/dashboard/sorted', [AdminDashboardController::Class, 'dashboardSorted'])->name('sort-status');
    Route::get('admin/dashboard/sorted', [AdminDashboardController::Class, 'dashboardSorted'])->name('sort-status');
    

Route::get('admin/customerlist', [AdminCustomerlistController::Class, 'customerlistView'])->middleware('isLoggedIn');
 Route::post('admin/customerlist/search', [AdminCustomerlistController::class, 'customerSearch']);
    Route::post('admin/customerlist/add', [AdminCustomerlistController::Class, 'customerAdd'])->name('customer-add');
    Route::post('admin/customerlist/editLocation', [AdminCustomerlistController::Class, 'editLocation'])->name('customer-edit-location');
    Route::post('admin/customerlist/delete/{id}', [AdminCustomerlistController::Class, 'customerDelete'])->name('customer-delete');
    Route::post('admin/customerlist/edit/{id}', [AdminCustomerlistController::Class, 'customerEdit'])->name('customer-edit');
    Route::get('admin/customerlist/verify/{id}', [AdminCustomerlistController::Class, 'verifyCustomer'])->name('verify-customer');
    Route::post('admin/customerlist/generate', [AdminCustomerlistController::Class, 'generatePDF'])->name('report-customer-info');
    Route::get('/download-pdf/{filename}', [AdminCustomerlistController::class, 'downloadPDF']);


Route::get('admin/technicianlist', [AdminTechnicianController::Class, 'technicianlistView'])->middleware('isLoggedIn');;
    Route::post('admin/technicianlist/add', [AdminTechnicianController::Class, 'technicianAdd'])->name('technician-add');
    Route::post('admin/technicianlist/delete/{id}', [AdminTechnicianController::Class, 'technicianDelete'])->name('technician-delete');
    Route::post('admin/technicianlist/edit/{id}', [AdminTechnicianController::Class, 'technicianEdit'])->name('technician-edit');

Route::get('admin/addjobreq', [AdminJobrequestController::Class, 'jobreqView'])->middleware('isLoggedIn');;
    Route::post('admin/addjobreq/assign', [AdminJobrequestController::Class, 'assignTech'])->name('assign-tech');
    Route::post('admin/addjobreq/cancel/{id}', [AdminJobrequestController::Class, 'cancelTech'])->name('cancel-assign');
    Route::get('admin/profile', [AdminProfileController::Class, 'profileView']);
    Route::post('admin/profile/edit/{id}', [AdminProfileController::Class, 'profileEdit'])->name('profile-edit-admin');
    Route::post('admin/profile/delete/{id}', [AdminProfileController::Class, 'profileDelete'])->name('profile-delete-admin');
    
    Route::post('admin/addjobreq/sorted', [AdminJobrequestController::Class, 'jobReqSorted'])->name('sort-status-jobReq');
    Route::post('admin/addjobreq/adminAddRequest', [AdminJobrequestController::Class, 'adminAddRequest'])->name('admin-add-customer-requestJob');
    Route::get('admin/addjobreq/sorted', [AdminJobrequestController::Class, 'jobReqSorted'])->name('sort-status-jobReq');
    Route::get('admin/addjobreq/sorted/area', [AdminJobrequestController::Class, 'jobReqSortedArea'])->name('sort-area-jobReq');
  Route::post('admin/addjobreq/sorted/area', [AdminJobrequestController::Class, 'jobReqSortedArea'])->name('sort-area-jobReq');
    
Route::get('admin/reports', [AdminReportsController::Class, 'reportsView'])->middleware('isLoggedIn');
     Route::post('admin/reports/edit/{id}', [AdminReportsController::Class, 'reportEdit'])->name('report-edit');
     Route::post('admin/reports/sorted', [AdminReportsController::Class, 'reportSort'])->name('sort-status-reports');
     Route::get('admin/reports/sorted', [AdminReportsController::Class, 'reportSort'])->name('sort-status-reports');
     Route::post('admin/reports/download-pdf/', [AdminReportsController::Class, 'generatePDF'])->name('report-generate-accomplishment-admin');
     
Route::get('admin/custReport', [AdminCustReportController::Class, 'custReportView'])->middleware('isLoggedIn');

Route::get('admin/location', [AdminLocationController::Class, 'locationView'])->middleware('isLoggedIn');
Route::get('admin/quotation', [AdminQuotationController::Class, 'quotationView'])->middleware('isLoggedIn');
    Route::post('admin/reports/generate/{id}', [AdminQuotationController::Class, 'reportGenerate'])->name('report-generate-quotation-admin');
    Route::get('/download-pdf/{filename}', [AdminQuotationController::class, 'downloadPDF']);


 
//Customer Section
Route::get('customer/dashboard', [CustomerDashboardController::Class, 'dashboardView'])->middleware('isLoggedIn');;
    Route::post('customer/dashboard/add', [CustomerDashboardController::Class, 'dashboardAdd'])->name('customer-requestJob');
Route::get('customer/jobreq', [CustomerJobreqController::Class, 'jobreqView'])->middleware('isLoggedIn');
    Route::get('customer/jobreq/view/{id}', [CustomerJobreqController::Class, 'jobreqViewClicked'])->name('job-view-clicked');


    Route::post('customer/jobreq/edit', [CustomerJobreqController::Class, 'jobreqEdit'])->name('job-edit');
    Route::post('customer/jobreq/cancel/{id}', [CustomerJobreqController::Class, 'jobreqCancel'])->name('job-cancel');
    
    Route::post('customer/jobreq/complete', [CustomerJobreqController::Class, 'jobreqComplete'])->name('job-complete');
    Route::post('customer/jobs/sorted', [CustomerJobreqController::Class, 'customerJobSorted'])->name('sort-status-customer');
    Route::get('customer/jobs/sorted', [CustomerJobreqController::Class, 'customerJobSorted'])->name('sort-status-customer');
    // Route::post('customer/jobs/generatePDF/{id}', [CustomerJobreqController::Class, 'generatePDF'])->name('generatePDF');
    Route::get('/customer/jobreq/view/generatePDF/{id}', [CustomerJobreqController::Class, 'generatePDF'])->name('generatePDF');
    Route::post('customer/approved/{id}', [CustomerJobreqController::Class, 'approvePDF'])->name('approvePDF');
    Route::post('customer/declineQuotation', [CustomerJobreqController::Class, 'declineQuotation'])->name('declineQuotation');
    Route::get('/download-pdf/{filename}', [CustomerJobreqController::class, 'downloadPDF']);
      
Route::get('customer/profile', [CustomerProfileController::Class, 'profileView']);
    Route::post('customer/profile/edit/{id}', [CustomerProfileController::Class, 'profileEdit'])->name('profile-edit');
    Route::post('customer/profile/delete/{id}', [CustomerProfileController::Class, 'profileDelete'])->name('profile-delete');

  
Route::get('customer/location', [CustomerLocationController::Class, 'locationView'])->middleware('isLoggedIn');
    Route::post('customer/location/edit/{id}', [CustomerLocationController::Class, 'locationEdit'])->name('location-edit');
    Route::get('customer/location/getIP', [CustomerLocationController::Class, 'locationGetIP']);


//Technician Section
Route::get('technician/techTask', [TechnicianTaskController::Class, 'technicianTaskView'])->middleware('isLoggedIn');
Route::get('technician/techTask/view/{id}', [TechnicianTaskController::Class, 'technicianTaskViewClicked'])->name('job-view-clicked-tech');

    Route::post('technician/accept/{id}', [TechnicianTaskController::Class, 'techAccept'])->name('tech-accept');
    Route::post('technician/abort/{id}', [TechnicianTaskController::Class, 'techAbort'])->name('tech-abort');
    Route::post('technician/decline/{id}', [TechnicianTaskController::Class, 'techDecline'])->name('tech-decline');
    Route::post('technician/delete/{id}', [TechnicianTaskController::Class, 'techDelete'])->name('tech-delete');
    Route::post('technician/complete/{id}', [TechnicianTaskController::Class, 'jobreqComplete'])->name('tech-complete');
    Route::post('technician/cancel/{id}', [TechnicianTaskController::Class, 'techCancel'])->name('tech-cancel');
    Route::get('technician/profile', [TechnicianProfileController::Class, 'profileView']);
    Route::post('technician/profile/edit/{id}', [TechnicianProfileController::Class, 'profileEdit'])->name('profile-edit-tech');
    Route::post('technician/profile/delete/{id}', [TechnicianProfileController::Class, 'profileDelete'])->name('profile-delete-tech');

    Route::post('technician/techTask/sorted', [TechnicianTaskController::Class, 'technicianTaskSorted'])->name('sort-status-tech');
    Route::get('technician/techTask/sorted', [TechnicianTaskController::Class, 'technicianTaskSorted'])->name('sort-status-tech');
    
Route::get('technician/location', [TechnicianLocationController::Class, 'locationView'])->middleware('isLoggedIn');
Route::get('technician/location/{lat}/{lng}/{name}/{status}/{address}', [TechnicianLocationController::Class, 'locationRedicrect'])->name('location-redirect');;

Route::get('technician/reports', [TechnicianDailyReports::Class, 'reportView'])->middleware('isLoggedIn');
    Route::post('technician/reports/add{id}', [TechnicianDailyReports::Class, 'reportAdd'])->name('report-add');
    // Route::post('technician/reports/add/inplace/{id}', [TechnicianDailyReports::Class, 'reportAddInplace'])->name('report-add-inplace');
    // Route::post('technician/reports/add/remarks/{id}', [TechnicianDailyReports::Class, 'reportAddRemarks'])->name('report-add-remarks');
    Route::post('technician/reports/generate/{id}', [TechnicianDailyReports::Class, 'reportGenerate'])->name('report-generate-quotation');
    Route::get('/download-pdf/{filename}', [TechnicianDailyReports::class, 'downloadPDF']);
//Profile Section
Route::post('/upload', [ImageController::Class, 'upload']);



