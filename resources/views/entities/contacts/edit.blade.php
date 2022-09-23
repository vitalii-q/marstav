@extends('layouts.hf')

@section('title',  $contact->surname.' '.$contact->name.' '.$contact->patronymic)

@section('js')
    <script src="{{ URL::asset('js/plugins/masked-inputs/jquery.maskedinput.min.js') }}"></script>

    {{--    <script src="{{ URL::asset('js/special/be_forms_plugins.min.js') }}"></script>--}}

    <script>jQuery(function(){ Codebase.helpers(['masked-inputs']); });</script>

    <script src="{{ URL::asset('js/pages/contacts.js') }}"></script>
@endsection

@section('content')

    <div class="content contacts">
        @if(session()->has('info'))
            <p class="alert alert-info">{{ session()->get('info') }}</p>
        @endif

        <div class="content-heading pt-8">
            <a href="{{ route('contacts.index') }}">Контакты</a>
            <small class="d-none d-sm-inline"> / Редактирование контакта</small>
        </div>

        <div class="col-lg-8 m-auto">
            <div class="block">

                <div class="block-header block-header-default">
                    <h3 class="block-title">
                        <i class="fa fa-user-circle mr-5 text-muted"></i> Добавление контакта
                    </h3>
                </div>

                <div class="block-content">

                    <form action="{{ route('contacts.update', $contact->code) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <div class="row items-push">

                            <div class="col-lg-12">

                                <div class="form-group row">
                                    <div class="col-12 col-lg-6">
                                        <label for="name">Имя</label>
                                        <input type="text" class="form-control form-control-lg" id="name" name="name" placeholder="Введите имя.." value="{{ $contact->name }}">
                                    </div>

                                    <div class="col-12 col-lg-6">
                                        <label for="surname">Фамилия</label>
                                        <input type="text" class="form-control form-control-lg" id="surname" name="surname" placeholder="Введите фамилию.." value="{{ $contact->surname }}">
                                    </div>
                                </div>
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                @error('surname')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group row">
                                    <div class="col-12 col-lg-6">
                                        <label for="patronymic">Отчество</label>
                                        <input type="text" class="form-control form-control-lg" id="patronymic" name="patronymic" placeholder="Введите отчество.." value="{{ $contact->patronymic }}">
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label for="born">Дата рождения</label>
                                        <input type="text" class="js-masked-date form-control form-control-lg" id="born" name="born" placeholder="дд/мм/гггг" value="{{ $contact->born }}">
                                    </div>
                                </div>
                                @error('patronymic')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                @error('born')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <hr class="edit_hr">

                                <div class="form-group row">
                                    <div class="col-12 col-lg-6">
                                        <label for="phone">Номер телефона</label>
                                        <input type="tel" class="form-control form-control-lg js-masked-phone" id="phone" name="phone" placeholder="(999) 999-9999" value="{{ $contact->phone }}">
                                    </div>

                                    <div class="col-12 col-lg-6">
                                        <label for="private_phone">Номер телефона (личный)</label>
                                        <input type="tel" class="form-control form-control-lg js-masked-phone" id="private_phone" name="private_phone" placeholder="(999) 999-9999" value="{{ $contact->private_phone }}">
                                    </div>
                                </div>
                                @error('phone')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                @error('private_phone')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group row">
                                    <div class="col-12 col-lg-6">
                                        <label for="email">Электронная почта</label>
                                        <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="Введите электронную почту.." value="{{ $contact->email }}">
                                    </div>

                                    <div class="col-12 col-lg-6">
                                        <label for="private_email">Электронная почта (личная)</label>
                                        <input type="email" class="form-control form-control-lg" id="private_email" name="private_email" placeholder="Введите электронную почту.." value="{{ $contact->private_email }}">
                                    </div>
                                </div>
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                @error('private_email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <hr class="edit_hr">

                                <div class="form-group row">
                                    <div class="col-12">
                                        <label for="address">Адрес</label>
                                        <input type="text" class="form-control form-control-lg" id="address" name="address" placeholder="Введите адрес.." value="{{ $contact->address }}">
                                    </div>
                                </div>
                                @error('address')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group row">
                                    <div class="col-12 col-lg-6">
                                        <label for="position">Должность</label>
                                        <input type="text" class="form-control form-control-lg" id="position" name="position" placeholder="Введите должность.." value="{{ $contact->position }}">
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label for="company">Компания</label>
                                        <input type="text" class="form-control form-control-lg" id="company" name="company" placeholder="Введите компанию.." value="{{ $contact->company }}">
                                    </div>
                                </div>
                                @error('position')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                @error('company')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <hr class="edit_hr">

                                <div class="form-group row">
                                    <label class="col-12 col-lg-12 m-auto" for="note">Заметки</label>
                                    <div class="col-12 col-lg-12 m-auto">
                                        <textarea class="js-maxlength form-control" id="note" name="note" rows="4" maxlength="2000" placeholder="Начните писать.." data-always-show="true">{{ $contact->note }}</textarea>
                                    </div>
                                </div>
                                @error('note')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-alt-primary d-block ml-auto">Сохранить</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>

@endsection
