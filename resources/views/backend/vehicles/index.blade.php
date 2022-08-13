@extends('layouts.backend')

@section('content')
    <div class="row mb-4">
        <div class="col-md-12 mb-4">
            <div class="card text-left">

                <div class="card-body">
                    <h4 class="card-title mb-3">vehicle
                        <a href="JavaScript:void(0)"
                           class="float-right createBtn"
                           data-route="{{ route('vehicle.create') }}"
                           data-formtype="modal"
                           data-formsize="large">
                            <span class="material-icons">add_box</span>
                        </a>
                    </h4>

                    <div class="table-responsive" id="globalTable">
                        <table id="datatable" class="display table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>Image</th>
                                <th>Company</th>
                                <th>Model</th>
                                <th>Reg. Number</th>
                                <th>Availability</th>
                                <th>Status</th>
                                @if(Auth::user()->role == 'Admin')
                                    <th>Renter</th>
                                @endif
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($vehicles as $vehicle)
                                    <tr data-row="{{ $vehicle->id }}">
                                        <td class="text-center"><img src="{{ asset('templates/images/vehicles/'.$vehicle->image) }}" alt="" width="100px" height="50px"></td>
                                        <td>{{ $vehicle->company }}</td>
                                        <td>{{ $vehicle->model }}</td>
                                        <td>{{ $vehicle->registration_number }}</td>
                                        <td>
                                            <form action="{{ route('vehicle-status-update', $vehicle->id) }}" method="post" class="status-form-{{$vehicle->id}}" id="status-form-{{$vehicle->id}}" data-id="{{ $vehicle->id }}">
                                                @csrf
                                                @method('PATCH')
                                                <label class="switch switch-primary mr-3 mt-2">
                                                    <input type="checkbox" name="availability" class="status-update" data-id="{{ $vehicle->id }}" {!! $vehicle->availability == 1 ? 'checked="checked"':'' !!}>
                                                    <span class="slider"></span>
                                                </label>
                                            </form>
                                        </td>
                                        <td>
                                            {{ $vehicle->status }}
                                            @if($vehicle->status == 'Disapproved')
                                                <a href="JavaScript:void(0)" data-toggle="modal" data-target="#query_{{$vehicle->id}}">
                                                    <span class="material-icons">
                                                        live_help
                                                    </span>
                                                </a>
                                            @endif
                                        <!-- Modal -->
                                            <div class="modal fade" id="query_{{$vehicle->id}}" tabindex="-1" role="dialog" aria-labelledby="query_{{$vehicle->id}}_ModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="title" id="query_{{$vehicle->id}}_ModalLabel">Reason for Disapproval</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            {{$vehicle->status_note}}
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        @if(Auth::user()->role == 'Admin')
                                            <td>{{ $vehicle->users->name }}</td>
                                        @endif
                                        <td class="text-center">
                                            <a href="JavaScript:void(0)"
                                               class="showBtn"
                                               data-route="{{ route('vehicle.show', $vehicle->id) }}"
                                               data-formtype="modal"
                                               data-formsize="large">
                                                <span class="material-icons">remove_red_eye</span>
                                            </a>
                                            @if($vehicle->user_id == Auth::user()->id)
                                                <a href="JavaScript:void(0)"
                                                   class="editBtn ml-auto mr-auto"
                                                   data-route="{{ route('vehicle.edit', $vehicle->id) }}"
                                                   data-formtype="modal"
                                                   data-formsize="large">
                                                    <span class="material-icons">create</span>
                                                </a>
                                            @endif
                                            <a class="deleteBtn ml-auto mr-auto" href="JavaScript:void(0)" data-route="{{ route('vehicle.destroy', $vehicle->id) }}">
                                                <span class="material-icons">
                                                    clear
                                                </span>
                                            </a>
                                            @if(Auth::user()->role == 'Admin' && $vehicle->users->role != 'Admin')
                                                @if($vehicle->status == 'Pending' || $vehicle->status == 'Disapproved')
                                                    <a href="JavaScript:void(0)"
                                                       class="approveBtn_{{$vehicle->id}} ml-auto mr-auto"
                                                       data-route="{{ route('vehicle.approval', $vehicle->id) }}"
                                                       data-id="{{ $vehicle->id }}">
                                                        <span class="material-icons">done_outline</span>
                                                    </a>
                                                    <form id="approveForm_{{$vehicle->id}}" data-id="{{ $vehicle->id }}" method="post" hidden>
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="text" name="status" value="Approved">
                                                    </form>
                                                @else
                                                    <a href="JavaScript:void(0)"
                                                        class="{{--disapproveBtn_{{$vehicle->id}}--}} ml-auto mr-auto"
                                                        data-id="{{ $vehicle->id }}"
                                                        data-toggle="modal" data-target="#disapproveModal_{{ $vehicle->id }}"
                                                        data-backdrop="static" data-keyboard="false"
                                                        >
                                                        <span class="material-icons">report_off</span>
                                                    </a>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @foreach($vehicles as $vehicle)
    <!-- Disapprove Modal -->
    <div class="modal fade" id="disapproveModal_{{ $vehicle->id }}" tabindex="-1" role="dialog" aria-labelledby="disapproveModalTitle_{{ $vehicle->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content row">
                <form action="{{ route('vehicle.approval', $vehicle->id) }}" id="disapproveForm_{{$vehicle->id}}" data-id="{{ $vehicle->id }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="col-md-12 p-3">
                        <h4 class="modal-title" id="disapproveModalTitle_{{ $vehicle->id }}">
                            Disapprove Form
                            <a class="close closeDisapproveModal" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </a>
                        </h4>
                        <div class="print-error-msg">
                            <div class="row mt-3 mb-3 ml-1 mr-1"></div>
                        </div>
                        <div class="row mt-12">
                            <div class="col-md-12 form-group mb-3 mt-3">
                                <div class="row">
                                    <input type="hidden" name="status" value="Disapproved">
                                    <div class="col-md-12 form-group">
                                        <label for="status_note">Status Note</label>
                                        <div class="input-group">
                                            <textarea type="text" name="status_note" class="form-control"></textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12 form-group mb-3 text-center">
                                <div class="">
                                    <button class="btn btn-success disapproveBtn_{{$vehicle->id}}" type="button">
                                        Disapprove!
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script src="{{ asset('templates/backend/js/vendor/jquery-3.3.1.min.js') }}"></script>
    <!-- page vendor js -->
    <script src="{{ asset('templates/backend/js/vendor/datatables.min.js') }}"></script>
    <script>
        // Approve Vehicle
        $('.approveBtn_{{$vehicle->id}}').on('click', function(e) {
            e.preventDefault();
            let action = $('.approveBtn_{{$vehicle->id}}').data('route');
            let globalTable = $('#globalTable');
            let approveForm = $('#approveForm_{{$vehicle->id}}');
            $.ajax({
                url: action,
                data:new FormData(approveForm[0]),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                // dataType:'json',
                async:false,
                type: 'post',
                processData: false,
                contentType: false,
                // dataType: "html",
                success: function (data) {
                    globalTable.replaceWith($('#globalTable',data));

                    $('tr').each(function (index, value){
                        if ($(this).data('row') === approveForm.data('id')) {
                            $(this).css('background', '#d8f5e0');
                            $(this).delay(1500).queue(function () {
                                $(this).css('background', 'transparent');
                            });
                        }
                    });

                    // window.location = "/vehicle";

                    $('#datatable').DataTable( {
                        "paging":   true,
                        "ordering": false,
                        "info":     true
                    } );

                },
                error: function (data) {
                    alert('Operation Failed!');
                }
            });
        });

        // Disapprove Vehicle
        $('.disapproveBtn_{{$vehicle->id}}').on('click', function(e) {
            e.preventDefault();
            let action = $('#disapproveForm_{{$vehicle->id}}').attr('action');
            let disapproveModal = $('#disapproveModal_{{ $vehicle->id }}');
            let globalTable = $('#globalTable');
            let disapproveForm = $('#disapproveForm_{{$vehicle->id}}');

            $.ajax({
                url: action,
                data:new FormData(disapproveForm[0]),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                // dataType:'json',
                async:false,
                type: 'post',
                processData: false,
                contentType: false,
                // dataType: "html",
                success: function (data) {
                    if($.isEmptyObject(data.error)){
                        disapproveModal.trigger("reset");
                        disapproveModal.modal('hide');
                        globalTable.replaceWith($('#globalTable',data));

                        $('.globalTable').replaceWith($('.globalTable',data));
                        $('tr').each(function (index, value){
                            if ($(this).data('row') === disapproveForm.data('id')) {
                                $(this).css('background', '#d8f5e0');
                                $(this).delay(1500).queue(function (next) {
                                    $(this).css('background', 'transparent');
                                    next();
                                });
                            }
                        });

                        // window.location = "/vehicle";

                        $('#datatable').DataTable( {
                            "paging":   true,
                            "ordering": false,
                            "info":     true
                        } );

                        $(".error").attr('hidden', true);
                    }else{
                        printErrorMsg(data.error);
                        setTimeout(function(){
                            $(".print-error-msg").fadeOut(3*1000);
                        }, 5*1000);
                    }
                },
                error: function (data) {
                    alert('Operation Failed!');
                }
            });
        });
    </script>
    @endforeach
@endsection
