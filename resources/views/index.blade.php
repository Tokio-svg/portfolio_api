<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>管理画面</title>
  <link rel="stylesheet" href="{{asset('/css/destyle.css')}}">
  <link rel="stylesheet" href="{{asset('/css/admin.css')}}">
</head>
<body>
  <div class="content__container">

    <div>
      {{$contacts->appends(request()->query())->links('vendor.pagination.default_custom')}}
    </div>

    <table class="contacts__table">
      <tr>
        <th></th>
        <th>ID</th>
        <th>name</th>
        <th>email</th>
        <th>content</th>
        <th>open</th>
      </tr>
      @foreach($contacts as $contact)
        <tr>
          <td class="td__button">
            <form action="/delete" method="post">
              @csrf
              <input type="hidden" name="id" value="{{$contact->id}}">
              <input type="submit" value="✖" class="submit__delete">
            </form>
          </td>
          <td>{{ $contact->id }}</td>
          <td>{{ $contact->name }}</td>
          <td>{{ $contact->email }}</td>
          <td>{{ $contact->content }}</td>
          <td class="td__button">
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
        </tr>
      @endforeach
    </table>

  </div>
</body>
</html>