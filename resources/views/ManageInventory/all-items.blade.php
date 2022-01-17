@extends('layouts.app')

@section('stylesheet')
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css ') }}">

    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
@endsection

@section('title', 'List of all Items')

@section('content')
    <div class="modal fade" id="add-item-modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Item</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('manage-inventory.store') }}" id="add-item-form" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Item Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="number" name="quantity" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Date Start</label>
                            <div class="input-group date" id="date_start" data-target-input="nearest">
                                <input type="text" name="date_start" class="form-control datetimepicker-input" data-target="#date_start"/>
                                <div class="input-group-append" data-target="#date_start" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Date End</label>
                            <div class="input-group date" id="date_end" data-target-input="nearest">
                                <input type="text" name="date_end" class="form-control datetimepicker-input" data-target="#date_end"/>
                                <div class="input-group-append" data-target="#date_end" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" onclick="event.preventDefault(); document.getElementById('add-item-form').submit()" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage Items</h1>
                </div>
                @can('add item')
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <button type="button" class="btn btn-block btn-success" data-toggle="modal" data-target="#add-item-modal">
                                    <i class="fa fa-plus"></i>
                                    Add Items
                                </button>
                            </li>
                        </ol>
                    </div>
                @endcan
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">All Items</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped projects">
                    <thead>
                        <tr>
                            <th style="width: 1%">
                                #
                            </th>
                            <th style="width: 10%">
                                Items
                            </th>
                            <th class="text-center" style="width: 1%">
                                Student
                            </th>
                            <th class="text-center" style="width: 1%">
                                Supervisor
                            </th>
                            <th class="text-center" style="width: 1%">
                                Status
                            </th>
                            <th style="width: 2%" class="text-center">
                                Action
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td>
                                    {{ ++$count }}
                                </td>
                                <td>
                                    {{ $item->name }}
                                </td>
                                <td class="text-center">
                                    {{ (is_null($item->student)) ? 'none' : $item->student->detail->name }}
                                </td>
                                <td>
                                    by: {{ $item->student->supervisor->detail->name }}
                                </td>
                                <td class="text-center">
                                    @switch($item->status_approval)
                                        @case(\App\Classes\Constants\ApprovalStatus::APPROVED)
                                            <span class="badge bg-success">approved</span>
                                        @break
                                        @case(\App\Classes\Constants\ApprovalStatus::PENDING)
                                            <span class="badge bg-warning">pending</span>
                                        @break
                                        @case(\App\Classes\Constants\ApprovalStatus::REJECTED)
                                            <span class="badge bg-danger">rejected</span>
                                        @break
                                    @endswitch
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary">Action</button>
                                        <button type="button" class="btn btn-primary dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu" role="menu">
                                            <a class="dropdown-item" href="{{ route('manage-inventory.show', $item->item_id) }}">View</a>
                                            @can('delete item')
                                                <a class="dropdown-item" href="{{ route('manage-inventory.destroy', $item->item_id) }}">Delete</a>
                                            @endcan
                                            @can('update item')
                                                <a class="dropdown-item" href="{{ route('manage-inventory.edit', $item) }}">Edit</a>
                                            @endcan
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer"></div>
        </div>
    </section>
@endsection

@section('scripts')
    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>

    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>

    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <script type="text/javascript">
        $(function () {
            $('#date_start').datetimepicker({
                format: 'L'
            });
            $('#date_end').datetimepicker({
                format: 'L'
            });
        });
    </script>
@endsection