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

                {{-- <div class="col col-sm-1">
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
                </div> --}}
                <div class="col col-sm-6">
                    <div class="card-search with-adv-search dropdown">
                        <input type="text" wire:model.live.debounce.500ms="search" class="form-control global_filter" id="global_filter"
                                placeholder="Search with name.." required="">
                            
                    </div>
                </div>
                <div class="col col-sm-3">
                    <div class="card-options text-right">
                        <span class="mr-5" id="top">{{$serviceTypes->links()}}</span>
                        
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="advanced_table" class="table">
                    <thead>
                        <tr>
                            {{-- <th class="nosort" width="10">
                                <label class="custom-control custom-checkbox m-0">
                                    <input type="checkbox" class="custom-control-input" id="selectall"
                                        name="" value="option2">
                                    <span class="custom-control-label">&nbsp;</span>
                                </label>
                            </th> --}}
                            <th>Name</th>

                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($serviceTypes as $serviceType)
                            <tr>
                                {{-- <td>
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input select_all_child"
                                            id="" name="" value="option2">
                                        <span class="custom-control-label">&nbsp;</span>
                                    </label>
                                </td> --}}
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