@extends('backend.layout.master')
@section('title', 'faqs')
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
                            <h3>Faq List</h3>
                        </div>

                        <div class="col-2">
                            <div class="ms-auto">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#faqmodel"><i class="bx bxs-plus-square"></i>Add Faq</button>
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
                                    <th>Question</th>
                                    <th>Answer</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $sl = 1;
                                @endphp
                                @foreach ($faqData as $cat)
                                    <tr>
                                        <td>{{ $sl++ }}</td>
                                        <td> {!! wordwrap(e($cat->question), 50, '<br>') !!}</td>
                                        <td>
                                            {!! wordwrap(e($cat->answer), 50, '<br>') !!}
                                        </td>

                                        <td>
                                            <div class="d-flex order-actions">

                                                <a href="javascript:void(0)" data-id="{{ $cat->id }}"
                                                    data-question="{{ $cat->question }}" data-answer="{{ $cat->answer }}"
                                                    class="open-EditLangDialog act"><i class='bx bxs-edit '></i></a>
                                                <form method="post"
                                                    action="{{ route('admin.faqDestroy', ['id' => $cat->id]) }}">
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
    <div class="modal fade" id="faqmodel" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add faq</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('admin.faqStore') }}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-12">

                                <div class="row g-1">
                                    <div class="col-12">
                                        <label for="compname" class="form-label">Question <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('question') is-invalid @enderror"
                                            name="question" value="{{ old('question') }}">
                                        @error('question')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="input11" class="form-label mt-2">Answer </label>
                                        <textarea class="form-control @error('answer') is-invalid @enderror" name="answer" id="input11"
                                            placeholder="answer..." rows="3"></textarea>
                                        @error('answer')
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
    <!--Edit Modal -->
    <div class="modal fade" id="Editfaqmodel" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit faq</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('admin.faqUpdate') }}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-12">
                                <input type="hidden" id="edit_id" name="faqid">
                                <div class="row g-1">
                                    <div class="col-12">
                                        <label for="compname" class="form-label">Question <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('question') is-invalid @enderror"
                                            name="question" id="edit_question" required>
                                        @error('question')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="input11" class="form-label mt-2">Answer <span
                                                class="text-danger">*</span></label>
                                        <textarea class="form-control @error('answer') is-invalid @enderror" name="answer" id="edit_answer" required
                                            placeholder="answer..." rows="3"></textarea>
                                        @error('answer')
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
                var question = $(this).data('question');
                var answer = $(this).data('answer');

                $("#edit_id").val(id);
                $("#edit_question").val(question);
                $("#edit_answer").val(answer);

                $("#Editfaqmodel").modal('show')

            });

        });


        $(document).ready(function() {
            $('#example').DataTable();
        });

        var myModal = new bootstrap.Modal($("#faqmodel"), {
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
