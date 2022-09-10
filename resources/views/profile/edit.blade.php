@extends('layouts.hf')

@section('title', 'Редактирование профайла')

@section('js')
    <script src="{{ URL::asset('js/pages/profile.js') }}"></script>

    <script src="{{ URL::asset('js/plugins/sweetalert2/sweetalert2.all.js') }}"></script>
    <script src="{{ URL::asset('js/plugins/masked-inputs/jquery.maskedinput.min.js') }}"></script>

    <script>jQuery(function(){ Codebase.helpers(['masked-inputs']); });</script>
@endsection

@section('content')
    <div class="content">
        @if(session()->has('info'))
            <p class="alert alert-info">{{ session()->get('info') }}</p>
        @endif

        @if(session()->has('error'))
            <p class="alert alert-danger">{{ session()->get('error') }}</p>
        @endif

        <div class="content-heading pt-8">
            <a href="{{ route('profile.show', $profile->code) }}">Профайл</a>
            <small class="d-none d-sm-inline"> / Редактирование</small>
        </div>

        <div class="block">

            <div class="block-content">

                <form action="{{ route('profile.update', [$profile->code]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <div class="row items-push">

                        <div class="col-lg-3">
                            <label>Аватар</label>
                            <div class="custom-file mb-43 mb-15">
                                <!-- Populating custom file input label with the selected filename (data-toggle="custom-file-input" is initialized in Helpers.coreBootstrapCustomFileInput()) -->
                                <input id="delete_image" type="text" name="delete_photo" value="no" placeholder="delete_image" hidden>
                                <input onchange="adminShowImage(this)" type="file" class="custom-file-input js-custom-file-input-enabled" id="image_show_input" name="photo" value="" data-toggle="custom-file-input" accept="image/*">
                                <label class="custom-file-label" for="image_show_input">Выбрать</label>
                            </div>
                            @error('photo')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="animated fadeIn">
                                <div class="options-container">
                                    <img id="imgShowElement" class="img-fluid options-item profile-photo" src="@isset($profile->photo) {{ URL::asset($profile->photo) }} @else {{ URL::asset('media/avatars/avatar15.jpg') }} @endif" alt="">
                                    <div class="options-overlay bg-black-op-75">
                                        <div class="options-overlay-content">
                                            <h3 class="h4 text-white mb-5">Аватар</h3>
                                            {{--<h4 class="h6 text-white-op mb-15">More Details</h4>--}}
                                            <a onclick="adminEditImg()" class="btn btn-sm btn-rounded btn-alt-primary min-width-75">
                                                Редактировать
                                            </a>
                                            <a onclick="adminDeleteImg()" class="btn btn-sm btn-rounded btn-alt-danger min-width-75">
                                                Удалить
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-7 offset-lg-1">

                            <p class="text-muted">
                                Ваше имя будет публично отображаться.<br>
                                Номер телефона и электронная почта будут доступны коллегам по компании.
                            </p>

                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="name">Имя</label>
                                    <input type="text" class="form-control form-control-lg" id="name" name="name" placeholder="Введите ваше имя.." value="{{ $profile->name }}">
                                </div>
                            </div>
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="surname">Фамилия</label>
                                    <input type="text" class="form-control form-control-lg" id="surname" name="surname" placeholder="Введите вашу фамилию.." value="{{ $profile->surname }}">
                                </div>
                            </div>
                            @error('surname')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="patronymic">Отчество</label>
                                    <input type="text" class="form-control form-control-lg" id="patronymic" name="patronymic" placeholder="Введите ваше отчество.." value="{{ $profile->patronymic }}">
                                </div>
                            </div>
                            @error('patronymic')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="email">Электронная почта</label>
                                    <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="Введите вашу электронную почту.." value="{{ $profile->email }}">
                                </div>
                            </div>
                            @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="phone">Номер телефона</label>
                                    <input type="tel" class="form-control form-control-lg js-masked-phone" id="phone" name="phone" placeholder="(999) 999-9999" value="{{ $profile->phone }}">
                                </div>
                            </div>
                            @error('phone')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="form-group row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-alt-primary">Сохранить</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>

        @if($profile->company_id)
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    <i class="si si-users mr-5 text-muted"></i> Компания: {{ App\Models\Company::query()->where('id', $profile->company_id)->first()->name }}
                </h3>
            </div>

            <div class="block-content">
                <div class="row items-push">
                    <div class="col-lg-3">
                        <p class="text-muted">
                            Если вы выйдете из компании, вы утратите доступ к задачам и перепискам компании.
                        </p>
                    </div>

                    <div class="col-lg-7 offset-lg-1">

                        <div class="form-group row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-alt-danger js-swal-confirm">Выйти из компании</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    <i class="si si-settings mr-5 text-muted"></i> Изменить пароль
                </h3>
            </div>

            <div class="block-content">
                <form action="{{ route('profile_change_password') }}" method="post">
                    @csrf
                    @method('put')

                    <div class="row items-push">
                        <div class="col-lg-3">
                            <p class="text-muted">
                                Смена пароля для входа в систему - простой способ обезопасить свою учетную запись.
                            </p>
                        </div>
                        <div class="col-lg-7 offset-lg-1">
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="old_password">Текущий пароль</label>
                                    <input type="password" class="form-control form-control-lg" id="old_password" name="old_password">
                                </div>
                            </div>
                            @error('old_password')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="password">Новый пароль</label>
                                    <input type="password" class="form-control form-control-lg" id="password" name="password">
                                </div>
                            </div>
                            @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="password_confirmation">Подтвердите новый пароль</label>
                                    <input type="password" class="form-control form-control-lg" id="password_confirmation" name="password_confirmation">
                                </div>
                            </div>
                            @error('password_confirmation')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror


                            <div class="form-group row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-alt-primary">Обновить</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- END Change Password -->

    </div>

@endsection
