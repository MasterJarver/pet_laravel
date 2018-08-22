<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    {{-- bootstrap css CDN --}}
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    {{-- bootstrap js CDN --}}
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <title>Todo List App</title>
</head>
<body>
<div class="container">
    <div class="col-md-offset-2 col-md-2"></div>
    <div class="row">
        <h1>Todo List</h1>
    </div>
    {{-- display success message --}}
    @if(Session::has('success'))
        <div class="alert alert-success">
            <strong>Success:</strong> {{ Session::get('success') }}
        </div>
    @endif
    {{-- display error message --}}
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Error:</strong>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row" style="margin-top: 10px; margin-bottom: 10px;">
        <form action="{{ route('tasks.store') }}" class="form-inline" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <input type="text" name="newTaskName" class="form-control" size="100%">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary btn-block" style="margin-left: 35px; padding: 6px 50px" value="Add Task">
            </div>
        </form>
        {{-- display stored tasks --}}
        @if(count($storedTasks) > 0)
            <table class="table" style="width: 100%">
                <thead>
                    <th>Task #</th>
                    <th>Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </thead>
                <tbody>
                    @foreach($storedTasks as $storedTask)
                        <tr>
                            <th>{{ $storedTask->id }}</th>
                            <td>{{ $storedTask->name }}</td>
                            <td><a href="{{ route('tasks.edit', ['tasks' => $storedTask->id]) }}" class="btn btn-secondary">Edit</a></td>
                            <td>
                                <form action="{{ route('tasks.destroy', ['tasks' => $storedTask->id]) }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="submit" class="btn btn-danger" value="Delete">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        <div class="row text-center" style="margin-left: auto; margin-right: auto">
            {{ $storedTasks->links("pagination::bootstrap-4") }}
        </div>
    </div>
</div>
</body>
</html>