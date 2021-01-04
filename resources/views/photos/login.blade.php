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
        こんにちは、ゲストさん
      </a>

      <ul class="nav">
        <li class="nav-item">
          <a href="login" class="nav-link pl-0">
            <i class="fas fa-sign-in-alt"></i>
            <span>ログイン</span>
          </a>
        </li>
        <li class="nav-item">
          <a href="signin" class="nav-link pl-0">
            <i class="fas fa-pen"></i>
            <span>サインイン</span>
          </a>
        </li>
      </ul>
    </div>

    <div class="container-fluid">
      <div class="row justify-content-center border">
      @if (session('message'))
        <div class="col-10">
          <p class="mt-3 text-center" style="color:red;">{{session('message')}}</p>
        </div>
      @endif
        <form action="login" class="col-10 contentinfo" method="post">
        @csrf
          <div class="form-group">
            <label for="mail">メールアドレス</label>
            <input type="text" class="form-control" id="mail" name="mail">
          </div>
          <div class="form-group">
            <label for="password">パスワード</label>
            <input type="password" class="form-control" id="password" name="password">
          </div>
          <div class="row justify-content-between">
            <button type="submit" class="btn btn-primary">ログイン</button>
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