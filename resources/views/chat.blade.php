@extends('layouts.hf')

@section('title', 'Чат')

@section('js')
    <script src="{{ URL::asset('js/pages/chat.js') }}"></script>
@endsection

@section('content')

    <div id="chat" class="row no-gutters content content-full chat">

        <div class="js-chat-options d-none d-md-block col-md-6 col-lg-4 bg-white border-right">

            <div class="js-chat-logged-user m-15 p-15 d-flex align-items-center justify-content-between rounded bg-body-light">
                <div class="d-flex align-items-center">
                    <a class="img-link img-status" href="javascript:void(0)">
                        <img class="img-avatar img-avatar32" src="{{ URL::asset('media/avatars/avatar15.jpg') }}" alt="Avatar">
                        <div class="img-status-indicator bg-success"></div>
                    </a>
                    <div class="ml-10">
                        <a class="font-w600" href="javascript:void(0)">John Doe</a>
                        <div class="font-size-sm text-muted">Web Developer</div>
                    </div>
                </div>
                <div class="ml-10">
                    <button type="button" class="btn btn-sm btn-circle btn-alt-secondary" data-toggle="dropdown">
                        <i class="fa fa-cog"></i>
                    </button>

                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="javascript:void(0)">
                            <i class="fa fa-fw fa-user mr-5"></i> View Profile
                        </a>
                        <a class="dropdown-item" href="javascript:void(0)">
                            <i class="fa fa-fw fa-pencil mr-5"></i> Edit Profile
                        </a>
                        <a class="dropdown-item" href="javascript:void(0)">
                            <i class="fa fa-fw fa-eye mr-5"></i> Change Visibility
                        </a>
                        <a class="dropdown-item mb-0" href="javascript:void(0)">
                            <i class="fa fa-fw fa-cog mr-5"></i> Settings
                        </a>
                    </div>

                    <button type="button" class="d-md-none btn btn-sm btn-circle btn-alt-success ml-5" data-toggle="class-toggle" data-target=".js-chat-options" data-class="d-none">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>
            </div>

            <div class="block block-transparent mb-0">

                <div id="chat_dialogs" class="js-chat-tabs-content block-content tab-content p-0 chat_dialogs">

                    <div class="tab-pane active p-15" id="chat-tabs-chats" role="tabpanel" data-simplebar>

                        <div class="push">
                            <ul class="chat-list">
                                <li class="chat-list-item">
                                    <div class="mr-10">
                                        <a class="img-link img-status" href="javascript:void(0)">
                                            <img class="img-avatar img-avatar48" src="{{ URL::asset('media/avatars/avatar4.jpg') }}" alt="">
                                            <div class="img-status-indicator bg-success"></div>
                                        </a>
                                    </div>
                                    <div>
                                        <a class="font-w600" href="javascript:void(0)">Judy Ford</a>
                                        <div class="font-size-xs text-muted">
                                            Hello there!
                                        </div>
                                    </div>
                                    <div class="ml-auto">
                                        <span class="badge badge-danger badge-pill">2</span>
                                    </div>
                                </li>
                                <li class="chat-list-item">
                                    <div class="mr-10">
                                        <a class="img-link img-status" href="javascript:void(0)">
                                            <img class="img-avatar img-avatar48" src="{{ URL::asset('media/avatars/avatar4.jpg') }}" alt="">
                                            <div class="img-status-indicator bg-success"></div>
                                        </a>
                                    </div>
                                    <div>
                                        <a class="font-w600" href="javascript:void(0)">Henry Harrison</a>
                                        <div class="font-size-xs text-muted">
                                            It's ready..
                                        </div>
                                    </div>
                                    <div class="ml-auto">
                                        <span class="badge badge-danger badge-pill">5</span>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="push">
                            <ul class="chat-list">
                                <li class="chat-list-item">
                                    <div class="mr-10">
                                        <a class="img-link img-status" href="javascript:void(0)">
                                            <img class="img-avatar img-avatar48" src="{{ URL::asset('media/avatars/avatar4.jpg') }}" alt="">
                                            <div class="img-status-indicator bg-success"></div>
                                        </a>
                                    </div>
                                    <div>
                                        <a class="font-w600" href="javascript:void(0)">Laura Carr</a>
                                        <div class="font-size-xs text-muted">
                                            Could you check out this PSD?
                                        </div>
                                    </div>
                                    <div class="ml-auto">
                                        <span class="badge badge-danger badge-pill">5</span>
                                    </div>
                                </li>
                                <li class="chat-list-item">
                                    <div class="mr-10">
                                        <a class="img-link img-status" href="javascript:void(0)">
                                            <img class="img-avatar img-avatar48" src="{{ URL::asset('media/avatars/avatar13.jpg') }}" alt="">
                                            <div class="img-status-indicator bg-success"></div>
                                        </a>
                                    </div>
                                    <div>
                                        <a class="font-w600" href="javascript:void(0)">David Fuller</a>
                                        <div class="font-size-xs text-muted">
                                            Hey John, how are you?
                                        </div>
                                    </div>
                                    <div class="ml-auto">
                                        <span class="badge badge-danger badge-pill">2</span>
                                    </div>
                                </li>
                                <li class="chat-list-item">
                                    <div class="mr-10">
                                        <a class="img-link img-status" href="javascript:void(0)">
                                            <img class="img-avatar img-avatar48" src="{{ URL::asset('media/avatars/avatar1.jpg') }}" alt="">
                                            <div class="img-status-indicator bg-success"></div>
                                        </a>
                                    </div>
                                    <div>
                                        <a class="font-w600" href="javascript:void(0)">Megan Fuller</a>
                                        <div class="font-size-xs text-muted">
                                            Can you please call me?
                                        </div>
                                    </div>
                                    <div class="ml-auto">
                                        <span class="badge badge-danger badge-pill">8</span>
                                    </div>
                                </li>
                                <li class="chat-list-item">
                                    <div class="mr-10">
                                        <a class="img-link img-status" href="javascript:void(0)">
                                            <img class="img-avatar img-avatar48" src="{{ URL::asset('media/avatars/avatar12.jpg') }}" alt="">
                                            <div class="img-status-indicator bg-success"></div>
                                        </a>
                                    </div>
                                    <div>
                                        <a class="font-w600" href="javascript:void(0)">Wayne Garcia</a>
                                        <div class="font-size-xs text-muted">
                                            This is very interesting..
                                        </div>
                                    </div>
                                    <div class="ml-auto">
                                        <span class="badge badge-danger badge-pill">7</span>
                                    </div>
                                </li>
                            </ul>
                        </div>

                    </div>

                </div>
            </div>

            <div class="d-md-none py-5 bg-body-dark"></div>
        </div>

        <div id="chat_right" class="col-md-6 col-lg-8 bg-white d-flex flex-column">
            <div class="js-chat-active-user p-15 d-flex align-items-center justify-content-between bg-white">
                <div class="d-flex align-items-center">
                    <a class="img-link img-status" href="javascript:void(0)">
                        <img class="img-avatar img-avatar32" src="{{ URL::asset('media/avatars/avatar12.jpg') }}" alt="Avatar">
                        <div class="img-status-indicator bg-success"></div>
                    </a>
                    <div class="ml-10">
                        <a class="font-w600" href="javascript:void(0)">Justin Smith</a>
                        <div class="font-size-sm text-muted">Web Designer</div>
                    </div>
                </div>
                <div class="ml-10">
                    <button type="button" class="btn btn-sm btn-circle btn-alt-secondary" data-toggle="dropdown">
                        <i class="fa fa-ellipsis-v"></i>
                    </button>

                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="javascript:void(0)">
                            <i class="fa fa-fw fa-thumb-tack mr-5"></i> Pin to top
                        </a>
                        <a class="dropdown-item" href="javascript:void(0)">
                            <i class="fa fa-fw fa-trash mr-5"></i> Delete Chat
                        </a>
                        <a class="dropdown-item mb-0" href="javascript:void(0)">
                            <i class="fa fa-fw fa-ban mr-5"></i> Block
                        </a>
                    </div>

                    <button type="button" class="d-md-none btn btn-sm btn-circle btn-alt-success ml-5" data-toggle="class-toggle" data-target=".js-chat-options" data-class="d-none">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>
            </div>

            <div class="js-chat-window p-15 bg-light flex-grow-1 text-wrap-break-word overflow-y-auto">
                <div class="d-flex mb-20">
                    <div>
                        <a class="img-link img-status" href="javascript:void(0)">
                            <img class="img-avatar img-avatar32" src="{{ URL::asset('media/avatars/avatar12.jpg') }}" alt="Avatar">
                            <div class="img-status-indicator bg-success"></div>
                        </a>
                    </div>
                    <div class="mx-10">
                        <div>
                            <p class="bg-body-dark text-dark rounded px-15 py-10 mb-5">
                                Hello there! How are you? I would like to ask you a couple of questions regarding the active project.
                            </p>
                        </div>
                        <div class="text-muted font-size-xs font-italic">10 min ago</div>
                    </div>
                </div>

                <div class="d-flex flex-row-reverse mb-20">
                    <div>
                        <a class="img-link img-status" href="javascript:void(0)">
                            <img class="img-avatar img-avatar32" src="{{ URL::asset('media/avatars/avatar15.jpg') }}" alt="Avatar">
                            <div class="img-status-indicator bg-success"></div>
                        </a>
                    </div>
                    <div class="mx-10 text-right">
                        <div>
                            <p class="bg-primary-lighter text-primary-darker rounded px-15 py-10 mb-5 d-inline-block">
                                Hi Justin! Sure thing!
                            </p>
                        </div>
                        <div>
                            <p class="bg-primary-lighter text-primary-darker rounded px-15 py-10 mb-5 d-inline-block">
                                Let me know what you would like to know.
                            </p>
                        </div>
                        <div class="text-right text-muted font-size-xs font-italic">just now</div>
                    </div>
                </div>
            </div>

            <div class="js-chat-message p-10 mt-auto">
                <form action="be_comp_chat_multiple_alt.html" method="POST" onsubmit="return false;">
                    <div class="d-flex align-items-center">
                        <button type="button" class="btn btn-alt-secondary btn-circle mr-5">
                            <i class="fa fa-fw fa-paperclip font-size-lg"></i>
                        </button>

                        <input type="text" class="form-control flex-grow mr-5" placeholder="Type a message..">

                        <button type="submit" class="btn btn-circle btn-alt-primary">
                            <i class="fa fa-share-square"></i>
                        </button>
                    </div>
                </form>
            </div>

        </div>

    </div>

@endsection
