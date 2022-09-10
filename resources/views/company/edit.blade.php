@extends('layouts.hf')

@section('title', 'Обновления компании: '.$company->name)

@section('content')
    <div class="content">
        <div class="content-heading pt-8">
            <a href="{{ route('company.index') }}">Компания</a>
            <small class="d-none d-sm-inline"> / {{ mb_strimwidth($company->name, 0, 120, "..") }}</small>
        </div>

        <div class="row d-block">
            <div class="col-md-12 m-0auto">
                <!-- Default Elements -->
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Обновления компании</h3>
                        <!--<div class="block-options">
                            <button type="button" class="btn-block-option">
                                <i class="si si-wrench"></i>
                            </button>
                        </div>-->
                    </div>

                    <div class="block-content">

                        <form action="{{ route('company.update', [$company->code]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="form-material floating pt-20">
                                        <input type="text" class="form-control" id="name"  name="name" value="{{ $company->name }}" maxlength="255">
                                        <label for="name">Заголовок</label>
                                    </div>
                                    @error('name')
                                    <div class="alert alert-danger mt-15 mb-0">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="form-material floating">
                                        <textarea class="form-control" id="description" name="description" rows="8" maxlength="4000">{{ $company->description }}</textarea>
                                        <label for="description">Описание</label>
                                    </div>
                                    @error('description')
                                    <div class="alert alert-danger mt-15 mb-0">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="form-material floating">
                                        <textarea class="form-control" id="board" name="board" rows="8" maxlength="4000">{{ $company->board }}</textarea>
                                        <label for="board">Доска объявлений</label>
                                    </div>
                                    @error('board')
                                    <div class="alert alert-danger mt-15 mb-0">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary min-width-125 ml-auto d-block">Обновить</button>
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
