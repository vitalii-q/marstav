@extends('layouts.hf')

@section('title', 'Чат')

@section('js')
    <script src="{{ URL::asset('js/pages/chat.js') }}"></script>
@endsection

@section('content')

    <chat></chat>

@endsection
