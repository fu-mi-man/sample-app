<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <main>
        <h1>メッセージ一覧</h1>
        <form action="/messages" method="post">
            @csrf
            <input type="text" name="body">
            <button type="submit">投稿</button>
        </form>
        <ul>
            @foreach ($messages as $message)
                <li>{{ $message->body }}</li>
            @endforeach
        </ul>
    </main>
</body>
</html>
