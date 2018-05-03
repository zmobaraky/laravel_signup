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
        <h3><?php echo $__env->yieldContent('title'); ?></h3>
    </div>
    <?php echo $__env->yieldContent('message'); ?>
    <?php echo $__env->yieldContent('content'); ?>
    <footer>
      Copyright
    </footer>
  <body>
<html>
