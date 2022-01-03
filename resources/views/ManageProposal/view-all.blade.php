@extends('layouts.app')

@section('stylesheet')
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css ') }}">

@endsection

@section('title', 'All Proposals')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage Proposals</h1>
                </div>

            </div>
        </div>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">All Title</h3>

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
                            Title
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
                        @foreach($titles as $title)
                            <tr>
                                <td>
                                    {{ ++$count }}
                                </td>
                                <td>
                                    {{ $title->psm_title }}
                                </td>
                                <td class="text-center">
                                    {{ (is_null($title->student)) ? 'none' : $title->student->name }}
                                </td>
                                <td>
                                    by: {{ $title->supervisor->name }}
                                </td>
                                <td class="text-center">
                                    @switch($title->proposal->status_approval)
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
                                            <a class="dropdown-item" href="{{ route('manage-proposal.detail', $title->title_id) }}">View</a>
                                            @can('edit proposal')
                                                <a class="dropdown-item" href="{{ route('manage-proposal.edit', $title->proposal->proposal_id) }}">Edit</a>
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


@endsection
