<div class="container">
    <div class="row">
        <div class="col-8 mx-auto text-center">

            <form method="GET" action="{{ route('checkService.index') }}">
                @csrf
                <div class="input-group custome-input-group">
                    <input name="refNumber" type="text" class="form-control" placeholder="Reference Number" required>
                    
                        <button type="submit" class="btn btn-solid-default rounded-0">Check Status</button>
                    
                </div>
            </form>
            
        </div>
    </div>
</div>
