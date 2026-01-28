@extends('backend.layout.master')
@section('title', 'Projects')
@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-10">
                        <h3>Projects List</h3>
                    </div>
                    <div class="col-2">
                        <a href="{{ route('admin.addProject') }}" class="btn btn-primary">
                            <i class="bx bxs-plus-square"></i>Add Project
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <ul class="nav nav-tabs nav-primary mb-3">
                    @php
                        $current = Route::currentRouteName();
                    @endphp
                    <li class="nav-item"><a class="nav-link {{ $current == 'admin.projects.all' ? 'active' : '' }}" href="{{ route('admin.projects.all') }}">All</a></li>
                    <li class="nav-item"><a class="nav-link {{ $current == 'admin.projects.completed' ? 'active' : '' }}" href="{{ route('admin.projects.completed') }}">Completed</a></li>
                    <li class="nav-item"><a class="nav-link {{ $current == 'admin.projects.incomplete' ? 'active' : '' }}" href="{{ route('admin.projects.incomplete') }}">Incomplete</a></li>
                    <li class="nav-item"><a class="nav-link {{ $current == 'admin.projects.ongoing' ? 'active' : '' }}" href="{{ route('admin.projects.ongoing') }}">Ongoing</a></li>
                    <li class="nav-item"><a class="nav-link {{ $current == 'admin.projects.pipeline' ? 'active' : '' }}" href="{{ route('admin.projects.pipeline') }}">Pipeline</a></li>
                    <li class="nav-item"><a class="nav-link {{ $current == 'admin.projects.rejected' ? 'active' : '' }}" href="{{ route('admin.projects.rejected') }}">Rejected</a></li>
                    <li class="nav-item"><a class="nav-link" href="">Maintenance </a></li>
                </ul>

                {{-- Yield specific tab content --}}
                @yield('tab_content')

            </div>
        </div>

    </div>
</div>

@endsection
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
