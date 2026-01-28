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
                <div class="breadcrumb-title pe-3">User Profile</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Profile</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="container">
                <div class="main-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-column align-items-center text-center">

                                        @if ($adminData->profile_photo_path)
                                            <img src="{{ asset('storage/admin') }}/{{ $adminData->profile_photo_path }}"
                                                alt="Profile Image" class="rounded-circle img-thumbnail"
                                                style="width: 120px; height: 120px; object-fit: cover;">
                                        @else
                                            <div class="rounded-circle bg-light border d-flex align-items-center justify-content-center"
                                                style="width: 120px; height: 120px;">
                                                <i class="fas fa-user fa-3x text-muted"></i>
                                            </div>
                                        @endif
                                        <div class="mt-3">
                                            <h4>{{ $adminData->name }}</h4>
                                            <p class="text-secondary mb-1">{{ $adminData->email }}</p>
                                            <p class="text-secondary mb-1">{{ $adminData->phone }}</p>
                                            <p class="text-muted font-size-sm">{{ $adminData->address }}</p>

                                        </div>
                                    </div>
                                    <hr class="my-4" />
                                    <ul class="list-group list-group-flush">
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <h6 class="mb-0">State</h6>
                                            <span class="text-secondary">{{ $adminData->state }}</span>
                                        </li>
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <h6 class="mb-0">City</h6>
                                            <span class="text-secondary">{{ $adminData->city }}</span>
                                        </li>
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <h6 class="mb-0">ZIP/Postal Code</h6>
                                            <span class="text-secondary">{{ $adminData->zip_code }}</span>
                                        </li>
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <h6 class="mb-0">Date of Birth</h6>
                                            <span class="text-secondary">{{ $adminData->date_of_birth }}</span>
                                        </li>
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <h6 class="mb-0">Gender</h6>
                                            <span class="text-secondary">{{ $adminData->gender }}</span>
                                        </li>
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <h6 class="mb-0">Bio</h6>
                                            <span class="text-secondary">{{ $adminData->bio }}</span>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body p-4">
                                    <div class="form-body mt-4">
                                        <form method="POST" enctype="multipart/form-data"
                                            action="{{ route('admin.profileStore') }}">
                                            @csrf
                                            <div class="row">

                                                <div class="col-lg-12 mb-3">
                                                    <label for="profile_image" class="form-label">Upload Profile
                                                        Image</label>
                                                    <input type="file" class="form-control" name="profile_image"
                                                        accept="image/*">
                                                    <small class="text-muted">Accepts JPG, PNG, GIF (Max: 2MB)</small>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="row g-3 needs-validation" novalidate="">
                                                        <!-- Basic Information -->
                                                        <div class="col-md-6">
                                                            <label for="name" class="form-label">Full Name <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" value="{{ $adminData->name }}"
                                                                class="form-control" name="name" required>
                                                            <div class="invalid-feedback">Please enter your full name.</div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label for="mobile" class="form-label">Mobile Number <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" value="{{ $adminData->phone }}"
                                                                class="form-control" name="phone" required>
                                                            <div class="invalid-feedback">Please enter your mobile number.
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label for="email" class="form-label">Email Address <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="email" value="{{ $adminData->email }}"
                                                                class="form-control" name="email" disabled required>
                                                            <div class="invalid-feedback">Please enter a valid email
                                                                address.</div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label for="gender" class="form-label">Gender</label>
                                                            <select name="gender" class="form-select">
                                                                <option value="">Select Gender</option>
                                                                <option value="male"
                                                                    {{ ($adminData->gender ?? '') == 'male' ? 'selected' : '' }}>
                                                                    Male
                                                                </option>
                                                                <option value="female"
                                                                    {{ ($adminData->gender ?? '') == 'female' ? 'selected' : '' }}>
                                                                    Female
                                                                </option>
                                                                <option value="other"
                                                                    {{ ($adminData->gender ?? '') == 'other' ? 'selected' : '' }}>
                                                                    Other
                                                                </option>
                                                            </select>
                                                        </div>

                                                        <!-- Address Information -->
                                                        <div class="col-md-12">
                                                            <label for="address" class="form-label">Address <span
                                                                    class="text-danger">*</span></label>
                                                            <textarea name="address" class="form-control" rows="3" required>{{ $adminData->address }}</textarea>
                                                            <div class="invalid-feedback">Please enter your address.</div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label for="city" class="form-label">City</label>
                                                            <input type="text" value="{{ $adminData->city ?? '' }}"
                                                                class="form-control" name="city">
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label for="state" class="form-label">State</label>
                                                            <input type="text" value="{{ $adminData->state ?? '' }}"
                                                                class="form-control" name="state">
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label for="zip_code" class="form-label">ZIP/Postal
                                                                Code</label>
                                                            <input type="text"
                                                                value="{{ $adminData->zip_code ?? '' }}"
                                                                class="form-control" name="zip_code">
                                                        </div>


                                                        <!-- Additional Information -->
                                                        <div class="col-md-6">
                                                            <label for="date_of_birth" class="form-label">Date of
                                                                Birth</label>
                                                            <input type="date"
                                                                value="{{ $adminData->date_of_birth ?? '' }}"
                                                                class="form-control" name="date_of_birth">
                                                        </div>



                                                        <div class="col-md-12">
                                                            <label for="bio"
                                                                class="form-label">Bio/Description</label>
                                                            <textarea name="bio" class="form-control" rows="3" placeholder="Tell us about yourself...">{{ $adminData->bio ?? '' }}</textarea>
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
        // Form validation
        (function() {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })()



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
