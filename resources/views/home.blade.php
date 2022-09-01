@extends('layouts.hf')

@section('title', 'Рабочий стол')

@section('js')
    <script src="{{ URL::asset('js/pages/workspace.js') }}"></script>

    <!-- Page JS Helpers (Table Tools helper) -->
    <script>jQuery(function(){ Codebase.helpers('table-tools'); });</script>

    <!-- Page JS Plugins -->
    <script src="{{ URL::asset('js/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <!-- Page JS Helpers (SlimScroll plugin) -->
    <script>jQuery(function(){ Codebase.helpers(['slimscroll']); });</script>
@endsection

@section('content')
    <div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div id="workspace" class="block workspace">
                <ul id="tabs_ul" class="nav nav-tabs nav-tabs-block align-items-center">
{{--                    <li id="tab_button_{{ $note->code }}" class="nav-item">--}}
{{--                        <a class="nav-link @if($i==1) active @endif">--}}
{{--                            <div class="opacity-0">{{ mb_strimwidth($note->title, 0, 14, "..") }}</div>--}}
{{--                            <div class="nav-link_tclicker">{{ mb_strimwidth($note->title, 0, 14, "..") }}</div>--}}
{{--                            <button data-tabbtnid="{{ $note->code }}" onclick="workspaceNoteClose(this)" type="button" class="btn-block-option btn-block-option-tab">--}}
{{--                                <i class="si si-close"></i>--}}
{{--                            </button>--}}
{{--                        </a>--}}
{{--                    </li>--}}
                    @php($i=1) @foreach($notes as $note)
                    @if($note->workspace === 1)
                    <li id="tab_button_{{ $note->code }}" class="nav-item">
                        <div data-tabbtnid="{{ $note->code }}" class="nav-link @if($i==1) active @endif">
                            {{ mb_strimwidth($note->title, 0, 14, "..") }}
                            <button onclick="workspaceNoteClose(this)" type="button" class="btn-block-option btn-block-option-tab" data-route="/notes/folder/{{ $note->code }}/update/ajax" data-tabbtnid="{{ $note->code }}" data-dest="close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </li>
                    @php($i++)
                    @endif
                    @endforeach

                    <li id="block_options" class="nav-item ml-auto nav-item_block-option">
                        <div class="block-options mr-15">
                            <button id="modal-popin-plus-btn" class="btn-block-option" type="button" data-toggle="modal" data-target="#modal-popin-plus">
                                <i id="modal-popin-plus-close-icon" class="si si-plus"></i>
                            </button>
                            <button id="modal-popin-select-note-btn" type="button" class="btn-block-option" data-toggle="modal" data-target="#modal-popin-notebook">
                                <i class="si si-notebook"></i>
                            </button>
                            <button type="button" class="btn-block-option btn-block-option-funcs" data-toggle="block-option" data-action="fullscreen_toggle"></button>
                            <!--<button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="close">
                                <i class="si si-close"></i>
                            </button>-->
                        </div>
                    </li>
                </ul>

                <div id="tab_content" class="block-content tab-content">

                    @php($i=1) @foreach($notes as $note)
                    @if($note->workspace === 1)
                    <div class="tab-pane @if($i==1) active @endif" id="tab_pane_{{ $note->code }}">
                        <div class="form-group row">
                            <div class="col-12">
                                <div class="form-material pt-0">
                                    <textarea class="form-control" id="text_{{ $note->code }}" name="text_{{ $note->code }}" rows="18" placeholder="Начните писать" maxlength="4000">{{ $note->text }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-3 ml-auto">
                                <button data-route="/notes/folder/{{ $note->code }}/update/ajax" data-tabbtnid="{{ $note->code }}" onclick="workspaceNoteUpdate(this)"
                                        class="btn btn-block btn-alt-primary js-animation-object animated" data-animation-class="flash">
                                    <i class="si si-check mr-5"></i> Сохранить
                                </button>
                            </div>
                        </div>
                    </div>
                    @php($i++)
                    @endif
                    @endforeach

                    @if($i = 1)
                        <div id="workspace_stub" class="hero bg-white bg-pattern h-auto mh-auto" data-toggle="modal" data-target="#modal-popin-plus" style="background-image: url({{ URL::asset('media/various/bg-pattern-inverse.png') }});">
                            <div class="hero-inner">
                                <div class="content content-full">
                                    <div class="py-30 text-center">
                                        <i class="si si-note text-warning display-3"></i>
                                        <h1 class="h2 font-w700 mt-30 mb-10">Добавьте заметку</h1>
                                        <h2 class="h3 font-w400 text-muted mb-50">Здесь вы можете управлять заметками</h2>
                                        <a class="btn btn-hero btn-noborder btn-rounded btn-warning">
                                            <i class="si si-pencil mr-10"></i> Добавить заметку
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>

            </div>

            <!-- Pop In Modals -->
            <div class="modal fade" id="modal-popin-plus" tabindex="-1" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
                <div class="modal-dialog modal-dialog-popin" role="document">
                    <div class="modal-content">
                        <div class="block block-themed block-transparent mb-0">
                            <div class="block-header bg-primary-dark">
                                <h3 class="block-title">Добавление заметки</h3>
                                <div class="block-options">
                                    <button class="btn-block-option modal_close_btn" type="button" data-dismiss="modal" aria-label="Close">
                                        <i class="si si-close"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="block-content">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <div class="form-material">
                                                    <input type="text" class="form-control" id="ws_add_note_title" name="title" placeholder="Введите название" maxlength="255">
                                                    <label for="ws_add_note_title">Название</label>
                                                </div>

                                                <div id="ws_add_note_title_error" class="alert alert-danger mt-15 mb-0 d-none"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-12" for="example-multiple-select">Папка</label>
                                    <div class="col-md-12">
                                        @php($size = count($folders)+1 < 7 ? count($folders)+1 : 7)
                                        <select class="form-control" id="ws_add_note_folder" name="folder_code" size="{{ $size }}">
                                            <option value="root" selected>Корневая папка</option>
                                            @foreach($folders as $folder)
                                                <option class="ws_add_note_so" value="{{ $folder->code }}">{{ $folder->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Отменить</button>
                            <button onclick="workspaceNoteAdd()" type="button" class="btn btn-alt-success">
                                <i class="si si-check"></i> Добавить
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modal-popin-notebook" tabindex="-1" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
                <div class="modal-dialog modal-dialog-popin" role="document">
                    <div class="modal-content">
                        <div class="block block-themed block-transparent mb-0">
                            <div class="block-header bg-primary-dark">
                                <h3 class="block-title">Заметки</h3>
                                <div class="block-options">
                                    <button class="btn-block-option modal_close_btn" type="button"  data-dismiss="modal" aria-label="Close">
                                        <i class="si si-close"></i>
                                    </button>
                                </div>
                            </div>

                            <table class="js-table-sections table table-hover">

                                @foreach($folders as $folder)
                                    <tbody class="js-table-sections-header ws_notes_list_folder">
                                    <tr>
                                        <td class="text-center w-30 pl-15 pr-5">
{{--                                            <i class="fa fa-angle-right"></i>--}}
                                            <div class="ws_arrow-right">
                                                <div class="ws_arrow-line-1"></div>
                                                <div class="ws_arrow-line-2"></div>
                                            </div>
                                        </td>
                                        <td class="font-w600 tc-black pl-15">{{ mb_strimwidth($folder->title, 0, 30, "..") }}</td>
                                        <td class="d-none d-sm-table-cell ta-right">
                                            {{--                                            <em class="text-muted">October 13, 2017 12:16</em>--}}
                                            <i class="si si-folder-alt tc-black"></i>
                                        </td>
                                    </tr>
                                    </tbody>

                                    <tbody class="ws_notes_list_note_block">
                                    @foreach($notes as $note)
                                        @if($note->folder_id == $folder->id)
                                            <tr class="ws_tree_note c-pointer" data-code="{{ $note->code }}">
                                                <td class="text-center"></td>
                                                <td class="font-w600 tc-black pl-0">{{ mb_strimwidth($note->title, 0, 30, "..") }}</td>
                                                <td class="d-none d-sm-table-cell ta-right"> <!-- October 18, 2017 12:16 -->
                                                    <span class="font-size-sm text-muted">{{ date('d F H:i Y', strtotime($note->updated_at)) }}</span>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>

                                @endforeach

                                <tbody class="ws_notes_list_wo-folder">
                                @foreach($notes as $note)
                                    @if($note->folder_id == null)
                                        <tr class="ws_tree_note c-pointer" data-code="{{ $note->code }}">
                                            <td class="text-center"></td>
                                            <td class="font-w600 tc-black pl-0">{{ mb_strimwidth($note->title, 0, 30, "..") }}</td>
                                            <td class="d-none d-sm-table-cell ta-right"> <!-- October 18, 2017 12:16 -->
                                                <span class="font-size-sm text-muted">{{ date('d F H:i Y', strtotime($note->updated_at)) }}</span>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>

                            </table>

                            @if(!count($notes))
                            <div id="workspace_stub" class="hero bg-white bg-pattern h-auto mh-auto" style="background-image: url({{ URL::asset('media/various/bg-pattern-inverse.png') }});">
                                <div class="hero-inner">
                                    <div class="content content-full">
                                        <div class="py-30 text-center">
                                            <i class="si si-note text-warning display-3"></i>
                                            <h1 class="h2 font-w700 mt-30 mb-10"></h1>
                                            <h2 class="h3 font-w400 text-muted mb-50">У вас еще нет заметок</h2>
                                            <a class="btn btn-hero btn-noborder btn-rounded btn-warning" onclick="addFirstNoteBtn()">
                                                <i class="si si-pencil mr-10"></i> Добавить заметку
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Pop In Modals -->

        </div>
    </div>
    </div>
@endsection
