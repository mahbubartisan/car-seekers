<form action="{{ route('company-policies.store') }}" method="post" id="globalForm">

    @csrf
    @method('POST')

    <div class="print-error-msg">
        <div class="row m-3"></div>
    </div>
    <div class="row">
        <div class="col-md-12 form-group mb-3">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Name">
        </div>

        <div class="col-md-12 form-group mb-3">
            <label for="description">Description</label>
            <textarea id="description" name="description" class="form-control" rows="10" cols="30"></textarea>
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

