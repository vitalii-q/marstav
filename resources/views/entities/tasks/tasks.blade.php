@extends('layouts.hf')

@section('title', 'Задачи')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
@endsection

@section('js')

@endsection

@section('content')
    <div class="content">
        @if(session()->has('info')) <!-- если уведовление или ошибка -->
        <p class="alert alert-info">{{ session()->get('info') }}</p> <!-- выводим сообщение -->
        @endif

        <div class="content-heading pt-8">
            Задачи

            <div class="dropdown float-right">
                <a href="{{ route('tasks.create') }}" type="button" class="btn btn-success min-width-125">Добавить задачу</a>
            </div>
        </div>

        <div class="block">
            <div class="block-content block-content-full">
                <table class="table table-bordered table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th class="text-center d-sm-table-cell" style="width: 40%;">Тема</th>
                            <th>Роль</th>
                            <th class="d-none d-sm-table-cell" style="width: 15%;">Приоритет</th>
                            <th class="d-none d-sm-table-cell" style="width: 15%;">Статус</th>
                            <th class="text-center" style="width: 15%;">Дедлайн</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($tasks as $task)
                        <tr>
                            <td class=""><a href="{{ route('tasks.show', [$task->code]) }}">{{ $task->title }}</a></td>

                            <?php $responsibility = '';
                            if($task->responsibility == 'observer') { $responsibility = 'Наблюдатель'; }
                            elseif ($task->responsibility == 'performer') { $responsibility = 'Исполнитель'; } ?>
                            <td class="font-w600">{{ $responsibility }}</td>

                            <?php $priority = '';
                            if($task->priority == '1') { $priority = 'Нормально'; }
                            elseif ($task->priority == '2') { $priority = 'Быстро'; }
                            elseif ($task->priority == '3') { $priority = 'Срочно'; }
                            elseif ($task->priority == '4') { $priority = 'Очень срочно'; } ?>
                            <td class="d-none d-sm-table-cell">{{ $priority }}</td>

                            <?php $status = 'Новая'; $status_style = 'badge-success';
                            if($task->status == 'expired') { $status = 'Просрочено'; $status_style = 'badge-danger'; } ?>
                            <td class="d-none d-sm-table-cell">
                                <span class="badge {{ $status_style }}">{{ $status }}</span>
                            </td>

                            <?php $date = '';
                            if($task->deadline) { $date = date('d-m-Y', strtotime($task->deadline)); } ?>
                            <td class="text-center">{{ $date }}</td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>

                <div class="d-flex">
                    <div class="col-sm-12 col-md-5">
                        <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">Показано
                            {{ $tasks->count() }} из {{ $tasks->total() }} задач</div>
                    </div>

                    {{ $tasks->links('layouts.pagination') }}
                </div>

            </div>
        </div>

    </div>
@endsection
