<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceType;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
       
        return view('inventory.service.pendingServices');

    }
    public function serviceTypes()
    {
       
        return view('inventory.service.serviceTypes');
    }
    public function createPendingService(){
        $serviceTypes = ServiceType::latest()->get();
        session(['createMode' => true, 'serviceTypes' => $serviceTypes]);
        return back();
    }
    public function editPendingService(Service $service){
        $serviceTypes = ServiceType::latest()->get();
        session(['editMode' => true, 'service' => $service, 'serviceTypes' => $serviceTypes]);
        return back();
    }
    public function updatePendingService(Service $service){
        $validated = request()->validate([
            'customerName' => 'required|max:50|min:2',
            'customerPhone' => 'required|min:10',
            'price' => 'required|numeric|min:1',
            
            // 'status' => 'required|in:Pending,Done,Aborted',
        ]);
        request()->validate(['serviceTypeId' => 'required|array|min:1',]);
        $selectedServiceTypes = request()->input('serviceTypeId',[]);
        
        // dd($validated);
        $service->update($validated);
        $service->serviceTypes()->sync($selectedServiceTypes);

        return back()->with('success', 'Service is Updated, successfully');
    }
    public function storePendingService()
    {
        $validated = request()->validate([
            'customerName' => 'required|max:50|min:2',
            'customerPhone' => 'required|min:10',
            'price' => 'required|numeric|min:1',
            
            // 'status' => 'required|in:Pending,Done,Aborted',
        ]);
        request()->validate(['serviceTypeId' => 'required|array|min:1',]);
        $validated['refNumber'] = date('Ymd-His');
        $validated['status'] = "Pending";
        $selectedServiceTypes = request()->input('serviceTypeId',[]);
        
        // dd($validated);
        $service = Service::create($validated);
        $service->serviceTypes()->sync($selectedServiceTypes);
        return redirect()->back()->with('success', 'New Pending Service is Added');
    }
    public function storeServiceType()
    {
        $validated = request()->validate([
            'name' => 'required|max:50|min:2',
        ]);
        ServiceType::create($validated);
        return back()->with('success', 'New Service Type is Added');
    }
    public function changePendingServiceStatus(Service $service){
        
         $service->update([
            'status' => "Done"
         ]);
        return back()->with('success', 'Service status is Updated, successfully');

    }
    public function abortPendingServiceStatus(Service $service){
        
        $service->update([
           'status' => "Aborted"
        ]);
       return back()->with('success', 'Service status is Updated, successfully');

   }
    public function destroyServiceType(ServiceType $serviceType)
    {
        $serviceType->delete();
        return back()->with('success', 'Service type is Deleted, successfully');
    }
    public function editServiceType(ServiceType $serviceType)
    {
        session(['editMode' => true, 'serviceType' => $serviceType]);
       
        return back();
    }
    public function updateServiceType(ServiceType $serviceType)
    {
        $validated = request()->validate([
            'name' => 'required|max:50|min:2',
        ]);
        $serviceType->update($validated);
        return back()->with('success', 'Service type is Updated, successfully');
    }
}
