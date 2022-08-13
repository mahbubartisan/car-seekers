@extends('layouts.backend')

@section('content')

    <div class="row mb-5">

        <div class="col-lg-8 col-md-8 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="content">

                        <h3 class="text-center pb-1">
                            Account Information
                            <span class="badge badge-warning float-right mt-1">
                                <a href="{{ route('edit-account-settings') }}" title="Edit Information">
                                    <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                </a>
                            </span>
                        </h3>

                        <div class="row" style="font-size: 16px;">
                            <div class="col-md-8 ml-auto mr-auto">
                                <div class="row">
                                    <div class="col-md-12 pb-2">
                                        <label for="name" class="mb-0">PayPal Account</label>
                                        <input type="text" name="paypal_account" id="paypal_account" class="form-control" value="{{ Auth::user()->paypal_account }}" readonly>
                                    </div>
                                    <div class="col-md-12 pb-2">
                                        <label for="name" class="mb-0">Name</label>
                                        <input type="text" name="name" id="name" class="form-control" value="{{ Auth::user()->name }}" readonly>
                                    </div>
                                    <div class="col-md-12 pb-2">
                                        <label for="email" class="mb-0">E-mail</label>
                                        <input type="email" name="email" id="email" class="form-control" value="{{ Auth::user()->email }}" readonly>
                                    </div>
                                    <div class="col-md-12 pb-2">
                                        <label for="contact" class="mb-0">Contact</label>
                                        <input type="text" name="contact" id="contact" class="form-control" value="{{ Auth::user()->contact }}" readonly>
                                    </div>
                                    <div class="col-md-12 pb-2">
                                        <label for="gender" class="mb-0">Gender</label>
                                        <input type="text" name="gender" id="gender" class="form-control" value="{{ Auth::user()->gender }}" readonly>
                                    </div>
                                    <div class="col-md-12 pb-2">
                                        <label for="address" class="mb-0">Address</label>
                                        <input type="text" name="address" id="address" class="form-control" value="{{ Auth::user()->address }}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-3 col-sm-12 text-center">
            <div class="card">
                <div class="card-body">
                    <div class="content">

                        <h3 class="text-center pb-2">
                            Avatar
                        </h3>

                        <img src="{{ asset('templates/images/avatars/'.Auth::user()->avatar) }}" alt="" width="200px">

                    </div>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-body">
                    <div class="content">

                        <h3 class="text-center pb-2">
                            Govt. issued id
                        </h3>

                        <img src="{{ asset('templates/images/govt_issued_id/'.Auth::user()->govt_issued_id) }}" alt="" width="200px">

                    </div>
                </div>
            </div>
        </div>

    </div>

    {{--<a href="JavaScript:void(0)" title="Edit Information"
       data-toggle="modal" data-target="#editAccount" data-keyboard="false" data-backdrop="static"
    >
        <i class="nav-icon i-Pen-2 font-weight-bold"></i>
    </a>--}}
    <!-- Modal -->
    {{--<div class="modal fade" id="editAccount" tabindex="-1" role="dialog" aria-labelledby="editAccountTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAccountTitle">Update Account Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 pb-2">
                            <label for="name" class="mb-0">Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ Auth::user()->name }}">
                        </div>
                        <div class="col-md-12 pb-2">
                            <label for="email" class="mb-0">E-mail</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ Auth::user()->email }}" readonly>
                        </div>
                        <div class="col-md-12 pb-2">
                            <label for="contact" class="mb-0">Contact</label>
                            <input type="text" name="contact" id="contact" class="form-control" value="{{ Auth::user()->contact }}">
                        </div>
                        <div class="col-md-12 pb-2">
                            <label for="gender" class="mb-0">Gender</label>
                            <input type="text" name="gender" id="gender" class="form-control" value="{{ Auth::user()->gender }}">
                        </div>
                        <div class="col-md-12 pb-2">
                            <label for="address" class="mb-0">Address</label>
                            <input type="text" name="address" id="address" class="form-control" value="{{ Auth::user()->address }}">
                        </div>
                        <div class="col-md-12 pb-2">
                            <label for="govt_issued_id" class="mb-0">Govt. issued id ({{ Auth::user()->govt_issued_id }})</label>
                            <input type="file" name="govt_issued_id" id="govt_issued_id" class="form-control">
                        </div>
                        <div class="col-md-12 pb-2">
                            <label for="avatar" class="mb-0">Avatar ({{ Auth::user()->avatar }})</label>
                            <input type="file" name="avatar" id="avatar" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>--}}

@endsection
