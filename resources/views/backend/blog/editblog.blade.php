@extends('backend.layout.master')
@section('title', ' Edit Blog')
@section('css_section')
<script src="https://cdn.tiny.cloud/1/v09k7327y2w2bb0y0g1nrjk1g3nbl2pkpixdsz7dr8e6gd4e/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
@stop
@section('content')


    <div class="page-wrapper">
        <div class="page-content">

            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">

                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item " aria-current="page"> Edit Blog</li>
                            <li class="breadcrumb-item active" aria-current="page"> {{ $blog->title }}</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <a href="{{ route('admin.blogList') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>


            <div class="card">
                <div class="card-body p-4">
                    <div class="form-body mt-4">
                        <form method="POST" enctype="multipart/form-data"
                            action="{{ route('admin.blogUpdate', ['id' => $blog->id]) }}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row g-3 needs-validation" novalidate="">

                                        <div class="col-md-6">
                                            <label for="compname" class="form-label">Title <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" value="{{ $blog->title }}"
                                                class="form-control @error('title') is-invalid @enderror" name="title">
                                            @error('title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-3">
                                            <label for="multiple-select-custom-field" class="form-label">Category <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select @error('category_id') is-invalid @enderror"
                                                name="category_id" id="category_id">
                                                <option value="">Choose Category...</option>
                                                @foreach ($catData as $cat)
                                                    <option value="{{ $cat->id }}"
                                                        @if ($blog->category_id == $cat->id) selected @endif>
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

                                        <div class="col-md-3">
                                            <label for="compname" class="form-label">Status <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select mb-4 @error('status') is-invalid @enderror"
                                                name="status">
                                                <option value="">Choose Status</option>
                                                <option value="1" {{ $blog->status == '1' ? 'selected' : '' }}>Active
                                                </option>
                                                <option value="0" {{ $blog->status == '0' ? 'selected' : '' }}>Inactive
                                                </option>
                                            </select>
                                            @error('status')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label for="compname" class="form-label">Thumbnail Photo <span
                                                    class="text-danger">*</span></label> <span class="text-danger">(width :
                                                330px, height: 260px)</span>
                                            <input type="file" accept="image/*"
                                                class="form-control @error('thumbnail_photo') is-invalid @enderror"
                                                name="thumbnail_photo">
                                            @error('thumbnail_photo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="compname" class="form-label">Photo <span
                                                    class="text-danger">*</span></label> <span class="text-danger">(width :
                                                1024px, height: 450px)</span>
                                            <input type="file" accept="image/*"
                                                class="form-control @error('photo') is-invalid @enderror" name="photo">
                                            @error('photo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label for="compname" class="form-label">Meta Tags</label>
                                            <input type="text" value="{{ $blog->meta_tags }}" class="form-control"
                                                name="meta_tags">

                                        </div>



                                        <div class="col-md-6">
                                            <label for="compname" class="form-label">Meta Description </label>
                                            <textarea name="meta_description" class="form-control" rows="4">{{ $blog->meta_description }}</textarea>

                                        </div>




                                        <div class="col-md-12">
                                            <label for="compname" class="form-label">Short Description <span
                                                    class="text-danger">*</span></label>
                                            <textarea name="short_description" class="form-control @error('short_description') is-invalid @enderror" rows="4">{{ $blog->short_description }}</textarea>
                                            @error('short_description')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="col-md-12">
                                            <label for="compname" class="form-label">Description <span
                                                    class="text-danger">*</span></label>
                                            <textarea name="description" id="tinytextarea" class="form-control @error('description') is-invalid @enderror"
                                                rows="4">{{ $blog->description }}</textarea>
                                            @error('description')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="col-md-12 text-end">
                                            <button type="submit" id="editBlogBtn"
                                                class="btn btn-primary px-4">Update</button>
                                        </div>

                                    </div>
                                </div>
                            </div><!--end row-->
                        </form>

                    </div>
                </div>
            </div>


        </div>
    </div>
    <!--end page wrapper -->

@stop
@section('js_section')


    <script>
        tinymce.init({
            selector: '#tinytextarea',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        });
    </script>

    <script>
        $(document).ready(function() {
    $("#editBlogBtn").closest("form").on("submit", function() {
        var btn = $("#editBlogBtn");
        btn.prop("disabled", true);
        btn.html(
            `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Updating...`
        );
    });
});

    </script>
@stop
