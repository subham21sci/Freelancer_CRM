@extends('backend.layout.master')
@section('title', 'Category')
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
                        <h3>Category List</h3>
                    </div>

                    <div class="col-2">
                        <div class="ms-auto">
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#categorymodel"><i class="bx bxs-plus-square"></i>Add Category</button>
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
                            @foreach ($category_list as $cat)
                                <tr>
                                    <td>{{ $sl++ }}</td>
                                    <td>{{ $cat->name }}</td>
                                    {{-- <td>

                                        <div class="product-img">

                                            <img src="{{asset('storage/category')}}/{{$cat->thumbnail}}" alt="">
                                        </div>
                                    </td>
                                    <td>{{ $cat->discription }}</td> --}}

                                    <td>
                                        <div class="d-flex order-actions">
                                            <a href="javascript:void(0)"  data-id="{{$cat->id}}" data-name="{{$cat->name}}" data-discription="{{$cat->discription}}" class="open-EditLangDialog act"><i
                                                class='bx bxs-edit '></i></a>

                                            <form method="post"
                                                action="{{ route('admin.catDestroy', ['id' => $cat->id]) }}">
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
                <h5 class="modal-title">Add Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" action="{{ route('admin.catStore') }}">
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
                                    <label for="img" class="form-label mt-2">Thumbnail</label>
                                    <input type="file" class="form-control @error('thumbnail') is-invalid @enderror"
                                        accept="image/*" name="thumbnail" id="img">
                                    @error('thumbnail')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="discription" class="form-label mt-2">Discription <span
                                            class="text-danger">*</span></label>
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
                <h5 class="modal-title">Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" action="{{route('admin.catUpdate')}}">
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
                                <div class="col-12">
                                    <label for="img" class="form-label mt-2">Thumbnail</label>
                                    <input type="file" class="form-control @error('thumbnail') is-invalid @enderror"
                                        accept="image/*" name="thumbnail" id="img">
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

    var myModal = new bootstrap.Modal($("#categorymodel"), {
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
