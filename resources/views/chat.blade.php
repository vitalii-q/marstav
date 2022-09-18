@extends('layouts.hf')

@section('title', 'Чат')

@section('js')
    <script src="{{ URL::asset('js/pages/chat.js') }}"></script>
@endsection

@section('content')
    <?php
        $user = \Illuminate\Support\Facades\Auth::user();
    ?>

    <div id="chat" class="row no-gutters content content-full chat">

        <div class="js-chat-options d-none d-md-block col-md-6 col-lg-4 bg-white border-right">

            <div class="js-chat-logged-user m-15 p-15 d-flex align-items-center justify-content-between rounded bg-body-light">
                <div class="d-flex align-items-center">
                    <a class="img-link img-status" href="{{ route('profile.show', $user->code) }}">
                        <div class="img-avatar avatar48" style="background-image: url({{ $user->photo }})"></div>
                    </a>
                    <div class="ml-10">
                        <a class="font-w600" href="{{ route('profile.show', $user->code) }}">{{ $user->surname.' '.$user->name }}</a>
                        <!--<div class="font-size-sm text-muted">Web Developer</div>-->
                    </div>
                </div>
                <div class="ml-10">
                    <button type="button" class="btn btn-sm btn-circle btn-alt-secondary" data-toggle="dropdown">
                        <i class="si si-settings"></i>
                    </button>

                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{ route('profile.show' , $user->code) }}">
                            <i class="si si-user mr-5"></i> Профайл
                        </a>
                        <a class="dropdown-item" href="{{ route('profile.edit' , $user->code) }}">
                            <i class="si si-pencil mr-5"></i> Редактировать
                        </a>
                        <a class="dropdown-item mb-0" href="{{ route('settings') }}">
                            <i class="si si-settings mr-5"></i> Настройки
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

                                @foreach($employees as $employee)
                                <?php
                                    $new_messages = \App\Models\Message::query()->where('from_id', $employee->id)->where('to_id', $user->id)->where('view', null)->get();
                                ?>
                                <li class="chat-list-item">
                                    <div class="mr-10">
                                        <a onclick="openDialog('{{ $employee->code }}')" class="img-link img-status" href="javascript:void(0)">
                                            <div class="img-avatar avatar48" style="background-image: url({{ $employee->photo }})"></div>
                                        </a>
                                    </div>
                                    <div>
                                        <a onclick="openDialog('{{ $employee->code }}')" class="font-w600" href="javascript:void(0)">{{ $employee->surname.' '.$employee->name }}</a>
                                        <!--<div class="font-size-xs text-muted">
                                            Hello there!
                                        </div>-->
                                    </div>
                                    <div class="ml-auto">
                                        <span id="new_mess_count_{{$employee->code}}" class="badge badge-danger badge-pill @if(!count($new_messages)) d-none @endif">{{ count($new_messages) }}</span>
                                    </div>
                                </li>
                                @endforeach

                            </ul>
                        </div>

                    </div>

                </div>
            </div>

            <div class="d-md-none py-5 bg-body-dark"></div>
        </div>

        <div id="chat_right" class="col-md-6 col-lg-8 bg-white d-flex flex-column">
            <div id="dialog_top" class="js-chat-active-user p-15 align-items-center justify-content-between bg-white d-none">
                <div class="d-flex align-items-center">
                    <a id="dialog_avatar_link" class="img-link img-status" href="javascript:void(0)">
                        <div id="dialog_avatar" class="img-avatar avatar32" style=""></div>
                    </a>
                    <div class="ml-10">
                        <a id="chat_name" class="font-w600" href=""></a>
{{--                        <div class="font-size-sm text-muted">Web Designer</div>--}}
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

            <div id="dialog_wrapper" class="js-chat-window p-15 bg-light flex-grow-1 text-wrap-break-word overflow-y-auto d-none">
            <div id="dialog">
            </div>
            </div>

            <div id="dialog_bottom" class="js-chat-message p-10 mt-auto d-none">
                <form id="message_form" method="POST" enctype="multipart/form-data" onsubmit="return false;">
                    @csrf

                    <div id="files_info" class="alert alert-info d-none mb-10"></div>
                    <div id="files_error" class="alert alert-danger d-none mb-10"></div>
                    @error('files')
                    <div class="alert alert-danger mb-10">{{ $message }}</div>
                    @enderror
                    @error('files.*')
                    <div class="alert alert-danger mb-10">{{ $message }}</div>
                    @enderror
                    @error('text')
                    <div class="alert alert-danger mb-10">{{ $message }}</div>
                    @enderror

                    <div class="d-flex align-items-center">
                        <button onclick="document.getElementById('files').click()" type="button" class="btn btn-alt-secondary btn-circle mr-5">
                            <i class="fa fa-fw fa-paperclip font-size-lg"></i>
                        </button>

                        <input id="files" onchange="inputFilesCountNotification()" type="file" class="d-none" name="files[]" value="" accept="*" multiple>

                        <textarea id="text" type="text" class="form-control flex-grow mr-5" name="text" placeholder="Введите сообщение.."></textarea>

                        <button id="send_button" onclick="" type="button" class="btn btn-circle btn-alt-primary">
                            <i class="fa fa-share-square"></i>
                        </button>
                    </div>
                </form>
            </div>

            <div id="chat_stub" class="hero bg-white bg-pattern stub minh-auto" style="background-image: url({{ URL::asset('media/various/bg-pattern-inverse.png') }});">
                <div class="hero-inner">
                    <div class="content content-full">
                        <div class="py-50 text-center">
                            <i class="si si-bubbles text-primary display-3"></i>
                            <h1 class="h2 font-w700 mt-30 mb-10">Выберите диалог</h1>
                            <h2 class="h3 font-w400 text-muted stub-text mb-50">Здесь вы можете обмениваться сообщениями</h2>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection
