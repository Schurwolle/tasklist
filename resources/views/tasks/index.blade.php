@extends('layouts.app')

@section('head')
{!!Html::style('/parsley.css')!!}
@endsection

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    New Task
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('errors.list')

                    <!-- New Task Form -->
                    
                    {!!Form::open(array('url' => '/task', 'class' => 'form-horizontal'))!!}

                        <!-- Task Name -->
                        <div class="form-group">
                            {!!Form::label('task-name', 'Task', ['class' => 'col-sm-3 control-label'])!!}
                           

                            <div class="col-sm-6">
                                {!!Form::text('name', old('task'), ['class' => 'form-control', 'id' => 'task-name', 'required', 'data-parsley-required-message' => 'Task field is required.', 'data-parsley-trigger' => 'change focusout'])!!}
                            </div>
                        </div>

                        <!-- Add Task Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                {!!Form::submit('Add Task', ['class' => 'btn btn-default'])!!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>

            <!-- Current Tasks -->
            @if (count($tasks) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Current Tasks
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped task-table">
                            <thead>
                                <th>Task</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $task)
                                    <tr>
                                        <td class="table-text"><div>{{ $task->name }}</div></td>

                                        <!-- Task Delete Button -->
                                        <td>
                                            {!!Form::open(['method' => 'DELETE', 'url' => '/task/'.$task->id])!!}

                                                {!!Form::submit('Delete',['id' => 'delete-task-'.$task->id, 'class' => 'btn btn-danger' ])!!}
                                                
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('footer')
    <script type="text/javascript">
        window.ParsleyConfig = {
            errorsWrapper: '<div></div>',
            errorTemplate: '<div class="alert alert-danger parsley" role="alert"></div>'
        };
    </script>

    {!!Html::script('/parsley.min.js')!!}
@endsection
