@extends('errors::minimal')

@section('title', __('Pagamento Requerido'))
@section('icon')
<x-icon name='shield-exclamation' class="w-12 h-12"></x-icon>
@endsection
@section('code', '402')
@section('message', __('Pagamento Requerido'))
