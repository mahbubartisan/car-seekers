<form action="{{ route('company-policies.update', $policy->id) }}" method="post" id="globalForm" data-id="{{ $policy->id }}">

    @csrf
    @method('PATCH')

    <div class="print-error-msg">
        <div class="row m-3"></div>
    </div>
    <div class="row">
        <div class="col-md-12 form-group mb-3">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{ $policy->name }}">
        </div>

        <div class="col-md-12 form-group mb-3">
            <label for="description">Description</label>
            <textarea id="description" name="description" class="form-control">{{ $policy->description }}</textarea>
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
