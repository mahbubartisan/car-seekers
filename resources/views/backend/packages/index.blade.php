@extends('layouts.backend')

@section('content')
    <div class="row mb-4">
        <div class="col-md-12 mb-4">
            <div class="card text-left">

                <div class="card-body">
                    <h4 class="card-title mb-3">Packages
                        <a href="JavaScript:void(0)"
                           class="float-right createBtn"
                           data-route="{{ route('packages.create') }}"
                           data-formtype="modal"
                           data-formsize="large">
                            <span class="material-icons">add_box</span>
                        </a>
                    </h4>

                    <div class="table-responsive" id="globalTable">
                        <table id="datatable" class="display table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>Name</th>
                                {{--<th>Duration</th>--}}
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($packages as $package)
                                    <tr data-row="{{ $package->id }}">
                                        <td>{{ $package->name }}</td>
                                        {{--<td>
                                            @foreach($package->durations as $duration)
                                                {{ $duration->label }} - {{ $duration->duration }} Hours <br>
                                            @endforeach
                                        </td>--}}
                                        <td>
                                            {!! Str::limit($package->description, 50) !!}
                                        </td>
                                        <td class="text-center">
                                            <a href="JavaScript:void(0)"
                                               class="showBtn"
                                               data-route="{{ route('packages.show', $package->id) }}"
                                               data-formtype="modal"
                                               data-formsize="large">
                                                <span class="material-icons">remove_red_eye</span>
                                            </a>
                                            <a href="JavaScript:void(0)"
                                               class="editBtn ml-auto mr-auto"
                                               data-route="{{ route('packages.edit', $package->id) }}"
                                               data-formtype="modal"
                                               data-formsize="large">
                                                <span class="material-icons">create</span>
                                            </a>
                                            <a class="deleteBtn ml-auto mr-auto" href="JavaScript:void(0)" data-route="{{ route('packages.destroy', $package->id) }}">
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
