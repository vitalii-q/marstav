@extends('layouts.hf')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('js/plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection

@section('js')
    <!-- Page JS Plugins -->
    <script src="{{ URL::asset('js/plugins/sweetalert2/sweetalert2.all.js') }}"></script>

    <!-- Page JS Code -->
    <script src="{{ URL::asset('_es6/special/be_ui_activity.js') }}"></script>
@endsection

@section('content')
    @if(session()->has('info')) <!-- если уведовление или ошибка -->
    <p class="alert alert-info">{{ session()->get('info') }}</p> <!-- выводим сообщение -->
    @endif

    <div class="content-heading pt-8">
        <div class="dropdown float-right">
            <a href="{{ route('entities.note.create', $folder->code) }}" type="button" class="btn btn-warning min-width-125">Добавить заметку</a>
            <!--<button type="button" class="btn btn-secondary dropdown-toggle" id="ecom-dashboard-stats-drop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Today
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="ecom-dashboard-stats-drop">
                <a class="dropdown-item active" href="javascript:void(0)">
                    <i class="fa fa-fw fa-calendar mr-5"></i>Today
                </a>
                <a class="dropdown-item" href="javascript:void(0)">
                    <i class="fa fa-fw fa-calendar mr-5"></i>This Week
                </a>
                <a class="dropdown-item" href="javascript:void(0)">
                    <i class="fa fa-fw fa-calendar mr-5"></i>This Month
                </a>
                <a class="dropdown-item" href="javascript:void(0)">
                    <i class="fa fa-fw fa-calendar mr-5"></i>This Year
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="javascript:void(0)">
                    <i class="fa fa-fw fa-circle-o mr-5"></i>All Time
                </a>
            </div>-->
        </div>
        <a href="{{ route('note_folders.notes.index') }}">Заметки</a> <small class="d-none d-sm-inline"> / {{ $folder->title }}</small>
    </div>
    <div class="row gutters-tiny notes">

        @foreach($notes as $note)
            <div id="folder_{{ $note->code }}" class="col-md-6 col-xl-3 note">
                <div class="block-options">
                    <div class="block-options-item p-0">
                        <a href="{{ route('entities.note.edit', [$folder->code, $note->code]) }}" data-toggle="tooltip" data-placement="left" title="Редактировать"
                           class="si si-pencil text-white-op text-white-op-c">
                        </a>
                        <i data-delroute="/notes/folder/{{ $note->code }}" data-elemid="folder_{{ $note->code }}" data-toggle="tooltip" data-placement="left" title="Удалить"
                           class="fa fa-times text-white-op text-white-op-c js-swal-confirm">
                        </i>
                    </div>
                </div>
                <a class="block block-rounded block-transparent bg-gd-sun" href="{{ route('entities.note.edit', [$folder->code, $note->code]) }}">
                    <div class="block-options block-options_icons-left">
                        <div class="block-options-itemp-0">
                            <i data-delroute="/notes/{{ $folder->code }}" data-elemid="folder_{{ $folder->code }}"
                               class="si si-note text-white-op text-white-op-c">
                            </i>
                        </div>
                    </div>
                    <div class="block-content block-content-full block-sticky-options">
                        <div class="folder-text note_folder-text py-20 text-center">
                            <div class="folder-title font-w700 text-white-op note-block_text">{{ mb_strimwidth($note->title, 0, 40, "..") }}</div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach

    </div>

@endsection
