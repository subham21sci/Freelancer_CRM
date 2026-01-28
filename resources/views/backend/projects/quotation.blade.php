@extends('backend.layout.master')
@section('title', 'Project quotation')
@section('css_Section')
@stop
@section('content')

    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">

                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item"><a href="javascript:;">Project List</a></li>
                            <li class="breadcrumb-item"><a href="javascript:;">Quotation</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $projectData->project_name }} </li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <a href="{{ route('admin.projects.pipeline') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
            <!--end breadcrumb-->

            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-10">
                            <h3> <strong>{{ $projectData->project_name }}</strong> <span style="font-size:14px">Quotation
                                    </span> </h3>
                        </div>

                        <div class="col-2">
                            <div class="ms-auto">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#paymentmodel"><i class="bx bxs-plus-square"></i>Add
                                        Quotation</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
    <!--end page wrapper -->

@stop
@section('js_section')
    <script>
        $('.confirm-button').click(function(event) {
            var form = $(this).closest("form");
            event.preventDefault();
            swal({
                    title: `Are you sure you want to delete this?`,
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });

    </script>
    <script>
        $(document).ready(function() {
            var table = $('#example2').DataTable({
                lengthChange: false,
                buttons: ['copy', 'excel', 'pdf', 'print']
            });

            table.buttons().container()
                .appendTo('#example2_wrapper .col-md-6:eq(0)');
        });
    </script>
@stop
