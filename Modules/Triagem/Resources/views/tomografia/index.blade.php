@extends('triagem::layouts.master')
@section('content')
    <div class="shadow-md">
        <div class="h-screen m-2 sm:grid justify-items-center">
            @include('triagem::triagens.table-realizadas')
        </div>
    </div>
@endsection