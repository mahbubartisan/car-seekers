@extends('layouts.backend')

@section('content')
    <div class="row mb-4">
        <div class="col-md-12 mb-4">
            <div class="card text-left">

                <div class="card-body">
                    <h4 class="card-title mb-3">Discounts
                        <a href="JavaScript:void(0)"
                           class="float-right createBtn"
                           data-route="{{ route('discounts.create') }}"
                           data-formtype="modal"
                           data-formsize="large">
                            <span class="material-icons">add_box</span>
                        </a>
                    </h4>
                    <div class="table-responsive" id="globalTable">
                        <table id="datatable" class="display table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Amount</th>
                                <th>Coupon Code</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($discounts as $discount)
                                    <tr data-row="{{ $discount->id }}">
                                        <td>{{ $discount->id }}</td>
                                        <td>{{ $discount->name }}</td>
                                        <td>{{ $discount->type }}</td>
                                        <td>{{ $discount->amount }}</td>
                                        <td>{{ $discount->coupon_code }}</td>
                                        <td>
                                            <form action="{{ route('discount-status-update', $discount->id) }}" method="post" class="status-form-{{$discount->id}}" id="status-form-{{$discount->id}}" data-id="{{ $discount->id }}">
                                                @csrf
                                                @method('PATCH')
                                                <label class="switch switch-primary mr-3 mt-2">
                                                    <input type="checkbox" name="status" class="status-update" data-id="{{ $discount->id }}" {!! $discount->status == 1 ? 'checked="checked"':'' !!}>
                                                    <span class="slider"></span>
                                                </label>
                                            </form>
                                        </td>
                                        <td class="text-center">
                                            <a href="JavaScript:void(0)"
                                               class="showBtn"
                                               data-route="{{ route('discounts.show', $discount->id) }}"
                                               data-formtype="modal"
                                               data-formsize="large">
                                                <span class="material-icons">remove_red_eye</span>
                                            </a>
                                            <a href="JavaScript:void(0)"
                                               class="editBtn ml-auto mr-auto"
                                               data-route="{{ route('discounts.edit', $discount->id) }}"
                                               data-formtype="modal"
                                               data-formsize="large">
                                                <span class="material-icons">create</span>
                                            </a>
                                            <a class="deleteBtn ml-auto mr-auto" href="JavaScript:void(0)" data-route="{{ route('discounts.destroy', $discount->id) }}">
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
