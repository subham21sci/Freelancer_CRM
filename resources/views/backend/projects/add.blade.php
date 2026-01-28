@extends('backend.layout.master')
@section('title', 'Project Add')
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

                                        <div class="col-4">
                                            <label for="multiple-select-custom-field" class="form-label">Category <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select @error('category_id') is-invalid @enderror"
                                                name="category_id" id="category_id">
                                                <option value="">Choose Category...</option>
                                                @foreach ($catData as $cat)
                                                    <option value="{{ $cat->id }}"
                                                        @if (old('category_id') == $cat->id) selected @endif>
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
                                         <div class="col-3">
                                            <label for="multiple-select-custom-field" class="form-label">Client<span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select @error('client_id') is-invalid @enderror"
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
                                        <div class="col-md-4">
                                            <label for="compname" class="form-label">Client Alternative Name </label>
                                            <input type="text"
                                                class="form-control @error('project_name') is-invalid @enderror"
                                                name="project_name">
                                            @error('project_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="compname" class="form-label">Project Name <span
                                                    class="text-danger">*</span></label>
                                            <input type="text"
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
                                            <input type="url" class="form-control @error('domain') is-invalid @enderror"
                                                name="domain">
                                            @error('domain')
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
                                                <option value="1">completed</option>
                                                <option value="2">incomplete</option>
                                                <option value="3">ongoing</option>
                                                <option value="4">pipeline</option>
                                                <option value="5">rejected</option>

                                            </select>
                                            @error('status')
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
                                            <button type="submit" class="btn btn-primary px-4">Submit</button>
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

@endsection
