@extends('layouts.hf')

@section('title', 'Добавление заметки')

@section('content')
    <div class="content">
    <div class="content-heading pt-8">
        <a href="{{ route('note_folders.notes.index') }}">Заметки</a>
        @if($folder)
            <small class="d-none d-sm-inline"> / <a href="{{ route('entities.note.index', $folder->code) }}">{{ $folder->title }}</a></small>
        @endif
        <small class="d-none d-sm-inline breadcrumb-item"> / Добавление заметки</small>
    </div>

    <div class="row d-block">
        <div class="col-md-12 m-0auto">
            <!-- Default Elements -->
            <div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Добавить заметку</h3>
                    <!--<div class="block-options">
                        <button type="button" class="btn-block-option">
                            <i class="si si-wrench"></i>
                        </button>
                    </div>-->
                </div>

                <div class="block-content">
                    @if($folder)
                    <form action="{{ route('entities.note.store', $folder->code) }}" method="post" enctype="multipart/form-data">
                    @else
                    <form action="{{ route('entities.note.store', 'root') }}" method="post" enctype="multipart/form-data">
                    @endif
                        @csrf

                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="form-material floating pt-20">
                                    <input type="text" class="form-control" id="material-text2" name="title"  maxlength="255">
                                    <label for="material-text2">Заголовок</label>
                                </div>
                                @error('title')
                                <div class="alert alert-danger mt-15 mb-0">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
                                <div class="form-material floating">
                                    <textarea class="form-control" id="material-textarea-large2" name="text" rows="8" maxlength="4000"></textarea>
                                    <label for="material-textarea-large2">Текст</label>
                                </div>
                                @error('text')
                                <div class="alert alert-danger mt-15 mb-0">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary min-width-125 ml-auto d-block">Сохранить</button>
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
