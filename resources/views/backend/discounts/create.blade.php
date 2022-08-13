<form action="{{ route('discounts.store') }}" method="post" id="globalForm">

    @csrf
    @method('POST')

    <div class="print-error-msg">
        <div class="row m-3"></div>
    </div>
    <div class="row">
        <div class="col-md-4 form-group mb-3">
            <label for="firstName1">Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Name">
        </div>

        <div class="col-md-2 form-group mb-3">
            <label for="lastName1">Type</label>
            <select name="type" id="type" class="form-control">
                <option value="percentage">Percentage</option>
                <option value="fixed">Fixed</option>
            </select>
        </div>

        <div class="col-md-2 form-group mb-3">
            <label for="exampleInputEmail1">Amount</label>
            <input type="number" class="form-control" name="amount" id="Amount" placeholder="Amount">
            <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
        </div>

        <div class="col-md-3 form-group mb-3">
            <label for="phone">Coupon Code</label>
            {{--                                <input class="form-control" name="coupon_code" id="coupon_code" placeholder="Coupon Code">--}}
            <input type="text" name="coupon_code" class="form-control" id="coupon_code">
        </div>

        <div class="col-md-1 form-group mb-3">
            <label for="status">Status</label>
            <br>
            <label class="switch switch-primary mr-3 mt-2">
                <input type="checkbox" name="status" id="status" checked="checked">
                <span class="slider"></span>
            </label>
        </div>
    </div>

</form>
