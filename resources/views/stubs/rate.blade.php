@extends('layouts.hf')

@section('title', 'Подписка деактивирована')

@section('css')

@endsection

@section('js')

@endsection

@section('content')

    <div class="content">

        <div class="block block-rounded">
            <div class="block-content block-content-full bg-pattern" style="background-image: url('assets/media/various/bg-pattern-inverse.png');">
                <div class="py-20 text-center">
                    <h2 class="font-w700 text-black mb-10">
                        Подписка деактивирована
                    </h2>
                    <h3 class="h5 text-muted mb-20">
                        Период вашей подписки завершен. Лимиты бесплатного тарифного плана Primary превышены. <br>
                        Вы можете продлить подписку для повышения лимитов.
                    </h3>
                    <a href="{{ route('settings') }}" type="button" class="btn btn-hero btn-rounded btn-primary text-uppercase min-width-125 mb-10">Настройки</a>
                </div>
            </div>
        </div>

        <div class="block border-bottom mb-0">
            <div class="block-content block-content-full border-bottom">
                <div class="row align-items-center">
                    <div class="col-sm-6 py-10">
                        <h3 class="h5 font-w700 mb-15">
                            Пользователи<span class="text-muted"></span>
                        </h3>
                        <div class="progress mb-5" style="height: 8px;">
                            <div class="progress-bar progress-bar-striped progress-bar-animated {{ $users_bg }}" role="progressbar" style="width: {{ $users_percents }}%;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p class="font-size-sm font-w600 mb-0">
                            <span class="font-w700">{{ count($users) }}</span> из <span class="font-w700">{{ $primary->users }}</span> Пользователей
                        </p>
                    </div>

                    <div class="col-sm-6 py-10 text-md-right">
                    </div>
                </div>
            </div>

            <div class="block">
                <div class="block-content block-content-full">
                    <div class="row align-items-center">
                        <div class="col-sm-6 py-10">
                            <h3 class="h5 font-w700 mb-15">
                                Доступное место<span class="text-muted"></span>
                            </h3>
                            <div class="progress mb-5" style="height: 8px;">
                                <div class="progress-bar progress-bar-striped progress-bar-animated {{ $space_bg }}" role="progressbar" style="width: {{ $space_percents }}%;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="font-size-sm font-w600 mb-0">
                                <span class="font-w700">{{ \App\Modules\Storage\Calculator::bToGb($space_involved) }}GB</span> из <span class="font-w700">{{ \App\Modules\Storage\Calculator::bToGb($primary->space) }}GB</span> Занято
                            </p>
                        </div>
                        <div class="col-sm-6 py-10 text-md-right">
                        </div>
                    </div>
                </div>
            </div>

    </div>

@endsection
