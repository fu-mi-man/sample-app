<table border="">
    <tr>
        <th>カテゴリ</th>
        <th>書籍名</th>
        <th>価格</th>
    </tr>
    @foreach ($books as $book)
    <tr @if ($loop->even) style="background-color: #f0f0f0" @endif>
        <td>{{ $book->category->title }}</td>
        <td>{{ $book->title }}</td>
        <td>{{ $book->price }}</td>
    </tr>
    @endforeach
</table>
