<html>
<body>

<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId: '1117418075108494',
      cookie: true, // This is important, it's not enabled by default
      version: 'v4.0'
    });

    FB.api(
      '/102802017779421/visitor_posts',
      'GET',
      {},
      function(response) {
          console.log(response);
      }
    );
  };
</script>
</body>
</html>
