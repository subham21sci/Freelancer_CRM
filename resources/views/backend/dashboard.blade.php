@extends('backend.layout.master')
@section('title', 'Dashboard')
@section('css_Section')
@stop
@section('content')

    <div class="page-wrapper">
        <div class="page-content">
            <h3>{{ Auth::user()->name }}</h3>
            <hr />
            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
                <a href="#">
                    <div class="col">
                        <div class="card radius-10 border-primary border-bottom border-3 border-0">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-secondary">Total Project</p>
                                        <h4 class="my-1">00</h4>
                                    </div>
                                    <div class="text-primary ms-auto font-35"><i class='bx bx-user'></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="#">
                    <div class="col">
                        <div class="card radius-10 border-danger border-bottom border-3 border-0">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-secondary">Total Clients</p>
                                        <h4 class="my-1">00</h4>
                                    </div>
                                    <div class="text-danger ms-auto font-35"><i class='fadeIn animated bx bx-buildings'></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="#">
                    <div class="col">
                        <div class="card radius-10 border-success border-bottom border-3 border-0">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-secondary"> Total Amount</p>
                                        <h4 class="my-1">00</h4>
                                    </div>
                                    <div class="text-success ms-auto font-35"><i class='bx bxs-group'></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="#">
                    <div class="col">
                        <div class="card radius-10 border-warning border-bottom border-3 border-0">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-secondary">Total Due Payment </p>
                                        <h4 class="my-1">00</h4>
                                    </div>
                                    <div class="text-warning ms-auto font-35"><i class='bx bx-cart font-30'></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>


        </div>
    </div>

@stop
@section('js_section')

@stop
