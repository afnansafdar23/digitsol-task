@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header border-0 pt-6">
        <div class="card-title">
            <h2>Documents</h2>
        </div>
        <div class="card-toolbar">
            <div class="d-flex justify-content-end">
                <a href="{{ route('admin.documents.create') }}" class="btn btn-primary">
                    <span class="svg-icon svg-icon-2">
                        <i class="fas fa-plus"></i>
                    </span>
                    Create Document
                </a>
            </div>
        </div>
    </div>
    <div class="card-body py-4">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if(session('message'))
        <div class="alert alert-info">
            {{ session('message') }}
        </div>
        @endif
        <div class="table-responsive">
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="documents_table">
                <thead>
                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                        <th>ID</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Modified At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 fw-semibold">
                    @foreach($documents as $document)
                    <tr>
                        <td>{{ $document->id }}</td>
                        <td>
                            <span class="badge badge-{{ $document->status === 'published' ? 'success' : 'warning' }}">
                                {{ $document->status }}
                            </span>
                        </td>
                        <td>{{ $document->created_at->format('Y-m-d H:i:s') }}</td>
                        <td>{{ $document->updated_at->format('Y-m-d H:i:s') }}</td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('admin.documents.show', $document->id) }}" 
                                   class="btn btn-sm btn-light btn-active-light-info me-2">View</a>
                                @if($document->status !== 'published')
                                    <a href="{{ route('admin.documents.edit', $document->id) }}" 
                                       class="btn btn-sm btn-light btn-active-light-primary me-2">Edit</a>
                                    <form action="{{ route('admin.documents.publish', $document->id) }}" method="POST" class="me-2">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-light btn-active-light-primary">Publish</button>
                                    </form>
                                @endif
                                <form action="{{ route('admin.documents.destroy', $document->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-light btn-active-light-danger">Delete</button>
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
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#documents_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.documents.index') }}",
            columns: [{
                    data: 'id'
                },
                {
                    data: 'status',
                    render: function(data) {
                        return `<span class="badge badge-${data === 'published' ? 'success' : 'warning'}">${data}</span>`;
                    }
                },
                {
                    data: 'created_at'
                },
                {
                    data: 'modified_at'
                },
                {
                    data: 'actions',
                    orderable: false,
                    searchable: false
                }
            ]
        });
    });
</script>
@endpush