@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header border-0 pt-6">
        <div class="card-title">
            <h2>{{ isset($document) ? 'Edit Document' : 'Create Document' }}</h2>
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

        <form id="document_form" method="POST"
            action="{{ isset($document) ? route('admin.documents.update', $document->id) : route('admin.documents.store') }}">
            @csrf
            @if(isset($document))
            @method('PATCH')
            @endif

            <div class="fv-row mb-7">
                <label class="required fw-semibold fs-6 mb-2">Payload</label>
                <div id="payload_editor" style="height: 400px">{{ isset($document) ? json_encode($document->payload, JSON_PRETTY_PRINT) : '{}' }}</div>
                <input type="hidden" name="payload" id="payload_input">
            </div>

            <div class="text-center pt-15">
                <button type="reset" class="btn btn-light me-3">Discard</button>
                <button type="submit" class="btn btn-primary">
                    <span class="indicator-label">Save</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.12/ace.js"></script>
<script>
    var editor = ace.edit("payload_editor");
    editor.setTheme("ace/theme/monokai");
    editor.session.setMode("ace/mode/json");

    $('#document_form').on('submit', function() {
        try {
            const payload = JSON.parse(editor.getValue());
            $('#payload_input').val(JSON.stringify(payload));
            return true;
        } catch (e) {
            toastr.error('Invalid JSON payload');
            return false;
        }
    });
</script>
@endpush