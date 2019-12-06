 <div id="js"> 
 <script>
$(function () {
     
      $('#update').hide();
      $('#update_user').hide();
      $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
      });

      datatablepaging();

    
});




$('#save').click(function() {
  //var validation = isvalid();
  // if(validation != 'VALID'){
  //   $("#contentmodalwarning").html("Maaf Ada kesalahan dalam data yang anda input sebagai berikut :<ul>"+validation+"</ul>");
  //   $("#modalwarning").modal("show");
  // }else{
       $.ajax({
          url :"<?php echo site_url();?>registrasi/assets/save",
          type:"POST",
          data:{
        		nama      :$("#nama").val(),
        		alamat    :$("#address").val(),
            tsi       :$("#tsi").val().replace( /\D+/g, ''),
            idnasabah :$("#idnas").val(),
            idjenis   :$("#idjenis").val(),
            },
          success: function(html){
               $('#contain').val($("#nama").val());
               datatablepaging(); 
               $("#forminput")[0].reset(); 
               $("#modalform").modal("hide");
               $("#contentmodalsuccess").html("<h5>Data baru berhasil disimpan</h5>");
               $("#modalsuccess").modal("show");
                   },
          error:function error(){
              $("#contentmodalerror").html("<h5>Data baru gagal disimpan</h5>");
              $("#modalerror").modal("show");
                            }                  
        });
  // }
});

$(document).on('keyup', '#tsi', function() {
  angka = $(this).val();
  rupiahnum = angka.replace( /\D+/g, '');
  rupiah = formatcurrency(rupiahnum);
  $(this).val(rupiah);
});

$('#new').click(function() {
  $("#modalform").modal("show");
  setTimeout(function() {
    datatablepagingnasabah();  
  },100)
});

$('#close').click(function() {
  $("#update").hide();
  $("#save").show();
  $("#forminput")[0].reset();
});

$('#refresh').click(function() {
  $('#contain').val('');
  datatablepaging();
});

$('#update').click(function() {
  // var validation = isvalid();
  // if(validation != 'VALID'){
  //   $("#contentmodalwarning").html("Maaf Ada kesalahan dalam data yang anda input sebagai berikut :<ul>"+validation+"</ul>");
  //   $("#modalwarning").modal("show");
  // }else{
        $.ajax({
          url :"<?php echo site_url();?>registrasi/assets/update",
          type:"POST",
          data:{
            nama      :$("#nama").val(),
            alamat    :$("#address").val(),
            tsi       :$("#tsi").val().replace( /\D+/g, ''),
            idnasabah :$("#idnas").val(),
            id        :$("#id").val(),
            idjenis   :$("#idjenis").val(),
            },
          success: function(html){
               $('#contain').val($("#nama").val());
               datatablepaging();
               $("#forminput")[0].reset();
               $("#update").hide();
               $("#save").show();
               $("#modalform").modal("hide");
               $("#contentmodalsuccess").html("<h5>Data baru berhasil diperbaharui</h5>");
               $("#modalsuccess").modal("show");
                   },
          error:function error(){ 
                $("#contentmodalerror").html("<h5>Data baru gagal diperbaharui</h5>");
                $("#modalerror").modal("show");
                            }                  
        });
  // }
});


// $('#save_user').click(function() {
//   var validation = isvaliduser();
//   if($('#password').val() != $('#confirm').val()){
//       $("#contentmodalwarning").html("<h5>konfirmasi password tidak sesuai dengan password yang dibuat</h5>");
//       $("#modalwarning").modal("show");
//   }
//   else if(validation != 'VALID'){
//      $("#contentmodalwarning").html("Maaf Ada kesalahan dalam data yang anda input sebagai berikut :<ul>"+validation+"</ul>");
//       $("#modalwarning").modal("show");
//   }
//   else{
//        $.ajax({
//           url :"<?php echo site_url();?>registrasi/assets/save_user",
//           type:"POST",
//           data:{
//             username  :$("#username").val(),
//             password  :$("#password").val(),
//             id_user   :$("#id_user").val()
//             },
//           success: function(html){
//                $("#form_user")[0].reset();
//                $("#modalform").modal("hide");
//                $("#contentmodalsuccess").html("<h5>Data baru berhasil disimpan</h5>");
//                $("#modalcreateaccount").modal("hide");
//                $("#modalsuccess").modal("show");
//                    },
//           error:function error(){
//               $("#contentmodalerror").html("<h5>Data baru gagal disimpan</h5>");
//               $("#modalerror").modal("show");
//                             }                  
//         });
//   } 
// });


$('#dodelete').click(function() {
   $.ajax({
      url :"<?php echo site_url();?>registrasi/assets/delete",
      type:"POST",
      data:{
      id : $('#deleteid').val(),
      },
      success:function(){
      $("#contentmodalsuccess").html("<h5>Data berhasil dihapus</h5>");
      $("#modalsuccess").modal("show");
      datatablepaging();  
      },
    });   
});

