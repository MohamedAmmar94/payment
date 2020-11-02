<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
<meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Ensures optimal rendering on mobile devices. -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->


        <style>
            body {
                font-family: 'Nunito';
            }
        </style>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    </head>
    <body class="antialiased">
    @if(isset($res) )
        @if($res['result']['code']=="000.100.110")
        <div class="alert alert-success" role="alert">
            {{$res['result']['description']}}
            <br>
            You Have paid amount {{$res['amount']}} {{$res['currency']}} from your {{$res['paymentBrand']}}  and operation id is {{$res['id']}}
        </div>
        @else
        <div class="alert alert-danger" role="alert">
            {{$res['result']['description']}}
        </div>
        @endif
    @endif
	<form id="form"  >
        {{ csrf_field() }}
        <input type="hidden" id="product-id" value="{{$product->id}}">
        <div class="container">
			<div class="row">
				<div class="col-md-3">title :</div>
				<div class="col-md-9">{{$product->title}}</div>
			</div>
			<div class="row">
				<div class="col-md-3">body :</div>
				<div class="col-md-9">{{$product->body}}</div>
			</div>
			<div class="row">
				<div class="col-md-3">price :</div>
				<div class="col-md-9">{{$product->price}}</div>
			</div>
            <div class="row">
                <button type="submit" class="btn btn-primary"> Buy Hyperpay</button>
            </div>
			<div class="row form-body">
				<!--<div id="paypal-button-container"></div>-->
			</div>

		</div>

    </form>
	 <script src="https://www.paypal.com/sdk/js?client-id=sb"></script>



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('form').on('submit', function(e){
                e.preventDefault();
                console.log("submite");
                id=$("#product-id").val();
                $.ajax({
                    type: "get",
                    url: "/buy/"+id,
                    datatype: 'html',
                }).done(
                    function(data)
                    {
                        $('.form-body').html(data.html);

                    }

                );
            });
        });

        // This function displays Smart Payment Buttons on your web page.
    </script>
    </body>
</html>
