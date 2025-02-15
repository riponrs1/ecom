@extends('layouts.app')
@section('content')
  <h1>Admin Dashboard
    welcome {{Auth::user()->name}}
  </h1>  
@endsection