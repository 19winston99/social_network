@extends('layouts.app')
@section('content')
<app user="{{Auth::user()}}"></app>
@endsection