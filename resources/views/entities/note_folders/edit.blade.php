@extends('layouts.hf')

@section('title', 'Добавление папки')

@section('content')
    <div class="content-heading pt-8">
        <a href="{{ route('note_folders.notes.index') }}">Заметки</a>
        <small class="d-none d-sm-inline"> / {{ mb_strimwidth($note_folder->title, 0, 40, "..") }}</small>
    </div>

    <div class="row d-block">
        <div class="col-md-6 m-0auto">
            <!-- Default Elements -->
            <div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Редактирование папки</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option">
                            <i class="si si-wrench"></i>
                        </button>
                    </div>
                </div>

                <div class="block-content">
                    <form action="{{ route('note_folders.notes.update', $note_folder->code) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="title">Введите название</label>
                                <div class="mb-16">
                                    <input type="text" class="form-control" id="title" name="title" value="{{ $note_folder->title }}" maxlength="255">
                                </div>
                                @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary min-width-125 ml-auto d-block">Сохранить</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
            <!-- END Default Elements -->
        </div>
    </div>
@endsection
