<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="@yield('description')" name="description">
    <meta content="@yield('author')" name="author">
    <title>@yield('title') </title>
    <!--favicon-->
    <link rel="icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/svg" />
    <!--plugins-->
    <link href="{{ asset('assets/plugins/notifications/css/lobibox.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/Drag-And-Drop/dist/imageuploadify.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/fancy-file-uploader/fancy_fileupload.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />


    <link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap-extended.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/dark-theme.css') }}/" />
    <link rel="stylesheet" href="{{ asset('assets/css/semi-dark.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/header-colors.css') }}" />
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/v09k7327y2w2bb0y0g1nrjk1g3nbl2pkpixdsz7dr8e6gd4e/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>

    @yield('css_section')
    <style type="text/css">
        .secondary {
            color: #005ac7;
        }

        .form-dlt-btn {
            font-size: 18px;
            width: 34px;
            height: 34px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f1f1f1;
            border: 1px solid #eeecec;
            text-align: center;
            border-radius: 20%;
            color: #2b2a2a;
            margin-left: 10px;
        }
    </style>
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->


        @include('backend.includes.header')
        @include('backend.includes.sidebar')
        @yield('content')
        @include('backend.includes.footer')

        <!-- Bootstrap JS -->
        <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
        <!--plugins-->
        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
        {{-- <script src="{{ asset('assets/plugins/apexcharts-bundle/js/apexcharts.min.js')}}"></script> --}}
        <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>

        <script src="{{ asset('assets/plugins/notifications/js/lobibox.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/notifications/js/notifications.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/notifications/js/notification-custom-script.js') }}"></script>

        <script src="{{ asset('assets/plugins/validation/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/validation/validation-script.js') }}"></script>

        <script src="{{ asset('assets/plugins/input-tags/js/tagsinput.js') }}"></script>


        <script src="{{ asset('assets/js/index.js') }}"></script>
        <!--app JS-->

        <script src="{{ asset('assets/plugins/Drag-And-Drop/dist/imageuploadify.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/fancy-file-uploader/jquery.fancy-fileupload.js') }}"></script>

        <script src="{{ asset('assets/plugins/fancy-file-uploader/jquery.ui.widget.js') }}"></script>
        <script src="{{ asset('assets/plugins/fancy-file-uploader/jquery.fileupload.js') }}"></script>
        <script src="{{ asset('assets/plugins/fancy-file-uploader/jquery.iframe-transport.js') }}"></script>

        {{-- <script src="{{ asset('assets/plugins/select2/js/select2-custom.js') }}"></script>
        <script src="{{ asset('assets/js/select2.min.js') }}"></script> --}}

        <script src="{{ asset('assets/js/app.js') }}"></script>


        @yield('js_section')


        @if (Session::has('success'))
            <script>
                Lobibox.notify('success', {
                    pauseDelayOnHover: true,
                    size: 'mini',
                    rounded: true,
                    icon: 'bx bx-check-circle',
                    delayIndicator: false,
                    continueDelayOnInactiveTab: false,
                    position: 'top right',
                    msg: ' {!! Session::get('success') !!}'
                });
            </script>
        @endif

        @if (Session::has('error'))
            <script>
                Lobibox.notify('error', {
                    pauseDelayOnHover: true,
                    continueDelayOnInactiveTab: false,
                    position: 'top right',
                    icon: 'bx bx-x-circle',
                    msg: ' {!! Session::get('error') !!}'
                });
            </script>
        @endif


        <script>
            $(document).ready(function() {
                $('#image-uploadify').imageuploadify();
            })
        </script>

        <script>
            $('#fancy-file-upload').FancyFileUpload({
                params: {
                    action: 'fileuploader'
                },
                maxfilesize: 1000000
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#image-uploadify').imageuploadify();
            })
        </script>


        <script>
            $(function() {
                $('[data-bs-toggle="popover"]').popover();
                $('[data-bs-toggle="tooltip"]').tooltip();
            })
        </script>

</body>

</html>
