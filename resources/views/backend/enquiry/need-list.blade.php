@extends('backend.layout.master')
@section('title', 'Need Post')
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
                            <h3>Need Post List</h3>
                        </div>


                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example2" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>SI</th>
                                    <th>Company</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $sl = 1;
                                @endphp
                                @foreach ($postList as $item)
                                    <tr>
                                        <td>{{ $sl++ }}</td>
                                        <td>{{ $item->company_name }}</td>
                                        <td>{{ $item->full_name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->mobile_no }}</td>

                                        <td>
                                            <div class="d-flex order-actions">
                                                {{-- <a href="javascript:void(0)" class=''>
                                                    <i class='bx bxs-trash'></i>

                                                </a> --}}

                                                <form method="post"
                                                    action="{{ route('admin.postNeedDestroy', ['id' => $item->id]) }}">
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
