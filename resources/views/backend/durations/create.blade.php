<form action="{{ route('durations.store') }}" method="post" id="globalForm">

    @csrf
    @method('POST')

    <div class="print-error-msg">
        <div class="row m-3"></div>
    </div>
    <div class="row">

        <div class="col-md-4">
            <select name="package_id" id="" class="form-control">
                <option value="">Select a package</option>
                @foreach($packages as $package)
                    <option value="{{ $package->id }}">{{ $package->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <input type="text" name="label" class="form-control" id="label" placeholder="label" value="">
        </div>
        <div class="col-md-4">
            <input type="number" name="duration" class="form-control" id="duration" placeholder="duration" value="">
        </div>
        <div class="col-md-12 form-group mb-3">
            <label for="description">Description</label>
            <textarea id="description" name="description" class="form-control" rows="10" cols="30"></textarea>
        </div>

        {{--<div class="col-md-12 form-group mb-3">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Name">
        </div>

        <div class="col-md-12 form-group mb-3">
            <label for="label">Duration</label>
            <div class="field_wrapper">
                <div class="row">
                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="label[]" class="form-control" id="label" placeholder="label">
                            </div>
                            <div class="col-md-6">
                                <input type="number" name="duration[]" class="form-control" id="duration" placeholder="duration">
                            </div>
                            <div class="col-md-12 form-group mb-3">
                                <label for="description">Description</label>
                                <textarea id="description" name="description[]" class="form-control description" rows="5" cols="30"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 pl-0 pr-0 pt-1">
                        <a href="JavaScript:void(0)" class="addMore">
                            <span class="material-icons">add_box</span>
                        </a>
                        <a href="JavaScript:void(0)" class="removeMore">
                            <span class="material-icons">close</span>
                        </a>
                    </div>
                </div>
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


<script>

    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });

        var table = $('#datatable').DataTable();

        $('.field_wrapper').children().find('.removeMore').first().hide();

        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML = '' +
            '<div class="row mt-1">\n' +
            '<div class="col-md-10">\n' +
            '                        <div class="row">\n' +
            '                            <div class="col-md-6">\n' +
            '                                <input type="text" name="label[]" class="form-control" id="label" placeholder="label">\n' +
            '                            </div>\n' +
            '                            <div class="col-md-6">\n' +
            '                                <input type="number" name="duration[]" class="form-control" id="duration" placeholder="duration">\n' +
            '                            </div>\n' +
            '                            <div class="col-md-12 form-group mb-3">\n' +
            '                                <label for="description">Description</label>\n' +
            '                                <textarea id="description" name="description[]" class="form-control description" rows="5" cols="30"></textarea>\n' +
            '                            </div>\n' +
            '                        </div>\n' +
            '                    </div>\n' +
            '                    <div class="col-md-2 pl-0 pr-0 pt-1">\n' +
            '                        <a href="JavaScript:void(0)" class="addMore">\n' +
            '                            <span class="material-icons">add_box</span>\n' +
            '                        </a>\n' +
            '                        <a href="JavaScript:void(0)" class="removeMore">\n' +
            '                            <span class="material-icons">close</span>\n' +
            '                        </a>\n' +
            '                    </div>\n';
            ''; //New input field html
        var x = 1; //Initial field counter is 1

        //Once add button is clicked
        $('body').on('click','.addMore', function(){
            // alert($('.description').length);
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html

            /*$('.description').removeAttr('name','description');
            $('.description').attr('name','description'+$('.description').length);
            $('.description').removeAttr('id','description');
            $('.description').attr('id','description'+$('.description').length);*/

            /*CKEDITOR.replace( 'description[]' );
            $("#submitBtn").on("click", function () {
                let description = CKEDITOR.instances.description.getData();
                $('#description').val(description);
            });
*/
            /*CKEDITOR.replace( 'description2' );
            $("#submitBtn").on("click", function () {
                let description2 = CKEDITOR.instances.description.getData();
                $('#description2').val(description2);
            })*/

            $(this).parent().children('.addMore').remove();
        });

        //Once remove button is clicked
        $(wrapper).on('click', '.removeMore', function(e){
            //alert('works');
            e.preventDefault();
            $(this).parent().parent().remove(); //Remove field html
            x--; //Decrement field counter
            $('.field_wrapper').children().find('.removeMore').parent().last().html('' +
                '<a href="JavaScript:void(0)" class="addMore">\n' +
                '                            <span class="material-icons">add_box</span>\n' +
                '                        </a>\n' +
                '                        <a href="JavaScript:void(0)" class="removeMore">\n' +
                '                            <span class="material-icons">close</span>\n' +
                '                        </a>' +
                '');
            $('.field_wrapper').children().find('.removeMore').first().hide();
        });

    });
</script>
