<form action="{{ route('users.store') }}" method="post" id="globalForm">

    @csrf
    @method('POST')

    <div class="print-error-msg">
        <div class="row m-3"></div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-2" id="paypal_account">
                    <span class="txt1 p-b-11 text-info">
                        PayPal Account (Business account)
                    </span></br>
            <input class="form-control border{{ $errors->has('paypal_account') ? ' is-invalid' : '' }}" type="text" name="paypal_account" placeholder="PayPal Account (Business account)">
            <span class="focus-form-control"></span>
        </div>
        <div class="col-md-6 mb-2">
                    <span class="txt1 p-b-11 text-info">
                        Name
                    </span></br>
            <input class="form-control border{{ $errors->has('name') ? ' is-invalid' : '' }}" type="text" name="name" placeholder="Name">
            <span class="focus-form-control"></span>
        </div>
        <div class="col-md-6 mb-2">
                    <span class="txt1 p-b-11 text-info">
                        Email
                    </span></br>
            <input class="form-control border{{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" name="email" placeholder="Email">
            <span class="focus-form-control"></span>
        </div>
        <div class="col-md-6 mb-2">
                    <span class="txt1 p-b-11 text-info">
						Avatar
					</span></br>
            <input class="{{ $errors->has('avatar') ? ' is-invalid' : '' }}" type="file" name="avatar" placeholder="Avatar">
        </div>
        <div class="col-md-6 mb-2">
                    <span class="txt1 p-b-11 text-info">
						Govt. Issued ID
					</span></br>
            <input class="{{ $errors->has('govt_issued_id') ? ' is-invalid' : '' }}" type="file" name="govt_issued_id" placeholder="Govt. Issued ID">
        </div>
        <div class="col-md-3 mb-2">
                    <span class="txt1 p-b-11 text-info">
                        Contact
                    </span></br>
            <input class="form-control border{{ $errors->has('contact') ? ' is-invalid' : '' }}" type="text" name="contact" placeholder="Contact">
            <span class="focus-form-control"></span>
        </div>
        <div class="col-md-9 mb-2">
                    <span class="txt1 p-b-11 text-info">
                        Address
                    </span></br>
            <input class="form-control border{{ $errors->has('address') ? ' is-invalid' : '' }}" type="text" name="address" placeholder="Address">
            <span class="focus-form-control"></span>
        </div>
        <div class="col-md-6 mb-2">
                    <span class="txt1 p-b-11 text-info">
                        Gender
                    </span></br>
            <select name="gender" id="" class="form-control border">
                <option value="Male" selected>Male</option>
                <option value="Female">Female</option>
            </select>
        </div>
        <div class="col-md-6 mb-2">
                    <span class="txt1 p-b-11 text-info">
                        Role
                    </span></br>
            <select name="role" id="role" class="form-control border">
                <option value="Customer" selected>Customer</option>
                <option value="Renter">Renter</option>
            </select>
        </div>
        <div class="col-md-6 mb-2">
                    <span class="txt1 p-b-11 text-info">
                        Password
                    </span></br>
            <input class="form-control border{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" name="password" placeholder="Password">
            <span class="focus-form-control"></span>
        </div>
        <div class="col-md-6 mb-2">
                    <span class="txt1 p-b-11 text-info">
                        Status
                    </span></br>
            <select name="status" id="" class="form-control border">
                <option value="Pending">Pending</option>
                <option value="Approved" selected>Approved</option>
                <option value="Disapproved">Disapproved</option>
                <option value="Suspended">Suspended</option>
            </select>
        </div>
    </div>

</form>


<script>
    $('#paypal_account').hide();
    $('#role').on('change', function () {
        if ($('#role').val() === 'Renter'){
            $('#paypal_account').show();
        }else{
            $('#paypal_account').hide();
        }
    })
</script>
