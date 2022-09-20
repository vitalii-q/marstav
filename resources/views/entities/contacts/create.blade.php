@extends('layouts.hf')

@section('title', 'Добавление контакта')

@section('js')
    <script src="{{ URL::asset('js/plugins/pwstrength-bootstrap/pwstrength-bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ URL::asset('js/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ URL::asset('js/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ URL::asset('js/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ URL::asset('js/plugins/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>
    <script src="{{ URL::asset('js/plugins/jquery-auto-complete/jquery.auto-complete.min.js') }}"></script>
    <script src="{{ URL::asset('js/plugins/masked-inputs/jquery.maskedinput.min.js') }}"></script>
    <script src="{{ URL::asset('js/plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>
    <script src="{{ URL::asset('js/plugins/dropzonejs/dropzone.min.js') }}"></script>
    <script src="{{ URL::asset('js/plugins/flatpickr/flatpickr.min.js') }}"></script>

    <script src="{{ URL::asset('js/special/be_forms_plugins.min.js') }}"></script>

    <script>jQuery(function(){ Codebase.helpers(['flatpickr', 'datepicker', 'colorpicker', 'maxlength', 'select2', 'masked-inputs', 'rangeslider', 'tags-inputs']); });</script>

    <script src="{{ URL::asset('js/pages/contacts.js') }}"></script>
@endsection

@section('content')

    <div class="content profile">
        @if(session()->has('info'))
            <p class="alert alert-info">{{ session()->get('info') }}</p>
        @endif

        <div class="content-heading pt-8">
            <a href="{{ route('contacts.index') }}">Контакты</a>
            <small class="d-none d-sm-inline"> / Добавление контакта</small>
        </div>

        <div class="col-lg-8 m-auto">
        <div class="block">

            <div class="block-header block-header-default">
                <h3 class="block-title">
                    <i class="fa fa-user-circle mr-5 text-muted"></i> Добавление контакта
                </h3>
            </div>

            <div class="block-content">

                <form action="{{ route('contacts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <div class="row items-push">

                        <div class="col-lg-12">

                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label for="phone">Номер телефона</label>
                                    <input type="tel" class="form-control form-control-lg js-masked-phone" id="phone" name="phone" placeholder="(999) 999-9999" value="">
                                </div>

                                <div class="col-lg-6">
                                    <label for="privet_phone">Личный номер телефона</label>
                                    <input type="tel" class="form-control form-control-lg js-masked-phone" id="privet_phone" name="privet_phone" placeholder="(999) 999-9999" value="">
                                </div>
                            </div>
                            @error('phone')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            @error('privet_phone')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label for="name">Имя</label>
                                    <input type="text" class="form-control form-control-lg" id="name" name="name" placeholder="Введите ваше имя.." value="">
                                </div>

                                <div class="col-lg-6">
                                    <label for="surname">Фамилия</label>
                                    <input type="text" class="form-control form-control-lg" id="surname" name="surname" placeholder="Введите вашу фамилию.." value="">
                                </div>
                            </div>
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            @error('surname')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label for="patronymic">Отчество</label>
                                    <input type="text" class="form-control form-control-lg" id="patronymic" name="patronymic" placeholder="Введите ваше отчество.." value="">
                                </div>
                                <div class="col-lg-6">
                                    <label for="born">Дата рождения</label>
                                    <input type="text" class="js-masked-date form-control form-control-lg" id="born" name="born" placeholder="dd/mm/yyyy">
                                </div>
                            </div>
                            @error('patronymic')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            @error('born')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="position">Должность</label>
                                    <input type="text" class="form-control form-control-lg" id="position" name="position" placeholder="Введите должность.." value="">
                                </div>
                            </div>
                            @error('position')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="form-group row">
                                <div class="col-12 col-lg-6">
                                    <label for="email">Электронная почта</label>
                                    <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="Введите электронную почту.." value="">
                                </div>

                                <div class="col-12 col-lg-6">
                                    <label for="privet_email">Электронная почта</label>
                                    <input type="email" class="form-control form-control-lg" id="privet_email" name="privet_email" placeholder="Введите личную почту.." value="">
                                </div>
                            </div>
                            @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            @error('privet_email')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="address">Адрес</label>
                                    <input type="text" class="form-control form-control-lg" id="address" name="address" placeholder="Введите должность.." value="">
                                </div>
                            </div>
                            @error('address')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="form-group row">
                                <label class="col-12 col-lg-12 m-auto" for="notes">Заметки</label>
                                <div class="col-12 col-lg-12 m-auto">
                                    <textarea class="js-maxlength form-control" id="notes" name="notes" rows="4" maxlength="2000" placeholder="Начните писать.." data-always-show="true"></textarea>
                                </div>
                            </div>

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
        </div>

    </div>

@endsection
