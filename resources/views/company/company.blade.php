@extends('layouts.hf')

@section('title', 'Компания')

@section('js')
    <script src="{{ URL::asset('js/pages/company.js') }}"></script>
@endsection

@section('content')

    @if($company)
        <div class="bg-image bg-image-bottom" style="background-image: url({{ URL::asset('media/photos/photo13@2x.jpg') }}">
            <div class="bg-primary-dark-op py-30">
                <div class="content content-full text-center">
                    <h1 class="h3 text-white font-w700 mb-10">
                        {{ $company->name }}
                    </h1>

                    <h2 class="h5 text-white-op">
                        {{ mb_strimwidth($company->description, 0, 4000, "..") }}
                    </h2>

                    @if($company->creator_id == Auth::user()->id)
                    <button type="button" class="btn btn-rounded btn-hero btn-sm btn-alt-success mb-5" data-toggle="modal" data-target="#modal_add_employee">
                        <i class="si si-user-follow mr-5"></i> Добавить сотрудника
                    </button>
                    <!--<button type="button" class="btn btn-rounded btn-hero btn-sm btn-alt-primary mb-5" data-toggle="modal" data-target="#company_modal_ad">
                        <i class="fa fa-envelope-o mr-5"></i> Объявление
                    </button>-->

                    <a class="btn btn-rounded btn-hero btn-sm btn-alt-secondary mb-5 px-20" href="{{ route('company.edit', [$company->code]) }}">
                        <i class="fa fa-pencil"></i>
                    </a>
                    @endif
                </div>
            </div>
        </div>

        @if(session()->has('info'))
            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                        <p class="alert alert-info mb-0">{{ session()->get('info') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if(session()->has('error'))
            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                        <p class="alert alert-danger mb-0">{{ session()->get('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="content company">

            @if($company->board)
            <div class="row">
                <div class="col-md-12">
                    <div class="block">
                        <div class="block-content">
                            <p>{{ $company->board }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <div class="row">
                @foreach($employees as $employee)
                <div class="col-md-6 col-xl-3">
                    <a class="block block-link-pop text-center employee_link" href="/profile/{{ $employee->code }}">
                        <div class="block-content block-content-full">
                            @if($employee->photo)
                            <div class="img-avatar avatar" style="background-image: url({{ $employee->photo }})"></div>
                            @else
                            <img class="img-avatar" src="{{ URL::asset('media/avatars/avatar2.jpg') }}" alt="">
                            @endif
                        </div>

                        <div class="block-content block-content-full bg-body-light">
                            <div class="font-w600 mb-5">{{ $employee->surname }} {{ $employee->name }}</div>
                            <div class="font-size-sm text-muted text-position">
                                {{ mb_strimwidth($employee->position, 0, 255, "..") }}
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>

        </div>
    @else
        <div id="workspace_stub" class="hero bg-pattern stub h-auto minh-auto" data-toggle="modal" data-target="#modal-popin-plus" style="background-image: url({{ URL::asset('media/various/bg-pattern-inverse.png') }});">
            <div class="hero-inner">
                <div class="content content-full">
                    <div class="py-60 text-center">
                        <i class="si si-users text-primary display-3"></i>
                        <h1 class="h2 font-w700 mt-30 mb-10">Компания</h1>
                        <h2 class="h3 font-w400 text-muted stub-text mb-50">
                            Создайте компанию и добавляйте сотрудников что бы вы могли добавлять им задачи и общаться в чате
                        </h2>
                        <a class="btn btn-hero btn-noborder btn-rounded btn-alt-primary" href="{{ route('company.create') }}">
                            <i class="si si-pencil mr-10"></i> Создать компанию
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="modal fade" id="modal_add_employee" tabindex="-1" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
        <div class="modal-dialog modal-dialog-popin" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Добавление сотрудника</h3>
                        <div class="block-options">
                            <button class="btn-block-option modal_close_btn" type="button" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>

                    <div class="block-content">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-material pt-0">
                                            <p class="modal_add_employee_p_title">
                                                Введите ID сотрудника которого хотите добавить. Узнать ID можно в разделе: Профайл -> ID
                                            </p>
                                            <input type="text" class="form-control" id="modal_add_employee_id" name="id" placeholder="Введите ID" maxlength="255">
                                            <input type="text" class="form-control" id="modal_add_company_id" name="company_id" placeholder="Введите ID" maxlength="255" hidden>
                                        </div>

                                        <div id="company_add_employee_error" class="alert alert-danger mt-15 mb-0 d-none"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Отменить</button>
                    <button onclick="addEmployee()" type="button" class="btn btn-alt-success">
                        <i class="si si-check"></i> Добавить
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection


