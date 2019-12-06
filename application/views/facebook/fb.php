<html>
<body>
<div id="FBDATA">
  data facebook
</div>
<script src="<?php echo base_url();?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script>

  window.fbAsyncInit = function() {
    FB.init({
      appId: '1117418075108494',
      cookie: true, // This is important, it's not enabled by default
      version: 'v4.0'
    });

// curl -i -X GET \
//  "https://graph.facebook.com/v3.3/102802017779421?fields=feed%7Bmessage%2Ccomments%7D&access_token=EAAP4SStutI4BADFDDwiazkD3MVgQk5JZC9wNz2H4MwMTAb8OCX7JjLCxoOYhVgHnS7s4lAA1I5U9E1v4KhYwzEHp0krEs3wr0Yv27ZA3nUwklWb0yh3tQrDZBNXAONXAJ9yoYE4igzZCQZBUktnse3OursQaBJlLZB82p1Qpzw6Tph4LAZBPW2vC9lUXSXZB9662HlaXM71MKAZDZD"

    FB.api(
      '/102802017779421?fields=feed%7Bmessage%2Ccomments%7D&access_token=EAAP4SStutI4BAMwMxCLNSSMHNufxbqaqtYNhuRdNeOdMISMYV33inaaPiPaIaZCv5yw4NcQ4Rbn2GlkpsXaMJs9yxFjWCCaTIZBip1ZBaVX9yqfUzB1lffGZBOKObOhiRRGFSuYIRMb1u3c0KeK4XX7TCTfnBvgU7ZAIBOBu26gZDZD',
      'GET',
      {},
      function(response) {
        $(document).ready(function(){
			console.log(response);
		});          
      }
    );
  };


</script>
<script async defer src="https://connect.facebook.net/en_US/sdk.js"></script>
</body>
</html>
