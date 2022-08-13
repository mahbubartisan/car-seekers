
<form action="{{ route('drivers.update', $driver->id) }}" method="post" id="globalForm">

    @csrf
    @method('PATCH')

    <div class="print-error-msg">
        <div class="row m-3"></div>
    </div>

    <div class="row">

        <div class="col-md-4 form-group mb-3">
            <label for="avatar">Avatar</label>
            <img src="{{ asset('templates/images/avatars/'.$driver->avatar) }}" alt="" width="100%" height="200px">
        </div>

        <div class="col-md-4 form-group mb-3">
            <label for="driving_license">Driving License</label>
            <img src="{{ asset('templates/images/driving_license/'.$driver->driving_license) }}" alt="" width="100%" height="200px">
        </div>

        <div class="col-md-4 form-group mb-3">
            <label for="contract_paper">Contract Paper</label>
            <img src="{{ asset('templates/images/contract_paper/'.$driver->contract_paper) }}" alt="" width="100%" height="200px">
        </div>

        <div class="col-md-3 form-group mb-3">
            <label for="vehicle_id">Vehicle</label>
            <input type="text" class="form-control" name="vehicle_id" id="vehicle_id" placeholder="Vehicle ID" value="{{ $driver->vehicles->company.'-'.$driver->vehicles->model.'-'.$driver->vehicles->registration_number }}" disabled>
        </div>

        <div class="col-md-3 form-group mb-3">
            <label for="driver_name">Driver Name</label>
            <input type="text" name="driver_name" class="form-control" id="driver_name" value="{{ $driver->driver_name }}" disabled>
        </div>

        <div class="col-md-3 form-group mb-3">
            <label for="contact">Contact</label>
            <input type="text" name="contact" class="form-control" id="contact" value="{{ $driver->contact }}" disabled>
        </div>

        <div class="col-md-3 form-group mb-3">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="email" value="{{ $driver->email }}" disabled>
        </div>

        <div class="col-md-12 form-group mb-3">
            <label for="address">Address</label>
            <textarea type="text" name="address" class="form-control" id="address" rows="3" disabled>{{ $driver->address }}</textarea>
        </div>
    </div>

</form>
