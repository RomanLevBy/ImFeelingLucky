<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8"/>
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    />
    <title>Registration Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f3f3;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .main {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            padding: 20px;
            width: 1000px;
        }

        .button-delete {
            padding: 15px;
            border-radius: 10px;
            border: none;
            background-color: #c10101;
            color: white;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        .button-new {
            padding: 15px;
            border-radius: 10px;
            border: none;
            background-color: #4caf50;
            color: white;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        .button-play {
            padding: 15px;
            border-radius: 10px;
            border: none;
            background-color: darkblue;
            color: white;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        .button-history {
            padding: 15px;
            border-radius: 10px;
            border: none;
            background-color: dimgray;
            color: white;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        .row {
            padding-bottom: 20px;
        }

        .button-left {
            float: left;
            width: 45%;
        }

        .button-right {
            float: right;
            width: 45%;
        }
    </style>
</head>
<body>
<div class="main">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="row">
        <div class="button-left">
            <form action="{{ route('link.delete', ['hash' => $link->hash]) }}" method="POST">
                @method('DELETE')
                @csrf <!-- {{ csrf_field() }} -->
                <input type="hidden" name="link_hash" value="{{ $link->hash }}">
                <button type="submit" class="button-delete">
                    Delete current lucky link
                </button>
            </form>
        </div>
        <div class="button-right">
            <form action="{{ route('link.store') }}" method="POST">
                @csrf <!-- {{ csrf_field() }} -->
                <input type="hidden" name="link_hash" value="{{ $link->hash }}">
                <button type="submit" class="button-new">
                    Generate new lucky link
                </button>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="button-left">
            <form action="{{ route('game.store') }}" method="POST">
                @csrf <!-- {{ csrf_field() }} -->
                <input type="hidden" name="link_hash" value="{{ $link->hash }}">
                <button type="submit" class="button-play">
                    Imfeelinglucky
                </button>
            </form>
        </div>
        <div class="button-right">
            <a href="/game-management/games?link_hash={{ $link->hash }}">
                <button type="button" class="button-history">
                    History
                </button>
            </a>
        </div>
    </div>
    @isset ($game)
        <div>
            <p>Score: {{ $game->score }}</p>
            <p>Result: {{ $game->result }}</p>
            <p>Win Amount: {{ $game->win_amount }}</p>
        </div>
    @endisset
</div>
</body>
</html>
