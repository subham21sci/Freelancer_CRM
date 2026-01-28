@extends('backend.layout.master')
@section('title', 'Blog')
@section('css_section')
@stop
@section('content')

    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">

            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-10">
                            <h3>Blog List</h3>
                        </div>

                        <div class="col-2">
                            <div class="ms-auto">
                                <div class="btn-group">
                                    <a href="{{ route('admin.blogCreate') }}" class="btn btn-primary">
                                        <i class="bx bxs-plus-square"></i> Add New
                                    </a>
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
                                    <th>S/N</th>
                                    <th>Image</th>
                                    <th>Category</th>
                                    <th> Title</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $sl = 1; ?>
                                @foreach ($blogData as $b)
                                    <tr class="odd gradeX">
                                        <td>
                                            {{ $sl++ }}
                                        </td>
                                        <td>
                                            <div class="product-img">
                                                <img src="{{ asset('storage/blog') }}/{{ $b->thumbnail_photo }}"
                                                    alt="">
                                            </div>
                                        </td>
                                        <td class="left">
                                            {{ $b->category_id ? $b->categoryinfo->name : '' }}
                                        </td>
                                        <td class="left">
                                            {!! nl2br(Str::wordwrap($b->title, 40, "\n", true)) !!}
                                        </td>
                                        <td class="left">{{ $b->updated_at->format('d M y') }}</td>
                                        <td class="left">
                                            @if ($b->status == 1)
                                                <span class="badge rounded-pill bg-success inv-badge">Active</span>
                                            @else
                                                <span class="badge rounded-pill bg-danger inv-badge">Inactive</span>
                                            @endif
                                        </td>
                                        <td>

                                            <div class="d-flex order-actions">
                                                <a href="{{ route('admin.blogEdit', ['id' => $b->id]) }}" class="">
                                                    <i class='bx bxs-edit'></i>
                                                </a>

                                                <form method="post"
                                                    action="{{ route('admin.blogDestroy', ['id' => $b->id]) }}">
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

@stop
@section('js_section')
    {{-- @if ($message = Session::get('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '{{ $message }}',
                showConfirmButton: false,
                timer: 2500
            })
        </script>
    @endif --}}
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
                buttons: ['copy', 'excel', 'pdf', 'print']
            });

            table.buttons().container()
                .appendTo('#example2_wrapper .col-md-6:eq(0)');
        });
    </script>
@stop
