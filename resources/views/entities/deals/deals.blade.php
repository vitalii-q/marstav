@extends('layouts.hf')

@section('title', 'Сделки')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('js/plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection

@section('js')
    <script src="{{ URL::asset('js/pages/notes.js') }}"></script>

    <!-- Page JS Plugins -->
    <script src="{{ URL::asset('js/plugins/sweetalert2/sweetalert2.all.js') }}"></script>

    <!-- Page JS Code -->
    <script src="{{ URL::asset('_es6/special/be_ui_activity.js') }}"></script>
@endsection

@section('content')

    <div class="content">
        @if(session()->has('info'))
            <p class="alert alert-info">{{ session()->get('info') }}</p>
        @endif

        <div class="content-heading pt-8">
            <div class="dropdown float-right">
                <a id="add_note_btn" href="{{ route('deals.create') }}" type="button" class="btn btn-square btn-warning min-width-125">Добавить сделку</a>
                <a href="{{ route('deals.settings') }}" type="button" class="btn btn-square btn-primary min-width-125">Настройка</a>
            </div>
            Сделки
        </div>

        <div class="block deals bs-none bg-none">

            <div class="block-content block-content-full p-0 d-flex">

                <div class="">
                    <div class="stage_title stage_type_1">Первый контакт</div>

                    <div class="stage_deals">
                        <div class="stage_deal">
                            123
                        </div>
                    </div>
                </div>

                <div class="">
                    <div class="stage_title stage_type_2">Первый контакт</div>
                </div>

                <div class="">
                    <div class="stage_title stage_type_3">Первый контакт</div>
                </div>

                <div class="">
                    <div class="stage_title stage_type_4">Первый контакт</div>
                </div>

                <div class="">
                    <div class="stage_title stage_type_5">Первый контакт</div>
                </div>

                <div class="">
                    <div class="stage_title stage_type_6">Первый контакт</div>
                </div>

            </div>

        </div>

    </div>

@endsection
