@extends('layouts.frontend')

@section('content')

    <div class="container">
    <div class="row mb-5 mt-5">

        <div class="col-lg-8 col-md-8 col-sm-12 mb-5">
            <div class="card">
                <div class="card-body">
                    <div class="content">

                        <h3 class="text-center pb-1">
                            Update Account Information
                        </h3>

                        <form action="{{ route('update-account-settings') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="row" style="font-size: 16px;">
                                <div class="col-md-8 ml-auto mr-auto">
                                    <div class="row">
                                        <div class="col-md-12 pb-2">
                                            <label for="name" class="mb-0">Name</label>
                                            <input type="text" name="name" id="name" class="form-control" value="{{ Auth::user()->name }}" required>
                                        </div>
                                        <div class="col-md-12 pb-2">
                                            <label for="email" class="mb-0">E-mail</label>
                                            <input type="email" name="email" id="email" class="form-control" value="{{ Auth::user()->email }}" readonly>
                                        </div>
                                        <div class="col-md-12 pb-2">
                                            <label for="contact" class="mb-0">Contact</label>
                                            <input type="text" name="contact" id="contact" class="form-control" value="{{ Auth::user()->contact }}" required>
                                        </div>
                                        <div class="col-md-12 pb-2">
                                            <label for="gender" class="mb-0">Gender</label>
                                            <input type="text" name="gender" id="gender" class="form-control" value="{{ Auth::user()->gender }}" required>
                                        </div>
                                        <div class="col-md-12 pb-2">
                                            <label for="address" class="mb-0">Address</label>
                                            <input type="text" name="address" id="address" class="form-control" value="{{ Auth::user()->address }}" required>
                                        </div>
                                        <div class="col-md-12 pb-2">
                                            <label for="avatar" class="mb-0">Avatar ({{ Auth::user()->avatar }})</label>
                                            <input type="file" name="avatar" id="avatar" class="form-control">
                                        </div>
                                        <div class="col-md-12 pb-2">
                                            <label for="govt_issued_id" class="mb-0">Govt. issued id ({{ Auth::user()->govt_issued_id }})</label>
                                            <input type="file" name="govt_issued_id" id="govt_issued_id" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-2">
                                <input type="submit" class="btn btn-primary float-right" value="Update">
                                <a href="{{ URL::previous() }}" class="btn btn-info float-right mr-2">Back</a>
                            </div>
                        </form>

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

                        <img src="{{ asset('templates/images/avatars/'.Auth::user()->avatar) }}" alt="" width="150px">

                        <br>

                        <span class="text-primary">
                            <b>
                                File Name: {{ Auth::user()->avatar }}
                            </b>
                        </span>

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

                        <img src="{{ asset('templates/images/govt_issued_id/'.Auth::user()->govt_issued_id) }}" alt="" width="150px">

                        <br>

                        <span class="text-primary">
                            <b>
                                File Name: {{ Auth::user()->govt_issued_id }}
                            </b>
                        </span>

                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>

@endsection
