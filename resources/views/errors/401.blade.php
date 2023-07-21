@extends('errors::minimal')

@section('title', __('Não autorizado'))
@section('icon')
<x-icon name='lock-closed' class="w-12 h-12"></x-icon>
@endsection
@section('code', '401')
@section('message', __('Não autorizado'))
