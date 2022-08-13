@extends('layouts.backend')

@section('content')
    <div class="row mb-4">
        <div class="col-md-12 mb-4">
            <div class="card text-left">

                <div class="card-body">
                    <h4 class="card-title mb-3">Drivers
                        <a href="JavaScript:void(0)"
                           class="float-right createBtn"
                           data-route="{{ route('drivers.create') }}"
                           data-formtype="modal"
                           data-formsize="large">
                            <span class="material-icons">add_box</span>
                        </a>
                    </h4>

                    <div class="table-responsive" id="globalTable">
                        <table id="datatable" class="display table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>Avatar</th>
                                <th>Driver Name</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Assigned Vehicle</th>
                                @if(Auth::user()->role == 'Admin')
                                    <th>Renter</th>
                                @endif
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($drivers as $driver)
                                    <tr data-row="{{ $driver->id }}">
                                        <td class="text-center"><img src="{{ asset('templates/images/avatars/'.$driver->avatar) }}" alt="" width="50px" height="50px"></td>
                                        <td>{{ $driver->driver_name }}</td>
                                        <td>{{ $driver->email }}</td>
                                        <td>{{ $driver->contact }}</td>
                                        <td>{{ $driver->vehicles->company.'-'.$driver->vehicles->model.'-'.$driver->vehicles->registration_number }}</td>
                                        @if(Auth::user()->role == 'Admin')
                                            <td>{{ $driver->users->name }}</td>
                                        @endif
                                        <td class="text-center">
                                            <a href="JavaScript:void(0)"
                                               class="showBtn"
                                               data-route="{{ route('drivers.show', $driver->id) }}"
                                               data-formtype="modal"
                                               data-formsize="large">
                                                <span class="material-icons">remove_red_eye</span>
                                            </a>
                                            <a href="JavaScript:void(0)"
                                               class="editBtn ml-auto mr-auto"
                                               data-route="{{ route('drivers.edit', $driver->id) }}"
                                               data-formtype="modal"
                                               data-formsize="large">
                                                <span class="material-icons">create</span>
                                            </a>
                                            <a class="deleteBtn ml-auto mr-auto" href="JavaScript:void(0)" data-route="{{ route('drivers.destroy', $driver->id) }}">
                                                <span class="material-icons">
                                                    clear
                                                </span>
                                            </a>
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
@endsection
