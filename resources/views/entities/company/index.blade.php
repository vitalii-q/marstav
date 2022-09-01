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
                        {{ $company->title }}
                    </h1>

                    <h2 class="h5 text-white-op">
                        {{ mb_strimwidth($company->description, 0, 4000, "..") }}
                    </h2>

                    @if($company->creator_id == Auth::user()->id)
                    <button type="button" class="btn btn-rounded btn-hero btn-sm btn-alt-success mb-5">
                        <i class="fa fa-plus mr-5"></i> Добавить сотрудника
                    </button>
                    <button type="button" class="btn btn-rounded btn-hero btn-sm btn-alt-primary mb-5">
                        <i class="fa fa-envelope-o mr-5"></i> Объявление
                    </button>

                    <a class="btn btn-rounded btn-hero btn-sm btn-alt-secondary mb-5 px-20" href="be_pages_generic_profile_edit.html">
                        <i class="fa fa-pencil"></i>
                    </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="content company">
        <div class="row">
            @foreach($employees as $employee)
            <div class="col-md-6 col-xl-3">
                <a class="block block-link-pop text-center" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <img class="img-avatar" src="{{ URL::asset('media/avatars/avatar2.jpg') }}" alt="">
                    </div>

                    <div class="block-content block-content-full bg-body-light">
                        <div class="font-w600 mb-5">{{ $employee->name }}</div>
                        <div class="font-size-sm text-muted text-position">
                            {{ $employee->position }}
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        </div>

    @else
    <div id="workspace_stub" class="hero bg-pattern h-auto mh-auto" data-toggle="modal" data-target="#modal-popin-plus" style="background-image: url({{ URL::asset('media/various/bg-pattern-inverse.png') }});">
        <div class="hero-inner">
            <div class="content content-full">
                <div class="py-30 text-center">
                    <i class="si si-users text-primary display-3"></i>
                    <h1 class="h2 font-w700 mt-30 mb-10">Компания</h1>
                    <h2 class="h3 font-w400 text-muted mb-50">Здесь вы будете видеть участников компании</h2>
                    <a class="btn btn-hero btn-noborder btn-rounded btn-alt-primary" href="{{ route('company.create') }}">
                        <i class="si si-pencil mr-10"></i> Создать компанию
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif

@endsection
