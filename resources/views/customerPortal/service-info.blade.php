<div class="authentication-form ">
    
    <h4>Welcome back, Here is your service information </h4>
    <div class="rounded p-3 mb-3 bg-info text-black">
        <p>Recieved Date: {{ $service->created_at->diffForHumans() }} </p>
        <h6>Customer Name: {{ $service->customerName }}</h6>
        <p>Customer Phone: {{ $service->customerPhone }}</p>
        <p>Service Type:
            @foreach ($service->serviceTypes as $serviceType)
                {{$serviceType->name}},
            @endforeach
        </p>
        <h5 class="alert-success d-inline rounded p-1 ">Status: {{ $service->status }}</h5>
    </div>
</div>