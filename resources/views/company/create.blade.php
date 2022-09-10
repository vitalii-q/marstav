@extends('layouts.hf')

@section('title', 'Создание компании')

@section('content')
    <div class="content">
    <div class="row d-block">
        <div class="col-md-12 m-0auto">
            <!-- Default Elements -->
            <div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Создание компании</h3>
                    <!--<div class="block-options">
                        <button type="button" class="btn-block-option">
                            <i class="si si-wrench"></i>
                        </button>
                    </div>-->
                </div>

                <div class="block-content">

                    <form action="{{ route('company.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="form-material floating pt-20">
                                    <input type="text" class="form-control" id="material-text2" name="name"  maxlength="255">
                                    <label for="material-text2">Название</label>
                                </div>
                                @error('name')
                                <div class="alert alert-danger mt-15 mb-0">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
                                <div class="form-material floating">
                                    <textarea class="form-control" id="material-textarea-large2" name="description" rows="8" maxlength="4000"></textarea>
                                    <label for="material-textarea-large2">Описание</label>
                                </div>
                                @error('description')
                                <div class="alert alert-danger mt-15 mb-0">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary min-width-125 ml-auto d-block">Создать</button>
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
