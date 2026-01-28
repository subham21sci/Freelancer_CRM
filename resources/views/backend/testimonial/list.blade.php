@extends('backend.layout.master')
@section('title', 'testimonials')
@section('css_Section')
@stop
@section('content')

<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">

        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-9">
                        <h3>Testimonial List</h3>
                    </div>

                    <div class="col-3">
                        <div class="ms-auto">
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#testimonialmodel"><i class="bx bxs-plus-square"></i>Add testimonial</button>
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
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Designation</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $sl = 1;
                            @endphp
                            @foreach ($testimonialData as $testimonial)
                                <tr>
                                    <td>{{ $sl++ }}</td>
                                    <td>

                                        <div class="product-img">

                                            <img src="{{asset('storage/testimonial')}}/{{$testimonial->photo}}" alt="">
                                        </div>
                                    </td>
                                    <td>{{ $testimonial->name }}</td>
                                    <td>
                                           {{$testimonial->designation}}
                                    </td>
                                    <td>
                                          {{-- {{Str::limit($testimonial->description, 30)}} --}}
                                          {!! wordwrap(e($testimonial->description), 50, '<br>') !!}
                                    </td>

                                    <td>
                                        <div class="d-flex order-actions">
                                            <a href="javascript:void(0)" data-id="{{ $testimonial->id }}" data-name="{{ $testimonial->name }}"
                                                data-designation="{{ $testimonial->designation }}" data-description="{{ $testimonial->description }}" class="open-EditTestimonialDialog act">
                                                 <i class='bx bxs-edit'></i>
                                             </a>

                                            <form method="post"
                                                action="{{ route('admin.testimonialDestroy', ['id' => $testimonial->id]) }}">
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
<div class="modal fade" id="testimonialmodel" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add testimonial</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" action="{{ route('admin.testimonialStore') }}">
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
                                    <label for="compname" class="form-label">Designation <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('designation') is-invalid @enderror"
                                        name="designation" value="{{ old('designation') }}">
                                    @error('designation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="img" class="form-label mt-2">Photo <span
                                        class="text-danger">*</span></label><span class="text-danger">(width : 80, height: 80)</span>
                                    <input type="file" class="form-control @error('photo') is-invalid @enderror"
                                        accept="image/*" name="photo" id="img">
                                    @error('photo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="input11" class="form-label mt-2">Description <span
                                        class="text-danger">*</span></label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="input11" placeholder="description..." rows="3"></textarea>
                                    @error('description')
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
<!-- Edit Testimonial Modal -->
<div class="modal fade" id="testimonialEditModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Testimonial</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" action="{{ route('admin.testimonialUpdate') }}">
                    @csrf
                    <input type="hidden" id="edit_id" name="id">
                    <div class="mb-3">
                        <label class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>

                    </div>
                    <div class="mb-3">
                        <label class="form-label">Designation <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_designation" name="designation" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Photo</label> <span class="text-danger">(width : 80, height: 80)</span>
                        <input type="file" class="form-control" accept="image/*" name="photo">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description <span class="text-danger">*</span></label>
                        <textarea name="description" class="form-control" id="edit_description" rows="3" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
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

    $(document).on('click', '.open-EditTestimonialDialog', function() {
        $('#edit_id').val($(this).data('id'));
        $('#edit_name').val($(this).data('name'));
        $('#edit_designation').val($(this).data('designation'));
        $('#edit_description').val($(this).data('description'));
        $('#testimonialEditModal').modal('show');
    });

    $(document).ready(function() {
        $('#example').DataTable();
    });

    var myModal = new bootstrap.Modal($("#testimonialmodel"), {
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
