@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header border-0 pt-6">
        <div class="card-title">
            <h2>Document Details</h2>
        </div>
        <div class="card-toolbar">
            @if($document->status === 'draft')
            <form action="{{ route('admin.documents.publish', $document->id) }}" method="POST" class="me-3">
                @csrf
                <button type="submit" class="btn btn-success">Publish</button>
            </form>
            <a href="{{ route('admin.documents.edit', $document->id) }}" class="btn btn-primary me-3">Edit</a>
            @endif
            <a href="{{ route('admin.documents.index') }}" class="btn btn-light">Back</a>
        </div>
    </div>
    <div class="card-body py-4">
        <div class="row mb-7">
            <div class="col-lg-4">
                <div class="fw-bold">ID</div>
                <div>{{ $document->id }}</div>
            </div>
            <div class="col-lg-4">
                <div class="fw-bold">Status</div>
                <div>
                    <span class="badge badge-{{ $document->status === 'published' ? 'success' : 'warning' }}">
                        {{ $document->status }}
                    </span>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="fw-bold">Created At</div>
                <div>{{ $document->created_at }}</div>
            </div>
        </div>
        <div class="row mb-7">
            <div class="col-lg-12">
                <div class="fw-bold">Payload</div>
                <pre class="bg-light p-4 rounded"><code>{{ json_encode($document->payload, JSON_PRETTY_PRINT) }}</code></pre>
            </div>
        </div>
    </div>
</div>
@endsection