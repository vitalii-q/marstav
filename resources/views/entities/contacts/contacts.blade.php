@extends('layouts.hf')

@section('title', 'Контакты')

@section('js')
    <script src="{{ URL::asset('js/pages/contacts.js') }}"></script>
@endsection

@section('content')

    <div id="contacts" class="row no-gutters content content-full contacts jc-c">
        <!-- Left Column -->
        <div class="js-chat-options d-none d-md-block col-md-6 col-lg-4 bg-white border-right">

            <div class="js-chat-logged-user m-15 d-flex align-items-center justify-content-between rounded ">

                <button type="button" class="btn btn-primary w-100">Добавить контакт</button>

            </div>

            <!-- Search -->
            <div class="js-chat-search px-15 pb-5">
                <form action="be_comp_chat_multiple_alt.html" method="POST" onsubmit="return false;">
                    <div class="form-group mb-0">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button type="submit" class="btn btn-light">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>

                            <input type="text" class="form-control" placeholder="Поиск..">
                        </div>
                    </div>
                </form>
            </div>
            <!-- END Search -->

            <!-- Chat Tabs -->
            <div class="block block-transparent mb-0">
                <ul class="js-chat-tabs nav nav-tabs nav-tabs-alt nav-justified px-15">
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

                                <li class="chat-list-item">
                                    <div class="mr-10">
                                        <a class="img-link img-status" href="javascript:void(0)">
                                            <img class="img-avatar img-avatar48" src="{{ URL::asset('media/avatars/avatar16.jpg') }}" alt="">
                                        </a>
                                    </div>
                                    <div>
                                        <a class="font-w600" href="javascript:void(0)">Henry Harrison</a>
                                        <div class="font-size-xs text-muted">
                                            Web Design
                                        </div>
                                    </div>
                                    <div class="ml-auto">
                                        <a class="btn btn-sm btn-circle btn-alt-warning my-5 mr-5" href="javascript:void(0)">
                                            <i class="fa fa-phone"></i>
                                        </a>
                                        <a class="btn btn-sm btn-circle btn-alt-info my-5 mr-5" href="javascript:void(0)">
                                            <i class="fa fa-video-camera"></i>
                                        </a>
                                        <a class="btn btn-sm btn-circle btn-alt-success my-5" href="javascript:void(0)">
                                            <i class="fa fa-comment"></i>
                                        </a>
                                    </div>
                                </li>

                                <li class="chat-list-item">
                                    <div class="mr-10">
                                        <a class="img-link img-status" href="javascript:void(0)">
                                            <img class="img-avatar img-avatar48" src="{{ URL::asset('media/avatars/avatar16.jpg') }}" alt="">
                                        </a>
                                    </div>
                                    <div>
                                        <a class="font-w600" href="javascript:void(0)">Henry Harrison</a>
                                        <div class="font-size-xs text-muted">
                                            Web Design
                                        </div>
                                    </div>
                                    <div class="ml-auto">
                                        <a class="btn btn-sm btn-circle btn-alt-warning my-5 mr-5" href="javascript:void(0)">
                                            <i class="fa fa-phone"></i>
                                        </a>
                                        <a class="btn btn-sm btn-circle btn-alt-info my-5 mr-5" href="javascript:void(0)">
                                            <i class="fa fa-video-camera"></i>
                                        </a>
                                        <a class="btn btn-sm btn-circle btn-alt-success my-5" href="javascript:void(0)">
                                            <i class="fa fa-comment"></i>
                                        </a>
                                    </div>
                                </li>

                                <li class="chat-list-item">
                                    <div class="mr-10">
                                        <a class="img-link img-status" href="javascript:void(0)">
                                            <img class="img-avatar img-avatar48" src="{{ URL::asset('media/avatars/avatar16.jpg') }}" alt="">
                                        </a>
                                    </div>
                                    <div>
                                        <a class="font-w600" href="javascript:void(0)">Henry Harrison</a>
                                        <div class="font-size-xs text-muted">
                                            Web Design
                                        </div>
                                    </div>
                                    <div class="ml-auto">
                                        <a class="btn btn-sm btn-circle btn-alt-warning my-5 mr-5" href="javascript:void(0)">
                                            <i class="fa fa-phone"></i>
                                        </a>
                                        <a class="btn btn-sm btn-circle btn-alt-info my-5 mr-5" href="javascript:void(0)">
                                            <i class="fa fa-video-camera"></i>
                                        </a>
                                        <a class="btn btn-sm btn-circle btn-alt-success my-5" href="javascript:void(0)">
                                            <i class="fa fa-comment"></i>
                                        </a>
                                    </div>
                                </li>

                                <li class="chat-list-item">
                                    <div class="mr-10">
                                        <a class="img-link img-status" href="javascript:void(0)">
                                            <img class="img-avatar img-avatar48" src="{{ URL::asset('media/avatars/avatar16.jpg') }}" alt="">
                                        </a>
                                    </div>
                                    <div>
                                        <a class="font-w600" href="javascript:void(0)">Henry Harrison</a>
                                        <div class="font-size-xs text-muted">
                                            Web Design
                                        </div>
                                    </div>
                                    <div class="ml-auto">
                                        <a class="btn btn-sm btn-circle btn-alt-warning my-5 mr-5" href="javascript:void(0)">
                                            <i class="fa fa-phone"></i>
                                        </a>
                                        <a class="btn btn-sm btn-circle btn-alt-info my-5 mr-5" href="javascript:void(0)">
                                            <i class="fa fa-video-camera"></i>
                                        </a>
                                        <a class="btn btn-sm btn-circle btn-alt-success my-5" href="javascript:void(0)">
                                            <i class="fa fa-comment"></i>
                                        </a>
                                    </div>
                                </li>

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

        </div>
        <!-- END Right Column -->
    </div>

@endsection
