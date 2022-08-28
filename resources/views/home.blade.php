@extends('layouts.hf')

@section('js')
    <script src="{{ URL::asset('js/pages/workspace.js') }}"></script>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div id="workspace" class="block workspace">
                <ul id="tabs_ul" class="nav nav-tabs nav-tabs-block align-items-center">
                    <!--<li id="tab_button_qwer" class="nav-item">
                        <a href="#tab_pane_qwer" class="nav-link ">
                            <div class="opacity-0">title</div>
                            <div class="nav-link_tclicker">title</div>
                            <button data-tabbtnid="qwer" onclick="workspaceNoteClose(this)" type="button" class="btn-block-option btn-block-option-tab">
                                <i class="si si-close"></i>
                            </button>
                        </a>
                    </li>-->
                    @php($i=1) @foreach($notes as $note)
                    <li id="tab_button_{{ $note->code }}" class="nav-item">
                        <a class="nav-link @if($i==1) active @endif">
                            <div class="opacity-0">{{ mb_strimwidth($note->title, 0, 14, "..") }}</div>
                            <div class="nav-link_tclicker">{{ mb_strimwidth($note->title, 0, 14, "..") }}</div>
                            <button data-tabbtnid="{{ $note->code }}" onclick="workspaceNoteClose(this)" type="button" class="btn-block-option btn-block-option-tab">
                                <i class="si si-close"></i>
                            </button>
                        </a>
                    </li>
                    @php($i++) @endforeach

                    <li id="block_options" class="nav-item ml-auto nav-item_block-option">
                        <div class="block-options mr-15">
                            <button type="button" class="btn-block-option" data-toggle="modal" data-target="#modal-popin-plus">
                                <i class="si si-plus"></i>
                            </button>
                            <button type="button" class="btn-block-option" data-toggle="modal" data-target="#modal-popin-notebook">
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

                    <!--<div class="tab-pane " id="tab_pane_qwer" role="tabpanel">
                        <div class="form-group row">
                            <div class="col-12">
                                <div class="form-material pt-0">
                                    <textarea class="form-control" id="text_qwer" name="text_qwer" rows="18" placeholder="Начните писать" maxlength="4000">text</textarea>
                                    </div>
                                </div>
                            </div>
                        <div class="form-group row">
                            <div class="col-3 ml-auto">
                                <button data-route="/notes/folder/qwer/update/ajax" data-elemid="qwer" onclick="workspaceNoteUpdate(this)" class="btn btn-block btn-alt-primary">
                                    <i class="si si-check mr-5"></i> Сохранить
                                </button>
                            </div>
                        </div>
                    </div>-->
                    @php($i=1) @foreach($notes as $note)
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
                                <button data-route="/notes/folder/{{ $note->code }}/update/ajax" data-elemid="{{ $note->code }}" onclick="workspaceNoteUpdate(this)" class="btn btn-block btn-alt-primary">
                                    <i class="si si-check mr-5"></i> Сохранить
                                </button>
                            </div>
                        </div>
                    </div>
                    @php($i++) @endforeach

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
                                    <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
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
                                <h3 class="block-title">Terms &amp; Conditions</h3>
                                <div class="block-options">
                                    <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                        <i class="si si-close"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="block-content">
                                <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                                <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-alt-success" data-dismiss="modal">
                                <i class="si si-check"></i> Perfect
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Pop In Modals -->
        </div>
    </div>
@endsection
