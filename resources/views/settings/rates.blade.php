@extends('layouts.hf')

@section('title', 'Тарифы')

@section('css')

@endsection

@section('js')

@endsection

@section('content')

    <div class="bg-primary">
        <div class="bg-pattern bg-black-op-25" style="background-image: url('{{ URL::asset('media/various/bg-pattern.png')}}')">
            <div class="content content-top text-center">
                <div class="py-50">
                    <h1 class="font-w700 text-white mb-10">Тарифные планы</h1>
                    <h2 class="h4 font-w400 text-white-op">Расширяйте возможности.</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="row py-30">

            @php($better = false) @foreach($rates as $rate)
                @if($user->rate_name == $rate->name) @php($better = true) @endif
                <div class="col-md-6 col-xl-3">
                    <a @if($rate->name == 'Primary') onclick="return false;" @else href="{{ route('rates.change', strtolower($rate->name)) }}" @endif class="block block-link-pop block-rounded block-bordered text-center c-pointer">
                        <div class="block-header">
                            <h3 class="block-title">
                                @if($user->rate_name == $rate->name) <i class="fa fa-check"></i> @endif
                                {{ $rate->name }}
                            </h3>
                        </div>
                        <div class="block-content bg-body-light">
                            <div class="h1 font-w700 mb-10 @if($user->rate_name == $rate->name) text-primary @endif">{{ $rate->price }}р</div>
                            <div class="h5 text-muted">в месяц</div>
                        </div>
                        <div class="block-content">
                            <p>Пользователи <strong>{{ $rate->users }}</strong></p>
                            <p>Хранилище <strong>{{ \App\Modules\Storage\Calculator::bToGb($rate->space) }}GB</strong></p>
                        </div>
                        <div class="block-content block-content-full">
                            <span class="btn btn-hero btn-sm btn-rounded btn-noborder @if($user->rate_name == $rate->name) btn-alt-primary @else btn-primary @endif">
                                <i class="fa fa-arrow-up mr-5 @if($better == false) transform180 @endif"></i>
                                @if($user->rate_name == $rate->name and $rate->name != 'Primary') Продлить @else Обновить @endif
                            </span>
                        </div>
                    </a>
                </div>
            @endforeach

        </div>
    </div>

@endsection
