<div class="row">
    <div class="col-md-12 form-group">
        <div class="row">
            <div class="col-md-6 form-group">
                <label for="email">Vehicle Name</label>
                <input type="text" class="form-control" value="{{ $booking->vehicles->company.' - '.$booking->vehicles->model }}" disabled>
            </div>
            <div class="col-md-6 form-group">
                <label for="email">Registration Number</label>
                <input type="text" class="form-control" value="{{ $booking->vehicles->registration_number }}" disabled>
            </div>
        </div>
        <label for="email">Package Info</label>
        <div class="row">
            <div class="col-md-6 form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="width: 120px"><span class="material-icons">map</span> Name</span>
                    </div>
                    <input type="text" name="" class="form-control" value="{{ $booking->packages->name }}" disabled>
                </div>
            </div>
            <div class="col-md-6 form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="width: 120px"><span class="material-icons">query_builder</span> Duration</span>
                    </div>
                    <input type="text" name="" class="form-control" value="{{ $booking->duration }} Hours" disabled>
                </div>
            </div>
            <div class="col-md-6 form-group mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><span class="material-icons">local_taxi</span></span>
                    </div>
                    <select name="" id="duration_id" class="form-control" disabled>
                        <option value="">Choose A Duration</option>
                        @foreach($booking->packages->durations as $duration)
                            <option value="{{ $duration->id }}" {{ $duration->id == $package_duration->id ? 'selected':'' }}>{{ $duration->label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6 form-group">
                <div class="row">
                    <div class="col-md-8">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="width: 120px"><span class="material-icons">date_range</span> Start Date</span>
                            </div>
                            <input type="text" name="" class="form-control date-selector" value="{{ $booking->start_date }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group">
                            <input type="text" name="" class="form-control time-selector" value="{{ \Carbon\Carbon::parse($booking->start_time)->format('g:i A') }}" disabled>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="width: 120px"><span class="material-icons">room</span> Pick Up</span>
                    </div>
                    <input type="text" name="" class="form-control" value="{{ $booking->pick_up }}" disabled>
                </div>
            </div>
            <div class="col-md-6 form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="width: 120px"><span class="material-icons">room</span> Drop off</span>
                    </div>
                    <input type="text" name="" class="form-control" value="{{ $booking->drop_off }}" disabled>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="width: 120px"><span class="material-icons">date_range</span> End Date</span>
                    </div>
                    <input type="text" name="" class="form-control date-selector" value="{{ $booking->end_date }}" disabled>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="width: 120px"><span class="material-icons">query_builder</span> End Time</span>
                    </div>
                    <input type="text" name="" class="form-control" value="{{ $booking->end_time == null ? '': \Carbon\Carbon::parse($booking->end_time)->format('g:i A') }}" disabled>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-4 form-group">
                <label for="email">Total Cost</label>
                <input type="text" class="form-control" value="$ {{ $booking->total_amount }}" disabled>
            </div>
            <div class="col-md-4 form-group">
                <label for="email">Total Paid</label>
                <input type="text" class="form-control" value="$ {{ $booking->total_paid }}" disabled>
            </div>
            <div class="col-md-4 form-group">
                <label for="email">Total Due</label>
                <input type="text" class="form-control" value="$ {{ $booking->total_amount - $booking->total_paid }}" disabled>
            </div>
        </div>
    </div>
</div>
