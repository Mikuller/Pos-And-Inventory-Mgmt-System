<div class="modal fade edit-layout-modal" id="showMessageItem" tabindex="-1" role="dialog"
        aria-labelledby="showMessageItem" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editLayoutItemLabel">Customer Comment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <p class="lead">Sender Name:  {{session('message')->senderName ?? 'Unknown'}}</p>
                    <p>Email: {{session('message')->senderEmail ?? 'Unknown'}}</p>
                    <p>Phone: {{session('message')->phoneNumber ?? 'Unknown'}}</p>
                    
                    <div class="jumbotron pt-30 pb-30 mt-30">
                        <h5 class="mt-0">{{  date_format(session('message')->created_at, 'F j, Y, g:i a') }}</h5>
                        <p class="lead">
                            {{session('message')->message}}
                        </p>
                    </div>
                    
                </div>
                
            </div>
        </div>
    </div>