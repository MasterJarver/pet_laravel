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
    <div class="row">
        <form action="{{ route('tasks.update', [$taskUnderEdit->id]) }}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group">
                <input type="text" name="updatedTaskName" class="form-control input-lg" style="width: 100%" value="{{ $taskUnderEdit->name }}">
            </div>
            <div class="form-group">
                <input type="submit" value="Save Changes" class="btn btn-success btn-lg">
                <a href="" class="btn btn-primary btn-lg" style="margin-left: 860px;">Go back</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>