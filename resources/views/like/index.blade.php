
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  
  <meta name="csrf-token" content="{{csrf_token()}}">
</head>
<body>
  
    @if(Auth::check())
      こんにちは、{{Auth::user()->name}}さん
      @else
      こんにちは、ゲストさん
    @endif

  <div id="app">
    <example-component :post_id="1" :user_id="1"></example-component>
  </div>
  <div id="app">
    <example-component :post_id="3" :user_id="2"></example-component>
  </div>

  <script src="js/app.js"></script>
</body>
</html>