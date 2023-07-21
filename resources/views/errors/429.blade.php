@extends('errors::minimal')

@section('title', __('Too Many Requests'))
@section('icon')
<x-icon name='x' class="w-12 h-12"></x-icon>
@endsection
@section('code', '429')
@section('message', __('Too Many Requests'))
