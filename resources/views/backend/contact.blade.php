@extends('backend.layout.master')
@section('title', 'Contact')
@section('css_Section')
@stop
@section('content')

    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">

                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Contact </li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">

                    </div>
                </div>
            </div>
            <!--end breadcrumb-->

            <div class="card">
                <div class="card-body p-4">
                    <div class="form-body mt-4">
                        <form method="POST" enctype="multipart/form-data"
                            action="{{route('admin.contactstore')}}">
                           @csrf
                            <div class="row">
                                <div class="col-lg-12">

                                    <div class="row g-3 needs-validation" novalidate="">

                                        <div class="col-md-4">
                                            <label for="compname" class="form-label">Mobile <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" value="{{$contData->mobile}}" class="form-control" name="mobile">
                                        </div>



                                        <div class="col-md-4">
                                            <label for="compname" class="form-label">Mobile 2 </label>
                                            <input type="text" value="{{$contData->mobile_second}}" class="form-control" name="mobile_second">
                                        </div>

                                        <div class="col-md-4">
                                            <label for="compname" class="form-label">Email <span
                                                    class="text-danger">*</span></label>
                                            <input type="email" value="{{$contData->email}}" class="form-control" name="email">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="compname" class="form-label">Address <span
                                                    class="text-danger">*</span></label>

                                            <textarea name="address" class="form-control" id="" cols="30" rows="3">{{$contData->address}}</textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="compname" class="form-label">Open and Close Time/Day <span
                                                    class="text-danger">*</span></label>

                                                    <input type="text" value="{{$contData->open_time}}" class="form-control" name="open_time">
                                        </div>




                                        <div class="col-md-12 text-end">

                                            <button type="submit" class="btn btn-primary px-4">Update</button>

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

@stop
