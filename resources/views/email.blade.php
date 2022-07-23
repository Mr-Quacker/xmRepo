<head>
<!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</head>
<div class="row">
    <h3>From {{$data['start-date']}} to {{$data['end-date']}}</h3>
</div>
<hr>
<div class="row ml-4">
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Date</th>
            <th scope="col">Open</th>
            <th scope="col">High</th>
            <th scope="col">Low</th>
            <th scope="col">Close</th>
            <th scope="col">Volume</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($prices as $item)
                @if (!is_null($item) && !is_null($item['open']))
                    <tr>
                        <td>{{date('Y-m-d', $item['date'])}}</td>
                        <td>{{$item['open']}}</td>
                        <td>{{$item['high']}}</td>
                        <td>{{$item['low']}}</td>
                        <td>{{$item['close']}}</td>
                        <td>{{$item['volume']}}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
      </table>
</div>
