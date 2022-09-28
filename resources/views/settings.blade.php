@extends('layouts.hf')

@section('title', 'Настройки сделок')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('js/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('js/plugins/select2/css/select2.css') }}">
@endsection

@section('js')
    <script src="{{ URL::asset('js/pages/deals.js') }}"></script>

    <script src="{{ URL::asset('js/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ URL::asset('js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>

    <script>jQuery(function(){ Codebase.helpers(['colorpicker']); });</script>

    <script src="{{ URL::asset('js/special/be_forms_validation.min.js') }}"></script>
@endsection

@section('content')

    <div class="content">
        <div class="content-heading pt-8">
            Настройки
            <div class="dropdown float-right">
                <a onclick="saveStages()" type="button" class="btn btn-square btn-primary text-white max-width-125 ml-auto d-block">Сохранить</a>
            </div>
        </div>

        @if(session()->has('info'))
            <p class="alert alert-info">{{ session()->get('info') }}</p>
        @endif

        <div class="block deal_stages bs-none bg-none">

            <div class="block-header block-header-default">
                <h3 class="block-title">
                    <i class="si si-settings mr-5 text-muted"></i> Настройки
                </h3>
            </div>

            <div class="block-content bg-white">

                <div class="row items-push">
                    fdhfg
                </div>

            </div>

        </div>

    </div>

@endsection
