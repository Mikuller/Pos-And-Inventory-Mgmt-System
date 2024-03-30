<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Message;
use App\Models\Product;
use App\Models\Service;
use App\Models\ServiceType;
use Illuminate\Http\Request;

class CustomerPortalController extends Controller
{
    public function index()
    {
        $serviceTypes = ServiceType::latest()->get();
        $products = Product::latest()->get();
        $categories = Category::latest()->get();
        $service = null;
        session(['showStatus'=>false]);
        if (request()->has('refNumber')) {
            
            $service = Service::where('refNumber', 'like', '%' . request('refNumber') . '%')->first();
            session(['showStatus'=> true]);
            // session()->put('service',$service);
        }
        return view('customerPortal.portal', compact('serviceTypes', 'products', 'categories', 'service'));
    }

    public function showServiceStatus()
    {
        if (request()->has('refNumber')) {
            $service = Service::where('refNumber', 'like', '%' . request('refNumber') . '%')->first();
        }

        return view('customerPortal.portal', compact('service'));
    }

    public function contactUsPage()
    {
        session()->put('showContactUsForm', true);
        return view('customerPortal.portal');
    }

    public function storeComment()
    {
       
       
            $validated = request()->validate([               
                'message' => 'required|min:5',
            ]);
            $validated['senderName'] = request('senderName',null);
            $validated['senderEmail'] = request('senderEmail',null);
            $validated['phoneNumber'] = request('phoneNumber', null);

           
            Message::create($validated);

            return redirect()->route('customer.contactUs')->with('success', 'Thanks, Comment is sent Successfully!');
            
   
    }
}