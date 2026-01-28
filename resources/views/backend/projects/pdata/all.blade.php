@extends('backend.projects.layout')

@section('tab_content')
    <div class="table-responsive">
        <table id="example2" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>SI</th>
                    <th>Project Name</th>
                    <th>Domain</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $sl = 1;
                @endphp
                @foreach ($projectData as $poj)
                    <tr>
                        <td>{{ $sl++ }}</td>
                        <td>
                            <p class="mb-0"> {{ $poj->project_name }}</p>
                            <span class="blockquote-footer"><strong>Category : </strong>{{ $poj->categoryinfo->name }}</span>
                            <br>
                            <span class="blockquote-footer"><strong>Client : </strong>{{ $poj->clientinfo->name }}</span>

                        </td>

                        <td>{{ $poj->domain }}</td>
                        <td>{{ $poj->created_at->format('d M y') }}</td>
                        <td>
                            @if ($poj->status == '1')
                                <span class="badge rounded-pill bg-success inv-badge">Completed</span>
                            @elseif ($poj->status == '2')
                                <span class="badge rounded-pill bg-secondary inv-badge">Incomplete</span>
                            @elseif ($poj->status == '3')
                                <span class="badge rounded-pill bg-info inv-badge">On Going</span>
                            @elseif ($poj->status == '4')
                                <span class="badge rounded-pill bg-warning inv-badge">Pipeline</span>
                            @elseif ($poj->status == '5')
                                <span class="badge rounded-pill bg-danger inv-badge">Rejected</span>
                            @endif
                        </td>

                        <td>
                            <div class="d-flex order-actions">
                                {{-- <a href="javascript:void(0)" class="open-EditLangDialog act"><i
                            class='bx bxs-edit '></i></a> --}}


                                <form method="post" action="{{ route('admin.projectDestroy', ['id' => $poj->id]) }}">
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
@endsection
