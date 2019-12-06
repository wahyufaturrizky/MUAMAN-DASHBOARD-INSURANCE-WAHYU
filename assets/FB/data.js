
  window.fbAsyncInit = function() {
    FB.init({
      appId: '1117418075108494',
      cookie: true, // This is important, it's not enabled by default
      version: 'v4.0'
    });


 // curl -i -X GET \
 // "https://graph.facebook.com/v4.0/102802017779421/?fields=feed.limit(1)%7Bmessage%2Ccomments.limit(10)%2Ccreated_time%7D&access_token=EAAP4SStutI4BAFPYhSkC0bugjKFgXHbKclP9dRZAnwRKOZB1zNlEJ2hGwPkJFvHZBaZBjZBm846ZCoGQmIcNcN5l6qIteqeF9x9YJZBtPHyihnJxBQYuMAiEeulofTdA1PtUZBLuOdl9OG5r7YyfcSHZBpmniaGjUhcOgZB286yZB22TQZDZD"
    FB.api(
      '/102802017779421?fields=feed.limit(1)%7Bmessage%2Ccomments.limit(10)%2Ccreated_time%7D&access_token=EAAP4SStutI4BAFPYhSkC0bugjKFgXHbKclP9dRZAnwRKOZB1zNlEJ2hGwPkJFvHZBaZBjZBm846ZCoGQmIcNcN5l6qIteqeF9x9YJZBtPHyihnJxBQYuMAiEeulofTdA1PtUZBLuOdl9OG5r7YyfcSHZBpmniaGjUhcOgZB286yZB22TQZDZD',
      'GET',
      {},
      function(response) {
        $(document).ready(function(){
          var sresponse = JSON.stringify(response);
          //console.log(sresponse);
			    $.each($.parseJSON(sresponse), function() {
            var sdata = JSON.stringify(this.data);
            console.log(sdata);
            $.each($.parseJSON(sdata), function() {
              //if(this.message != null){
              $("#data").append('<div><b><h3 class="text-blue">' +this.message+'</h5></b></div>');
              $("#data").append('<div><b><h5 class="text-green">POST ID : ' +this.id+'</h5></b></div>');
              $("#data").append('<div><b><h5 class="text-green">CREATED TIME : ' +this.created_time+'</h5></b></div>');
                  //comment
                  var scomment = JSON.stringify(this.comments);
                  $("#data").append('<div><h4>Comment : </h4></div>')
                  $.each($.parseJSON(scomment), function() {
                      sdata = JSON.stringify(this);
                      console.log(sdata);
                     
                          $.each($.parseJSON(sdata), function() {
                              if(this.message != null){
                                
                               $("#data").append('<div style="padding-left:20px"><h4  class="text-blue"><span class="message">' + this.message + '</span></h4></div>');
                                $("#data").append('<div style="padding-left:20px"><h6  class="text-green">COMMENT ID : <span class="id">' + this.id + '</span></h6></div>');
                                $("#data").append('<div style="padding-left:20px"><h6  class="text-green">CREATED TIME : <span class="timestamp">' + this.created_time + '</span></h6></div>');
                                $("#data").append('<div><hr></div>');
                              }
                          });
                      
                  });
              //}  
            });   

          });
		    });          
      }
    );
  };
