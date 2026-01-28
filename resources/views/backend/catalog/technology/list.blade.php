@extends('backend.layout.master')
@section('title', 'Technology')
@section('css_section')
    <style>
        .image-preview-wrapper {
            margin-top: 15px;
            display: none;
        }

        .preview-card {
            border: 2px dashed #dee2e6;
            border-radius: 8px;
            padding: 15px;
            background: #f8f9fa;
            max-width: 250px;
        }

        .image-preview {
            max-width: 100%;
            max-height: 200px;
            border-radius: 4px;
            display: block;
            margin: 0 auto;
        }

        .preview-actions {
            text-align: center;
            margin-top: 10px;
        }

        .current-image-wrapper {
            margin-top: 10px;
            padding: 10px;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            background: #f8f9fa;
            display: inline-block;
        }
    </style>
@stop
@section('content')

    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h3 class="mb-0">Technology List</h3>

                        <div class="ms-auto">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#categorymodel">
                                <i class="bx bxs-plus-square"></i> Add Technology
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
                                    <th>Thumbnail</th>
                                    <th>Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $sl = 1;
                                @endphp
                                @foreach ($technologylist as $cat)
                                    <tr>
                                        <td>{{ $sl++ }}</td>
                                        <td>
                                            <div class="product-img">
                                                <img src="{{ asset('storage/technology') }}/{{ $cat->thumbnail }}"
                                                    alt="{{ $cat->name }}" width="60" height="60">
                                            </div>
                                        </td>
                                        <td>{{ $cat->name }}</td>
                                        <td>
                                            <div class="d-flex order-actions">
                                                <a href="javascript:void(0)"
                                                   data-id="{{ $cat->id }}"
                                                   data-name="{{ $cat->name }}"
                                                   data-image="{{ asset('storage/technology') }}/{{ $cat->thumbnail }}"
                                                   class="open-EditLangDialog act">
                                                    <i class='bx bxs-edit'></i>
                                                </a>

                                                <form method="post"
                                                    action="{{ route('admin.technology.technologyDestroy', ['id' => $cat->id]) }}">
                                                    @csrf
                                                    <button type="submit" class="act form-dlt-btn confirm-button">
                                                        <i class='bx bxs-trash'></i>
                                                    </button>
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

    <!-- Add Modal -->
    <div class="modal fade" id="categorymodel" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Technology</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data"
                        action="{{ route('admin.technology.technologyStore') }}" id="addTechnologyForm">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label for="name" class="form-label">Name <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" id="name" value="{{ old('name') }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="thumbnail" class="form-label">Thumbnail <span
                                                class="text-danger">*</span></label>
                                        <input type="file" class="form-control @error('thumbnail') is-invalid @enderror"
                                            accept="image/*" name="thumbnail" id="thumbnail">
                                        @error('thumbnail')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Accepted formats: JPG, PNG, GIF, WEBP. Max size: 2MB</div>
                                    </div>
                                </div>
                                <div class="image-preview-wrapper mt-3" id="imagePreviewContainer">
                                    <div class="preview-card">
                                        <p class="text-center mb-2 fw-semibold">Preview</p>
                                        <img id="imagePreview" class="image-preview" src=""
                                            alt="Technology image preview">
                                        <div class="preview-actions">
                                            <button type="button" class="btn btn-sm btn-outline-danger" id="removeImage">
                                                <i class="ti ti-trash me-1"></i>Remove
                                            </button>
                                        </div>
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
                    <h5 class="modal-title">Edit Technology</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data"
                        action="{{ route('admin.technology.technologyUpdate') }}" id="editTechnologyForm">
                        {{ csrf_field() }}
                        <input type="hidden" id="edit_id" name="id">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row g-3">
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
                                        <label for="edit_thumbnail" class="form-label">Thumbnail</label>
                                        <input type="file"
                                            class="form-control @error('thumbnail') is-invalid @enderror" accept="image/*"
                                            name="thumbnail" id="edit_thumbnail">
                                        @error('thumbnail')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Accepted formats: JPG, PNG, GIF, WEBP. Max size: 2MB</div>
                                    </div>
                                </div>

                                <!-- Current Image Display -->
                                <div class="current-image-wrapper mt-3" id="currentImageWrapper">
                                    <p class="mb-1 small text-muted">Current Image:</p>
                                    <img id="currentTechnologyImage" src=""
                                         class="img-fluid rounded-2"
                                         style="max-width:120px;max-height:120px;">
                                </div>

                                <!-- New Image Preview -->
                                <div class="image-preview-wrapper mt-3" id="editImagePreviewContainer">
                                    <div class="preview-card">
                                        <p class="text-center mb-2 fw-semibold">New Image Preview</p>
                                        <img id="editImagePreview" class="image-preview" src=""
                                            alt="Technology image preview">
                                        <div class="preview-actions">
                                            <button type="button" class="btn btn-sm btn-outline-danger" id="removeEditImage">
                                                <i class="ti ti-trash me-1"></i>Remove
                                            </button>
                                        </div>
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
    $(document).ready(function() {
        // Delete confirmation
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

        // Open Edit Modal
        $(document).on('click', '.open-EditLangDialog', function() {
            var id = $(this).data('id');
            var name = $(this).data('name');
            var image = $(this).data('image');

            $("#edit_id").val(id);
            $("#edit_name").val(name);

            // Show current image
            if (image) {
                $("#currentTechnologyImage").attr('src', image);
                $("#currentImageWrapper").show();
            } else {
                $("#currentImageWrapper").hide();
            }

            // Reset preview and file input
            $("#edit_thumbnail").val('');
            $("#editImagePreview").attr('src', '');
            $("#editImagePreviewContainer").hide();

            $("#categoryEditModal").modal('show');
        });

        // Show Add Modal if Validation Errors
        var myModal = new bootstrap.Modal($("#categorymodel"), {
            keyboard: false
        });
        @if ($errors->any())
            myModal.show();
        @endif

        // Initialize DataTable
        var table = $('#example2').DataTable({
            lengthChange: false,
            buttons: ['copy', 'excel', 'pdf', 'print']
        });
        table.buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');

        // ===== IMAGE PREVIEW HANDLING =====

        // --- Add Technology Image Preview ---
        $('#thumbnail').on('change', function() {
            handleImagePreview(this, '#imagePreview', '#imagePreviewContainer');
        });

        // --- Edit Technology Image Preview ---
        $('#edit_thumbnail').on('change', function() {
            handleImagePreview(this, '#editImagePreview', '#editImagePreviewContainer');
        });

        // --- Remove Image for Add Modal ---
        $('#removeImage').on('click', function() {
            $('#thumbnail').val('');
            $('#imagePreview').attr('src', '');
            $('#imagePreviewContainer').hide();
        });

        // --- Remove Image for Edit Modal ---
        $('#removeEditImage').on('click', function() {
            $('#edit_thumbnail').val('');
            $('#editImagePreview').attr('src', '');
            $('#editImagePreviewContainer').hide();
        });

        // ===== FORM SUBMISSION HANDLING =====

        // Add Technology Form
        $('#addTechnologyForm').on('submit', function(e) {
            e.preventDefault();
            var $btn = $('#catSubmitBtn');

            if ($(this)[0].checkValidity()) {
                // Set loading state
                $btn.prop('disabled', true);
                $btn.find('.spinner-border').removeClass('d-none');
                $btn.find('.btn-text').text('Please wait...');

                // Submit the form
                $(this).off('submit').submit();
            }
        });

        // Edit Technology Form
        $('#editTechnologyForm').on('submit', function(e) {
            e.preventDefault();
            var $btn = $('#catUpadteBtn');

            if ($(this)[0].checkValidity()) {
                // Set loading state
                $btn.prop('disabled', true);
                $btn.find('.spinner-border').removeClass('d-none');
                $btn.find('.btn-text').text('Please wait...');

                // Submit the form
                $(this).off('submit').submit();
            }
        });

        // Helper function for image preview
        function handleImagePreview(input, previewId, containerId) {
            const file = input.files[0];
            if (file) {
                // Validate file type
                if (!file.type.match('image.*')) {
                    alert('Please select a valid image file.');
                    $(input).val('');
                    return;
                }

                // Validate file size (2MB)
                if (file.size > 2 * 1024 * 1024) {
                    alert('Image size must be less than 2MB.');
                    $(input).val('');
                    return;
                }

                // Preview image
                const reader = new FileReader();
                reader.onload = function(e) {
                    $(previewId).attr('src', e.target.result);
                    $(containerId).show();
                };
                reader.readAsDataURL(file);
            } else {
                $(containerId).hide();
            }
        }
    });
</script>
@stop
