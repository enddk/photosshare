<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="../style.css">
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

    <div class="container-fluid border">
      <div class="row justify-content-center">
        <div class="col-10 contentinfo">
          <h5>NAME : {{Auth::user()->name}}</h5>
          <br>
          <h5>MAIL : {{Auth::user()->email}}</h5>
          <br>
          <div class="row justify-content-between" style="margin-bottom:50px;">
            <a href="../index" class="btn btn-secondary">戻る</a>  
            <a href="../index/edit?id={{Auth::user()->id}}" class="btn btn-primary">編集</a>
          </div>
          <h4>投稿作品</h4>
          <div class="row">
          @foreach($items as $item)
            <div class="card col-sm-6 col-lg-4 col-12">
            <div class="card-img-box">
              <img src="../../storage/app/{{$item->image}}" alt="" class="card-img-top">
            </div>
              <div class="card-body">
                <h4 class="card-title">
                  {{$item->title}}
                </h4>
                <p class="card-text">
                    @if(Auth::user()->id == $item->id)
                    <a href="mypage">by:{{$item->name}}</a>
                    @else
                    <a href="../index/profile?id={{$item->id}}">by:{{$item->name}}</a>
                    @endif
                </p>
                <a href="view?id={{$item->post_id}}" class="btn btn-primary">
                  詳しく見る
                </a>
              </div>
            </div> 
          @endforeach
          </div>
        </div>
      </div>
    </div>

  </div>

  <footer class="bg-dark">
    <p class="text-center">
      <small style="color:white;">Copyright &copy; 2020 </small>
    </p>
  </footer>


  


  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="../main.js"></script>
</body>
</html>