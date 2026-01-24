<div class="container-fluid">
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-6">
                <div class="page-header-title">
                    <i class="fa fa-book bg-blue"></i>
                    <div class="d-inline">
                        <h5>Manage Spare Parts</h5>
                        <span>Insert and View Availabel Spare Parts</span>
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
                            <a href="{{ route('spareParts.index') }}">Manage Spare Parts</a>
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

                @include('inventory.spare_parts.create')
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
                                    <label class="ml-2 d-inline" for="Available"><input type="checkbox"
                                            wire:model.live="searchAvailable" id="Available" name="status1"
                                            value="Available" required /> Available</label><br />
                                    <label class="ml-2" for="Unavailable"><input type="checkbox"
                                            wire:model.live="searchUnavailable" name="status2" id="Unavailable"
                                            value="Unavailable" required /> Unavailable</label>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input wire:model.live="searchByDate" class="form-control" type="date"
                                            required />
                                    </div>
                                </div>

                            </div>


                            <table id="advanced_table" class="table">
                                <thead>
                                    <tr>

                                        <th class="wp-10">Image</th>
                                        <th>Name</th>
                                        <th class="text-center">Amount</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Withdrawer's Name</th>
                                        <th class="text-center">Withdraw DateTime</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($spareParts as $index => $sparePart)
                                        <tr>

                                            <td><img src="{{ $sparePart->getImageURL() }}" class="table-user-thumb"
                                                    alt="image_product"> </td>
                                            <td>{{ $sparePart->name }}</td>
                                            <td class="text-center">{{ $sparePart->availableAmount }}</td>
                                            <td>
                                                @if ($sparePart->availableAmount > 0)
                                                    <span
                                                        class="badge badge-pill badge-success mb-1 text-black">Available</span>
                                                @else
                                                    <span
                                                        class="badge badge-pill badge-warning mb-1 text-black">Unavailable</span>
                                                @endif

                                            </td>
                                            <td class="text-center">
                                                @if ($sparePart->SparePartWithdraws->isNotEmpty())
                                                    {{ $sparePart->SparePartWithdraws->first()->withdrawerName }}
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($sparePart->SparePartWithdraws->isNotEmpty())
                                                    {{  date_format($sparePart->SparePartWithdraws->first()->created_at, 'F j, Y, g:i a')  }}
                                                @endif
                                            </td>
                                            <td>
                                                @if (isset($makeWithdraw[$sparePart->id]) || isset($makeDeposit[$sparePart->id]))
                                                    @if (isset($makeWithdraw[$sparePart->id]) && $makeWithdraw[$sparePart->id])
                                                        <div class="row align-items-center">
                                                            <div class="col">
                                                                <div class="input-group mb-1">
                                                                    <input name="amount" min="{{ 1 }}"
                                                                        max="{{ $sparePart->availableAmount }}"
                                                                        wire:model="amount" type="number"
                                                                        class="form-control input-width"
                                                                        placeholder="amt">
                                                                </div>
                                                                <div class="input-group mb-0">
                                                                    <input name="withdrawerName"
                                                                        wire:model="withdrawerName" class="form-control"
                                                                        type="text" placeholder="By">
                                                                </div>
                                                            </div>
                                                            <div class="col-auto m-0">
                                                                <button type="button"
                                                                    wire:click="saveWithdraw({{ $sparePart->id }})"
                                                                    class="btn btn-sm btn-warning"><i
                                                                        class="fa fa-share-square"
                                                                        aria-hidden="true"></i></button>
                                                            </div>
                                                        </div>
                                                    @elseif ($makeDeposit[$sparePart->id])
                                                        <div class="row align-items-center">
                                                            <div class="col">
                                                                <div class="input-group mb-1">
                                                                    <input name="amount" min="{{ 1 }}"
                                                                        wire:model="amount" type="number"
                                                                        class="form-control input-width"
                                                                        placeholder="amt">
                                                                </div>
                                                                <div class="input-group mb-0">
                                                                    <input name="depositorName"
                                                                        wire:model="depositorName" class="form-control"
                                                                        type="text" placeholder="By">
                                                                </div>
                                                            </div>
                                                            <div class="col-auto m-0">
                                                                <button type="button"
                                                                    wire:click="saveDeposit({{ $sparePart->id }})"
                                                                    class="btn btn-sm btn-success"><i
                                                                        class="fa fa-plus-square"
                                                                        aria-hidden="true"></i></button>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @else
                                                    <div class="dropdown d-inline-block">
                                                        <a class="nav-link dropdown-toggle" href="#"
                                                            id="moreDropdown" role="button" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            <i class="ik ik-more-vertical"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right">

                                                            <a class="dropdown-item"
                                                                href="{{ route('spareParts.show', ['sparePart' => $sparePart->id]) }}"><i
                                                                    class="fa fa-eye"></i> Show Details</a>
                                                            <a class="dropdown-item"
                                                                href="{{ route('spareParts.edit', ['sparePart' => $sparePart->id]) }}"><i
                                                                    class="fa fa-pen"></i> Edit Info</a>
                                                            <a class="dropdown-item"
                                                                href="{{ route('spareParts.destroy', ['sparePart' => $sparePart->id]) }}"
                                                                onclick="confirmation(event)"><i
                                                                    class="ik ik-trash-2"></i>
                                                                Delete</a>
                                                            <button class="dropdown-item"
                                                                wire:click="createWithdraw({{ $sparePart->id }})"><i
                                                                    class="fa fa-minus-square" aria-hidden="true"></i>
                                                                Make a Withdraw</button>
                                                            <button class="dropdown-item"
                                                                wire:click="createDeposit({{ $sparePart->id }})"><i
                                                                    class="fa fa-plus-square" aria-hidden="true"></i>
                                                                Make a Deposit</button>
                                                        </div>
                                                    </div>
                                                @endif








                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse

                                </tbody>
                            </table>



                        </div>
                        <div class="col col-sm-3 ">
                            {{ $spareParts->links() }}
                        </div>
                    </div>
                </div>
            </div>


        </div>


    </div>
</div>
