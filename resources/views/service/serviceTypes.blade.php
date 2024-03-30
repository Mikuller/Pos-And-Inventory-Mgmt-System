@extends('inventory.layout')
@section('title', 'Services')
@section('content')


    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-user-plus bg-blue"></i>
                        <div class="d-inline">
                            <h5>Service Types</h5>
                            <span>View, delete and update Service Types</span></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('dashboard')}}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('service.index') }}">Service Types</a>
                            </li>

                        </ol>
                    </nav>

                </div>
                @include('include.message')
            </div>
        </div>
        <livewire:service-types/>
    </div>
    <div class="modal fade edit-layout-modal pr-0" id="serviceTypeAdd" role="dialog"
        aria-labelledby="serviceTypeAddLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog w-300" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="serviceTypeAddLabel">Add Service Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('service.store.ServiceType') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="d-block">Service Type Name</label>
                            <input type="text" name="name" class="form-control"
                                placeholder="Enter Service Type Name">
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="Save" value="Save">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if (session('editMode') && session('serviceType')->exists()  ?? false)
        <script>
            // Open the modal using JavaScript
            $(document).ready(function() {
                $('#serviceTypeEdit').modal('show');
            });
        </script>
        <?php session(['editMode' => false]); ?>{{-- Reset the session value after displaying modal --}}

        <div class="modal fade edit-layout-modal pr-0" id="serviceTypeEdit" role="dialog"
            aria-labelledby="serviceTypeEditLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog w-300" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="supplierEditLabel">Edit Service Type</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <form
                            action="{{ route('service.update.ServiceType', ['serviceType' => session('serviceType')->id]) }}"
                            method="POST">
                            @csrf
                            <div class="form-group">
                                <label class="d-block">Service Type Name</label>
                                <input type="text" name="name" class="form-control"
                                    placeholder="Enter Service Type Name" value="{{ session('serviceType')->name }}">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="Update" value="Update">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
