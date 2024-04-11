<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceType;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        return view('service.pendingServices');
    }
    public function serviceTypes()
    {
        return view('service.serviceTypes');
    }
    public function createPendingService()
    {
        $serviceTypes = ServiceType::latest()->get();
        session(['createMode' => true, 'serviceTypes' => $serviceTypes]);
        return back();
    }
    public function editPendingService(Service $service)
    {
        //users can't edit a service after a day , 
        //because services are filtered with the time of update 
        //and updating a service after a day F*s with the daily report
        //this will allow me to show pending services that are registerd today and Done services that are marked as Done today
        if ($service->created_at < date("Y-m-d H:i:s")) {
            return back()->with('error',"Pending Service is not eligible for Editing");
        } else {
            $serviceTypes = ServiceType::latest()->get();
            session(['editMode' => true, 'service' => $service, 'serviceTypes' => $serviceTypes]);
            return back();
        }
        
    }
    public function updatePendingService(Service $service)
    {
        $validated = request()->validate([
            'customerName' => 'required|max:50|min:2',
            'customerPhone' => 'required|min:10',
            'price' => 'required|numeric|min:1',
            'statusNote' => 'nullable',

            // 'status' => 'required|in:Pending,Done,Aborted',
        ]);
        $validated['paymentMethod'] = request('paymentMethod', null);
        $validated['deposit_bank_id'] = request('depositBank', null);
        $validated['eCashRefNumber'] = request('eCashRefNumber', null);

        request()->validate(['serviceTypeId' => 'required|array|min:1']);
        $selectedServiceTypes = request()->input('serviceTypeId', []);

        // dd($validated);
        $service->update($validated);
        $service->serviceTypes()->sync($selectedServiceTypes);

        return back()->with('success', 'Service is Updated, successfully');
    }
    public function storePendingService()
    {
        try {
            //dd(request()->all());
            $validated = request()->validate([
                'customerName' => 'required|max:50|min:2',
                'customerPhone' => 'required|min:10',
                'price' => 'required|numeric|min:1',
                'statusNote' => 'nullable',

                // 'status' => 'required|in:Pending,Done,Aborted',
            ]);
            request()->validate(['serviceTypeId' => 'required|array|min:1']);
            $phoneSubStr = substr($validated['customerPhone'], -8);
            $validated['refNumber'] = $validated['customerName'] . $phoneSubStr;
            $validated['status'] = 'Pending';
            $selectedServiceTypes = request()->input('serviceTypeId', []);

            // dd($validated);

            $service = Service::create($validated);
            $service->serviceTypes()->sync($selectedServiceTypes);
            return redirect()->back()->with('success', 'New Pending Service is Added');
        } catch (ValidationException $e) {
            // Pass validation errors back to the view
            return redirect()->back()->withInput()->withErrors($e);
        } catch (\Exception $e) {
            // Handle other exceptions
            return redirect()->back()->with('error', substr($e, 22, 60));
        }
    }
    public function storeServiceType()
    {
        try {
            $validated = request()->validate([
                'name' => 'required|max:50|min:2',
            ]);
            ServiceType::create($validated);
            return back()->with('success', 'New Service Type is Added');
        } catch (\Exception $e) {
            // Handle other exceptions
            return redirect()->back()->with('error', substr($e, 22, 55));
        }
    }
    public function servicePaymentEdit(Service $service)
    {
        session(['editPaymentMode' => true,'service'=>$service]);
        return back();
    }
    public function markAsDone(Service $service)
    {
       
        if (request('paymentMethod')!=null) {
            try {
                $service->update([
                    'paymentMethod' => request('paymentMethod'),
                    'deposit_bank_id' => request('depositBank'),
                    'eCashRefNumber' => request('eCashRefNumber'),
                    'price' => request('price'),

                    'status' => 'Done',
                ]);
                
                return back()->with('success', 'Service status is Updated, successfully');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', substr($e, 22, 55));
            }
        }else {
            return back()->with('error', 'Service status NOT Updated!!');
        }
       
    }
    public function markAsPending(Service $service)
    {
        $service->update([
            'status' => 'Pending',
        ]);
        return back()->with('success', 'Service status is Updated, successfully');
    }
    public function abortPendingServiceStatus(Service $service)
    {
        $service->update([
            'status' => 'Aborted',
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
