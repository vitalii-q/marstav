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
                    <div onclick="qiwiNotis()">12345</div>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="row py-30">

            @php($better = false) @foreach($rates as $rate)
                @if($user->rate_name == $rate->name) @php($better = true) @endif

                <?php
                $m_shop = 1760404574;
                $m_orderid = bin2hex(random_bytes(14));
                $m_amount = number_format($rate->price, 2, '.', '');
                $m_curr = 'RUB';
                $m_desc = base64_encode('Payment №'.bin2hex(random_bytes(4)));
                $m_key = '1hEhtehPqiPrMhKZ';

                $arHash = array(
                    $m_shop,
                    $m_orderid,
                    $m_amount,
                    $m_curr,
                    $m_desc
                );

                $arHash[] = $m_key;

                $sign = strtoupper(hash('sha256', implode(':', $arHash)));?>

                <form method="post" action="https://payeer.com/merchant/">
                    <input type="hidden" name="m_shop" value="<?=$m_shop?>">
                    <input type="hidden" name="m_orderid" value="<?=$m_orderid?>">
                    <input type="hidden" name="m_amount" value="<?=$m_amount?>">
                    <input type="hidden" name="m_curr" value="<?=$m_curr?>">
                    <input type="hidden" name="m_desc" value="<?=$m_desc?>">
                    <input type="hidden" name="m_sign" value="<?=$sign?>">
                    <input type="submit" name="m_process" value="send" />
                </form>

                <div class="col-md-6 col-xl-3">
                    <a @if($rate->name == 'Primary') onclick="return false;" @else href="https://payeer.com/merchant/?m_shop={{$m_shop}}&m_orderid={{$m_orderid}}&m_amount={{$m_amount}}&m_curr={{$m_curr}}&m_desc={{$m_desc}}&m_sign={{$sign}}&lang=ru" @endif class="block block-link-pop block-rounded block-bordered text-center c-pointer" target="_blank">
                        <div class="block-header">
                            <h3 class="block-title">
                                @if($user->rate_name == $rate->name) <i class="fa fa-check"></i> @endif
                                {{ $rate->name }}
                            </h3>
                        </div>
                        <div class="block-content bg-body-light">
                            <div class="h1 font-w700 mb-10 @if($user->rate_name == $rate->name) text-primary @endif">{{ $rate->price }}р</div>
                            <div class="h5 text-muted">месяц</div>
                        </div>
                        <div class="block-content">
                            <p>Пользователи <strong>{{ $rate->users }}</strong></p>
                            <p>Хранилище <strong>{{ \App\Modules\Storage\Calculator::bToGb($rate->space) }}GB</strong></p>
                        </div>
                        <div class="block-content block-content-full">
                            <span class="btn btn-hero btn-sm btn-rounded btn-noborder @if($user->rate_name == $rate->name) btn-alt-primary @else btn-primary @endif">
                                <i class="si  @if($better == false) si-arrow-down @else si-arrow-up @endif mr-5"></i>
                                @if($user->rate_name == $rate->name and $rate->name != 'Primary') Продлить @else Обновить @endif
                            </span>
                        </div>
                    </a>
                </div>
            @endforeach

        </div>
    </div>

@endsection
