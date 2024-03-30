<div class="row">
    <div class="col-md-12">
        <div class="mb-2 clearfix">

            <div class="collapse d-md-block display-options" id="displayOptions">

                <div class="d-block d-md-inline-block">

                    <div class="search-sm d-inline-block float-md-left mr-1 mb-1 align-top">
                        <input type="text" class="form-control" placeholder="Search.."
                            wire:model.live.debounce.500ms="search">
                    </div>
                </div>
                <div class="float-md-right">
                    {{ $messages->links() }}
                </div>
            </div>
        </div>
        <div class="separator mb-20"></div>

        <div class="row layout-wrap" id="layout-wrap">
            <div class="col-12 list-item">
                @forelse ($messages as $message)
                    <div class="card d-flex flex-row mb-3">
                        
                        <div class="d-flex flex-grow-1 min-width-zero card-content">
                            <div
                                class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                                <a class="list-item-heading mb-1 truncate w-40 w-xs-100" href="{{ route('message.show', ['message' => $message->id]) }}">
                                    {{ $message->message }}
                                </a>
                                <p class="mb-1 text-muted text-small category w-15 w-xs-100">
                                    {{ $message->senderName ?? 'Unknown' }}</p>
                                <p class="mb-1 text-muted text-small category w-15 w-xs-100">
                                    {{ $message->phoneNumber ?? 'Unknown' }}</p>
                                <p class="mb-1 text-muted text-small category w-15 w-xs-100">
                                    {{ $message->senderEmail ?? 'Unknown' }}</p>
                                <p class="mb-1 text-muted text-small date w-15 w-xs-100">
                                    {{ date_format($message->created_at, 'F j, Y, g:i a') }}</p>

                            </div>
                            <div class="list-actions">

                                <a href="{{ route('message.show', ['message' => $message->id]) }}"><i
                                        class="ik ik-eye"></i></a>

                                @can('admin')
                                    <a href="{{ route('message.destroy', ['message' => $message->id]) }}"
                                         onclick="confirmation(event)"><i class="ik ik-trash-2"></i></a>
                                @endcan


                            </div>

                        </div>
                    </div>
                @empty
                    <div class="card d-flex flex-row mb-3">
                        <span class="text-danger p-3">No messages yet</span>
                    </div>
                @endforelse

            </div>


        </div>

    </div>
</div>
