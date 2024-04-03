<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header row">
                <div class="col col-sm-4">
                    <a href="{{ route('service.create.pendingService') }}" class="btn btn-sm btn-success ">+ Pending
                        Service</a>
                    <a href="{{ route('service.serviceTypes') }}" class=" btn btn-sm btn-primary">+ Service Types</a>
                </div>
                <div class="col col-sm-2">
                    
                        <input wire:model.live.debounce.500ms="searchWithDate" class="form-control" type="date"
                            />
                    
                </div>
                <div class="col col-sm-2">
                        <input type="text" wire:model.live.debounce.500ms="search" class="form-control "
                            placeholder="Search...">
                </div>
                <div class="col col-sm-4 mt-2">
                        {{ $pendingServices->links() }}      
                </div>
            </div>
            <div class="card-body">
                <table id="advanced_table" class="table">
                    <thead>
                        <tr>
                           
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
                                                    href="{{ route('service.markAsPending.pendingService', ['service' => $pendingService->id]) }}"><i
                                                        class="fa fa-check-circle"></i> Mark as Pending </a>

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
