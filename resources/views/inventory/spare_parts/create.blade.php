<div class="col-md-3 pr-0">
    <div class="card mb-0">
        <form wire:submit.prevent="store">

            <div class="card-body">

                <div class="form-group">
                    <label>Name</label>
                    <input name="name" wire:model="name" type="text" class="form-control"
                        placeholder="Enter Spare part Name">
                    @error('name')
                        <div class="help-block with-errors">
                            <span class="text-red">{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Amount</label>
                    <input name="availableAmount" min="{{1}}"  wire:model="availableAmount" type="number" class="form-control"
                        placeholder="Enter amount">
                    @error('availableAmount')
                        <div class="help-block with-errors">
                            <span class="text-red">{{ $message }}</span>
                        </div>
                    @enderror
                </div>
               

                <div class="form-group">
                    <label>Image</label>

                    <input type="file" wire:model="photo" name="photo">

                    @error('photo')
                        <div class="help-block with-errors">
                            <span class="text-red">{{ $message }}</span>
                        </div>
                    @enderror
                    @if ($photo)
                        <img class="img-fluid img-thumbnail mt-2" src="{{ $photo->temporaryUrl() }}">
                    @endif
                </div>

                <button type="submit" class="btn btn-primary" {{ !$photo ? 'disabled' : '' }}>Save</button>

            </div>
        </form>
    </div>
</div>
