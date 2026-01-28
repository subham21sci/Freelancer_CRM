@extends('backend.layout.master')
@section('title', 'Clients')
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
                            <h3>Filter Clients</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row align-items-center">
                        <form class="row" method="GET" action="{{ route('admin.clients.clientsList') }}">
                            <div class="col-md-5">
                                <label for="input1" class="form-label">Date</label>
                                <input type="date" class="form-control" id="input1" name="date"
                                    value="{{ request('date') }}">
                            </div>
                            <div class="col-md-4">
                                <label for="input9" class="form-label">Status</label>
                                <select class="form-control form-select" id="statusType" name="status">
                                    <option value="all" @if (request('status') == 'all') selected @endif>All</option>
                                    <option value="1" @if (request('status') == '1') selected @endif>Active</option>
                                    <option value="0" @if (request('status') == '0') selected @endif>Non Active
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-3 mt-4">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="submit" class="btn btn-primary px-4">Submit</button>

                                    <a href="{{ route('admin.clients.clientsList') }}" class="btn btn-secondary">Reset</a>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-10">
                            <h3>Clients List</h3>
                        </div>

                        <div class="col-2">
                            <div class="ms-auto">
                                <div class="btn-group">
                                    <a href="{{ route('admin.clients.addClient') }}" class="btn btn-primary"><i
                                            class="bx bxs-plus-square"></i>Add Client</a>
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
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $sl = 1;
                                @endphp
                                @foreach ($clientData as $cat)
                                    <tr>
                                        <td>{{ $sl++ }}</td>
                                        <td>{{ $cat->name }}</td>
                                        <td>{{ $cat->mobile }} | {{ $cat->alternative_mobile }}</td>
                                        <td>{{ $cat->email }}</td>
                                        <td>{{ date('d M y', strtotime($cat->jdate)) }}</td>

                                        <td>
                                            @if ($cat->status == '1')
                                                <span class="badge rounded-pill bg-success inv-badge">Active</span>
                                            @else
                                                <span class="badge rounded-pill bg-danger inv-badge">Not Active</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex order-actions">
                                                <a href="{{ route('admin.clients.clientEdit', ['id' => $cat->id]) }}"
                                                    class="act"><i class='bx bxs-edit '></i></a>

                                                <form method="post"
                                                    action="{{ route('admin.clients.clientDestroy', ['id' => $cat->id]) }}">
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
