<form action="{{ route('vehicle.update', $vehicle->id) }}" method="post" id="globalForm">

    @csrf
    @method('PATCH')

    <div class="print-error-msg">
        <div class="row m-3"></div>
    </div>
    <div class="row">
        <div class="col-md-12 form-group mb-3">
            <label for="image">Image</label><br>
            <img src="{{ asset('templates/images/vehicles/'.$vehicle->image) }}" alt="">
        </div>

        <div class="col-md-6 form-group mb-3">
            <label for="company">Company</label>
            <input type="text" name="company" class="form-control" id="company" value="{{ $vehicle->company }}" disabled>
        </div>

        <div class="col-md-6 form-group mb-3">
            <label for="model">Model</label>
            <input type="text" name="model" class="form-control" id="model" value="{{ $vehicle->model }}" disabled>
        </div>

        <div class="col-md-4 form-group mb-3">
            <label for="registration_number">Reg. Number</label>
            <input type="text" name="registration_number" class="form-control" id="registration_number" value="{{ $vehicle->registration_number }}" disabled>
        </div>

        <div class="col-md-4 form-group mb-3">
            <label for="minimum_charge">Minimum Charge</label>
            <input type="number" name="minimum_charge" class="form-control" id="minimum_charge" value="{{ $vehicle->minimum_charge }}" disabled>
        </div>

        <div class="col-md-4 form-group mb-3">
            <label for="hourly_charge">Hourly Charge</label>
            <input type="number" name="hourly_charge" class="form-control" id="hourly_charge" value="{{ $vehicle->hourly_charge }}" disabled>
        </div>

        <div class="col-md-2 form-group mb-3">
            <label for="seat_capacity">Seat Capacity</label>
            <input type="number" name="seat_capacity" class="form-control" id="seat_capacity" value="{{ $vehicle->seat_capacity }}" disabled>
        </div>

        <div class="col-md-2 form-group mb-3">
            <label for="color">Color</label>
            <input type="text" name="color" class="form-control" id="color" value="{{ $vehicle->color }}" disabled>
        </div>

        <div class="col-md-2 form-group mb-3">
            <label for="air_condition">Air Conditioner</label>
            <select name="air_condition" id="air_condition" class="form-control" disabled>
                <option value="yes" {!! $vehicle->air_condition == "yes" ? 'selected':'' !!}>Yes</option>
                <option value="no" {!! $vehicle->air_condition == "no" ? 'selected':'' !!}>No</option>
            </select>
        </div>

        <div class="col-md-2 form-group mb-3">
            <label for="exampleInputEmail1">Gear Type</label>
            <select name="gear_type" id="gear_type" class="form-control" disabled>
                <option value="auto" {!! $vehicle->gear_type == "auto" ? 'selected':'' !!}>Auto</option>
                <option value="manual" {!! $vehicle->gear_type == "manual" ? 'selected':'' !!}>Manual</option>
            </select>
        </div>

        <div class="col-md-2 form-group mb-3">
            <label for="exampleInputEmail1">Fuel Type</label>
            <select name="fuel_type" id="fuel_type" class="form-control" disabled>
                <option value="gas" {!! $vehicle->fuel_type == "gas" ? 'selected':'' !!}>Gas</option>
                <option value="oil" {!! $vehicle->fuel_type == "oil" ? 'selected':'' !!}>Oil</option>
            </select>
        </div>

        <div class="col-md-2 form-group mb-3">
            <label for="availability">Availability</label>
            <br>
            <label class="switch switch-primary mr-3 mt-2">
                <input type="checkbox" name="availability" id="availability" {!! $vehicle->availability == 1 ? 'checked="checked"':'' !!} disabled>
                <span class="slider"></span>
            </label>
        </div>
    </div>

</form>