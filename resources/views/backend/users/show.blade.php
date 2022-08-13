<form method="post" id="globalForm">

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
            <input class="form-control border" type="text" name="name" value="{{ $user->name }}" disabled>
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
						Avatar {{ $user->avatar }}
					</span></br>
            <img src="{{ asset('templates/images/avatars/'.$user->avatar) }}" alt="" width="70px" height="70px">
        </div>
        <div class="col-md-6 mb-2">
                    <span class="txt1 p-b-11 text-info">
						Govt. Issued ID {{ $user->govt_issued_id }}
					</span></br>
            <img src="{{ asset('templates/images/govt_issued_id/'.$user->govt_issued_id) }}" alt="" width="70px" height="70px">
        </div>
        <div class="col-md-3 mb-2">
                    <span class="txt1 p-b-11 text-info">
                        Contact
                    </span></br>
            <input class="form-control border" type="text" name="contact" value="{{ $user->contact }}" disabled>
            <span class="focus-form-control"></span>
        </div>
        <div class="col-md-9 mb-2">
                    <span class="txt1 p-b-11 text-info">
                        Address
                    </span></br>
            <input class="form-control border" type="text" name="address" value="{{ $user->address }}" disabled>
            <span class="focus-form-control"></span>
        </div>
        <div class="col-md-6 mb-2">
                    <span class="txt1 p-b-11 text-info">
                        Gender
                    </span></br>
            <select name="gender" id="" class="form-control border" disabled>
                <option value="Male" {{ $user->gender == 'Male' ? 'selected':'' }}>Male</option>
                <option value="Female" {{ $user->gender == 'Female' ? 'selected':'' }}>Female</option>
            </select>
        </div>
        <div class="col-md-6 mb-2">
                    <span class="txt1 p-b-11 text-info" disabled>
                        Role
                    </span></br>
            <select name="role" id="" class="form-control border" disabled>
                <option value="Customer" {{ $user->role == 'Customer' ? 'selected':'' }}>Customer</option>
                <option value="Renter" {{ $user->role == 'Renter' ? 'selected':'' }}>Renter</option>
            </select>
        </div>
        <div class="col-md-6 mb-2">
                    <span class="txt1 p-b-11 text-info">
                        Password
                    </span></br>
            <input class="form-control border" type="password" name="password" value="" disabled>
            <span class="focus-form-control"></span>
        </div>
        <div class="col-md-6 mb-2">
                    <span class="txt1 p-b-11 text-info">
                        Status
                    </span></br>
            <select name="status" id="" class="form-control border" disabled>
                <option value="Pending" {{ $user->status == 'Pending' ? 'selected':'' }}>Pending</option>
                <option value="Approved" {{ $user->status == 'Approved' ? 'selected':'' }}>Approved</option>
                <option value="Disapproved" {{ $user->status == 'Disapproved' ? 'selected':'' }}>Disapproved</option>
                <option value="Suspended" {{ $user->status == 'Suspended' ? 'selected':'' }}>Suspended</option>
            </select>
        </div>
    </div>

</form>
