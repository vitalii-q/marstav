@extends('layouts.hf')

@section('title', 'Добавление задачи')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('js/plugins/flatpickr/flatpickr.min.css') }}">
@endsection

@section('js')
    <script src="{{ URL::asset('js/plugins/flatpickr/flatpickr.js') }}"></script>

    <script src="{{ URL::asset('js/pages/tasks.js') }}"></script>

    <script>jQuery(function(){ Codebase.helpers(['flatpickr']); });</script>
@endsection

@section('content')
    <div class="content">
        <div class="content-heading pt-8">
            <a href="{{ route('tasks.index') }}">Задачи</a>
            <small class="d-none d-sm-inline breadcrumb-item"> / Добавление задачи</small>
        </div>

        <div class="row d-block">
            <div class="col-md-12 m-0auto">
                <!-- Default Elements -->
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Задача</h3>
                        <!--<div class="block-options">
                            <button type="button" class="btn-block-option">
                                <i class="si si-wrench"></i>
                            </button>
                        </div>-->
                    </div>

                    <div class="block-content">

                        <form action="{{ route('tasks.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="title">Тема *</label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Тема задачи..">
                                    @error('title')
                                    <div class="alert alert-danger mt-15 mb-0">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="description">Описание *</label>
                                    <textarea class="form-control" id="description" name="description" rows="6" placeholder="Введите описание.."></textarea>
                                    @error('description')
                                    <div class="alert alert-danger mt-15 mb-0">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="deadline">Дедлайн</label>
                                    <input type="text" class="js-flatpickr form-control bg-white mb-16" id="deadline" name="deadline" placeholder="Дата">
                                    @error('deadline')
                                    <div class="alert alert-danger mt-15 mb-0">{{ $message }}</div>
                                    @enderror

                                    <?php if(count($employees) > 6) { $select_size = 7; } else { $select_size = count($employees)+1; } ?>
                                    <label class="" for="performer">Исполнитель *</label>
                                    <select class="form-control mb-16" id="performer" name="performer" size="{{ $select_size }}">
                                        <option value="" selected></option>
                                        @foreach($employees as $employee)
                                        <option class="ws_add_note_so" value="{{ $employee->code }}">{{ $employee->surname . ' ' . $employee->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('performer')
                                    <div class="alert alert-danger mt-15">{{ $message }}</div>
                                    @enderror

                                    <label class="" for="priority">Приоритет *</label>
                                    <select class="form-control mb-16" id="priority" name="priority">
                                        <option value="1">Нормально</option>
                                        <option value="2">Быстро</option>
                                        <option value="3">Срочно</option>
                                        <option value="4">Очень срочно</option>
                                    </select>
                                    @error('priority')
                                    <div class="alert alert-danger mt-15">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-6">
                                    <label>Файлы</label>
                                    <div class="custom-file mb-43 mb-15">
                                        <input onchange="inputFilesCountNotification()" type="file" class="custom-file-input js-custom-file-input-enabled" id="files" name="files[]" value="" data-toggle="custom-file-input" accept="*" multiple>
                                        <label class="custom-file-label" for="files">Выбрать</label>
                                    </div>
                                    <div id="files_info" class="alert alert-info d-none"></div>
                                    <div id="files_error" class="alert alert-danger d-none"></div>
                                    @error('files')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    @error('files.*')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                    <label class="" for="observers">Наблюдатели *</label>
                                    <select class="form-control mb-16" id="observers" name="observers[]" size="{{ $select_size }}" multiple>
                                        <option value="" selected></option>
                                        @foreach($employees as $employee)
                                        <option value="{{ $employee->code }}">{{ $employee->surname . ' ' . $employee->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('observers')
                                    <div class="alert alert-danger mt-15">{{ $message }}</div>
                                    @enderror
                                    @error('observers.*')
                                    <div class="alert alert-danger mt-15">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary min-width-125 ml-auto d-block">Добавить</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
                <!-- END Default Elements -->
            </div>
        </div>
    </div>
@endsection
