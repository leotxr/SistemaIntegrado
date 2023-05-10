@extends('triagem::layouts.master')
@section('content')
    <div class="shadow-md">
        <div class="sm:grid justify-items-center m-2 h-screen">
            @include('triagem::triagens.table-realizadas')
        </div>
    </div>
@endsection
