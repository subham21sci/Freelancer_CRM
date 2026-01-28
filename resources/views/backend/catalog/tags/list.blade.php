@extends('backend.layout.master')
@section('title', 'Tags')
@section('css_section')
@stop
@section('content')

    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">

            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h3 class="mb-0">Tags List</h3>

                        <div class="ms-auto">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#categorymodel">
                                <i class="bx bxs-plus-square"></i> Add Tags
                            </button>
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
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $sl = 1;
                                @endphp
                                @foreach ($tagData as $tag)
                                    <tr>
                                        <td>{{ $sl++ }}</td>
                                        <td>{{ $tag->name }}</td>
                                        <td>
                                            <div class="d-flex order-actions">
                                                <a href="javascript:void(0)" data-id="{{ $tag->id }}"
                                                    data-name="{{ $tag->name }}" class="openEditCategory act"><i
                                                        class='bx bxs-edit '></i></a>

                                                <form method="post"
                                                    action="{{ route('admin.tags.tagDestroy', ['id' => $tag->id]) }}">
                                                    @csrf
                                                    <button type="submit" class="act form-dlt-btn confirm-button"><i
                                                            class='bx bxs-trash'></i></button>
                                                </form>

                                            </div>
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
    <!--end page wrapper -->
    <!-- Modal -->
    <div class="modal fade" id="categorymodel" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Tag</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('admin.tags.tagStore') }}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-12">

                                <div class="row g-1">
                                    <div class="col-12">
                                        <label for="compname" class="form-label">Name <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" value="{{ old('name') }}">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary d-flex justify-content-center align-items-center" type="submit"
                        id="catSubmitBtn">
                        <span class="spinner-border spinner-border-sm me-2 d-none" role="status" aria-hidden="true"></span>
                        <span class="btn-text">Submit</span>
                    </button>

                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="categoryEditModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Tag</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('admin.tags.tagUpdate') }}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row g-1">
                                    <input type="hidden" id="edit_id" name="id">
                                    <div class="col-12">
                                        <label for="edit_name" class="form-label">Name <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control  @error('editname') is-invalid @enderror"
                                            id="edit_name" name="editname" required>

                                        @error('editname')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary d-flex justify-content-center align-items-center" type="submit"
                        id="catUpadteBtn">
                        <span class="spinner-border spinner-border-sm me-2 d-none" role="status"
                            aria-hidden="true"></span>
                        <span class="btn-text">Update</span>
                    </button>

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

        $(document).on('click', '.openEditCategory', function() {
            $('#edit_id').val($(this).data('id'));
            $('#edit_name').val($(this).data('name'));
            $('#categoryEditModal').modal('show');
        });

        var myModal = new bootstrap.Modal($("#categorymodel"), {
            keyboard: false
        });
        @if ($errors->any())
            myModal.show();
        @endif

        $(document).ready(function() {
            var table = $('#example2').DataTable({
                lengthChange: false,
                buttons: ['copy', 'excel', 'pdf', 'print']
            });

            table.buttons().container()
                .appendTo('#example2_wrapper .col-md-6:eq(0)');
        });


        $(function() {
            // For Add Category form
            $('#categorymodel form').on('submit', function(e) {
                e.preventDefault();

                var $btn = $('#catSubmitBtn');

                if ($(this)[0].checkValidity()) {
                    $btn.prop('disabled', true);
                    $btn.find('.spinner-border').removeClass('d-none');
                    $btn.find('.btn-text').text('Please wait...');

                    $(this).off('submit').submit();
                }
            });

            // For Edit Category form
            $('#categoryEditModal form').on('submit', function(e) {
                e.preventDefault();

                var $btn = $('#catUpadteBtn');

                if ($(this)[0].checkValidity()) {
                    $btn.prop('disabled', true);
                    $btn.find('.spinner-border').removeClass('d-none');
                    $btn.find('.btn-text').text('Please wait...');

                    $(this).off('submit').submit();
                }
            });
        });
    </script>
@stop
