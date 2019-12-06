<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId: '1117418075108494',
      cookie: true, // This is important, it's not enabled by default
      version: 'v4.0'
    });

    FB.api(
      '/102802017779421/?fields=access_token&access_token=1117418075108494|bK6_oQKC3iJyoXtaoAVipXQuVT4',
      'GET',
      {},
      function(response) {
          var jsonres = JSON.stringify(response);
          console.log(jsonres);
          // var data1 = JSON.parse(jsonres);
          // for (var i = 0; i < data1.data.length; i++) {
          //   var data2 = JSON.stringify(data1.data[i]);
          //   var value = JSON.parse(data2);
          //   console.log(value.message);
          //   console.log(value.id);
          //   var datetime = value.created_time;
          //   console.log(datetime.substring(0,10));
          //   console.log(datetime.substring(11,19));
            
          //   var datetime = value.created_time;

          //   var node1 = document.createElement("LI");
          //   var textnode1 = document.createTextNode("PESAN : "+value.message);
          //   node1.appendChild(textnode1);

          //   var node2 = document.createElement("LI");
          //   var textnode2 = document.createTextNode("ID : "+value.id);
          //   node2.appendChild(textnode2);

          //   var node3 = document.createElement("LI");
          //   var textnode3 = document.createTextNode("TANGGAL : "+datetime.substring(0,10));
          //   node3.appendChild(textnode3);

          //   var node4 = document.createElement("LI");
          //   var textnode4 = document.createTextNode("WAKTU : "+datetime.substring(11,19));
          //   node4.appendChild(textnode4);

          //   document.getElementById("FBDATA").appendChild(node2);
          //   document.getElementById("FBDATA").appendChild(node1);
          //   document.getElementById("FBDATA").appendChild(node3);
          //   document.getElementById("FBDATA").appendChild(node4);
          // }
      }
    );
  };
</script>
<script async defer src="https://connect.facebook.net/en_US/sdk.js"></script>