$('#dorequest').click(function() {
  var idassets = $('#idrequestproteksi').val();
  window.location.replace("<?php echo site_url();?>simulasi/kendaraan/asset/"+idassets);
  //  $.ajax({
  //     url :"<?php echo site_url();?>registrasi/assets/request",
  //     type:"POST",
  //     data:{
  //     idassets : $('#idrequestproteksi').val(),
  //     },
  //     success:function(){
  //     $("#contentmodalsuccess").html("<h5>Request Anda akan diproses</h5>");
  //     $("#modalsuccess").modal("show");
  //     datatablepaging();  
  //     },
  //   });   
});

$('#close_user').click(function() {
  $("#form_user")[0].reset();
});

$(document).on('keyup', '#contain', function() {
    datatablepaging();
});





function datatablepaging() {

     $.ajax({
          url :"<?php echo site_url();?>registrasi/assets/paging?search="+$('#contain').val(),
          type:"POST",
          data:{
            },
          success: function(result){
          
          $('#paging').html(result);

          var page = parseInt($('#countpageassets').val());
              for (let i = 1; i <=page; i++) {
                $('.pageassets'+i).click(function() {
                  $('#pagenumber').html('PAGE '+i);
                  datatableview(i);
                })
              } 
            },
      });
      var x ='';
      datatableview(x);
}


function datatableview(i) {
      $('#example1').dataTable({ 
        "scrollX": true,
        "paging": false,
        "info" : false,
        "bDestroy" : true,
        "sScrollXInner": "100%" ,
        "searching" :false, 
        "ajax": "<?php echo site_url()?>registrasi/assets/ajax_data/?page="+i+"&search="+$('#contain').val()
      });
      
      var data = null;
      var table = $('#example1').DataTable();
      $('#example1 tbody').on('click', '#delete', function () {
        data = table.row( $(this).parents('tr') ).data();
          $("#deleteid").val(data[7]);
          $("#deletename").html(data[0]); 
          $("#modalconfirm").modal("show"); 
      });


      $('#example1 tbody').on('click', '#edit', function () {
        data = table.row( $(this).parents('tr') ).data();
        console.log(data);
          $("#update").show();
          $("#save").hide();

          $("#nama").val(data[0]);
          $("#address").val(data[1]);
          $("#tsi").val(data[2]);
          $("#id").val(data[7]);
          $("#modalform").modal("show");
      });

      $('#example1 tbody').on('click','#request', function () {
        data = table.row( $(this).parents('tr') ).data();
        $("#contentrequest").html('Apakah anda yakin ingin memproteksi assets '+data[0]+' ?');
        $("#idrequestproteksi").val(data[7]);
        $("#modalrequest").modal("show");
      });
}

// function isvalid() {
//     //cek if blank
//     var result = 'VALID';
//     var cekblank =0;
//     var messageblank = '';
//     $('.entries').each(function() {
//       if ($(this).val()==''){
//         cekblank++;
//       }
//     });
//     if (cekblank > 0){
//       messageblank = '<li>mohon isi semua keterangan pada form</li>';
//     }

//     //cek valid email
//     var email = $('#email').val();
//     var messageemail = '';
//     var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
//     if (filter.test(email)) {
//     }
//     else {
//       messageemail = '<li>mohon gunakan format email yang valid</li>';;
//     }

//     //cek valid phoe
//     var telp = $('#telp').val();
//     var messagetelp = '';
//     var filter2 = /^[0-9]+$/;
//     if (filter2.test(telp)) {
//     }
//     else {
//       messagetelp = '<li>mohon masukkan no telp dengan benar</li>';;
//     }

//     if(messageblank!= '' || messageemail != '' || messagetelp != ''){
//       result = messageblank+messageemail+messagetelp;
//     }

//     return result;
// }

// function isvaliduser() {
//     //cek if blank
//     var result = 'VALID';
//     var cekblank =0;
//     var messageblank = '';
//     $('.entries2').each(function() {
//       if ($(this).val()==''){
//         cekblank++;
//       }
//     });
//     if (cekblank > 0){
//       messageblank = '<li>mohon isi semua keterangan pada form</li>';
//     }

//     if(messageblank!= ''){
//       result = messageblank;
//     }

//     return result;
// }


function formatcurrency(number) { 
  
  var number_string = number.toString(),
  sisa  = number_string.length % 3,
  rupiah  = number_string.substr(0, sisa),
  ribuan  = number_string.substr(sisa).match(/\d{3}/g);
    
  if (ribuan) {
    separator = sisa ? ',' : '';
    rupiah += separator + ribuan.join(',');
  }
  rupiah = "Rp. "+ rupiah;
  return rupiah;
}

 </script>
 </div>