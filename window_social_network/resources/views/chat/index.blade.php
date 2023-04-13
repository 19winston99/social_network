@extends('layouts.app')
@section('content')
<div class="container mb-5">
    <board auth="{{ Auth::user() }}"></board>
</div>
@endsection