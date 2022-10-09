@extends('layouts.hf')

@section('title', 'Контакты')

@section('js')
    <script src="{{ URL::asset('js/pages/contacts.js') }}"></script>
@endsection

@section('content')

    <div id="contacts" class="row no-gutters content content-full contacts jc-c">

        <!-- Left Column -->
        <div class="js-chat-options d-none d-md-block col-md-6 col-lg-4 bg-white border-right">
            @if(session()->has('info'))
                <div class="col-12">
                    <p class="alert alert-info mt-10 mb-10">{{ session()->get('info') }}</p>
                </div>
            @endif

            <div class="js-chat-logged-user m-15 d-flex align-items-center justify-content-between rounded">
                <a href="{{ route('contacts.create') }}" type="button" class="btn btn-primary w-100">Добавить контакт</a>
            </div>

            <!-- Search -->
            <div class="js-chat-search px-15 pb-5">
                <form action="" method="POST" onsubmit="return false;">
                    <div class="form-group mb-0">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button type="submit" class="btn btn-light contacts_search-btn">
                                    <i class="si si-magnifier"></i>
                                </button>
                            </div>

                            <input onchange="contactsSearch(this)" type="text" class="form-control" placeholder="Поиск..">
                        </div>
                    </div>
                </form>
            </div>
            <!-- END Search -->

            <!-- Chat Tabs -->
            <div class="block block-transparent mb-0">
                <ul class="js-chat-tabs nav nav-tabs nav-tabs-alt nav-justified px-15 contacts_tabs">
                    <li class="nav-item">
                        <a class="nav-link active">
                            <i class="si si-call-end text-muted font-size-lg"></i>
                        </a>
                    </li>
                </ul>

                <div class="block block-transparent mb-0">
                    <div id="contacts_list" class="js-chat-tabs-content block-content tab-content p-0 contacts_list">

                        <div class="tab-pane p-15 active" id="chat-tabs-contacts">

                            <ul class="chat-list">

                                @foreach($contacts as $contact_item)
                                <div class="chat-list_item-wrapper">
                                    <a onclick="showContact('{{ $contact_item->code }}')" href="javascript:void(0)">
                                        <li class="chat-list-item">
                                            <div class="mr-10">
                                                <div class="img-link img-status">
                                                    <img class="img-avatar img-avatar48" src="{{ URL::asset('media/avatars/avatar16.jpg') }}" alt="">
                                                </div>
                                            </div>
                                            <div>
                                                <div class="font-w600 contact_name">{{ $contact_item->name .' '. $contact_item->surname }}</div>
                                                <div class="font-size-xs text-muted contacts_position">
                                                    {{ $contact_item->position }}
                                                </div>
                                            </div>
                                        </li>
                                    </a>
                                    <div class="contacts_buttons ml-auto">
                                        <a class="btn btn-sm btn-circle btn-alt-warning my-5 mr-5" href="tel:{{ $contact_item->phone }}">
                                            <i class="si si-call-out"></i>
                                        </a>
                                        <!--<a class="btn btn-sm btn-circle btn-alt-info my-5 mr-5" href="javascript:void(0)">
                                            <i class="fa fa-video-camera"></i>
                                        </a>
                                        <a class="btn btn-sm btn-circle btn-alt-success my-5" href="javascript:void(0)">
                                            <i class="fa fa-comment"></i>
                                        </a>-->
                                    </div>
                                </div>
                                @endforeach

                            </ul>

                        </div>

                    </div>
                </div>

            </div>
            <!-- END Chat Tabs -->

            <!-- Separator (visible on mobile) -->
            <div class="d-md-none py-5 bg-body-dark"></div>
        </div>
        <!-- END Left Column -->

        <!-- Right Column -->
        <div id="contacts_right" class="col-md-6 col-lg-6 bg-white d-flex flex-column">
            <div id="contact_info" class="col-12 contact_info d-none">
                @if(isset($contact))
                    <h3 class="mb-10">{{ $contact->surname.' '.$contact->name.' '.$contact->patronymic }}</h3>
                    <small class="fs-14">{{ $contact->born }}</small>

                    <hr>

                    <div class="form-group row">
                        <div class="col-12 col-lg-6 mb-10">
                            <label>Номер телефона</label>
                            <div class="">{{ $contact->phone }}</div>
                        </div>

                        <div class="col-12 col-lg-6 mb-10">
                            <label>Номер телефона (личный)</label>
                            <div class="">{{ $contact->private_phone }}</div>
                        </div>

                        <div class="col-12 col-lg-6 mb-10">
                            <label>Электронная почта</label>
                            <div class="">{{ $contact->email }}</div>
                        </div>

                        <div class="col-12 col-lg-6 mb-10">
                            <label>Электронная почта (личная)</label>
                            <div class="">{{ $contact->private_email }}</div>
                        </div>
                    </div>

                    <hr>

                    <div class="form-group row">
                        <div class="col-12 col-lg-6 mb-10">
                            <label>Должность</label>
                            <div class="">{{ $contact->position }}</div>
                        </div>

                        <div class="col-12 col-lg-6 mb-10">
                            <label>Компания</label>
                            <div class="">{{ $contact->company }}</div>
                        </div>

                        <div class="col-12 mb-10">
                            <label>Адрес</label>
                            <div class="">{{ $contact->address }}</div>
                        </div>
                    </div>

                    <hr>

                    <div class="form-group row mb-20">
                        <div class="col-12 mb-10">
                            {{ $contact->note }}
                        </div>
                    </div>

                    <a href="{{ route('contacts.edit', $contact->code) }}" type="button" class="btn btn-primary w-100 mb-20">Редактировать</a>
                @endif
            </div>

            @if(!isset($contact))
                <div id="contacts_stub" class="hero bg-white bg-pattern stub minh-auto overflow-hidden" style="background-image: url({{ URL::asset('media/various/bg-pattern-inverse.png') }});">
                    <div class="hero-inner">
                        <div class="content content-full">
                            <div class="py-50 text-center">
                                <i class="si si-call-end text-primary display-3"></i>
                                <h1 class="h2 font-w700 mt-30 mb-10">Контакты</h1>
                                <h2 class="h3 font-w400 text-muted stub-text mb-50">Здесь вы можете управлять вашими контактами</h2>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <!-- END Right Column -->
    </div>

@endsection
