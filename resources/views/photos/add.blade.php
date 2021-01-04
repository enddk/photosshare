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
    @if(count($errors) > 0)
    @endif
      <div class="row justify-content-center">
        <form action="add" class="col-10 contentinfo" enctype="multipart/form-data" method="POST">
        @csrf
          <div class="form-group">
            <label for="image">画像</label>
            <input type="file" name="image" id="image" class="form-control-file">
            @error('image')
            <p class="mt-0" style="color:red;">{{$message}}</p>
            @enderror
          </div>
          <div class="form-group">
            <label for="title">タイトル</label>
            <input type="text" class="form-control" id="title" name="title">
            @error('title')
            <p class="mt-0" style="color:red;">{{$message}}</p>
            @enderror
          </div>
          <div class="form-group">
            <label for="text">テキスト</label>
            <textarea name="text" id="text" rows="3" class="form-control"></textarea>
          </div>
          <div class="form-group">
            <input type="hidden" value="{{Auth::user()->id}}" name="user">
          </div>
          <div class="row justify-content-between">
            <button type="submit" class="btn btn-primary">投稿</button>
            <a href="../index" class="btn btn-secondary">キャンセル</a>  
          </div>
        </form>
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