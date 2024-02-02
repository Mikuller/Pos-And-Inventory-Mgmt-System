<div>
   
    @if (session('showStatus'))
        @include('customerPortal.status.showStatus')
    @else
        @include('customerPortal.status.statusForm')
    @endif
</div>
