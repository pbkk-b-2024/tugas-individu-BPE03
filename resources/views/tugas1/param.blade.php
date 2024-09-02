@extends('dashboard.base')

@section('title', 'Routing Parameter')

@section('content')
<div class="card mb-4">
    <div class="card-header">
        <h5 class="card-title">1 Parameter</h5><br>
        <h5  class="card-title">Preview URL : <span id="preview-1"></span></h5>
    </div>
    <div class="card-body">
        <form id="form1" method="GET" action="">
            <div class="form-group">
                <label for="param1">Parameter 1:</label>
                <input type="text" class="form-control" id="param1" name="param1" placeholder="Enter parameter 1" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

@endsection

@section('script')
{{-- <script>
    document.getElementById('form1').addEventListener('submit', function(e) {
        e.preventDefault();
        const param1 = document.getElementById('param1').value;
        const url = `{{ url('/param') }}/${param1}`;
        window.location.href = url;
    });
</script> --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form1 = document.getElementById('form1');
        const param1Input = document.getElementById('param1');
        const preview1Span = document.getElementById('preview-1');

        function updatePreview1() {
            const param1 = encodeURIComponent(param1Input.value);
            const previewUrl1 = `{{ url('/param') }}/${param1}`;
            preview1Span.textContent = previewUrl1;
        }

        param1Input.addEventListener('input', updatePreview1);

        form1.addEventListener('submit', function(e) {
            e.preventDefault();
            const param1 = encodeURIComponent(param1Input.value);
            const url = `{{ url('/param') }}/${param1}`;
            window.location.href = url;
        });

        // Initialize previews
        updatePreview1();
    });
</script>
@endsection