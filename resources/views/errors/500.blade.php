@extends('errors::minimal')

@section('title', __('Server Error'))
@section('icon')
<x-icon name='code' class="w-12 h-12"></x-icon>
@endsection
@section('code', '500')
@section('message', __('Server Error'))
