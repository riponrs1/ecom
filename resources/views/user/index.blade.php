@extends('layouts.app')
@section('content')
<h1> User Dashboard welcome   {{Auth::user()->name}}</h1>
@endsection