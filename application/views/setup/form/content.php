<?php foreach ($getform->result() as $k) :?>

<?php if($k->type_field =='TEXT'):?>
    <div class="col-xs-12 col-sm-3">
      <div class="form-group">     
        <label><?php echo $k->caption?></label>
      </div>
    </div>
    <div class="col-xs-12 col-sm-7">
      <div class="form-group">     
      	<input type="text" class="value form-control" id="<?php echo $k->id_field;?>" placeholder="">
      </div>
    </div>
<?php elseif($k->type_field =='DATE'):?>
    <div class="col-xs-12 col-sm-3">
      <div class="form-group">     
        <label><?php echo $k->caption?></label>
      </div>
    </div>
    <div class="col-xs-12 col-sm-7">
      <div class="form-group">     
      	    <div class="input-group">
               	<div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>       
            	<input type="text" id="<?php echo $k->id_field;?>" class="form-control value datepicker" placeholder="yyyy-mm-dd">
           	</div>
      </div>
    </div>
<?php elseif($k->type_field =='NUMBER'):?>
    <div class="col-xs-12 col-sm-3">
      <div class="form-group">     
        <label><?php echo $k->caption?></label>
      </div>
    </div>
    <div class="col-xs-12 col-sm-7">
      <div class="form-group">     
      	<input type="number" class="value form-control" id="<?php echo $k->id_field;?>" placeholder="">
      </div>
    </div>
<?php elseif($k->type_field =='LOV'):?>
    <div class="col-xs-12 col-sm-3">
      <div class="form-group">     
        <label><?php echo $k->caption?></label>
      </div>
    </div>
    <div class="col-xs-12 col-sm-7">
      <div class="form-group">      
      	<select class="form-control value <?php echo $k->lov;?>" id="<?php echo $k->id_field;?>">
      		
      	</select>
      </div>
    </div>
<?php endif;?>
<?php endforeach;?>
