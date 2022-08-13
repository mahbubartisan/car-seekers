<form action="{{ route('packages.update', $package->id) }}" method="post" id="globalForm">

    @csrf
    @method('PATCH')

    <div class="print-error-msg">
        <div class="row m-3"></div>
    </div>
    <div class="row">
        <div class="col-md-12 form-group mb-3">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{ $package->name }}" disabled>
        </div>
        <div class="col-md-12 form-group mb-3">
            <label for="description">Description</label>
            <textarea id="description" name="description" class="form-control" rows="10" cols="30" disabled>{{ $package->description }}</textarea>
        </div>

        {{--<div class="col-md-12 form-group mb-3">
            <label for="label">Duration</label>
            <div class="field_wrapper">
                @foreach($package->durations as $duration)
                    <div class="row {{ !$loop->first ? 'mt-1':'' }}">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" name="label[]" class="form-control" id="label" placeholder="label" value="{{ $duration->label }}" disabled>
                                </div>
                                <div class="col-md-6">
                                    <input type="number" name="duration[]" class="form-control" id="duration" placeholder="duration" value="{{ $duration->duration }}" disabled>
                                </div>
                                <div class="col-md-12 form-group mb-3">
                                    <label for="description">Description</label>
                                    <textarea id="description" name="description[]" class="form-control" rows="10" cols="30" disabled>{{ $duration->description }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>--}}

    </div>

</form>

<script>
    CKEDITOR.replace( 'description' );

    $("#submitBtn").on("click", function () {
        let description = CKEDITOR.instances.description.getData();
        $('#description').val(description);
    })
</script>
