@extends('backend.layout.master')
@section('title', 'Project Payment')
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
                            <li class="breadcrumb-item"><a href="javascript:;">Payment</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $projectData->project_name }} </li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <a href="{{ route('admin.projects.ongoing') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
            <!--end breadcrumb-->
            <hr />
            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3">

                <div class="col">
                    <div class="card radius-10 border-success border-bottom border-3 border-0">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary"> Total Payment Recived</p>
                                    <h4 class="my-1">00</h4>
                                </div>
                                <div class="text-success ms-auto font-35"><i class='bx bxs-group'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card radius-10 border-primary border-bottom border-3 border-0">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Total Payment</p>
                                    <h4 class="my-1">00</h4>
                                </div>
                                <div class="text-primary ms-auto font-35"><i class='bx bx-user'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card radius-10 border-danger border-bottom border-3 border-0">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Total Due Payment</p>
                                    <h4 class="my-1">00</h4>
                                </div>
                                <div class="text-danger ms-auto font-35"><i class='fadeIn animated bx bx-buildings'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h3> <strong>{{ $projectData->project_name }}</strong> <span style="font-size:14px">Payment
                                    List</span> </h3>
                        </div>

                        <div class="col-4">
                            <div class="ms-auto">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#paymentmodel"><i class="bx bxs-plus-square"></i>Add
                                        Payment</button>
                                </div>

                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#paymentmodel"><i class="bx bxs-plus-square"></i>Add
                                        Invoice</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example2" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>SI</th>
                                    <th>Name</th>
                                    {{-- <th>Thumbnail</th>
                                <th>Discription</th> --}}

                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $sl = 1;
                                @endphp


                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end page wrapper -->
    <!-- Modal -->
    <div class="modal fade" id="paymentmodel" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Payment </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('admin.catStore') }}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-12">

                                <div class="row g-1">
                                    <div class="col-12">
                                        <label for="compname" class="form-label">Amount<span
                                                class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('amount') is-invalid @enderror"
                                            name="amount" value="{{ old('amount') }}">
                                        @error('amount')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="img" class="form-label mt-2">Screenshot</label>
                                        <input type="file"
                                            class="form-control @error('screenshot') is-invalid @enderror" accept="image/*"
                                            name="screenshot" id="img">
                                        @error('screenshot')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label for="discription" class="form-label mt-2">Discription</label>
                                        <textarea name="discription" cols="0" rows="2"
                                            class="w-100 form-control @error('discription') is-invalid @enderror">{{ old('discription') }}</textarea>
                                        @error('discription')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>

                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="LanguagemodelEdit1" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('admin.catUpdate') }}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row g-1">
                                    <input type="hidden" id="edit_id" name="id">
                                    <div class="col-12">
                                        <label for="edit_name" class="form-label">Name <span
                                                class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control  @error('editname') is-invalid @enderror" id="edit_name"
                                            name="editname" required>

                                        @error('editname')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="img" class="form-label mt-2">Thumbnail</label>
                                        <input type="file"
                                            class="form-control @error('thumbnail') is-invalid @enderror" accept="image/*"
                                            name="thumbnail" id="img">
                                        @error('thumbnail')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label for="discription" class="form-label mt-2">Discription <span
                                                class="text-danger">*</span></label>
                                        <textarea name="discription" cols="0" rows="2" id="edit_discription"
                                            class="w-100 form-control @error('discription') is-invalid @enderror">{{ old('discription') }}</textarea>
                                        @error('discription')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                </form>
            </div>
        </div>
    </div>
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

        $(document).ready(function() {
            $(document).on('click', '.open-EditLangDialog', function() {

                var id = $(this).data('id');
                var name = $(this).data('name');
                var discription = $(this).data('discription');

                $("#edit_id").val(id);
                $("#edit_name").val(name);
                $("#edit_discription").val(discription);

                $("#LanguagemodelEdit1").modal('show')

            });

        });

        $(document).ready(function() {
            $('#example').DataTable();
        });

        var myModal = new bootstrap.Modal($("#paymentmodel"), {
            keyboard: false
        });
        @if ($errors->any())
            myModal.show();
        @endif
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
