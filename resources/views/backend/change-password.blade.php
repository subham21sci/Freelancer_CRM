@extends('backend.layout.master')
@section('title', 'profile ')
@section('css_Section')
    <style>
        .profile-image-container img {
            border: 3px solid #dee2e6;
            transition: border-color 0.3s ease;
        }

        .profile-image-container img:hover {
            border-color: #0d6efd;
        }
    </style>
@stop
@section('content')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">User Change Password</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Change Password</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="container">
                <div class="main-body">
                    <div class="row">

                        <div class="col-lg-10 offset-lg-1">
                            <div class="card">
                                <div class="card-body p-4">
                                    <div class="form-body mt-4">
                                        <form method="POST" action="{{ route('admin.changePasswordupdate') }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="row g-3 needs-validation" novalidate="">
                                                        <div class="row mb-3">
                                                            <label for="old_password" class="col-3 col-form-label">Old
                                                                Password <span class="text-danger">*</span></label>
                                                            <div class="col-9">
                                                                <input type="password" name="old_password"
                                                                    class="form-control" id="old_password"
                                                                    placeholder="Old Password">
                                                                @error('old_password')
                                                                    <span class="text-danger small">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>


                                                        <div class="row mb-3">
                                                            <label for="new_password" class="col-3 col-form-label">New
                                                                Password <span class="text-danger">*</span></label>
                                                            <div class="col-9">
                                                                <input type="password" name="new_password"
                                                                    class="form-control" id="new_password"
                                                                    placeholder="New Password">
                                                                @error('new_password')
                                                                    <span class="text-danger small">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>


                                                        <div class="row mb-3">
                                                            <label for="new_password_confirmation"
                                                                class="col-3 col-form-label">Re-type Password <span
                                                                    class="text-danger">*</span></label>
                                                            <div class="col-9">
                                                                <input type="password" name="new_password_confirmation"
                                                                    class="form-control" id="new_password_confirmation"
                                                                    placeholder="Confirm Password">
                                                            </div>
                                                        </div>


                                                        <div class="col-md-12 text-end">
                                                            <button type="submit" id="submitBtnAddress"
                                                                class="btn btn-primary px-4">
                                                                <span class="spinner-border spinner-border-sm d-none me-2"
                                                                    role="status"></span>
                                                                <span class="btn-text">
                                                                    <i class="fas fa-save me-2"></i>Update Profile
                                                                </span>
                                                            </button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>


                            </div>


                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--end page wrapper -->

@stop
@section('js_section')
    <script>
        $(document).ready(function() {
            $('form').on('submit', function() {
                var $form = $(this);
                var $btn = $form.find('#submitBtnAddress');

                $btn.prop('disabled', true);
                $btn.find('.spinner-border').removeClass('d-none');
                $btn.find('.btn-text').text('Please wait...');
            });
        });
    </script>
@stop
