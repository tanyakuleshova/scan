<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/skeleton/2.0.4/skeleton.min.css" rel="stylesheet" type="text/css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="six column">
                    <form method="POST" action="/admin/makescan">
                        {{ csrf_field() }}
                        <div class="row" style="margin: 15px 0">
                            <strong>Скан-код</strong>
                        </div>
                        <div class="row">
                            <div class="six columns">
                                <input name="scan" class="u-full-width" type="text" placeholder="Ввести скан-код" id="scan">
                            </div>
                            <div class="two columns">
                                <input class="button-primary" type="submit" value="Подтвердить">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                @if(Session::has('message'))
                    {{ Session::get('message') }}
                @endif
            </div>
            @if(isset($scan) || isset($new_scan))
                @if($new_scancode)
                    <div class="row" style="margin: 15px 0">
                        <strong>Привязать сканкод</strong>
                    </div>
                @endif
                <div class="row">
                    <div class="two columns">
                        @if($scan) {{$scan}}
                            @elseif($new_scan) {{$new_scan}}
                        @endif
                    </div>
                    <div class="two columns">
                        {{$product_title}}
                    </div>
                    @if($new_scancode)
                        <form method="POST" action="/admin/new-scancode">
                            {{ csrf_field() }}
                            <div class="row">
                                <input name="new_scan" class="u-full-width" type="hidden" value="{{$scan}}">
                                <div class="four columns">
                                    <select class="product-select u-full-width" name="product"></select>
                                </div>
                                <div class="two columns">
                                    <input class="button-primary" type="submit" value="Подтвердить">
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
            @endif
        </div>
    </body>
</html>

<script
        src="https://code.jquery.com/jquery-1.12.4.js"
        integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU="
        crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script type="text/javascript">

$(document).ready(function () {

    $('.product-select').select2({
        placeholder: 'Введите название товара',

        ajax: {
            url: '/admin/select2-autocomplete-ajax',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results:  $.map(data, function (item) {
                        return {
                            text: item.title,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });

});

</script>