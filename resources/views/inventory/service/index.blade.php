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
                    <a href="{{ route('service.pendingServices') }}" class="btn btn-sm btn-primary">Add Pending Service </a>

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
        <div class="row">
            <!-- start message area-->
            <div class="col-md-12">
            </div> <!-- end message area-->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header row">
                        <div class="col col-sm-2">
                            <a href="#serviceTypeAdd" data-toggle="modal" data-target="#serviceTypeAdd"
                                class="btn btn-sm btn-primary">Add New Service Type </a>
                        </div>

                        <div class="col col-sm-1">
                            <div class="card-options d-inline-block">

                                <div class="dropdown d-inline-block">
                                    <a class="nav-link dropdown-toggle" href="#" id="moreDropdown" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                            class="ik ik-more-horizontal"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="moreDropdown">
                                        <a class="dropdown-item" href="#">Delete</a>
                                        <a class="dropdown-item" href="#">More Action</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col col-sm-6">
                            <div class="card-search with-adv-search dropdown">
                                <form action="">
                                    <input type="text" class="form-control global_filter" id="global_filter"
                                        placeholder="Search.." required="">
                                    <button type="submit" class="btn btn-icon"><i class="ik ik-search"></i></button>
                                    <button type="button" id="adv_wrap_toggler"
                                        class="adv-btn ik ik-chevron-down dropdown-toggle" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false"></button>
                                    <div class="adv-search-wrap dropdown-menu dropdown-menu-right"
                                        aria-labelledby="adv_wrap_toggler">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="text" class="form-control column_filter"
                                                        id="col0_filter" placeholder="Name" data-column="0">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control column_filter"
                                                        id="col1_filter" placeholder="Code" data-column="1">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control column_filter"
                                                        id="col2_filter" placeholder="Country" data-column="2">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control column_filter"
                                                        id="col3_filter" placeholder="City" data-column="3">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control column_filter"
                                                        id="col4_filter" placeholder="Email" data-column="4">
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-theme">Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col col-sm-3">
                            <div class="card-options text-right">
                                <span class="mr-5" id="top">1 - 10 of 100</span>
                                <a href="#"><i class="ik ik-chevron-left"></i></a>
                                <a href="#"><i class="ik ik-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="advanced_table" class="table">
                            <thead>
                                <tr>
                                    <th class="nosort" width="10">
                                        <label class="custom-control custom-checkbox m-0">
                                            <input type="checkbox" class="custom-control-input" id="selectall"
                                                name="" value="option2">
                                            <span class="custom-control-label">&nbsp;</span>
                                        </label>
                                    </th>
                                    <th>Name</th>

                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($serviceTypes as $serviceType)
                                    <tr>
                                        <td>
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input select_all_child"
                                                    id="" name="" value="option2">
                                                <span class="custom-control-label">&nbsp;</span>
                                            </label>
                                        </td>
                                        <td>{{ $serviceType->name }}</td>
                                        <td>
                                            <a
                                                href="{{ route('service.edit.ServiceType', ['serviceType' => $serviceType->id]) }}"><i
                                                    class="ik ik-edit f-16 mr-15 text-green"></i></a>
                                            <a href="{{ route('service.destroy', ['serviceType' => $serviceType->id]) }}"><i
                                                    class="ik ik-trash-2 f-16 text-red"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
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
