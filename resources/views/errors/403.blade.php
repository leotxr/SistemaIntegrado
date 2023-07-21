@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('icon')
<x-icon name='lock-closed' class="w-12 h-12"></x-icon>
@endsection
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Forbidden'))
