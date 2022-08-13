<form action="{{ route('drivers.update', $driver->id) }}" method="post" id="globalForm" data-id="{{ $driver->id }}">

    @csrf
    @method('PATCH')

    <div class="print-error-msg">
        <div class="row m-3"></div>
    </div>

    <div class="row">
        <div class="col-md-4 form-group mb-3">
            <label for="avatar">Avatar</label>
            <img src="{{ asset('templates/images/avatars/'.$driver->avatar) }}" alt="" width="100%" height="200px">
            <input type="file" class="form-control" name="avatar" id="avatar" placeholder="" required>
        </div>
        <div class="col-md-4 form-group mb-3">
            <label for="driving_license">Driving License</label>
            <img src="{{ asset('templates/images/driving_license/'.$driver->driving_license) }}" alt="" width="100%" height="200px">
            <input type="file" class="form-control" name="driving_license" id="driving_license" placeholder="" required>
        </div>
        <div class="col-md-4 form-group mb-3">
            <label for="contract_paper">Contract Paper</label>
            <img src="{{ asset('templates/images/contract_paper/'.$driver->contract_paper) }}" alt="" width="100%" height="200px">
            <input type="file" class="form-control" name="contract_paper" id="contract_paper" placeholder="" required>
        </div>

        <div class="col-md-3 form-group mb-3">
            <label for="vehicle_id">Vehicle</label>
            <select name="vehicle_id" id="vehicle_id" class="form-control">
                <option value="">Please Choose one</option>
                @foreach($vehicles as $vehicle)
                    <option value="{{ $vehicle->id }}" {{ $vehicle->id == $driver->vehicle_id ? 'selected':'' }}>{{ $vehicle->company.'-'.$vehicle->model.'-'.$driver->vehicles->registration_number }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3 form-group mb-3">
            <label for="driver_name">Driver Name</label>
            <input type="text" name="driver_name" class="form-control" id="driver_name" value="{{ $driver->driver_name }}" required>
        </div>

        <div class="col-md-3 form-group mb-3">
            <label for="contact">Contact</label>
            <input type="text" name="contact" class="form-control" id="contact" value="{{ $driver->contact }}" required>
        </div>

        <div class="col-md-3 form-group mb-3">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="email" value="{{ $driver->email }}" required>
        </div>

        <div class="col-md-12 form-group mb-3">
            <label for="address">Address</label>
            <textarea type="text" name="address" class="form-control" id="address" rows="3" required>{{ $driver->address }}</textarea>
        </div>
    </div>

</form>
