@extends('layouts.app')

@section('stylesheet')
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css ') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
@endsection

@section('title', 'Edit Proposal')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Item</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Item Details</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                            title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <form action="{{ route('manage-inventory.update', $item->item_id) }}" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="inputName">Project Name</label>
                                        <input id="inputName" type="text" name="psm_title" value="{{ $title->psm_title }}"
                                               class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputObjective">Objective</label>
                                        <textarea id="inputObjective" name="objective" class="form-control" rows="6">{{ $proposal->objective }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputScope">Scope of Project</label>
                                        <textarea id="inputScope" name="scope_of_project" class="form-control" rows="6">{{ $proposal->scope_of_project }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputBackground">Problem Background</label>
                                        <textarea id="inputBackground" name="problem_background" class="form-control" rows="6">{{ $proposal->problem_background }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputTechniques">Techniques</label>
                                        <textarea id="inputTechniques" name="techniques" class="form-control" rows="6">{{ $proposal->techniques }}</textarea>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <div class="row justify-content-center">
                                        <div class="col-5">
                                            <a href="{{ route('manage-proposal.detail', $proposal_id) }}" class="btn btn-secondary">Cancel</a>
                                            <input id="submitForm" type="submit" value="Update Proposal"
                                                   class="btn btn-warning float-right">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>

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
