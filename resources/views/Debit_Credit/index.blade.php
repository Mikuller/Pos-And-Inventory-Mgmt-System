@extends('inventory.layout')
@section('title', 'Manage Staff')
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-6">
                    <div class="page-header-title">
                        <i class="fa fa-book bg-blue"></i>
                        <div class="d-inline">
                            <h5>Manage Debit/Credit</h5>
                            <span>Insert and View Debit/Credit</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('staffs.index') }}">Manage Debit/Credit</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            @include('include.message')
        </div>
        <div class="row">

            <div class="col-md-12">

                {{-- <input type="hidden" name="_token" credit="k4JC0rIKsVlV9AR9NCn4JfVS7hvobvmKTZm9pwR6"> --}}
                <div class="row">


                    <div class="col-md-6">
                        <div class="card mb-0 p-2">  
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <p class="btn bg-warning bg-btn text-white"> Debt </p>
                                        </div>
                                    </div>

                                </div>
                                <table id="advanced_table" class="table">
                                    <thead>
                                        <tr>
                                            {{-- <th>ID</th> --}}
                                            <th>Creditor's Name</th>
                                            <th>Creditor's Phone</th>
                                            <th>Amount</th>
                                            <th>Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($account_payable as $debt)
                                            <tr>
                                                {{-- <td>{{ $key + 1 }}</td> --}}
                                                <td>{{ $debt->creditorName }}</td>
                                                <td>{{ $debt->creditorPhone }}</td>
                                                <td>{{ $debt->amount }}</td>
                                                <td><a class="text-primary" href="{{ $debt->expense_id!=null ?  route('expense.show',['expense'=>$debt->expense_id]) : route('purchases.show',['purchase'=>$debt->purchase_id])}}"> {{ $debt->deptDescription }}</a></td>
                                            </tr>
                                        @empty
                                        @endforelse

                                    </tbody>
                                </table>
                            <div class="col col-sm-3 ">
                                {{ $account_payable->links() }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card mb-0 p-2">
                            
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <a href="#addCredit" data-toggle="modal" data-target="#addCredit"
                                                class="btn btn-success">+ Credit ( የሰጠህው ዱቤ )</a>
                                        </div>
                                    </div>

                                </div>


                                <table id="advanced_table" class="table">
                                    <thead>
                                        <tr>
                                            {{-- <th class="wp-10">ID</th>           --}}
                                            <th class="wp-40">Debitor's Name</th>
                                            <th class="wp-40">Debitor's Phone</th>
                                            <th class="wp-15">Amount</th>
                                            <th class="wp-20">Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($account_receivable as $credit)
                                            <tr>
                                                {{-- <td>{{ $key + 1 }}</td> --}}    
                                                <td>{{ $credit->debtorName }}</td>
                                                <td>{{ $credit->debtorPhone }}</td>
                                                <td>{{ $credit->amount }} </td>
                                                <td><a class="text-primary" href="{{$credit->sale_id!=null ? route('sales.show',['sale'=>$credit->sale_id])   :  route('service.index')  }}">{{ $credit->creditDescription }}</a> </td>
                                                <td>
                                                    <div class="dropdown d-inline-block">
                                                        <a class="nav-link dropdown-toggle" href="#" id="moreDropdown"
                                                            role="button" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <i class="ik ik-more-vertical"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" href="{{route('credit.edit',['credit'=>$credit->id])}}"><i
                                                                    class="ik ik-edit"></i> Edit </a>
                                                            <a class="dropdown-item" href="{{route('credit.destroy',['credit'=>$credit->id])}}">
                                                                <i class="fa fa-trash"  onclick="confirmation(event)"></i> Delete </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse

                                    </tbody>
                                </table>
                            
                            <div class="col col-sm-3 ">
                                {{ $account_receivable->links() }}
                            </div>
                        </div>
                    </div>
                </div>


            </div>


        </div>
    </div>

    @include('Debit_Credit.create')

    @if (session('editMode') && session('credit')->exists() ?? false)
        @include('Debit_Credit.edit_credit')
        <script>
            // Open the modal using JavaScript
            $(document).ready(function() {
                $('#creditEdit').modal('show');
            });
        </script>
        <?php session(['editMode' => false]); ?>
    @endif



@endsection
