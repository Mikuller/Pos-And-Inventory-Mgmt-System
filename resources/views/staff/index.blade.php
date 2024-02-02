@extends('inventory.layout')
@section('title', 'Manage Staff')
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-6">
                    <div class="page-header-title">
                        <i class="ik ik-shopping-cart bg-blue"></i>
                        <div class="d-inline">
                            <h5>Manage Staff Information</h5>
                            <span>Create and View Staffs</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 ">
                    <a href="{{ route('auditLog.index') }}" class="btn btn-primary float-right">Audit Log</a>
                </div>
                <div class="col-lg-3">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/dashboard"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Manage Staff</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            @include('include.message')
        </div>
        <div class="row">
            <!-- start message area-->
            <div class="col-md-12">
            </div> <!-- end message area-->
            <div class="col-md-12">

                {{-- <input type="hidden" name="_token" value="k4JC0rIKsVlV9AR9NCn4JfVS7hvobvmKTZm9pwR6"> --}}
                <div class="row">

                    @include('staff.create')
                    <div class="col-md-9">
                        <div class="card mb-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <input wire:model.live.debounce.500ms="search" type="text"
                                                class="form-control" placeholder="Search with any attribute.." required>
                                        </div>
                                    </div>

                                </div>

                                <div class="card-body">
                                    <table id="advanced_table" class="table">
                                        <thead>
                                            <tr>
                                                <th class="wp-10">ID</th>
                                                <th class="wp-40">Full Name</th>
                                                <th class="wp-20">Email</th>
                                                <th class="wp-15">Privilege</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($staffs as $staff)
                                                <tr>
                                                    <td>{{ $staff->id }}</td>
                                                    <td> {{ $staff->name }}</td>
                                                    <td>{{ $staff->email }}</td>
                                                    <td>
                                                        @if ($staff->isAdmin)
                                                            <span
                                                                class="badge badge-pill badge-success mb-1 text-black">OWNER</span>
                                                        @else
                                                            <span
                                                                class="badge badge-pill badge-warning mb-1 text-black">CLERK</span>
                                                        @endif

                                                    </td>
                                                    <td>
                                                        <div class="dropdown d-inline-block">
                                                            <a class="nav-link dropdown-toggle" href="#"
                                                                id="moreDropdown" role="button" data-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false">
                                                                <i class="ik ik-more-vertical"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item"
                                                                    href="{{ route('staffs.edit', $staff->id) }}"><i
                                                                        class="ik ik-edit"></i> Edit </a>
                                                                {{-- add condition here --}}
                                                                <a class="dropdown-item"
                                                                    href="{{ route('staffs.changePrivilege', ['staff' => $staff->id]) }}">
                                                                    <i class="fa fa-check-circle"></i> Change Privilege
                                                                </a>
                                                                @if ($staff->accountStatus == 'active')
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('staffs.changeAccountStatus', ['staff' => $staff->id]) }}">
                                                                        <i class="fa fa-ban"></i> Deactivate
                                                                    </a>
                                                                @else
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('staffs.changeAccountStatus', ['staff' => $staff->id]) }}">
                                                                        <i class="fa fa-check-circle"></i> Activate
                                                                    </a>
                                                                @endif

                                                                <form method="POST"
                                                                    action ="{{ route('staffs.destroy', $staff->id) }}">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <button type="submit" class="dropdown-item">
                                                                        <i class="fa fa-trash"></i> Delete </button>
                                                                </form>
                                                            </div>
                                                        </div>
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


            </div>


        </div>
    </div>


    @if (session('editMode') && session('staff')->exists() ?? false)
        @include('staff.edit')
        <script>
            // Open the modal using JavaScript
            $(document).ready(function() {
                $('#staffEdit').modal('show');
            });
        </script>
        <?php session(['editMode' => false]); ?>
    @endif



@endsection
