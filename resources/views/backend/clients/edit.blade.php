@extends('backend.layout.master')
@section('title', 'Client Edit')
@section('css_Section')
@stop
@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">

                <div class="ps-3">
                   <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item " aria-current="page"><a href="{{ route('admin.clients.clientsList') }}">Client</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Client Add </li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <a href="{{ route('admin.clients.clientsList') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
            <!--end breadcrumb-->

            <div class="card">
                <div class="card-body p-4">
                    <div class="form-body mt-4">
                        <form method="POST" action="{{ route('admin.clients.clientUpdate',['id'=>$clientData->id]) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row g-3 needs-validation" novalidate="">

                                        <div class="col-md-6">
                                            <label for="compname" class="form-label">Name <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                name="name" value="{{ $clientData->name }}">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="compname" class="form-label">Mobile No. <span
                                                    class="text-danger">*</span></label>
                                            <input type="number" class="form-control @error('mobile') is-invalid @enderror"
                                                name="mobile" value="{{ $clientData->mobile }}">
                                            @error('mobile')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="compname" class="form-label">Alternative Mobile No. </label>
                                            <input type="number"
                                                class="form-control @error('alternative_mobile') is-invalid @enderror"
                                                name="alternative_mobile" value="{{ $clientData->alternative_mobile }}">
                                            @error('alternative_mobile')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="compname" class="form-label">Email</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                name="email" value="{{ $clientData->email }}">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-6">
                                            <label for="multiple-select-custom-field" class="form-label">Status <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select @error('status') is-invalid @enderror" name="status"
                                                id="status">
                                                <option value="">Choose status...</option>
                                                <option value="1" {{ $clientData->status == 1 ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ $clientData->status == 0 ? 'selected' : '' }}>Not Active</option>

                                            </select>
                                            @error('status')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="compname" class="form-label">Date <span
                                                    class="text-danger">*</span></label>
                                            <input type="date" class="form-control @error('jdate') is-invalid @enderror"
                                                name="jdate" value="{{ $clientData->jdate }}">
                                            @error('jdate')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-12">
                                            <label for="compname" class="form-label">Description </label>
                                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ $clientData->description }}</textarea>
                                            @error('description')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="col-md-12 text-end">
                                            <button type="submit" id="submitBtn"
                                                class="btn btn-primary px-4">Update</button>

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
@stop
@section('js_section')
    <script>
        $(document).ready(function() {
            $('form').on('submit', function() {
                var $form = $(this);
                var $btn = $form.find('button[type=submit], #submitBtn').first();
                $btn.prop('disabled', true);
                $btn.find('.spinner-border').removeClass('d-none');
                // if there's a .btn-text inside the button, update it; otherwise change the text
                var $btnText = $btn.find('.btn-text');
                if ($btnText.length) {
                    $btnText.text('Please wait...');
                } else {
                    $btn.contents().filter(function() {
                        return this.nodeType === 3;
                    }).first().replaceWith(' Please wait...');
                }
            });
        });
    </script>
@endsection
