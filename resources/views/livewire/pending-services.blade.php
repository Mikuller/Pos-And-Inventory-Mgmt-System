<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header row">
                <div class="col col-sm-4">
                    <a href="#serviceAdd" data-toggle="modal" data-target="#serviceAdd" class="btn btn-sm btn-success ">+
                        Pending
                        Service</a>
                    <a href="{{ route('service.serviceTypes') }}" class=" btn btn-sm btn-primary">+ Service Types</a>
                </div>
                <div class="col col-sm-2">

                    <input wire:model.live.debounce.500ms="searchWithDate" class="form-control" type="date" />

                </div>
                <div class="col col-sm-2">
                    <input type="text" wire:model.live.debounce.500ms="search" class="form-control "
                        placeholder="Search...">
                </div>
                <div class="col col-sm-3">
                    <select wire:model.live.debounce.500ms="searchByMaintainer" name="searchByMaintainer"
                        class="form-control">
                        <option selected value="{{ null }}">Select maintainer's name</option>
                        @forelse ($maintainerNames as $maintainerName)
                            @if ($maintainerName != null)
                                <option value="{{ $maintainerName }}">{{ $maintainerName }}</option>
                            @endif
                        @empty
                        @endforelse
                    </select>
                </div>

            </div>
            <div class="card-body">
                <table id="advanced_table" class="table">
                    <thead>
                        <h5 class="text-primary float-left">Total Revenue:
                            {{ number_format($pendingServices->where('status', '=', 'Done')->sum('price')) }} </h5>
                        <div class="float-left ml-3">
                            <label for="cash1" class="mt-1"> <input type="checkbox" id="cash1"
                                    wire:model.live="cash"> Cash</label>
                            <label for="e-cash" class="d-block "> <input type="checkbox" id="e-cash"
                                    wire:model.live="eCash"> E-Cash</label>
                        </div>

                    </thead>
                    <thead>
                        <tr>
                            <th>Ref_ID.</th>
                            <th>Customer Name</th>
                            <th>Service Type</th>
                            <th class="text-center">Total Price</th>
                            <th class="text-center">Total Expense</th>
                            <th class="text-center">Maintainer's Name</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Payment Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pendingServices  as $pendingService)

                            <tr>

                                <td>{{ $pendingService->refNumber }}</td>
                                <td>{{ $pendingService->customerName }}</td>

                                <td>
                                    @foreach ($pendingService->serviceTypes as $serviceTypes)
                                        {{ $serviceTypes->name }},
                                    @endforeach
                                </td>
                                <td class="text-center">{{ $pendingService->price }}</td>
                                <td class="text-center">{{ $pendingService->totalExpense() }}</td>
                                <td class="text-center">{{ $pendingService->maintainerName }}</td>
                                <td class="text-center">
                                    @if ($pendingService->status == 'Aborted')
                                        <span
                                            class="badge badge-pill badge-danger mb-1 text-black">{{ $pendingService->status }}</span>
                                    @else
                                        <span
                                            class="badge badge-pill {{ $pendingService->status == 'Pending' ? 'badge-warning' : 'badge-success' }}  mb-1 text-black">{{ $pendingService->status }}</span>
                                    @endif
                                </td>
                                <td class="text-center"><span
                                        class="badge badge-pill  {{ $pendingService->paymentStatus == 'Unpaid' ? 'badge-warning' : 'badge-success' }}  mb-1 text-black">{{ $pendingService->paymentStatus }}</span>
                                </td>
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
                                                href="{{ route('service.show.pendingService', ['service' => $pendingService->id]) }}">
                                                <i class="fa fa-eye"></i> Show Details </a>

                                            @if ($pendingService->status == 'Done')
                                                <a class="dropdown-item"
                                                    href="{{ route('service.servicePaymentEdit.pendingService', ['service' => $pendingService->id]) }}">
                                                    <i class="fa fa-gavel"></i> Manage Payment </a>
                                                <a class="dropdown-item"
                                                    href="{{ route('service.markAsPending.pendingService', ['service' => $pendingService->id]) }}"><i
                                                        class="fa fa-check-circle"></i> Mark as Pending </a>
                                            @else
                                                <a class="dropdown-item"
                                                    href="{{ route('service.markAsDone.pendingService', ['service' => $pendingService->id]) }}">
                                                    <i class="fa fa-check-circle"></i> Mark as Done </a>

                                                @can('admin')
                                                    <a class="dropdown-item"
                                                        href="{{ route('service.abortStatus.pendingService', ['service' => $pendingService->id]) }}">
                                                        <i class="fa fa-ban"></i> Abort </a>
                                                @endcan
                                            @endif
                                        </div>
                                    </div>
                                </td>

                            </tr>

                        @empty
                            <tr>
                                <span class=" b-b-primary text-primary text-center ">
                                    <p>No Records!!</p>
                                </span>
                            </tr>

                        @endforelse

                    </tbody>
                </table>
            </div>
            <div class="col col-sm-3 ">
                {{ $pendingServices->links() }}
            </div>
        </div>
    </div>
</div>
