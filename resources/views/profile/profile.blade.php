@extends('layouts.hf')

@section('title', $profile->name . ' ' . $profile->surname)

@section('js')
    <script src="{{ URL::asset('js/pages/profile.js') }}"></script>

    <!-- Page JS Plugins -->
    <script src="{{ URL::asset('js/plugins/sweetalert2/sweetalert2.all.js') }}"></script>
@endsection

@section('content')

    <div class="content profile">
        @if(session()->has('info'))
            <p class="alert alert-info">{{ session()->get('info') }}</p>
        @endif

        <div class="content-heading pt-8">
            <a href="{{ route('profile.show', $user->code) }}">Профайл</a>
            <small class="d-none d-sm-inline"> / {{ mb_strimwidth($profile->name, 0, 40, "..") }}</small>
        </div>

        <div class="block">

            <div class="block-header block-header-default">
                <h3 class="block-title">
                    <i class="si si-user mr-5 text-muted"></i> Профайл пользователя
                </h3>

                @if($profile->id == \Illuminate\Support\Facades\Auth::user()->id)
                <a href="{{ route('profile.edit', $profile->code) }}" class="btn btn-alt-primary mr-auto">Редактировать</a>
                @endif
                @if(isset($company) and $user->id == $company->creator_id and $user->company_id == $profile->company_id and $user->id != $profile->id)
                    <button id="expel_an_employee" data-code="{{ $profile->code }}" class="btn btn-alt-danger mr-auto js-swal-confirm">Исключить</button>
                @endif
            </div>

            <div class="block-content">

                <div class="row items-push">

                    <div class="col-lg-3">
                        <div class="photo" style="background-image: url(@if($profile->photo) {{ URL::asset($profile->photo) }} @else {{ URL::asset('media/avatars/avatar15.jpg') }} @endif )"></div>
                    </div>

                    <div class="col-lg-7 offset-lg-1">

                        <div class="form-group row">
                            <div class="col-12">
                                <p class="title">Имя:</p>
                                <p class="text">{{ $profile->name }}</p>
                                <div class="profile-group"></div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
                                <p class="title">Фамилия:</p>
                                <p class="text">{{ $profile->surname }}</p>
                                <div class="profile-group"></div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
                                <p class="title">Отчество:</p>
                                <p class="text">{{ $profile->patronymic }}</p>
                                <div class="profile-group"></div>
                            </div>
                        </div>

                        @if(\Illuminate\Support\Facades\Auth::user()->company_id == $profile->company_id)
                        <div class="form-group row">
                            <div class="col-12">
                                <p class="title">Электронная почта:</p>
                                <p class="text">{{ $profile->email }}</p>
                                <div class="profile-group"></div>
                            </div>
                        </div>

                        <div class="form-group row mb-50">
                            <div class="col-12">
                                <p class="title">Телефон:</p>
                                <p class="text">{{ $profile->phone }}</p>
                                <div class="profile-group"></div>
                            </div>
                        </div>
                        @endif

                        @if($profile->company_id)
                        <div class="form-group row mb-50">
                            <div class="col-12">
                                <p class="title">Компания:</p>
                                <p class="text">{{ \App\Models\Company::query()->where('id', $profile->company_id)->first()->name }}</p>
                                <div class="profile-group"></div>
                            </div>
                        </div>
                        @endif

                        <div class="form-group row">
                            <div class="col-12">
                                <p class="title">ID:</p>
                                <p class="text">{{ $profile->code }}</p>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
