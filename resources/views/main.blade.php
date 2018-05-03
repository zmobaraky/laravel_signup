<html>
  <head>
      <link rel="stylesheet" href="/css/style.css">
      <script src="/js/jquery.min.js"></script>
      <script src="/js/ajax.js"></script>
  </head>
  <body>
    <header>
      <a href='index.php'>Home</a>
    </header>



    <div id="header">
        <h3>@yield('title')</h3>
    </div>
    @yield('message')
    @yield('content')
    <footer>
      Copyright
    </footer>
  <body>
<html>
