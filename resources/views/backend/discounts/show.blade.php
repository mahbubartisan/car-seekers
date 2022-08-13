<div class="row">
    <div class="col-md-4 form-group mb-3">
        <label for="firstName1">Name</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{ $discount->name }}" disabled>
    </div>

    <div class="col-md-2 form-group mb-3">
        <label for="lastName1">Type</label>
        <select name="type" id="type" class="form-control" disabled>
            <option value="percentage" {{ $discount->type == 'percentage' ? 'selected':'' }}>Percentage</option>
            <option value="fixed" {{ $discount->type == 'fixed' ? 'selected':'' }}>Fixed</option>
        </select>
    </div>

    <div class="col-md-2 form-group mb-3">
        <label for="exampleInputEmail1">Amount</label>
        <input type="number" class="form-control" name="amount" id="Amount" placeholder="Amount" value="{{ $discount->amount }}" disabled>
    </div>

    <div class="col-md-3 form-group mb-3">
        <label for="phone">Coupon Code</label>
        <input type="text" name="coupon_code" class="form-control" id="coupon_code" value="{{ $discount->coupon_code }}" disabled>
    </div>

    <div class="col-md-1 form-group mb-3">
        <label for="status">Status</label>
        <br>
        <label class="switch switch-primary mr-3 mt-2">
            <input type="checkbox" name="status" id="status"  {!! $discount->status == 1 ? 'checked="checked"':'' !!} disabled>
            <span class="slider"></span>
        </label>
    </div>
</div>
