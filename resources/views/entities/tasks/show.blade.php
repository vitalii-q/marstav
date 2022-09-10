@extends('layouts.hf')

@section('title', $task->title)

@section('css')

@endsection

@section('js')

@endsection

@section('content')
    <div class="content">
        @if(session()->has('info'))
        <p class="alert alert-info">{{ session()->get('info') }}</p>
        @endif

        <div class="content-heading pt-8">
            <a href="{{ route('tasks.index') }}">Задачи</a>
            <small class="d-none d-sm-inline breadcrumb-item"> / {{ mb_strimwidth($task->title, 0, 40, "..") }}</small>

            <div class="dropdown float-right">
                <a href="" type="button" class="btn btn-primary min-width-125">Передать</a>
            </div>
        </div>

        <div class="block">
            <div class="block-content">
                <div class="row items-push mb-20">

                    <div class="col-md-8">
                        <h3>Описание</h3>
                        <div>
                            {{ $task->description }}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <h3>Учасники</h3>

                        <div>
                            <h6 class="mb-5">Постановщик</h6>
                            <p><a href="{{ route('profile.show', [$creator->code]) }}">{{ $creator->surname.' '.$creator->name }}</a></p>

                            <h6 class="mb-5">Исполнитель</h6>
                            @foreach($members as $member)
                                @if($member->responsibility == 'performer')
                                <p><a href="{{ route('profile.show', [$member->code]) }}">{{ $member->surname.' '.$member->name }}</a></p>
                                @endif
                            @endforeach

                            <h6 class="mb-5">Наблюдатели</h6>
                            @foreach($members as $member)
                                @if($member->responsibility == 'observer')
                                <p><a href="{{ route('profile.show', [$member->code]) }}">{{ $member->surname.' '.$member->name }}</a></p>
                                @endif
                            @endforeach
                        </div>
                    </div>

                </div>

                <table class="table table-borderless">
                    <tbody>
                    <tr class="table-active">
                        <td class="d-none d-sm-table-cell"></td>
                        <td class="font-size-sm text-muted">
                            <a href="be_pages_generic_profile.html">Andrea Gardner</a> on <em>February 1, 2017 16:15</em>
                        </td>
                    </tr>
                    <tr>
                        <td class="d-none d-sm-table-cell text-center" style="width: 140px;">
                            <div class="mb-10">
                                <a href="be_pages_generic_profile.html">
                                    <img class="img-avatar" src="assets/media/avatars/avatar3.jpg" alt="">
                                </a>
                            </div>
                            <small>489 Posts<br>Level 4</small>
                        </td>
                        <td>
                            <p>Potenti elit lectus augue eget iaculis vitae etiam, ullamcorper etiam bibendum ad feugiat magna accumsan dolor, nibh molestie cras hac ac ad massa, fusce ante convallis ante urna molestie vulputate bibendum tempus ante justo arcu erat accumsan adipiscing risus, libero condimentum venenatis sit nisl nisi ultricies sed, fames aliquet consectetur consequat nostra molestie neque nullam scelerisque neque commodo turpis quisque etiam egestas vulputate massa, curabitur tellus massa venenatis congue dolor enim integer luctus, nisi suscipit gravida fames quis vulputate nisi viverra luctus id leo dictum lorem, inceptos nibh orci.</p>
                            <hr>
                            <p class="font-size-sm text-muted">There is only one way to avoid criticism: do nothing, say nothing, and be nothing.</p>
                        </td>
                    </tr>

                    <tr class="table-active" id="forum-reply-form">
                        <td class="d-none d-sm-table-cell"></td>
                        <td class="font-size-sm text-muted">
                            <a href="be_pages_generic_profile.html">Albert Ray</a> Just now
                        </td>
                    </tr>
                    <tr>
                        <td class="d-none d-sm-table-cell text-center">
                            <div class="mb-10">
                                <a href="be_pages_generic_profile.html">
                                    <img class="img-avatar" src="assets/media/avatars/avatar13.jpg" alt="">
                                </a>
                            </div>
                            <small>152 Posts<br>Level 4</small>
                        </td>
                        <td>
                            <form action="{{ route('task.comment', [$task->code]) }}" method="post">
                                @csrf

                                <div class="form-group row">
                                    <div class="col-12">
                                        <!-- CKEditor (js-ckeditor id is initialized in Helpers.ckeditor()) -->
                                        <!-- For more info and examples you can check out http://ckeditor.com -->
                                        <textarea class="form-control"  name="text" rows="10" maxlength="2000"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-alt-primary">
                                        <i class="si si-paper-plane"></i> Отправить
                                    </button>
                                </div>
                            </form>
                        </td>
                    </tr>
                    </tbody>
                </table>

            </div>
        </div>

    </div>
@endsection
