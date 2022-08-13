<form action="{{ route('users.update', $user->id) }}" method="post" id="globalForm" data-id="{{ $user->id }}">

    @csrf
    @method('PATCH')

    <div class="print-error-msg">
        <div class="row m-3"></div>
    </div>
    <div class="row">
        @if($user->role == 'Renter')
            <div class="col-md-12 mb-2">
                    <span class="txt1 p-b-11 text-info">
                        PayPal Account
                    </span></br>
                <input class="form-control border" type="text" name="paypal_account" value="{{ $user->paypal_account }}" disabled>
                <span class="focus-form-control"></span>
            </div>
        @endif
        <div class="col-md-6 mb-2">
                    <span class="txt1 p-b-11 text-info">
                        Name
                    </span></br>
            <input class="form-control border" type="text" name="name" value="{{ $user->name }}">
            <span class="focus-form-control"></span>
        </div>
        <div class="col-md-6 mb-2">
                    <span class="txt1 p-b-11 text-info">
                        Email
                    </span></br>
            <input class="form-control border" type="email" name="email" value="{{ $user->email }}" disabled>
            <span class="focus-form-control"></span>
        </div>
        <div class="col-md-6 mb-2">
                    <span class="txt1 p-b-11 text-info">
						Avatar
					</span></br>
            <input class="" type="file" name="avatar" value="Avatar">
        </div>
        <div class="col-md-6 mb-2">
                    <span class="txt1 p-b-11 text-info">
						Govt. Issued ID
					</span></br>
            <input class="" type="file" name="govt_issued_id" value="Govt. Issued ID">
        </div>
        <div class="col-md-3 mb-2">
                    <span class="txt1 p-b-11 text-info">
                        Contact
                    </span></br>
            <input class="form-control border" type="text" name="contact" value="{{ $user->contact }}">
            <span class="focus-form-control"></span>
        </div>
        <div class="col-md-9 mb-2">
                    <span class="txt1 p-b-11 text-info">
                        Address
                    </span></br>
            <input class="form-control border" type="text" name="address" value="{{ $user->address }}">
            <span class="focus-form-control"></span>
        </div>
        <div class="col-md-6 mb-2">
                    <span class="txt1 p-b-11 text-info">
                        Gender
                    </span></br>
            <select name="gender" id="" class="form-control border">
                <option value="Male" {{ $user->gender == 'Male' ? 'selected':'' }}>Male</option>
                <option value="Female" {{ $user->gender == 'Female' ? 'selected':'' }}>Female</option>
            </select>
        </div>
        <div class="col-md-6 mb-2">
                    <span class="txt1 p-b-11 text-info">
                        Role
                    </span></br>
            <select name="role" id="" class="form-control border">
                <option value="Customer" {{ $user->role == 'Customer' ? 'selected':'' }}>Customer</option>
                <option value="Renter" {{ $user->role == 'Renter' ? 'selected':'' }}>Renter</option>
            </select>
        </div>
        <div class="col-md-6 mb-2">
                    <span class="txt1 p-b-11 text-info">
                        Password
                    </span></br>
            <input class="form-control border" type="password" name="password" value="">
            <span class="focus-form-control"></span>
        </div>
        <div class="col-md-6 mb-2">
                    <span class="txt1 p-b-11 text-info">
                        Status
                    </span></br>
            <select name="status" id="" class="form-control border">
                <option value="Pending" {{ $user->status == 'Pending' ? 'selected':'' }}>Pending</option>
                <option value="Approved" {{ $user->status == 'Approved' ? 'selected':'' }}>Approved</option>
                <option value="Disapproved" {{ $user->status == 'Disapproved' ? 'selected':'' }}>Disapproved</option>
                <option value="Suspended" {{ $user->status == 'Suspended' ? 'selected':'' }}>Suspended</option>
            </select>
        </div>
    </div>

</form>
