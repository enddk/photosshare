<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="../style.css">
  <meta name="csrf-token" content="{{csrf_token()}}">
</head>
<body>
  <div class="container-fluid">
    <div class="navbar navbar-light bg-light fixed-top">
      <a href="../index" class="navbar-brand">
        @if(Auth::check())
        こんにちは、{{Auth::user()->name}}さん
        @else
        こんにちは、ゲストさん
        @endif
      </a>

      <ul class="nav">
        <li class="nav-item">
          <a href="logout" class="nav-link pl-0">
            <i class="fas fa-sign-out-alt"></i>
            <span>ログアウト</span>
          </a>
        </li>
        <li class="nav-item">
          <a href="add" class="nav-link pl-0">
            <i class="fas fa-plus-square"></i>
            <span>投稿</span>
          </a>
        </li>
        <li class="nav-item">
          <a href="mypage" class="nav-link pl-0">
            <i class="fas fa-user-circle"></i>
            <span>マイページ</span>
          </a>
        </li>
      </ul>
    </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-md-8 col-12">
          @foreach($items as $item)
          <img src="../../storage/app/{{$item->image}}" alt="">
          <div class="contentinfo">
            <h2>{{$item->title}}</h2>
            <p>{{$item->text}}</p>
            <p class="card-text">
              @if(Auth::user()->id == $item->id)
              <a href="mypage">by:{{$item->name}}</a>
              @else
              <a href="../index/profile?id={{$item->id}}">by:{{$item->name}}</a>
              @endif
            </p>
            <div class="row justify-content-between mb-5">
              @if(Auth::user()->id == $item->id)
              <form action="delete" method="post">
                @csrf
                <input type="hidden" value="{{$item->post_id}}" name="post_id">
                <button type="submit" class="btn btn-danger">削除</button>
              </form>
              <a href="../index" class="btn btn-secondary">戻る</a>
              @else 
              <a href="../index" class="btn btn-secondary">戻る</a>
              @endif
            </div>
          </div>
          @endforeach
        </div>
        <div class="col-md-4 col-12">
          <div class="mb-2">
            @foreach($items as $item)
              <span class="border p-2 mr-1 d-inline-block" style="border-radius:5px;" id="app">
                <example-component :post_id="{{$item->post_id}}" :user_id="{{Auth::user()->id}}"></example-component>
              </span>
              <a href="download?filename={{$item->image}}" class="border p-2 d-inline-block" style="border-radius:5px; color:black;">
                <i class="fas fa-arrow-down">
                  Download
                </i>
              </a>
            @endforeach
          </div>
          <div class="comments" style="height:300px; overflow:auto;">
            @foreach($comments as $comment)
              <div class="comment border-bottom p-2">
                <h5 style="font-size:12px;">{{$comment->comment}}</h5>
                <p class="m-1" style="font-size:10px;">{{$comment->user}} {{$comment->created_at}}</p>
              </div>
            @endforeach
          </div>
          @foreach($items as $item)
          <form action="comment" method="post">
          @csrf
            <textarea class="form-control" name="comment" id="area"></textarea>
            <input type="hidden" name="user" value="{{Auth::user()->name}}">
            <input type="hidden" name="post_id" value="{{$item->post_id}}">
            <button class="btn btn-primary mt-2" id="btn" disabled>送信</button>
          </form>
          @endforeach
        </div>
      </div>
    </div>
  </div>


  <footer class="bg-dark">
    <p class="text-center">
      <small style="color:white;">Copyright &copy; 2020 </small>
    </p>
  </footer>
 
  <script>
    var btn = document.querySelector('#btn');
    var area = document.querySelector('#area');

    area.addEventListener('input', function(){
      if(area.value.length == 0){
        btn.disabled = true;
      } else {
        btn.disabled = false;
      }
    });

  </script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="../js/app.js"></script>
</body>
</html>