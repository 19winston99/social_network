@if($errors->any())
<div class="alert alert-danger mt-0">
    @foreach($errors->all() as $error)
    <p>{{ $error }}</p>
    @endforeach
</div>
@endif