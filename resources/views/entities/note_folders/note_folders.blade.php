@extends('layouts.hf')

@section('title', 'Заметки')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('js/plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection

@section('js')
    <script src="{{ URL::asset('js/pages/notes.js') }}"></script>

    <!-- Page JS Plugins -->
    <script src="{{ URL::asset('js/plugins/sweetalert2/sweetalert2.all.js') }}"></script>

    <!-- Page JS Code -->
    <script src="{{ URL::asset('_es6/special/be_ui_activity.js') }}"></script>
@endsection

@section('content')

    <div class="content">
    @if(session()->has('info'))
    <p class="alert alert-info">{{ session()->get('info') }}</p>
    @endif

    <div class="content-heading pt-8">
        <div class="dropdown float-right">
            <a id="add_note_btn" href="{{ route('entities.note.create', 'root') }}" type="button" class="btn btn-warning min-width-125">Добавить заметку</a>
            <a href="{{ route('note_folders.notes.create') }}" type="button" class="btn btn-primary min-width-125">Добавить папку</a>
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
        Заметки <!--<small class="d-none d-sm-inline">Awesome!</small>-->
    </div>

    <div class="row gutters-tiny notes">

        @foreach($folders as $folder)
            <div id="folder_{{ $folder->code }}" class="note col-md-6 col-xl-3">
                <div class="block-options">
                    <div class="block-options-itemp-0">
                        <a href="/notes/{{ $folder->code }}/edit" data-delroute="entities/note_folders/{{ $folder->code }}" data-elemid="folder_{{ $folder->code }}" data-toggle="tooltip" data-placement="left" title="Редактировать"
                           class="si si-pencil text-white-op text-white-op-c">
                        </a>
                        <i data-delroute="/notes/{{ $folder->code }}" data-elemid="folder_{{ $folder->code }}" data-toggle="tooltip" data-placement="left" title="Удалить"
                           class="fa fa-times text-white-op text-white-op-c js-swal-confirm">
                        </i>
                    </div>
                </div>
                <a class="block block-rounded block-transparent bg-gd-sea" href="/notes/folder/{{ $folder->code }}">
                    <div class="block-options block-options_icons-left">
                        <div class="block-options-itemp-0">
                            <i data-delroute="/notes/{{ $folder->code }}" data-elemid="folder_{{ $folder->code }}"
                               class="si si-folder-alt text-white-op text-white-op-c js-swal-confirm">
                            </i>
                        </div>
                    </div>
                    <div class="block-content block-content-full block-sticky-options">
                        <div class="folder-text py-20 text-center">
                            <div class="folder-title font-w700 text-white-op note-block_text">{{ mb_strimwidth($folder->title, 0, 40, "..") }}</div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach

        @foreach($notes as $note)
            <div id="folder_{{ $note->code }}" class="col-md-6 col-xl-3 note">
                <div class="block-options">
                    <div class="block-options-item p-0">
                        <a href="{{ route('entities.note.edit', ['root', $note->code]) }}" data-toggle="tooltip" data-placement="left" title="Редактировать"
                           class="si si-pencil text-white-op text-white-op-c">
                        </a>
                        <i data-delroute="/notes/folder/{{ $note->code }}" data-elemid="folder_{{ $note->code }}" data-toggle="tooltip" data-placement="left" title="Удалить"
                           class="fa fa-times text-white-op text-white-op-c js-swal-confirm">
                        </i>
                    </div>
                </div>
                <a class="block block-rounded block-transparent bg-gd-sun" href="{{ route('entities.note.edit', ['root', $note->code]) }}">
                    <div class="block-options block-options_icons-left">
                        <div class="block-options-itemp-0">
                            <i class="si si-note text-white-op text-white-op-c"></i> {{-- data-delroute="/notes/{{ $folder->code }}" data-elemid="folder_{{ $folder->code }}" --}}
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

        <div id="notes_stub" class="hero bg-white bg-pattern h-auto mh-auto" style="background-image: url({{ URL::asset('media/various/bg-pattern-inverse.png') }});">
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

    </div>
    </div>

@endsection
