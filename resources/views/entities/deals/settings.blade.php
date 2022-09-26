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
            <a href="{{ route('deals.index') }}">Сделки</a>
            <small class="d-none d-sm-inline"> / Настройки</small>

            <div class="dropdown float-right">
                <a onclick="saveStages()" type="button" class="btn btn-square btn-primary text-white max-width-125 ml-auto d-block">Сохранить</a>
            </div>
        </div>

        @if(session()->has('info'))
            <p class="alert alert-info">{{ session()->get('info') }}</p>
        @endif
        <p id="settings_error" class="alert alert-danger d-none"></p>

        <div class="block deal_stages bs-none bg-none">

            <div class="row gutters-tiny p-0 d-flex">

                @foreach($stages as $stage)
                <div id="stage_{{ $stage->code }}" class="js-validation-bootstrap stage" data-code="{{ $stage->code }}">

                    <div class="form-group row">
                        <label class="col-8" for="title_{{ $stage->code }}">Название <span class="text-danger">*</span></label>
                        <div class="col-4">
                            <i onclick="deleteStage('{{ $stage->code }}')" class="si si-close js-swal-confirm stages_icon_close" data-toggle="tooltip" data-placement="left" title="Удалить"></i>
                        </div>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="title_{{ $stage->code }}" name="title_{{ $stage->code }}" placeholder="Название.." value="{{ $stage->title }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-12" for="color_{{ $stage->code }}">Цвет <span class="text-danger">*</span></label>
                        <div class="col-lg-12">
                            <div class="js-colorpicker input-group" data-format="hex">
                                <input type="text" class="form-control" id="color_{{ $stage->code }}" name="color_{{ $stage->code }}" value="{{ $stage->color?$stage->color:'#42a5f5' }}">
                                <div class="input-group-append">
                                    <span class="input-group-text colorpicker-input-addon">
                                        <i></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-12 col-form-label" for="val-digits_{{ $stage->code }}">Позиция <span class="text-danger">*</span></label>
                        <div class="col-lg-12">
                            <input type="text" class="form-control position" id="val-digits_{{ $stage->code }}" name="val-digits_{{ $stage->code }}" placeholder="5" maxlength="4" value="{{ $stage->position }}">
                        </div>
                    </div>

                </div>
                @endforeach

                <a href="{{ route('deals.add_stage') }}" id="stage_more" class="stage_more">
                    <div class="stage_more_inner">
                        <div class="stage_more_title">ДОБАВИТЬ ЭТАП</div>
                        <div class="stage_more_box">
                            <div class="stage_more_line1"></div>
                            <div class="stage_more_line2"></div>
                        </div>
                    </div>
                </a>

            </div>

        </div>

    </div>

@endsection
