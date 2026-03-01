@extends('backend.layout.master')
@section('title', 'Project Add')
@section('css_section')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>

        .select2-container--default .select2-selection--multiple {
            min-height: 38px;
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
            padding: 0.375rem 0.75rem;
            background-color: #fff;
        }
        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #0d6efd;
            border: 1px solid #0d6efd;
            color: #fff;
            border-radius: 0.25rem;
            padding: 0 8px;
            margin-top: 4px;
            height: 24px;
            line-height: 22px;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: #fff;
            margin-right: 6px;
        }

        .select2-container .select2-search--inline .select2-search__field {
            margin-top: 4px;
            height: 24px;
        }

        .select2-container {
            width: 100% !important;
        }

        .is-invalid + .select2-container .select2-selection {
    border-color: #dc3545 !important;
}

.is-invalid + .select2-container--focus .select2-selection {
    box-shadow: 0 0 0 0.25rem rgba(220,53,69,.25) !important;
}

    </style>
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
                            <li class="breadcrumb-item " aria-current="page"><a href="#">Project</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Project Add </li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <a href="{{ route('admin.projects.all') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
            <!--end breadcrumb-->

            <div class="card">
                <div class="card-body p-4">
                    <div class="form-body mt-4">
                        <form method="POST" action="{{ route('admin.projectStore') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row g-3 needs-validation" novalidate="">

                                        <div class="col-6">
                                            <label for="category_id" class="form-label">
                                                Category <span class="text-danger">*</span>
                                            </label>
                                            <select
                                                class="form-select cat_select_single @error('category_id') is-invalid @enderror"
                                                name="category_id" id="category_id">
                                                <option value="">Choose Category...</option>
                                                @foreach ($catData as $cat)
                                                    <option value="{{ $cat->id }}"
                                                        {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                                        {{ $cat->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>



                                        <div class="col-5">
                                            <label for="client_id" class="form-label">Client<span
                                                    class="text-danger">*</span></label>
                                            <select
                                                class="form-select client_select_single @error('client_id') is-invalid @enderror"
                                                name="client_id" id="client_id">
                                                <option value="">Choose Client...</option>
                                                @foreach ($clientData as $cli)
                                                    <option value="{{ $cli->id }}"
                                                        @if (old('client_id') == $cli->id) selected @endif>
                                                        {{ $cli->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('client_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-1 d-flex align-items-end">
                                            <div class="">
                                                <a href="{{ route('admin.clients.addClient') }}"
                                                    class="btn btn-outline-info"><i class="bx bx-plus me-0"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label for="tags-select" class="form-label">Tags</label>
                                            <select
                                                class="tags-select2-multiple form-select @error('tags') is-invalid @enderror"
                                                name="tags[]" id="tags-select" multiple="multiple">
                                                @foreach ($tagData as $tags)
                                                    <option value="{{ $tags->id }}"
                                                        {{ collect(old('tags', []))->contains($tags->id) ? 'selected' : '' }}>
                                                        {{ $tags->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('tags')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="compname" class="form-label">Project Name <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" value="{{ old('project_name') }}"
                                                class="form-control @error('project_name') is-invalid @enderror"
                                                name="project_name">
                                            @error('project_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="compname" class="form-label">Domain / URL</label>
                                            <input type="url" value="{{ old('domain') }}" class="form-control @error('domain') is-invalid @enderror"
                                                name="domain">
                                            @error('domain')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-3">
                                            <label for="multiple-select-custom-field" class="form-label">Status <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select @error('status') is-invalid @enderror" name="status"
                                                id="status">
                                                <option value="">Choose status...</option>
                                                <option value="pipeline" {{ old('status') == 'pipeline' ? 'selected' : '' }}>Pipeline</option>
                                                <option value="ongoing" {{ old('status') == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                                                <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                                <option value="maintenance" {{ old('status') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                                                <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                            </select>
                                            @error('status')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <label for="compname" class="form-label">Start Date <span
                                                    class="text-danger">*</span></label>
                                            <input type="date" value="{{ old('start_date') }}" class="form-control @error('start_date') is-invalid @enderror"
                                                name="start_date">
                                            @error('start_date')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-12">
                                            <label for="compname" class="form-label">Description </label>
                                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description') }}</textarea>
                                            @error('description')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="col-md-12 text-end">
                                             <button class="btn btn-primary" type="submit" id="submitBtn">
                                                <span class="spinner-border spinner-border-sm me-2 d-none" role="status"
                                                    aria-hidden="true"></span>
                                                <span class="btn-text">Submit</span>
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
@stop
@section('js_section')

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
           $('.cat_select_single, .client_select_single').select2({
    minimumResultsForSearch: 5,
    width: '100%'
});


            $('.tags-select2-multiple').select2({
                placeholder: "Select Tags",
                width: '100%'
            });

        });
$('#submitBtn').closest('form').on('submit', function(e) {
            e.preventDefault();

            var $btn = $('#submitBtn');

            if ($(this)[0].checkValidity()) {
                $btn.prop('disabled', true);
                $btn.find('.spinner-border').removeClass('d-none');
                $btn.find('.btn-text').text('Please wait...');

                $(this).off('submit').submit();
            }
        });

    </script>
@endsection
