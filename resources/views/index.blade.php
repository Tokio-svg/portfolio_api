<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>管理画面</title>
</head>
<body>
  <table>
    <tr>
      <th>ID</th>
      <th>name</th>
      <th>email</th>
      <th>content</th>
      <th>open</th>
      <th></th>
    </tr>
    @foreach($contacts as $contact)
      <tr>
        <td>{{ $contact->id }}</td>
        <td>{{ $contact->name }}</td>
        <td>{{ $contact->email }}</td>
        <td>{{ $contact->content }}</td>
        <td>
          @if(!$contact->read_flag)
            <form action="/read" method="post">
              @csrf
              <input type="hidden" name="id" value="{{$contact->id}}">
              <input type="submit" value="OK" class="submit__read">
            </form>
          @else
            既読
          @endif
        </td>
        <td>
          <form action="/delete" method="post">
            @csrf
            <input type="hidden" name="id" value="{{$contact->id}}">
            <input type="submit" value="削除" class="submit__delete">
          </form>
        </td>
      </tr>
    @endforeach
  </table>
</body>
</html>