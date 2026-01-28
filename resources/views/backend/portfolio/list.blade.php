@extends('backend.layout.master')
@section('title', 'Portfolio')
@section('css_Section')
@stop
@section('content')

<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">

        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-10">
                        <h3>Portfolio List</h3>
                    </div>

                    <div class="col-2">
                        <div class="ms-auto">
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#gallerymodel"><i class="bx bxs-plus-square"></i>Add Portfolio</button>
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
                                <th>Category</th>
                                <th>Photo</th>
                                <th>URL</th>

                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $sl = 1;
                            @endphp
                            @foreach ($galleryData as $gal)
                                <tr>
                                    <td>{{ $sl++ }}</td>
                                    <td>{{ $gal->name }}</td>
                                    <td>{{ $gal->categoryinfo->name }}</td>
                                    <td>{{ $gal->url }}</td>
                                    <td>
                                        <div class="product-img">

                                            <img src="{{asset('storage/portfolio')}}/{{$gal->photo}}" alt="">
                                        </div>
                                    </td>


                                    <td>
                                        <div class="d-flex order-actions">

                                            <form method="post"
                                                action="{{ route('admin.galDestroy', ['id' => $gal->id]) }}">
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
<div class="modal fade" id="gallerymodel" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Portfolio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" action="{{ route('admin.gallStore') }}">
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
                                <div class="col-12">
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
                                <div class="col-12">
                                    <label for="url" class="form-label">URL <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('url') is-invalid @enderror"
                                        name="url" value="{{ old('url') }}">
                                    @error('url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="img" class="form-label mt-2">Photo <span
                                        class="text-danger">*</span></label><span class="text-danger">(width : 600px, height: 730px)</span>
                                    <input type="file" class="form-control @error('photo') is-invalid @enderror"
                                        accept="image/*" name="photo" id="img">
                                    @error('photo')
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
        $('#example').DataTable();
    });

    var myModal = new bootstrap.Modal($("#gallerymodel"), {
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
             buttons: [ 'copy', 'excel', 'pdf', 'print']
        });

        table.buttons().container()
            .appendTo('#example2_wrapper .col-md-6:eq(0)');
    });
</script>
@stop
