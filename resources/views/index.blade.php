<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- Styles -->
    <style>

    </style>
</head>
<body>
<div class="flex-center position-ref full-height">

    <div class="content">
        <div class="title m-b-md">
            Downloader
        </div>

        <form action="{{ route('add') }}" method="POST">

            {{ csrf_field() }}

               <div class="form-group col-6">
                   <div class="row">
                   <input class="form-control col-4" name="url" type="text" required value="{{ old('url') }}">

                   @if ($errors->has('url'))
                       <span class="color-red">
                            <strong>{{ $errors->first('url') }}</strong>
                        </span>
                   @endif

                   <input class="btn btn-primary col-2" type="submit" value="Download">
                   </div>
               </div>


        </form>

        <table class="table">
            <thead>
                <tr>
                    <td>Status</td>
                    <td>Url</td>
                    <td>Download Path</td>
                </tr>
            </thead>
            <tbody>
                @foreach($report as $row)
                    <tr>
                        <td>{{ $row['status'] }}</td>
                        <td>{{ $row['url'] }}</td>
                        <td>{{ url('/') . $row['path'] }}</td>
                    </tr>
                @endforeach
            </tbody>

        </table>

        {{ $report->links() }}

    </div>
</div>
</body>
</html>
