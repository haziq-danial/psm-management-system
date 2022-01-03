@extends('layouts.app')

@section('stylesheet')
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css ') }}">
@endsection

@section('Title', 'Item Detail')

@section('content')
    <div class="modal fade" id="approval-status">
        <div class="modal-dialog modal-xs">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Change approval status</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('manage-inventory.approval', $item->item_id) }}" id="approval-form" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="inputTechniques">Set approval status</label>
                            <select class="form-control" name="status_approval">
                                <option value="">-- Set status --</option>
                                <option value="1">Approved</option>
                                <option value="2">Pending</option>
                                <option value="3">Rejected</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" onclick="event.preventDefault(); document.getElementById('approval-form').submit()" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>View Item</h1>
                </div>
                @can('set approve item')
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#approval-status">
                                    <i class="fa fa-plus"></i>
                                    Set Approval Status
                                </button>
                            </li>
                        </ol>
                    </div>
                @endcan
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Item Details</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputName">Item Name</label>
                            <p>{{ $item->name }}</p>
                        </div>
                        <div class="form-group">
                            <label for="inputObjective">Quantity</label>
                            <p>{{ $item->quantity }}</p>
                        </div>
                        <div class="form-group">
                            <label for="inputScope">Owner</label>
                            <p>{{ $item->student->detail->name }}</p>
                        </div>
                        <div class="form-group">
                            <label for="inputBackground">Date Start</label>
                            <p>{{ $item->date_start }}</p>
                        </div>
                        <div class="form-group">
                            <label for="inputTechniques">Date End</label>
                            <p>{{ $item->date_end }}</p>
                        </div>
                        <div class="form-group">
                            <label for="inputTechniques">Status</label>
                            <p>
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
                            </p>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <div class="row justify-content-center">
                            <div class="col-6">
                                @can('view all items')
                                    <a href="{{ route('manage-inventory.view-all') }}" class="btn btn-secondary">Back</a>
                                @endcan
                                @can('view item')
                                    <a href="{{ route('manage-inventory.view-one') }}" class="btn btn-secondary">Back</a>
                                @endcan

                                @can('update item')
                                    <a href="{{ route('manage-inventory.edit', $item->item_id) }}" class="btn btn-warning">Edit Item</a>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>

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
@endsection



