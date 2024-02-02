<div id="main" class="col-md-12">

    <input type="hidden" name="_token" value="k4JC0rIKsVlV9AR9NCn4JfVS7hvobvmKTZm9pwR6">
    <div class="row">
        <div class="col-md-3 pr-0">
            <div class="card mb-0">
                <span class="form-header m-2 text-center "><strong> Select Date Interval For Report</strong></span>
                <form wire:submit.prevent="generateReport">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Start Date</label>
                            <input wire:model="startDate" class="form-control" type="date" required />
                        </div>
                        <div class="form-group">
                            <label>End Date</label>
                            <input wire:model="endDate" class="form-control" type="date" required/>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger btn-checkout btn-pos-checkout" type="submit">GENERATE
                                REPORT</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>


        @include('inventory.report.reportTable')




    </div>


</div>
