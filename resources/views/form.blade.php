<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Form</title>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">
        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

        <script>
        $( function() {
          $( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd'});
        } );
        </script>

        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

        <script type="text/javascript" src="{{URL::asset('js/form.js')}}"></script>
    </head>

    <body>
        <div class="d-none symbols">
            @foreach ($symbols as $symbol)
                <span>{{$symbol}}</span>
            @endforeach
        </div>
        <div class="row mx-4 mt-5">
            <form class="row col-md-6 needs-validation" method="POST" novalidate action="form/submit">
                @csrf
                <div class="row mt-2 col-md-12">
                    <div class="col">
                        <label for="symbol" class="form-label">Symbol</label>
                        <input type="text" class="form-control" id="symbol" name="symbol" placeholder="Symbol" required>
                        <div class="invalid-feedback">
                            Please provide a valid symbol.
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-5">
                        <label for="start-date" class="form-label">Start Date</label>
                        <input type="text" class="form-control datepicker" name="start-date" id="start-date" placeholder="Start Date" required>
                        <div class="invalid-feedback">
                            Please provide a valid start date. (Must be equal to End Date or earlier)
                        </div>
                    </div>
                    <div class="col-md-5">
                        <label for="end-date" class="form-label">End Date</label>
                        <input type="text" class="form-control datepicker" name="end-date" id="end-date" placeholder="End Date" required>
                        <div class="invalid-feedback">
                            Please provide a valid end date. (Must be Today or earlier)
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" name="email" id="email" placeholder="Email" required>
                        <div class="invalid-feedback">
                            Please provide a valid email.
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-3">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
        </div>


    </body>
</html>
