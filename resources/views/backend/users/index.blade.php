@extends('layouts.backend')

@section('content')
    <div class="row mb-4">
        <div class="col-md-12 mb-4">
            <div class="card text-left">

                <div class="card-body">
                    <h4 class="card-title mb-3">Users
                        <a href="JavaScript:void(0)"
                           class="float-right createBtn"
                           data-route="{{ route('users.create') }}"
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
                                <th>Name</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Status</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr data-row="{{ $user->id }}">
                                        <td><img src="{{ asset('templates/images/avatars/'.$user->avatar) }}" alt="" width="50px" height="50px"></td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->contact }}</td>
                                        <td>
                                            <form action="{{ route('user-status-update', $user->id) }}" method="post" class="status-form-{{$user->id}}" data-id="{{ $user->id }}">
                                                @csrf
                                                @method('PATCH')
                                                <select name="status" class="status-update form-control" data-id="{{$user->id}}">
                                                    <option value="Pending" {{ $user->status == 'Pending' ? 'selected':'' }}>Pending</option>
                                                    <option value="Approved" {{ $user->status == 'Approved' ? 'selected':'' }}>Approved</option>
                                                    <option value="Disapproved" {{ $user->status == 'Disapproved' ? 'selected':'' }}>Disapproved</option>
                                                    <option value="Suspended" {{ $user->status == 'Suspended' ? 'selected':'' }}>Suspended</option>
                                                </select>
                                            </form>
                                        </td>
                                        <td>{{ $user->role }}</td>
                                        <td class="text-center">
                                            <a href="JavaScript:void(0)"
                                               class="showBtn"
                                               data-route="{{ route('users.show', $user->id) }}"
                                               data-formtype="modal"
                                               data-formsize="large">
                                                <span class="material-icons">remove_red_eye</span>
                                            </a>
                                            <a href="JavaScript:void(0)"
                                               class="editBtn ml-auto mr-auto"
                                               data-route="{{ route('users.edit', $user->id) }}"
                                               data-formtype="modal"
                                               data-formsize="large">
                                                <span class="material-icons">create</span>
                                            </a>
                                            <a class="deleteBtn ml-auto mr-auto"
                                               href="JavaScript:void(0)"
                                               data-route="{{ route('users.destroy', $user->id) }}">
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
