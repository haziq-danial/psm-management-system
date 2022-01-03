@extends('layouts.app')

@section('stylesheet')
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css ') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
@endsection

@section('title', 'Proposal Details')

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
                    <form action="{{ route('manage-proposal.approval', $proposal_id) }}" id="approval-form" method="post">
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
                    <h1>View Proposal</h1>
                </div>
                @can('set approval proposal')
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
                        <h3 class="card-title">Proposal Details</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputName">Project Name</label>
                            <p>{{ $title }}</p>
                        </div>
                        <div class="form-group">
                            <label for="inputObjective">Objective</label>
                            <p>{{ $proposal->objective }}</p>
                        </div>
                        <div class="form-group">
                            <label for="inputScope">Scope of Project</label>
                            <p>{{ $proposal->scope_of_project }}</p>
                        </div>
                        <div class="form-group">
                            <label for="inputBackground">Problem Background</label>
                            <p>{{ $proposal->problem_background }}</p>
                        </div>
                        <div class="form-group">
                            <label for="inputTechniques">Techniques</label>
                            <p>{{ $proposal->techniques }}</p>
                        </div>
                        <div class="form-group">
                            <label for="inputTechniques">Status</label>
                            <p>
                                @switch($proposal->status_approval)
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
                                @can('view all proposals')
                                    <a href="{{ route('manage-proposal.view-all') }}" class="btn btn-secondary">Back</a>
                                @endcan
                                @can('book title')
                                    <a href="{{ route('manage-title.remove-book-title', $proposal_id) }}" class="btn btn-danger">Cancel Booking</a>
                                @endcan

                                @can('edit proposal')
                                    <a href="{{ route('manage-proposal.edit', $proposal_id) }}" class="btn btn-warning">Edit Proposal</a>
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
