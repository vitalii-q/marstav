@extends('layouts.hf')

@section('title', 'Сделки')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('js/plugins/flatpickr/flatpickr.min.css') }}">
@endsection

@section('js')
    <script src="{{ URL::asset('js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ URL::asset('js/plugins/flatpickr/flatpickr.min.js') }}"></script>

    <script>jQuery(function(){ Codebase.helpers(['flatpickr', 'datepicker']); });</script>

    <script src="{{ URL::asset('js/pages/deals.js') }}"></script>
@endsection

@section('content')

    <div class="content">
        @if(session()->has('info'))
            <p class="alert alert-info">{{ session()->get('info') }}</p>
        @endif

        <div class="content-heading pt-8">
            <div class="dropdown float-right">
                <a id="add_deal_btn" type="button" class="btn btn-square btn-primary min-width-125 text-white" data-toggle="modal" data-target="#modal_add_deal">Добавить сделку</a>
                <a id="settings" href="{{ route('deals.settings') }}" type="button" class="btn text-white btn-square btn-primary min-width-125">Настройки</a>
            </div>
            Сделки
        </div>

        <div class="deals_wrapper">

            @if(count($stages))
                @if($deals_count)
                    <div class="arrow_wrapper">
                        <div id="arrow_left_block" class="arrow_block arrow_left_block d-none">
                            <i class="arrow_left_icon si si-arrow-left ml-5 fs-12"></i>
                        </div>
                    </div>
                @endif

                <div id="deals" class="deals bs-none bg-none">

                    <div class="block-content block-content-full p-0 mb-15">

                        <div id="stages_list" class="stages_list d-flex">

                            @php($i=1) @foreach($stages as $stage)
                                <div class="stage_title" style="background-color: {{ $stage->color }}">{{ $stage->title }}
                                    @if(count($stages) == $i)
                                    <div class="stage_title_form_square" style="background-color: {{ $stage->color }}"></div>
                                    @else
                                    <div class="stage_title_form_arrow" style="background-color: {{ $stage->color }}"></div>
                                    @endif
                                </div>
                            @php($i++) @endforeach

                        </div>

                        @if(!$deals_count)
                            <div onclick="document.getElementById('add_deal_btn').click()" id="deals_stub" class="hero bg-white bg-pattern stub h-auto minh-auto" style="background-image: url({{ URL::asset('media/various/bg-pattern-inverse.png') }});">
                                <div class="hero-inner">
                                    <div class="content content-full">
                                        <div class="py-50 text-center">
                                            <i class="si si-handbag text-primary display-3"></i>
                                            <h1 class="h2 font-w700 mt-30 mb-10">Нет сделок</h1>
                                            <h2 class="h3 font-w400 text-muted stub-text mb-50">Здесь вы можете управлять сделками</h2>
                                            <a class="btn btn-hero btn-noborder btn-rounded btn-primary text-white">
                                                <i class="si si-check mr-10"></i> Добавить сделку
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else

                            <div id="deals_list" class="deals_list d-flex">

                                @php($i=1) @foreach($stages as $stage)
                                <div class="stage_deals">
                                    <?php
                                    $deals = \App\Models\Entities\Deal::query()
                                        ->select('id', 'status', 'name', 'phone', 'email', 'position', 'company', 'product', 'price', 'deadline', 'note', 'code')
                                        ->where('user_id', $user->id)->where('stage_id', $stage->id)->where('deadline', '!=', null)->orderBy('deadline')
                                        ->get();
                                    $deals_null_deadline = \App\Models\Entities\Deal::query()
                                        ->select('id', 'status', 'name', 'phone', 'email', 'position', 'company', 'product', 'price', 'deadline', 'note', 'code')
                                        ->where('user_id', $user->id)->where('stage_id', $stage->id)->where('deadline', null)->orderBy('updated_at', 'desc')
                                        ->get();
                                    $deals = $deals->merge($deals_null_deadline);

                                    if (count($stages) == $i) {$last = 'true'; } else { $last = 'false'; }
                                    ?>

                                    @foreach($deals as $deal)
                                        <?php unset($deal->id);
                                        if($deal->deadline) {
                                            $deadline = str_replace([' ', '-', ':'], '', date('Y-m-d', strtotime($deal->deadline)));
                                            $today = str_replace([' ', '-', ':'], '', date('Y-m-d', strtotime(\Carbon\Carbon::today())));

                                            if ($deadline < $today) { $border = 'border-left: solid 3px #FF0A1C'; }
                                            elseif ($deadline == $today) { $border = 'border-left: solid 3px #F2F800'; }
                                            elseif ($deadline > $today) { $border = 'border-left: solid 3px #38F02A'; }
                                        } else { $border = 'border-left: solid 3px #ffffff'; }
                                        ?>
                                        <div class="stage_deal" style="{{ $border }}">
                                            <p class="stage_deal_name mb-2">{{ mb_strimwidth($deal->name, 0, 40, "..") }}</p>
                                            <p class="mb-5">{{ mb_strimwidth($deal->status, 0, 30, "..") }}</p>
                                            <p class="mb-10">{{ mb_strimwidth($deal->note, 0, 80, "..") }}</p>

                                            <div class="d-flex">
                                                <?php
                                                if ($deal->deadline) {
                                                    $deadline_exp = explode('-', date('m-d H:i', strtotime($deal->deadline)));
                                                    $deadline_exp_2 = explode(' ', $deadline_exp[1]);
                                                    //dump($deadline_exp_2);

                                                    $date = \App\Helpers\Date::getDay($deadline_exp_2[0]).' '.\App\Helpers\Date::getMonth($deadline_exp[0]).' '.$deadline_exp_2[1];
                                                }
                                                ?>
                                                <p class="stage_deal_date text-darkgray mb-0">{{ $deal->deadline?$date:'' }}</p>

                                                <button onclick="openDeal({{ $deal }}, {{ $last }})" class="btn btn-sm btn-primary stage_deal_btn" data-toggle="modal" data-target="#modal_change_deal">Открыть</button>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                                @php($i++) @endforeach

                                <div id="deals_scroll_wrapper" class="deals_scroll_wrapper">
                                    <div id="scroll" class="deals_scroll d-none"></div>
                                </div>

                            </div>
                        @endif

                        @if($deals_count)
                            <div id="arrow_bottom_wrapper" class="arrow_bottom_wrapper">
                                <div id="arrow_bottom_block" class="arrow_block arrow_bottom_block d-none">
                                    <i class="arrow_bottom_icon si si-arrow-down ml-5 fs-12"></i>
                                </div>
                            </div>
                        @endif

                    </div>

                </div>

                @if($deals_count)
                    <div class="arrow_wrapper arrow_wrapper_right">
                        <div id="arrow_right_block" class="arrow_block arrow_right_block d-none">
                            <i class="arrow_right_icon si si-arrow-right ml-5 fs-12"></i>
                        </div>
                    </div>
                @endif

            @else
                <div onclick="document.getElementById('settings').click()" id="stages_stub" class="hero bg-white bg-pattern stub h-auto minh-auto" style="background-image: url({{ URL::asset('media/various/bg-pattern-inverse.png') }});">
                    <div class="hero-inner">
                        <div class="content content-full">
                            <div class="py-50 text-center">
                                <i class="si si-layers text-primary display-3"></i>
                                <h1 class="h2 font-w700 mt-30 mb-10">Этапы сделок</h1>
                                <h2 class="h3 font-w400 text-muted stub-text mb-50">Здесь вы можете управлять сделками</h2>
                                <a class="btn btn-hero btn-noborder btn-rounded btn-primary text-white">
                                    <i class="si si-settings mr-10"></i> Настроить этапы
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>

    </div>

    <div class="modal fade" id="modal_add_deal" tabindex="-1" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Добавление сделки</h3>
                        <div class="block-options">
                            <button id="modal_add_deal_close" class="btn-block-option modal_close_btn" type="button" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>

                    <div class="block-content">

                        <form id="add_deal_form" action="" method="POST">

                        <div class="row items-push">

                            <div class="col-xl-6">

                                <div class="form-row">
                                    <div class="form-group col-lg-12">
                                        <div class="form-material">
                                            <input type="text" class="js-flatpickr form-control js-flatpickr-enabled flatpickr-input add_deal_name" id="name" name="name" placeholder="Введите имя..">
                                            <label for="name">Имя</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-lg-12">
                                        <div class="form-material">
                                            <input type="text" class="js-flatpickr form-control js-flatpickr-enabled flatpickr-input add_deal_phone" id="phone" name="phone" placeholder="Введите номер..">
                                            <label for="phone">Телефон</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-lg-12">
                                        <div class="form-material">
                                            <input type="text" class="js-flatpickr form-control js-flatpickr-enabled flatpickr-input add_deal_email" id="email" name="email" placeholder="Введите email..">
                                            <label for="email">Email</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-lg-12">
                                        <div class="form-material">
                                            <input type="text" class="js-flatpickr form-control js-flatpickr-enabled flatpickr-input add_deal_product" id="product" name="product" placeholder="Введите продукт..">
                                            <label for="product">Продукт / Товар</label>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-xl-6">

                                <div class="form-row">
                                    <div class="form-group col-lg-12">
                                        <div class="form-material">
                                            <input type="text" class="datepicker js-flatpickr form-control add_deal_deadline" id="datetime" name="deadline" placeholder="Введите дату.." data-allow-input="true" data-enable-time="true" data-time_24hr="true">
                                            <label for="datetime">Дедлайн</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-lg-12">
                                        <div class="form-material">
                                            <input type="text" class="js-flatpickr form-control js-flatpickr-enabled flatpickr-input add_deal_position" id="position" name="position" placeholder="Введите должность..">
                                            <label for="position">Должность</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-lg-12">
                                        <div class="form-material">
                                            <input type="text" class="js-flatpickr form-control js-flatpickr-enabled flatpickr-input add_deal_company" id="company" name="company" placeholder="Введите компанию..">
                                            <label for="company">Компания</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-lg-12">
                                        <div class="form-material">
                                            <input type="text" class="js-flatpickr form-control js-flatpickr-enabled flatpickr-input add_deal_price" id="price" name="price" placeholder="Введите цену..">
                                            <label for="price">Цена</label>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-xl-12">
                                <div class="form-group row mt--20">
                                    <div class="col-12">
                                        <div class="form-material">
                                            <input type="text" class="js-flatpickr form-control js-flatpickr-enabled flatpickr-input add_deal_status" id="status" name="status" placeholder="Введите цену..">
                                            <label for="price">Статус</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-12">
                                        <div class="form-material">
                                            <textarea class="form-control add_deal_note" id="note" name="note" rows="8" placeholder="Начните писать.."></textarea>
                                            <label for="note">Заметки</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                            <p id="add_deal_form_error" class="alert alert-danger d-none">{{ session()->get('error') }}</p>
                        </form>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Отменить</button>
                    <button onclick="addDeal()" type="button" class="btn btn-alt-success">
                        <i class="si si-check"></i> Добавить
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_change_deal" tabindex="-1" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Сделка</h3>
                        <div class="block-options">
                            <button id="modal_change_deal_close" class="btn-block-option modal_close_btn" type="button" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>

                    <div class="block-content">

                        <form id="change_deal_form" action="" method="POST">

                            <div class="row items-push">

                                <div class="col-xl-6">

                                    <div class="form-row">
                                        <div class="form-group col-lg-12">
                                            <div class="form-material">
                                                <input type="text" class="js-flatpickr form-control js-flatpickr-enabled flatpickr-input change_deal_name" id="name" name="name" placeholder="Введите имя..">
                                                <label for="name">Имя</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-lg-12">
                                            <div class="form-material">
                                                <input type="text" class="js-flatpickr form-control js-flatpickr-enabled flatpickr-input change_deal_phone" id="phone" name="phone" placeholder="Введите номер..">
                                                <label for="phone">Телефон</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-lg-12">
                                            <div class="form-material">
                                                <input type="text" class="js-flatpickr form-control js-flatpickr-enabled flatpickr-input change_deal_email" id="email" name="email" placeholder="Введите email..">
                                                <label for="email">Email</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-lg-12">
                                            <div class="form-material">
                                                <input type="text" class="js-flatpickr form-control js-flatpickr-enabled flatpickr-input change_deal_product" id="product" name="product" placeholder="Введите продукт..">
                                                <label for="product">Продукт / Товар</label>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-xl-6">

                                    <div class="form-row">
                                        <div class="form-group col-lg-12">
                                            <div class="form-material">
                                                <input type="text" class="datepicker js-flatpickr form-control change_deal_deadline" id="datetime" name="deadline" placeholder="Введите дату.." maxlength="16" data-allow-input="true" data-enable-time="true" data-time_24hr="true">
                                                <label for="datetime">Дедлайн</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-lg-12">
                                            <div class="form-material">
                                                <input type="text" class="js-flatpickr form-control js-flatpickr-enabled flatpickr-input change_deal_position" id="position" name="position" placeholder="Введите должность..">
                                                <label for="position">Должность</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-lg-12">
                                            <div class="form-material">
                                                <input type="text" class="js-flatpickr form-control js-flatpickr-enabled flatpickr-input change_deal_company" id="company" name="company" placeholder="Введите компанию..">
                                                <label for="company">Компания</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-lg-12">
                                            <div class="form-material">
                                                <input type="text" class="js-flatpickr form-control js-flatpickr-enabled flatpickr-input change_deal_price" id="price" name="price" placeholder="Введите цену..">
                                                <label for="price">Цена</label>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-xl-12">
                                    <div class="form-group row mt--20">
                                        <div class="col-12">
                                            <div class="form-material">
                                                <input type="text" class="js-flatpickr form-control js-flatpickr-enabled flatpickr-input change_deal_status" id="status" name="status" placeholder="Введите цену..">
                                                <label for="price">Статус</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-12">
                                            <div class="form-material">
                                                <textarea class="form-control change_deal_note" id="note" name="note" rows="8" placeholder="Начните писать.."></textarea>
                                                <label for="note">Заметки</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <p id="change_deal_form_error" class="alert alert-danger d-none"></p>
                        </form>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Отменить</button>
                    <button id="update_deal_btn"  type="button" class="btn btn-alt-primary">
                        <i class="si si-refresh"></i> Обновить
                    </button>
                    <button id="close_deal_btn" onclick="" type="button" class="btn btn-alt-danger">
                        <i class="si si-check"></i> Завершить
                    </button>
                    <button id="next_deal_btn" onclick="" type="button" class="btn btn-alt-success">
                        <i class="si si-check"></i> Следующий этап
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection
