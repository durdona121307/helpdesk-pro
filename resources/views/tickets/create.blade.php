<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Ticket</title>
</head>
<body>

<h1>Yangi Ticket yaratish</h1>

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="/tickets" method="POST">

    @csrf

    <div>
        <label>Muammo nomi:</label><br>
        <input type="text" name="title">
    </div>

    <br>

    <div>
        <label>Batafsil:</label><br>
        <textarea name="description"></textarea>
    </div>

    <br>

    <button type="submit">
        Ticket yuborish
    </button>

</form>

</body>
</html>