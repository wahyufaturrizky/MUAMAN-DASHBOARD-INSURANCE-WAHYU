               <?php $rowcount = count($getformvalue);?>

                <div id="formcontentdetail">
                  <div class="row">
                    <div class="col-xs-12 col-sm-3">
                      <div class="form-group">     
                        <label>No Polisi</label>
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-9">
                      <div class="form-group">     
                        <?php if($rowcount>0):$value = $getformvalue[0]['no_polisi']; else :$value=''; endif; ?>
                        <input type="text" class="form-control entries2" id="nopol" name="nama" placeholder="Nomor Polisi" value="<?php echo $value;?>">
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-xs-12 col-sm-3">
                      <div class="form-group">     
                        <label>No Rangka/Mesin</label>
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-9">
                      <div class="form-group">
                        <?php if($rowcount>0):$value = $getformvalue[0]['no_rangka_mesin']; else:$value=''; endif; ?>     
                        <input type="text" class="form-control entries2" id="norangka" name="nama" placeholder="Nomor Rangka / Mesin" value="<?php echo $value;?>">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-xs-12 col-sm-3">
                      <div class="form-group">     
                        <label>Penggunaan</label>
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-9">
                      <div class="form-group">
                         <?php if($rowcount>0):$value = $getformvalue[0]['penggunaan']; else:$value=''; endif; ?>      
                        <input type="number" class="form-control entries2" id="penggunaan" name="nama" placeholder="digunakan sudah ... tahun" value="<?php echo $value;?>">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-xs-12 col-sm-3">
                      <div class="form-group">     
                        <label>THP</label>
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-9">
                      <div class="form-group">
                       <?php if($rowcount>0):$value = $getformvalue[0]['thp']; else:$value=''; endif; ?>      
                        <input type="text" class="form-control entries2" id="thp" name="nama" placeholder="Rp. Nilai THP" value="<?php echo $value;?>">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-xs-12 col-sm-3">
                      <div class="form-group">     
                        <label>Kondisi</label>
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-9">
                      <div class="form-group">
                        <?php if($rowcount>0):$value = $getformvalue[0]['kondisi']; else:$value=''; endif; ?>      
                        <select class="form-control entries2" id="kondisi">
                      <?php if($value === 'Total Loss Only'):?>
                        <option value="Total Loss Only" selected>Total Loss Only</option>
                        <option value="Comprehensive">Comprehensive</option>
                      <?php elseif($value === 'Comprehensive'):?>
                        <option value="Total Loss Only">Total Loss Only</option>
                        <option value="Comprehensive" selected>Comprehensive</option>
                      <?php else :?>
                        <option value="Total Loss Only">Total Loss Only</option>
                        <option value="Comprehensive">Comprehensive</option>
                      <?php endif;?>
                      </select>
                        </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-xs-12 col-sm-3">
                      <div class="form-group">     
                        <label>TJH Pihak 3</label>
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-9">
                      <div class="form-group">     
                         <?php if($rowcount>0):$value = $getformvalue[0]['TJHpihak3']; else:$value=''; endif; ?> 
                        <input type="text" class="form-control entries2" id="tjhpihak3" name="nama" placeholder="Rp. Nilai TJH Pihak 3" value="<?php echo $value;?>">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-xs-12 col-sm-3">
                      <div class="form-group">     
                        <label>TJH Penumpang</label>
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-9">
                      <div class="form-group">
                        <?php if($rowcount>0):$value = $getformvalue[0]['TJHpenumpang']; else:$value=''; endif; ?>     
                        <input type="text" class="form-control entries2" id="tjhpenumpang" name="nama" placeholder="Rp. Nilai TJH Pihak 3" value="<?php echo $value;?>">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-xs-12 col-sm-3">
                      <div class="form-group">     
                        <label>PA Pengemudi</label>
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-9">
                      <div class="form-group">     
                        <?php if($rowcount>0):$value = $getformvalue[0]['PApengemudi']; else:$value=''; endif; ?>
                        <input type="text" class="form-control entries2" id="papengemudi" name="nama" placeholder="Rp. Nilai PA Pengemudi" value="<?php echo $value;?>">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-xs-12 col-sm-3">
                      <div class="form-group">     
                        <label>PA Penumpang</label>
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-9">
                      <div class="form-group">
                        <?php if($rowcount>0):$value = $getformvalue[0]['PApenumpang']; else:$value=''; endif; ?>     
                        <input type="text" class="form-control entries2" id="papenumpang" name="nama" placeholder="Rp. Nilai PA Penumpang" value="<?php echo $value;?>">
                      </div>
                    </div>
                  </div>

            <?php if($rowcount>0):?>
                <?php 
                $item = explode("|",$getformvalue[0]['aksesoris_item']);
                $price = explode("|",$getformvalue[0]['aksesoris_harga']);
              if(count($item)==0):?>
                  <div class="row">
                    <div class="col-xs-12 col-sm-3">
                      <div class="form-group">     
                        <label>Aksesoris</label>
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-9">
                      <div class="form-group">
                        <input type="button" class="btn btn-info btn-flat" id="addaksesoris" value="Tambah Item">
                      </div>
                    </div>
                  </div>
                  <input type="hidden" id="indexitem" value="0">
                   <div id="addrowitem">
                      
                    </div>
              <?php else: ?>
                  <div class="row">
                    <div class="col-xs-12 col-sm-3">
                      <div class="form-group">     
                        <label>Aksesoris</label>
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-9">
                      <div class="form-group">
                        <input type="button" class="btn btn-info btn-flat" id="addaksesoris" value="Tambah Item">
                      </div>
                    </div>
                  </div>

                    <?php for ($i=0; $i < count($item); $i++) : ?>
                      <div class="row">
                        <div class="col-xs-12 col-sm-3">
                          <div class="form-group">     
                            <label>Item <?php $indexitem = $i+1; echo $i+1;?></label>
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-5">
                          <div class="form-group">
                            <input type="text" class="form-control namaitem" value="<?php echo $item[$i];?>" placeholder="Nama Item">
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-4">
                          <div class="form-group">
                            <input type="text" class="form-control hargaitem" value="<?php echo $price[$i];?>" placeholder="Rp. Harga Item">
                          </div>
                        </div>
                      </div>
                    <?php endfor;?>
                    <input type="hidden" id="indexitem" value="<?php echo $indexitem;?>">
                    <div id="addrowitem">
                      
                    </div>
              <?php endif; ?>
            <?php else:?>
                <div class="row">
                    <div class="col-xs-12 col-sm-3">
                      <div class="form-group">     
                        <label>Aksesoris</label>
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-9">
                      <div class="form-group">
                        <input type="button" class="btn btn-info btn-flat" id="addaksesoris" value="Tambah Item">
                      </div>
                    </div>
                  </div>
                  <input type="hidden" id="indexitem" value="0">
                   <div id="addrowitem">
                      
                    </div>
              <?php endif; ?>
                  <div class="row">
                    <div class="col-xs-12 col-sm-3">
                      <div class="form-group">     
                        <label>Lainnya</label>
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-9">
                      <div class="form-group">
                         <?php if($rowcount>0):$value = $getformvalue[0]['lain2']; else:$value=''; endif; ?>     
                        <input type="text" class="form-control entries2" id="lainnya" name="nama" placeholder="Rp. Nilai Lainnya" value="<?php echo $value;?>">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-xs-12 col-sm-3">
                      <div class="form-group">     
                        <label>Informasi</label>
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-9">
                      <div class="form-group">
                         <?php if($rowcount>0):$value = $getformvalue[0]['informasi']; else:$value=''; endif; ?>
                        <textarea class="form-control entries2" id="informasi" placeholder="informasi klaim"><?php echo $value;?></textarea>     
                      </div>
                    </div>
                  </div>
                </div>
                <script>
                  $('#thp').val(formatcurrency($('#thp').val()));
                  $('#tjhpenumpang').val(formatcurrency($('#tjhpenumpang').val()));
                  $('#tjhpihak3').val(formatcurrency($('#tjhpihak3').val()));
                  $('#papengemudi').val(formatcurrency($('#papengemudi').val()));
                  $('#papenumpang').val(formatcurrency($('#papenumpang').val()));
                  $('#lainnya').val(formatcurrency($('#lainnya').val()));
                  $('.hargaitem').each(function() {
                        $(this).val(formatcurrency($(this).val()));
                  });



                  function akseptasi() {
                      var item_name = itemValue();
                      var item_harga = hargaItem();


                    // $(document).on('keyup', '#tjhpihak3', function() {
                    //   angka = $(this).val();
                    //   rupiahnum = angka.replace( /\D+/g, '');
                    //   rupiah = formatcurrency(rupiahnum);
                    //   $(this).val(rupiah);
                    // });



                      $.ajax({ 
                              url :"<?php echo site_url();?>polis/polis/akseptasikendaraan",
                              type:"POST",
                              data:{
                                  registrasi      :$("#registrasi").val(),
                                  no_polisi       :$("#nopol").val(),
                                  no_rangka       :$("#norangka").val(),
                                  penggunaan      :$("#penggunaan").val(),
                                  thp             :$("#thp").val().replace( /\D+/g, ''),
                                  kondisi         :$("#kondisi").val(),
                                  tjhpihak3       :$("#tjhpihak3").val().replace( /\D+/g, ''),
                                  tjhpenumpang    :$("#tjhpenumpang").val().replace( /\D+/g, ''),
                                  papengemudi     :$("#papengemudi").val().replace( /\D+/g, ''),
                                  papenumpang     :$("#papenumpang").val().replace( /\D+/g, ''),
                                  lainnya         :$("#lainnya").val().replace( /\D+/g, ''),
                                  informasi       :$("#informasi").val(),
                                  namaitem        :item_name,
                                  hargaitem       :item_harga, 
                                },
                              success: function(result){
                              var status = '1';
                              return status;
                                },
                              error:function error(){
                              var status = '0';
                              return status ;
                              }
                            });
                    }


                    function itemValue() {
                      var value = '';
                      var delimiter ='';
                      $('.namaitem').each(function() {
                        value = value + delimiter +$(this).val();
                        delimiter = '|';
                      });

                      return value;
                    }

                    function hargaItem() {
                      var value = '';
                      var delimiter ='';
                      $('.hargaitem').each(function() {
                        value = value + delimiter +$(this).val().replace( /\D+/g, '');
                        delimiter = '|';
                      });

                      return value;
                    }
                </script>