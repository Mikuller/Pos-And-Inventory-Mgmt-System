<div class="container-fluid">
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-6">
                <div class="page-header-title">
                    <i class="fa fa-book bg-blue"></i>
                    <div class="d-inline">
                        <h5>Manage Expenses</h5>
                        <span>Insert and View Expenses</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}"><i class="ik ik-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('expense.index') }}">Manage Expenses</a>
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

                @include('Expenses.create')
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
                                <div class="col-sm-4">
                                    <label class="ml-2 d-inline" for="paid2"><input type="checkbox" wire:model.live="searchPaid"
                                            name="payStatus" id="paid2" value="Paid" required /> Paid</label><br />
                                    <label class="ml-2" for="unpaid2"><input type="checkbox" wire:model.live="searchUnpaid"
                                            name="payStatus" id="unpaid2" value="Unpaid" required /> Unpaid</label>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input wire:model.live="searchByDate" class="form-control" type="date" required />
                                    </div>
                                </div>

                            </div>


                            <table id="advanced_table" class="table">
                                <thead>
                                    <tr>
                                        <th>Date Time</th>
                                        <th>Paid To</th>
                                        <th>Reason</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($expenses as $index => $expense)
                                        <tr>
                                            <td> {{ $expense->created_at->diffForHumans() }}</td>
                                            <td> {{ $expense->payedPartnerName }}</td>
                                            <td>{{ $expense->expenseReason }}</td>
                                            <td>{{ $expense->amount }}</td>
                                            <td>
                                                @if ($expense->status == 'Paid')
                                                    <span
                                                        class="badge badge-pill badge-success mb-1 text-black">Paid</span>
                                                @else
                                                    <span
                                                        class="badge badge-pill badge-warning mb-1 text-black">Unpaid</span>
                                                @endif

                                            </td>
                                            <td>
                                                <div class="text-center">
                                                    <a class="btn btn-sm btn-primary d-inline ml-2"
                                                        href="{{ route('expense.edit', ['expense' => $expense->id]) }}"><i
                                                            class="fa fa-pen"></i></a>
                                                    <a class="btn btn-sm btn-danger"
                                                        href="{{ route('expense.destroy', ['expense' => $expense->id]) }}"
                                                        onclick="confirmation(event)"><i class="ik ik-trash-2"></i></a>
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('expense.show', ['expense' => $expense->id]) }}"
                                                       ><i class="ik ik-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse

                                </tbody>
                            </table>



                        </div>
                        <div class="col col-sm-3 ">
                            {{ $expenses->links() }}
                        </div>
                    </div>
                </div>
            </div>


        </div>


    </div>
</div>
