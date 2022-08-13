<form action="{{ route('drivers.store') }}" method="post" id="globalForm" enctype="multipart/form-data">

    @csrf
    @method('POST')

    <div class="print-error-msg">
        <div class="row m-3"></div>
    </div>

    <div class="row">

        <div class="col-md-4 form-group mb-3">
            <label for="avatar">Avatar</label>
            <input type="file" class="form-control" name="avatar" id="avatar" placeholder="">
        </div>
        <div class="col-md-4 form-group mb-3">
            <label for="driving_license">Driving License</label>
            <input type="file" class="form-control" name="driving_license" id="driving_license" placeholder="">
        </div>
        <div class="col-md-4 form-group mb-3">
            <label for="contract_paper">Contract Paper</label>
            <input type="file" class="form-control" name="contract_paper" id="contract_paper" placeholder="">
        </div>

        <div class="col-md-3 form-group mb-3">
            <label for="vehicle_id">Vehicle</label>
            <select name="vehicle_id" id="vehicle_id" class="form-control">
                <option value="">Please Choose one</option>
                @foreach($vehicles as $vehicle)
                    <option value="{{ $vehicle->id }}">{{ $vehicle->company.'-'.$vehicle->model.'-'.$vehicle->registration_number }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3 form-group mb-3">
            <label for="driver_name">Driver Name</label>
            <input type="text" name="driver_name" class="form-control" id="driver_name">
        </div>

        <div class="col-md-3 form-group mb-3">
            <label for="contact">Contact</label>
            <input type="text" name="contact" class="form-control" id="contact">
        </div>

        <div class="col-md-3 form-group mb-3">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="email">
        </div>

        <div class="col-md-12 form-group mb-3">
            <label for="address">Address</label>
            <textarea type="text" name="address" class="form-control" id="address" rows="3"></textarea>
        </div>
    </div>

</form>
