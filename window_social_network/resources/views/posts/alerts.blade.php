@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p class="mb-0">{{ $message }}</p>
</div>
@endif