<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task</title>
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
</head>
<body>
    <main>
        <section>
            <div class="myFormParent">
                <form action="" method="POST">
                    <input type="text" class="f_csrf" value="{{ csrf_token() }}" hidden>
                    <div class="myFormChild">
                        <label for="countryForm">Choose Country</label>
                        <select name="" id="countryForm" required>
                            <option value="">Choose..</option>
                            @foreach($countries as $row_countries)
                                <option data-code="{{ $row_countries->code }}" value="{{ $row_countries->country }}">{{ $row_countries->country }}</option>
                            @endforeach
                        </select>
                        <label for="cityForm">State</label>
                        <select name="city" id="cityForm" disabled required>
                            <option value="" class="f_cityForm"></option>
                        </select>
                        <button class="f_send" disabled>Send</button>
                    </div>
                </form>
            </div>
        </section>
    </main>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/main.js') }}"></script>


</body>
</html>
