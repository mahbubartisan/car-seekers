<form action="{{ route('vehicle.store') }}" method="post" id="globalForm">

    @csrf
    @method('POST')

    <div class="print-error-msg">
        <div class="row m-3"></div>
    </div>
    <div class="row">
        <div class="col-md-12 form-group mb-3">
            <label for="image">Image</label>
            <input type="file" class="form-control" name="image" id="image" placeholder="image">
        </div>

        <div class="col-md-6 form-group mb-3">
            <label for="company">Company</label>
            <input type="text" name="company" class="form-control" id="company">
        </div>

        <div class="col-md-6 form-group mb-3">
            <label for="model">Model</label>
            <input type="text" name="model" class="form-control" id="model">
        </div>

        <div class="col-md-4 form-group mb-3">
            <label for="registration_number">Reg. Number</label>
            <input type="text" name="registration_number" class="form-control" id="registration_number">
        </div>

        <div class="col-md-4 form-group mb-3">
            <label for="minimum_charge">Minimum Charge</label>
            <input type="number" name="minimum_charge" class="form-control" id="minimum_charge">
        </div>

        <div class="col-md-4 form-group mb-3">
            <label for="hourly_charge">Hourly Charge</label>
            <input type="number" name="hourly_charge" class="form-control" id="hourly_charge">
        </div>

        <div class="col-md-2 form-group mb-3">
            <label for="seat_capacity">Seat Capacity</label>
            <input type="number" name="seat_capacity" class="form-control" id="seat_capacity">
        </div>

        <div class="col-md-2 form-group mb-3">
            <label for="color">Color</label>
            <input type="text" name="color" class="form-control" id="color">
        </div>

        <div class="col-md-2 form-group mb-3">
            <label for="air_condition">Air Conditioner</label>
            <select name="air_condition" id="air_condition" class="form-control">
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>
        </div>

        <div class="col-md-2 form-group mb-3">
            <label for="exampleInputEmail1">Gear Type</label>
            <select name="gear_type" id="gear_type" class="form-control">
                <option value="auto">Auto</option>
                <option value="manual">Manual</option>
            </select>
        </div>

        <div class="col-md-2 form-group mb-3">
            <label for="exampleInputEmail1">Fuel Type</label>
            <select name="fuel_type" id="fuel_type" class="form-control">
                <option value="gas">Gas</option>
                <option value="oil">Oil</option>
            </select>
        </div>

        <div class="col-md-2 form-group mb-3">
            <label for="availability">Availability</label>
            <br>
            <label class="switch switch-primary mr-3 mt-2">
                <input type="checkbox" name="availability" id="availability" checked="checked">
                <span class="slider"></span>
            </label>
        </div>

    </div>

</form>
