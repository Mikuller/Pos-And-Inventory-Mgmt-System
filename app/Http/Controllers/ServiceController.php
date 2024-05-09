<?php

namespace App\Http\Controllers;

use App\Models\Credit;
use App\Models\Service;
use App\Models\ServiceType;
use Carbon\Carbon;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        return view('service.service_views.index');
    }
    public function serviceTypes()
    {
        return view('service.service_type_views.index');
    }

    public function editPendingService(Service $service)
    {
        $serviceTypes = ServiceType::latest()->get();
        session(['editMode' => true, 'service' => $service, 'serviceTypes' => $serviceTypes]);
        return back();
    }
    public function showPendingService(Service $service)
    {
        $serviceTypes = ServiceType::latest()->get();
        session(['showMode' => true, 'service' => $service, 'serviceTypes' => $serviceTypes]);
        return back();
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
            // $phoneSubStr = substr($validated['customerPhone'], -8);
            $validated['refNumber'] =  $validated['customerName'];
            $validated['status'] = 'Pending';
            $selectedServiceTypes = request()->input('serviceTypeId', []);

            // dd($validated);

            $service = Service::create($validated);
            $service->update([
                'refNumber' => $validated['customerName']."/".$service->id
            ]);
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
        session(['editPaymentMode' => true, 'service' => $service]);
        return back();
    }
    public function savePaymentInfo(Service $service)
    {
        if (request('paymentMethod') != null) {
            try {
                $service->update([
                    'paymentMethod' => request('paymentMethod'),
                    'paymentStatus' => request('paymentStatus'),
                    'deposit_bank_id' => request('depositBank'),
                    'paymentTimestamp' => Carbon::now(),
                    'maintainerName' => request('maintainerNameNew')!=null ? request('maintainerNameNew') : request('maintainerName'),
                    'eCashRefNumber' => request('eCashRefNumber'),
                    'price' => request('price'),
                ]);
                if ($service->paymentStatus == 'Unpaid') {
                    $this->saveAsCredit($service);
                }
                return back()->with('success', 'Service status is Updated, successfully');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', substr($e, 22, 55));
            }
        } else {
            return back()->with('error', 'Service status NOT Updated!!');
        }
    }
    public function saveAsCredit($service)
    {
        Credit::create([
            'debtorName' => $service->customerName,
            'debtorPhone' => $service->customerPhone,
            'amount' => $service->price,
            'creditDescription' => 'Service Credit',
            'service_id' => $service->id,
        ]);
    }
    public function markAsDone(Service $service)
    {
        $service->update([
            'status' => 'Done',
        ]);
        return back()->with('success', 'Service status is Updated, successfully');
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
