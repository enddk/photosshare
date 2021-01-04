<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container-fluid">
    <div class="navbar navbar-light bg-light fixed-top">
      <a href="index" class="navbar-brand">
        @if(Auth::check())
        こんにちは、{{Auth::user()->name}}さん
        @else
        こんにちは、ゲストさん
        @endif
      </a>

      <ul class="nav">
        @foreach($data as $item)
        <li class="nav-item">
          <a href="index/{{$item['pass']}}" class="nav-link pl-0">
          <i class="{{$item['icon']}}"></i>
          <span>{{$item['navi']}}</span>
          </a>
        </li>
        @endforeach
      </ul>
    </div>

    <div class="container-fluid">
      <div class="row justify-content-between justify-content-lg-start">
        @if (session('message'))
          <div class="col-12">
            <p class="text-center">{{session('message')}}</p>
          </div>
        @endif
        
        <div class="col-12 logo">
          <img src="img/logo.png" alt="">
          
        </div>

        <!-- <div class="col-12 p-0" style="display:flex; justify-content:flex-end;">
          <form action="search" method="post">
            <div class="input-group p-0">
              <input type="text" class="form-control" placeholder="テキスト入力欄">
              <span class="input-group-btn">
                <button type="submit" class="btn btn-primary">
                  <i class="fas fa-search"></i>
                </button>
              </span>
            </div>
          </form>
        </div> -->

        @foreach($items as $item)
        <div class="card col-sm-6 col-lg-4 col-12">
          <div class="card-img-box">
            <img src="../storage/app/{{$item->image}}" alt="" class="card-img-top">
          </div>
          <div class="card-body">
            <h4 class="card-title">
              {{$item->title}}
            </h4>
            <p class="card-text">
                @if(Auth::id() == $item->id)
                <a href="index/mypage">by:{{$item->name}}</a>
                @else
                <a href="index/profile?id={{$item->id}}">by:{{$item->name}}</a>
                @endif
            </p>
            <a href="index/view?id={{$item->post_id}}" class="btn btn-primary">
              詳しく見る
            </a>
          </div>
        </div>
        @endforeach
      </div>
    </div>

  </div>

  <footer class="bg-dark d-block">
    <p class="text-center">
      <small style="color:white;">Copyright &copy; 2020 All Rights Reserved</small>
    </p>
  </footer>
 
  

 



  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>