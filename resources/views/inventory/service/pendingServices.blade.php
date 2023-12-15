@extends('inventory.layout')
@section('title', 'Services')
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="fa fa-spinner bg-green" aria-hidden="true"></i>
                        <div class="d-inline">
                            <h5>Pending services</h5>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <a href="{{ route('service.serviceTypes') }}" class="btn btn-sm btn-primary">Add Service Types</a>

                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('service.index') }}">Pending services</a>
                            </li>
                        </ol>
                    </nav>
                </div>
                @include('include.message')
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header row">
                        <div class="col col-sm-2">
                            <a href="{{ route('service.create.pendingService') }}" class="btn btn-primary btn-rounded">Add
                                service</a>
                        </div>
                        <div class="col col-sm-1">

                            <div class="card-options d-inline-block">
                                <div class="dropdown d-inline-block">
                                    <a class="nav-link dropdown-toggle" href="#" id="moreDropdown" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                            class="ik ik-more-horizontal"></i></a>
                                    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="moreDropdown">
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
                                        placeholder="Search..">
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
                                                        id="col1_filter" placeholder="Warehouse" data-column="1">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control column_filter"
                                                        id="col2_filter" placeholder="Supplier" data-column="2">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <select class="form-control" name="sale_status">
                                                        <option selected="">Select Status</option>
                                                        <option value="recieved">Recieved</option>
                                                        <option value="ordered">Ordered</option>
                                                        <option value="pending">Pending</option>
                                                    </select>
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
                                <span class="mr-5" id="top">1 - 50 of 2,500</span>
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
                                    <th class="nosort">RefNo.</th>
                                    <th>Customer Name</th>
                                    <th>Service Type</th>
                                    <th>Total Price</th>
                                    <th>Status</th>
                                    @can('admin')
                                    <th>Action</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pendingServices  as $pendingService)

                                    <tr>
                                        <td>
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input select_all_child"
                                                    id="" name="" value="option2">
                                                <span class="custom-control-label">&nbsp;</span>
                                            </label>
                                        </td>
                                        <td>{{ $pendingService->refNumber }}</td>
                                        <td>{{ $pendingService->customerName }}</td>

                                        <td>
                                            @foreach ($pendingService->serviceTypes as $serviceTypes)
                                                {{ $serviceTypes->name }},
                                            @endforeach
                                        </td>



                                        <td>{{ $pendingService->price }}</td>
                                        <td>
                                            @if ($pendingService->status == 'Aborted')
                                                <span
                                                    class="badge badge-pill badge-danger mb-1 text-black">{{ $pendingService->status }}</span>
                                            @else
                                                <span
                                                    class="badge badge-pill {{ $pendingService->status == 'Pending' ? 'badge-warning' : 'badge-success' }}  mb-1 text-black">{{ $pendingService->status }}</span>
                                            @endif
                                        </td>
                                        @can('admin')
                                            <td>
                                                <div class="dropdown d-inline-block">
                                                    <a class="nav-link dropdown-toggle" href="#" id="moreDropdown"
                                                        role="button" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i class="ik ik-more-vertical"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item"
                                                            href="{{ route('service.edit.pendingService', ['service' => $pendingService->id]) }}"><i
                                                                class="ik ik-edit"></i> Edit </a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('service.changeStatus.pendingService', ['service' => $pendingService->id]) }}"><i
                                                                class="fa fa-check-circle"></i> Mark as Done </a>

                                                        <a class="dropdown-item"
                                                            href="{{ route('service.abortStatus.pendingService', ['service' => $pendingService->id]) }}">
                                                            <i class="fa fa-ban"></i> Abort </a>
                                                    </div>
                                                </div>
                                            </td>
                                        @endcan

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

    @if (session('createMode'))
        <script>
            // Open the modal using JavaScript
            $(document).ready(function() {
                $('#serviceAdd').modal('show');
            });
        </script>
        <?php session(['createMode' => false]); ?>
        <div class="modal fade edit-layout-modal pr-0" id="serviceAdd" role="dialog" aria-labelledby="serviceAddLabel"
            style="display: none;" aria-hidden="true">
            <div class="modal-dialog w-300" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="supplierAddLabel">Add service</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('service.store.pendingService') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="d-block">Customer Name</label>
                                <input type="text" name="customerName" class="form-control"
                                    placeholder="Enter Customer Name">
                                @error('customerName')
                                    <div class="help-block with-errors">
                                        <span class="text-red">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="d-block">Phone</label>
                                <input type="text" name="customerPhone" class="form-control"
                                    placeholder="Enter Phone">
                                @error('customerPhone')
                                    <div class="help-block with-errors">
                                        <span class="text-red">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="d-block">Price</label>
                                <input type="text" name="price" class="form-control" placeholder="Enter Price">
                                @error('price')
                                    <div class="help-block with-errors">
                                        <span class="text-red">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Service Type</label>
                                @forelse (session('serviceTypes') as $serviceType)
                                    <div class="border-checkbox-section ml-3">

                                        <div class="border-checkbox-group border-checkbox-group-success d-block">

                                            <input name="serviceTypeId[]" class="border-checkbox" type="checkbox"
                                                id="checkbox{{ $serviceType->id }}" value="{{ $serviceType->id }}">
                                            <label class="border-checkbox-label"
                                                for="checkbox{{ $serviceType->id }}">{{ $serviceType->name }}</label>

                                        </div>

                                    </div>
                                @empty
                                @endforelse

                                @error('serviceTypeId')
                                    <div class="help-block with-errors">
                                        <span class="text-red">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="Save" value="Save">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (session('editMode') && session('service')->exists() ?? false)
        <script>
            // Open the modal using JavaScript
            $(document).ready(function() {
                $('#serviceEdit').modal('show');
            });
        </script>
        <?php session(['editMode' => false]); ?>
        <div class="modal fade edit-layout-modal pr-0" id="serviceEdit" role="dialog"
            aria-labelledby="serviceEditLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog w-300" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="supplierAddLabel">Add service</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('service.update.pendingService', ['service' => session('service')->id]) }}"
                            method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="d-block">Customer Name</label>
                                <input type="text" name="customerName" class="form-control"
                                    placeholder="Enter Customer Name" value="{{ session('service')->customerName }}">
                                @error('customerName')
                                    <div class="help-block with-errors">
                                        <span class="text-red">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="d-block">Phone</label>
                                <input type="text" name="customerPhone" class="form-control"
                                    placeholder="Enter Phone" value="{{ session('service')->customerPhone }}">
                                @error('customerPhone')
                                    <div class="help-block with-errors">
                                        <span class="text-red">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Service Type</label>
                                @forelse (session('serviceTypes') as $serviceType)
                                    <div class="border-checkbox-section ml-3">

                                        <div class="border-checkbox-group border-checkbox-group-success d-block">
                                            @if (session('service')->serviceTypes->contains($serviceType))
                                                <input name="serviceTypeId[]" class="border-checkbox" type="checkbox"
                                                    id="checkbox{{ $serviceType->id }}" value="{{ $serviceType->id }}"
                                                    checked>
                                                <label class="border-checkbox-label"
                                                    for="checkbox{{ $serviceType->id }}">{{ $serviceType->name }}</label>
                                            @else
                                                <input name="serviceTypeId[]" class="border-checkbox" type="checkbox"
                                                    id="checkbox{{ $serviceType->id }}" value="{{ $serviceType->id }}">
                                                <label class="border-checkbox-label"
                                                    for="checkbox{{ $serviceType->id }}">{{ $serviceType->name }}</label>
                                            @endif

                                        </div>

                                    </div>
                                @empty
                                @endforelse

                                @error('serviceTypeId')
                                    <div class="help-block with-errors">
                                        <span class="text-red">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="d-block">Price</label>
                                <input type="text" name="price" class="form-control" placeholder="Enter Price"
                                    value="{{ session('service')->price }}">
                                @error('price')
                                    <div class="help-block with-errors">
                                        <span class="text-red">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="Save" value="Update">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- push external js -->
    @push('script')
        <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
        <script src="{{ asset('plugins/DataTables/Cell-edit/dataTables.cellEdit.js') }}"></script>
        <!--get editable datatable script-->
        <script src="{{ asset('js/editable-datatable.js') }}"></script>
    @endpush

@endsection
