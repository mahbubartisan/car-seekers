<form action="{{ route('durations.update', $duration->id) }}" method="post" id="globalForm" data-id="{{ $duration->id }}">

    @csrf
    @method('PATCH')

    <div class="print-error-msg">
        <div class="row m-3"></div>
    </div>
    <div class="row">
        <div class="col-md-12 form-group mb-3">
            <div class="row">
                <div class="col-md-4">
                    <select name="package_id" id="" class="form-control">
                        <option value="">Select a package</option>
                        @foreach($packages as $package)
                            <option value="{{ $package->id }}" {{ $package->id == $duration->package_id ? 'selected':'' }}>{{ $package->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="text" name="label" class="form-control" id="label" placeholder="label" value="{{ $duration->label }}">
                </div>
                <div class="col-md-4">
                    <input type="number" name="duration" class="form-control" id="duration" placeholder="duration" value="{{ $duration->duration }}">
                </div>
                <div class="col-md-12 form-group mb-3">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" class="form-control" rows="10" cols="30">{{ $duration->description }}</textarea>
                </div>
            </div>
        </div>

    </div>

</form>

<script>
    CKEDITOR.replace( 'description' );

    $("#submitBtn").on("click", function () {
        let description = CKEDITOR.instances.description.getData();
        $('#description').val(description);
    })
</script>
