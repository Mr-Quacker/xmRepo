<html>
    <head>
        <title>Data {{app('request')->input()['data']['symbol']}}</title>
        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

        <!-- Datatables -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.6.0/dt-1.12.1/r-2.3.0/datatables.min.css"/>

        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.6.0/dt-1.12.1/r-2.3.0/datatables.min.js"></script>

        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
        <script type="text/javascript" src="{{URL::asset('js/table.js')}}"></script>
    </head>
    <body class="mx-5 mt-3">

        <div class="d-none" symbol="{{app('request')->input()['data']['symbol']}}"></div>
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
                @foreach ($data as $item)
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
    </body>
</html>
