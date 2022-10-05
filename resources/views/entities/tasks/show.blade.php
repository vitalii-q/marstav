@extends('layouts.hf')

@section('title', $task->title)

@section('css')

@endsection

@section('js')
    <script src="{{ URL::asset('js/pages/tasks.js') }}"></script>
@endsection

@section('content')
    <div class="content tasks">
        @if(session()->has('info'))
        <p class="alert alert-info">{{ session()->get('info') }}</p>
        @endif

        <div class="content-heading pt-8">
            <a href="{{ route('tasks.index') }}">Задачи</a>
            <small class="d-none d-sm-inline breadcrumb-item"> / {{ mb_strimwidth($task->title, 0, 40, "..") }}</small>

            @php($observers = [])
            @foreach($members as $member)
                @if($member->responsibility == 'performer')
                    @php($performer = $member)
                @else
                    @php(array_push($observers, $member))
                @endif
            @endforeach

            <div class="dropdown float-right">
                @if(!$task->deleted_at)
                    @if($user->id == $performer->id)
                    <a id="task_work" href="{{ route('task.work', [$task->code]) }}" type="button" class="btn btn-square btn-primary min-width-125">В работе</a>
                    <a id="task_transmit" href="{{ $performer->code }}" type="button" class="btn btn-square btn-primary min-width-125" data-toggle="modal" data-target="#modal_task_transmit">Передать</a>
                    @endif

                    @if($user->id == $performer->id or $user->id == $task->creator_id)
                    <a id="task_members" href="{{ $performer->code }}" type="button" class="btn btn-square btn-primary min-width-125" data-toggle="modal" data-target="#modal_task_members">Участники</a>
                    @endif

                    @if($user->id == $performer->id)
                    <a id="task_complete" href="{{ route('task.finish', [$task->code]) }}" type="button" class="btn btn-square btn-danger min-width-125">Завершить</a>
                    @endif
                @endif
            </div>
        </div>

        <div class="block">
            <div class="block-content">
                <div class="row items-push mb-10">

                    <div class="col-md-8">
                        <h3 @if($task->deleted_at) class="text-gray d-flex" @endif>Описание @if($task->deleted_at) <strong class="text-danger text-bold">&nbsp;&nbsp;ЗАКРЫТА</strong> @endif</h3>
                        <div>
                            {{ $task->description }}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <h3 @if($task->deleted_at) class="text-gray" @endif>Учасники</h3>

                        <div>
                            <div class="mb-20">
                                <h6 class="mb-5">Постановщик</h6>
                                <p class="mb-0">
                                    <a @if(!$task->deleted_at) href="{{ route('profile.show', [$creator->code]) }}" @else class="text-darkgray" @endif>{{ $creator->surname.' '.$creator->name }}</a>
                                </p>
                            </div>

                            <div @if($observers) class="mb-20" @endif>
                                <h6 class="mb-5">Исполнитель</h6>
                                <p class="mb-0">
                                    <a @if(!$task->deleted_at) href="{{ route('profile.show', [$performer->code]) }} @else class="text-darkgray" @endif">{{ $performer->surname.' '.$performer->name }}</a>
                                </p>
                            </div>

                            <div>
                                @if($observers)
                                    <h6 class="mb-5">Наблюдатели</h6>
                                    @foreach($observers as $observer)
                                        @if($observer->responsibility == 'observer')
                                        <p class="mb-0"><a @if(!$task->deleted_at) href="{{ route('profile.show', [$observer->code]) }}" @else class="text-darkgray" @endif>{{ $observer->surname.' '.$observer->name }}</a></p>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>

                </div>

                @if(count($files))
                    <hr class="mt--10">

                    <div class="files d-flex flex-wrap">
                        @foreach($files as $file)
                        <a @if(!$task->deleted_at) href="{{ $file->src }} @endif" download>
                            <div class="file">
                                <i class="si si-doc file_icon"></i> {{ $file->name }}
                            </div>
                        </a>
                        @endforeach
                    </div>
                @endif

                <table class="table table-borderless">
                    <tbody>

                    @foreach($comments as $comment)
                    <tr class="table-active">
                        <td class="d-none d-sm-table-cell"></td>
                        <td class="font-size-sm text-muted">
                            <a href="{{ route('profile.show', [$comment->code]) }}">{{ $comment->surname.' '.$comment->name }}</a> <em>{{ date('d F Y h:m', strtotime($comment->created_at)) }}</em>
                        </td>
                    </tr>
                    <tr>
                        <td class="d-none d-sm-table-cell text-center" style="width: 140px;">
                            <div class="">
                                <a href="{{ route('profile.show', [$comment->code]) }}">
                                    <div class="img-avatar avatar" style="background-image: url({{ URL::asset($comment->avatar()) }})"></div>
                                </a>
                            </div>
                            <small>{{ $comment->surname.' '.$comment->name }}</small>
                        </td>
                        <td>
                            <p>{{ $comment->text }}</p>

                            <p class="font-size-sm text-muted">
                                <?php $comment_files = \App\Models\File::query()->where('comment_id', $comment->id)->get(); ?>
                                @if(count($comment_files))
                                <hr class="mt--10">

                                <div class="files d-flex flex-wrap">
                                    @foreach($comment_files as $comment_file)
                                        <a @if(!$task->deleted_at) href="{{ $comment_file->src }}" @endif download>
                                            <div class="file">
                                                <i class="si si-doc file_icon"></i> {{ $comment_file->name }}
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                                @endif
                            </p>
                        </td>
                    </tr>
                    @endforeach

                    @if(!$task->deleted_at)
                    <tr class="table-active" id="forum-reply-form">
                        <td class="d-none d-sm-table-cell"></td>
                        <td class="font-size-sm text-muted">
                            <a href="{{ route('profile.show', [$user->code]) }}">{{ $user->surname.' '.$user->name }}</a> Сейчас
                        </td>
                    </tr>
                    <tr>
                        <td class="d-none d-sm-table-cell text-center comment-left">
                            <div class="">
                                <a href="{{ route('profile.show', [$user->code]) }}">
{{--                                    <img class="img-avatar" src="{{ URL::asset($user->photo) }}" alt="">--}}
                                    <div class="img-avatar avatar" style="background-image: url({{ URL::asset($user->photo) }})"></div>
                                </a>
                            </div>
                            <small>{{ $user->surname.' '.$user->name }}</small>
                        </td>
                        <td>
                            <form id="task_add_comment_form" action="{{ route('task.comment', [$task->code]) }}" method="post" onsubmit="return false;" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group row">
                                    <div class="col-12">
                                        <textarea class="form-control"  name="text" rows="10" maxlength="2000"></textarea>
                                    </div>
                                </div>

                                <div id="files_info" class="alert alert-info d-none"></div>
                                <div id="files_error" class="alert alert-danger d-none"></div>
                                @error('files')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                @error('files.*')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group d-flex">
                                    <button onclick="taskCheckStorage()" class="btn btn-alt-primary">
                                        <i class="si si-paper-plane"></i> Отправить
                                    </button>

                                    <div class="ml-auto">
                                        <div class="attach_file">
                                            <input onchange="inputFilesCountNotification()" type="file" class="custom-file-input js-custom-file-input-enabled" id="files" name="files[]" value="" data-toggle="custom-file-input" accept="*" multiple>
                                            <label class="custom-file-label" for="files">Прикрепить файл</label>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </td>
                    </tr>
                    @endif

                    </tbody>
                </table>

                <?php $employees = \App\Models\User::query()->where('company_id', $user->company_id)->get(); ?>
                <div class="modal fade" id="modal_task_transmit" data-task="{{ $task->code }}" tabindex="-1" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-popin" role="document">
                        <div class="modal-content">
                            <div class="block block-themed block-transparent mb-0">
                                <div class="block-header bg-primary-dark">
                                    <h3 class="block-title">Передать задачу</h3>
                                    <div class="block-options">
                                        <button id="modal_task_transmit_close" class="btn-block-option modal_close_btn" type="button" data-dismiss="modal" aria-label="Close">
                                            <i class="si si-close"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="block-content">
                                    <label class="" for="task_employee">Сотрудники</label>
                                    <select class="form-control mb-16" id="task_employee" name="employee" size="8">
                                        @foreach($employees as $employee)
                                        @if($user->id !== $employee->id)
                                        <option value="{{ $employee->code }}">{{ $employee->surname . ' ' . $employee->name }}</option>
                                        @endif
                                        @endforeach
                                    </select>

                                    <div id="task_transmit_error" class="alert alert-danger mt-15 mb-0 d-none"></div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Отменить</button>
                                <button onclick="taskTransmit()" type="button" class="btn btn-alt-success">
                                    <i class="si si-check"></i> Передать
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                $member_ids = [];
                foreach ($members as $member) {
                    array_push($member_ids, $member->id);
                }

                $no_members = [];
                foreach ($employees as $employee) {
                    if (!in_array($employee->id, $member_ids)) {
                        array_push($no_members, $employee);
                    }
                }?>
                <div class="modal fade" id="modal_task_members" data-task="{{ $task->code }}" tabindex="-1" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-popin" role="document">
                        <div class="modal-content">
                            <div class="block block-themed block-transparent mb-0">
                                <div class="block-header bg-primary-dark">
                                    <h3 class="block-title">Добавление наблюдателя</h3>
                                    <div class="block-options">
                                        <button id="modal_task_members_close" class="btn-block-option modal_close_btn" type="button" data-dismiss="modal" aria-label="Close">
                                            <i class="si si-close"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="block-content">
                                    @if($no_members)
                                        <label class="" for="task_add_member">Сотрудники</label>
                                        <select class="form-control mb-16" id="task_add_member" name="employees[]" size="8" multiple>
                                            @foreach($no_members as $employee)
                                                <option value="{{ $employee->code }}">{{ $employee->surname . ' ' . $employee->name }}</option>
                                            @endforeach
                                        </select>

                                        <div id="task_add_member_error" class="alert alert-danger mt-15 mb-15 d-none"></div>
                                    @else
                                        <div class="hero bg-white bg-pattern h-auto minh-auto" style="background-image: url({{ URL::asset('media/various/bg-pattern-inverse.png') }});">
                                            <div class="hero-inner">
                                                <div class="content content-full">
                                                    <div class="py-30 text-center">
                                                        <i class="si si-users text-success display-3"></i>
                                                        <h1 class="h2 font-w700 mt-30 mb-10"></h1>
                                                        <h2 class="h3 font-w400 text-muted mb-50">Все участвуют</h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Отменить</button>
                                <button onclick="taskAddMembers()" type="button" class="btn btn-alt-success">
                                    <i class="si si-check"></i> Добавить
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection
