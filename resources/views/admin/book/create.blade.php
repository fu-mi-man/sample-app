<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <main>
        <h1>書籍登録</h1>
        <form action="{{ route('book.store') }}" method="POST">
            @csrf
            <div>
                <label>カテゴリ</label>
                <select name="category_id">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->title }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label>タイトル</label>
                <input type="text" name="title">
            </div>
            <div>
                <label>価格</label>
                <input type="text" name="price">
            </div>
            <input type="submit" value="送信">
        </form>
    </main>
</body>
</html>
