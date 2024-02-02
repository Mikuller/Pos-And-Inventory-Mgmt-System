<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header row">
                <div class="col col-sm-2">
                    <a href="{{ route('service.create.pendingService') }}" class="btn btn-primary btn-rounded">Add
                        service</a>
                </div>
                {{-- <div class="col col-sm-1">

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

                </div> --}}
                <div class="col col-sm-6">
                    <div class="card-search with-adv-search dropdown">

                        <input type="text" wire:model.live.debounce.500ms="search" class="form-control global_filter"
                            id="global_filter" placeholder="Search by Customer Name..">
                       {{-- <button type="button" id="adv_wrap_toggler" class="adv-btn ik ik-chevron-down dropdown-toggle"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                         <div class="adv-search-wrap dropdown-menu dropdown-menu-right"
                            aria-labelledby="adv_wrap_toggler">
                            
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" wire:model.live.debounce.500ms="searchWithType"
                                                class="form-control column_filter" id="col2_filter"
                                                placeholder="Search With Service Type"  data-column="2">
                                        </div>
                                    </div>
                                    
                                </div>
                                
                        </div> --}}

                    </div>
                </div>
                <div class="col col-sm-3">
                    <div class="card-options text-right">
                        <span class="mr-5" id="top">{{ $pendingServices->links() }}</span>

                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="advanced_table" class="table">
                    <thead>
                        <tr>
                            <th class="nosort" width="10">
                                <label class="custom-control custom-checkbox m-0">
                                    <input type="checkbox" class="custom-control-input" id="selectall" name=""
                                        value="option2">
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
