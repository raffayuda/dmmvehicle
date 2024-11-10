<?php

use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;


Auth::routes();
Route::group(['middleware' => 'auth'], function () {
    // Route::get('/', 'HomeController@index')->name('home');
    Route::group(['middleware'=>['web','cekuser:1']],
    function(){
            Route::view('/cobain','dashboard.modal');
            Route::get('/', 'HomeController@index')->name('home');
            Route::get('api/listalert','HomeController@listalert')->name('listalert');
            Route::get('api/listyellow','HomeController@listyellow')->name('listyellow');
            Route::get('api/listorange','HomeController@listorange')->name('listorange');
            Route::get('api/listred','HomeController@listred')->name('listred');

            Route::get('api/listyellowmain','HomeController@listyellowmain')->name('listyellowmain');
            Route::get('api/listorangemain','HomeController@listorangemain')->name('listorangemain');
            Route::get('api/listredmain','HomeController@listredmain')->name('listredmain');


            Route::get('api/vehiclemodel','ApiController@listVehicleModel')->name('listVehicleModel');
            Route::get('api/selectvehiclemodel','ApiController@selectVehicleModel')->name('selectVehicleModel');
            Route::get('api/selectpo','ApiController@selectpo')->name('selectpo');

            Route::get('api/manufacturer','ApiController@listManufacturer')->name('listManufacturer');
            Route::get('api/selectmanufacturer','ApiController@selectManufacturer')->name('selectManufacturer');
            
            Route::get('api/package','ApiController@listPackage')->name('listPackage');
            Route::get('api/selectpackage','ApiController@selectPackage')->name('selectPackage');
            Route::get('api/selectpackagetype','ApiController@selectPackageType')->name('selectPackageType');

            Route::get('api/customer','ApiController@listCustomer')->name('listCustomer');

            Route::get('api/supplier','SupplierController@listsupplier')->name('listsupplier');

            Route::get('api/employee','EmployeeController@listemployee')->name('listemployee');
            Route::get('api/selectdriver','ApiController@selectDriver')->name('selectDriver');
            Route::get('api/selectemployee','ApiController@selectEmployee')->name('selectEmployee');
            Route::get('api/selectskill','ApiController@selectSkill')->name('selectSkill');
            Route::get('api/selectmechanic','ApiController@selectMechanic')->name('selectMechanic');
            Route::get('api/selectleadinghead','ApiController@selectLeadinghead')->name('selectLeadinghead');
            Route::get('api/selectkoordinator','ApiController@selectKoordinator')->name('selectKoordinator');




            Route::get('api/sparepart','SparepartController@listsparepart')->name('listsparepart');
            Route::get('api/selectspareparttype','ApiController@selectSparepartType')->name('selectSparepartType');
            Route::get('api/selectsparepart','ApiController@selectSparepart')->name('selectSparepart');
            Route::get('api/selectstatuspart','ApiController@selectstatuspart')->name('selectstatuspart');

            

            Route::get('api/vehicle','VehicleController@listvehicle')->name('listvehicle');
            Route::get('api/selectvehicle','ApiController@selectVehicle')->name('selectVehicle');


            Route::get('api/lisence','LisenceController@listlisence')->name('listlisence');

            Route::get('api/daily','DailyController@listdaily')->name('listdaily');
            Route::get('api/dailyhistory','DailyController@listdailyhistory')->name('listdailyhistory');
            Route::get('dailyhistory','DailyController@dailyhistory');

            Route::get('api/selectequipement','ApiController@selectEquipement')->name('selectEquipement');
            Route::get('api/selectcondition','ApiController@selectCondition')->name('selectCondition');

            Route::get('api/inventory','InventoryController@listinventory')->name('listinventory');

            Route::get('api/grn','GrnController@listgrn')->name('listgrn');
            Route::get('api/listrequestedgrn','GrnController@listrequestedgrn')->name('listrequestedgrn');
            Route::get('api/selectdoctype','ApiController@selectDoctype')->name('selectDoctype');
            Route::get('api/selectsupplier','AselepiController@selectSupplier')->name('selectSupplier');


            Route::get('api/gin','GinController@listgin')->name('listgin');
            Route::get('api/listrequestedgin','GinController@listrequestedgin')->name('listrequestedgin');


            Route::get('api/maintenance','MaintenanceController@listmaintenance')->name('listmaintenance');
            Route::get('api/maintenancedue','HomeController@listmaintenancedue')->name('listmaintenancedue');

            Route::get('api/workorder','WorkorderController@listworkorder')->name('listworkorder');
            Route::get('api/listworkorderpackage/{id}','WorkorderpackageController@listworkorderpackage')->name('listworkorderpackage');
            Route::get('api/listworkorderpackageselect/{id}/{work}','WorkorderpackageController@listworkorderpackageselect')->name('listworkorderpackageselect');
            Route::get('history','WorkorderController@history')->name('history');
            Route::get('api/history','WorkorderController@listhistory')->name('listhistory');

            Route::get('api/requisition','RequisitionController@listrequisition')->name('listrequisition');
            Route::get('requisition/send/{id}','RequisitionController@requisitionsend')->name('requisitionsend');
            Route::get('requisition/acknowledge/{id}','RequisitionController@requisitionacknowledge')->name('requisitionacknowledge');
            Route::get('requisition/approve/{id}','RequisitionController@requisitionapprove')->name('requisitionapprove');
            Route::get('api/requested/{id}','RequestedController@listrequested')->name('listrequested');

            Route::get('api/purchase','PurchaseController@listpurchase')->name('listpurchase');
            Route::get('api/coba','CobaController@listcoba')->name('listcoba');
            Route::get('api/purchasereport','PurchaseController@listpurchasereport')->name('listpurchasereport');


            Route::get('api/partpackage/{wo}','PartpackageController@listpartpackageselect')->name('listpartpackageselect');
            Route::get('api/partpackagelist/{wo}','PartpackageController@listpartpackage')->name('listpartpackage');
            Route::get('editpart/{id}/{work}','PartpackageController@editpart');
            Route::patch('updatepart/{id}','PartpackageController@updatepart')->name('updatepart');

            Route::resource('vehiclemodel','VehiclemodelController');
            Route::resource('manufacturer','ManufacturerController');
            Route::resource('package','PackageController');
            Route::resource('partpackage','PartpackageController');
            Route::resource('customer','CustomerController');
            Route::resource('supplier','SupplierController');
            Route::resource('employee','EmployeeController');
            Route::resource('kimper','EmployeeController');
            Route::resource('sparepart','SparepartController');
            Route::resource('vehicle','VehicleController');
            Route::resource('lisence','LisenceController');
            Route::resource('daily','DailyController');
            Route::resource('inventory','InventoryController');
            Route::resource('stockopname','StockopnameController');
            Route::get('listsparepartopname','StockopnameController@listsparepartopname')->name('listsparepartopname');
            Route::get('adjustment/{id}','StockopnameController@adjustment');
            Route::get('listadjustment/{id}','StockopnameController@listadjustment')->name('listadjustment');


            Route::resource('initial','InitialController');
            Route::resource('grn','GrnController');
            Route::post('savegrn','GrnController@savegrn')->name('savegrn');
            Route::get('addgrn/{id}','GrnController@addgrn')->name('addgrn');
            Route::resource('coba','CobaController');
            Route::resource('gin','GinController');
            Route::get('addgin/{id}','GinController@addgin')->name('addgin');
            Route::post('savegin','GinController@savegin')->name('savegin');


            Route::resource('maintenance','MaintenanceController');
            Route::resource('workorder','WorkorderController');
            Route::post('savewo','WorkorderController@savewo')->name('savewo');
            Route::get('addpackage/{id}/{work}','WorkorderpackageController@addpackage')->name('addpackage');
            Route::get('addpart/{part}/{work}','PartpackageController@addpart')->name('addpart');
            Route::get('delpackage/{id}','WorkorderpackageController@delpackage')->name('delpackage');


            




            Route::resource('requisition','RequisitionController');
            Route::post('requisitions','RequisitionController@createspr')->name('createspr');
            Route::resource('requested','RequestedController');
            Route::resource('purchase','PurchaseController');
            Route::post('savepurchase','PurchaseController@savepurchase')->name('savepurchase');
            Route::get('submitpruchase/{id}','PurchaseController@submitpurchase')->name('submitpurchase');
            Route::get('rejectpurchase/{id}','PurchaseController@rejectpurchase')->name('rejectpurchase');
            Route::get('editpurchase/{id}','PurchaseController@editpurchase')->name('editpurchase');
            Route::get('printpurchase/{id}','PurchaseController@printpurchase')->name('printpurchase');
            Route::patch('purchase/poprice/{id}','PurchaseController@poprice')->name('poprice');
            Route::patch('editpurchase/poprice/{id}','PurchaseController@poprice')->name('poprice');
            Route::get('purchasereport','PurchaseController@purchasereport');
            // Route::get('purchase/{id}','PurchaseController@printpo');


            Route::get('requested/create/{id}','RequestedController@create');

            Route::get('printstock/{id}','InventoryController@printstock');
            Route::get('printwo/{id}','WorkorderController@printwo');
            Route::get('inprogress/{id}','WorkorderController@inprogress');
            Route::get('pending/{id}','WorkorderController@pending');


            Route::get('wodone/{id}','WorkorderController@wodone')->name('wodone');
            Route::post('done/{id}','WorkorderController@done')->name('done');
            
            Route::get('/sendemail', 'SendEmailController@index');
            Route::post('/sendemail/send', 'SendEmailController@send');



// New Flow PR
            Route::resource('pr','PrController');
            Route::get('prdata','PrController@prdata')->name('prdata');
            Route::get('rejectpr/{id}','PrController@rejectpr')->name('rejectpr');
            Route::get('submitpr/{id}','PrController@submitpr')->name('submitpr');
            Route::get('acknowledgepr/{id}','PrController@acknowledgepr')->name('acknowledgepr');
            Route::get('approvepr/{id}','PrController@approvepr')->name('approvepr');

            
            Route::get('addpartdata/{id}','PrController@addpartdata')->name('addpartdata');

            Route::resource('prdetail','PrdetailController');
            Route::get('prdetail/{id}/{spareparts_id}','PrdetailController@addprdetail')->name('addprdetail');

            Route::get('listdetailpr/{id}','PrdetailController@listdetailpr')->name('listdetailpr');



            Route::resource('po','PoController');
            Route::get('rejectpo/{id}','PoController@rejectpo')->name('rejectpo');
            Route::get('submitpo/{id}','PoController@submitpo')->name('submitpo');
            Route::get('cancelpo/{id}','PoController@cancelpo')->name('cancelpo');
            Route::get('donepo/{id}','PoController@donepo')->name('donepo');
            Route::get('printpo/{id}','PoController@printpo')->name('printpo');
            Route::get('liststatuspo','PoController@liststatuspo')->name('liststatuspo');
            Route::get('statuspo','PoController@statuspo')->name('statuspo');

            Route::get('podata','PoController@podata')->name('podata');




            Route::resource('podetail','PodetailController');

            Route::get('listdetailpo/{id}','PodetailController@listdetailpo')->name('listdetailpo');


            Route::resource('createwo','CreatewoController');
            Route::get('listwomanual','CreatewoController@listwomanual')->name('listwomanual');


            Route::resource('robbing','RobbingController');



            //New PRocurement Process

            Route::resource('newpr','NewprController');
            Route::resource('newprdetail','NewprdetailController');
            Route::get('newprdata','NewprController@newprdata')->name('newprdata');
            Route::get('newprdetaildata/{id}','NewprdetailController@newprdetaildata')->name('newprdetaildata');
            Route::get('sparepartlist/{id}','NewprdetailController@sparepartlist')->name('sparepartlist');
            Route::get('addprdetail/{id}/{spareparts_id}','NewprdetailController@addprdetail')->name('addprdetail');
            Route::get('submitnewpr/{id}','NewprController@submitnewpr')->name('submitnewpr');
            Route::get('rejectnewpr/{id}','NewprController@rejectnewpr')->name('rejectnewpr');
            Route::get('acknowledgenewpr/{id}','NewprController@acknowledgenewpr')->name('acknowledgenewpr');
            Route::get('approvenewpr/{id}','NewprController@approvenewpr')->name('approvenewpr');



            Route::resource('newpo','NewpoController');
            Route::resource('newpodetail','NewpodetailController');

            Route::get('viewsubmit/{newpos_id}','NewpoController@viewsubmit');

            Route::get('newpodata','NewpoController@newpodata')->name('newpodata');
            Route::get('addpodata','NewpoController@addpodata')->name('addpodata');
            Route::get('newpo/{newprs_id}/addpo','NewpoController@addpo')->name('addpo');
            Route::get('addpodetaildata','NewpodetailController@addpodetaildata')->name('addpodetaildata');
            Route::post('updatepodetail/{newpos_id}','NewpodetailController@updatepodetail')->name('newpodetail.updatepodetail');
            Route::get('addpopartdetaildata/{newprs_id}/{newpos_id}','NewpodetailController@addpopartdetaildata')->name('addpopartdetaildata');
            Route::get('newpodetail/{newprdetails_id}/addpodetail/{newpos_id}/{spareparts_id}','NewpodetailController@addpodetail');
            Route::get('submitnewpo/{newpos_id}','NewpoController@submitnewpo')->name('submitnewpo');
            Route::get('printnewpo/{newpos_id}','NewpoController@printnewpo')->name('printnewpo');
            Route::get('editnewpo/{newpos_id}','NewpoController@editnewpo')->name('editnewpo');
            Route::get('cancelnewpo/{newpos_id}','NewpoController@cancelnewpo')->name('cancelnewpo');
            Route::get('donenewpo/{newpos_id}','NewpoController@donenewpo')->name('donenewpo');
            Route::get('rejectnewpo/{newprs_id}','NewpoController@rejectnewpo')->name('rejectnewpo');
//PO Repot
            Route::get('liststatusnewpo','NewpoController@liststatusnewpo')->name('liststatusnewpo');


            Route::resource('newgr','NewgrController');
            Route::resource('newgrdetail','NewgrdetailController');

            Route::get('newgrdata','NewgrController@newgrdata')->name('newgrdata');
            Route::get('addgrdata','NewgrController@addgrdata')->name('addgrdata');
            Route::get('newgr/{newpos_id}/addgr','NewgrController@addgr')->name('addgr');
            Route::get('addgrdetaildata','NewgrdetailController@addgrdetaildata')->name('addgrdetaildata');
            Route::post('updategrdetail/{newgrs_id}','NewgrdetailController@updategrdetail')->name('newgrdetail.updategrdetail');
            Route::get('addgrpartdetaildata/{newpos_id}/{newgrs_id}','NewgrdetailController@addgrpartdetaildata')->name('addgrpartdetaildata');
            Route::get('newgrdetail/{newpodetails_id}/addgrdetail/{newgrs_id}/{spareparts_id}','NewgrdetailController@addgrdetail');
            Route::get('submitnewgr/{newgrs_id}','NewgrController@submitnewgr')->name('submitnewgr');



            






            





    });
});

Route::group(['middleware' => 'web'],function() {
    // Route::resource('transaksi', 'TransaksiController');
    // Route::resource('new', 'NewController');
    Route::get('users/profil', 'UserController@profil')->name('user.profil');
    Route::patch('users/{id}/change', 'UserController@changeprofil');
});