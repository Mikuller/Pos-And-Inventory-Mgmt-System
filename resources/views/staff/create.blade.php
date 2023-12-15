<div class="col-md-3 pr-0">
    <div class="card mb-0">
        <form class="forms-sample" method="POST" action="{{ route('staffs.store') }}">
            @csrf
            <div class="card-body">

                <div class="form-group">
                    <label>Full Name</label>
                    <input name="name" type="text" class="form-control"
                        placeholder="Enter Full Name">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input name="email" type="email" class="form-control" placeholder="Enter Email">
                </div>
                {{-- <div class="form-group">
                    <label>Phone Number</label>
                    <input name="phone" type="phone" class="form-control"
                        placeholder="Enter Phone Number">
                </div> --}}
                <div class="form-group">
                    <label>Privilege</label>
                    <select name="privilege" class="form-control">
                        <option value="" selected disabled>Select Privilege </option>
                        <option value=1>Owner</option>
                        <option value=0>Clerk</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>

            </div>
        </form>
    </div>
</div>