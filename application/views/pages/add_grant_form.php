<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >

<script type="text/javascript" src="<?php echo base_url();?>assets/js/zebra_datepicker.js"></script>
<script type="text/javascript">
$(function(){
  $("#date").Zebra_DatePicker({
  
  });
  
});
</script>
<?php echo validation_errors(); ?>
<div class="col-md-8 col-md-offset-2">
    <center> 		<strong><?php if(isset($msg)){ echo $msg;}?></strong>
 <h3><u>ADD GRANT</u></h3></center><br>
    <?php echo form_open('masters/add/grant',array('role'=>'form')); ?>
    <div class="form-group">
        <label for="grant_name" class="col-md-4">Grant Name</label>
        <div  class="col-md-8">
        <input type="text" class="form-control" placeholder="Grant Name" id="grant_name" name="grant_name" />
        </div>
    </div>
     <div class="form_group">		
     <label for="phase_name" class="col-md-4">Grant Phase Name</label>   
      <div  class="col-md-8">    
        <script>


       $(document).ready (function () {
				$("#grant_name").change(function(){
					$("#phase_name").val($(this).val());
				});
                $phasecount=1;
                $('.btnAdd').click (function () {       
                    $('.buttons').append('<div class="col-md-6 col-md-offset-4"><input type="text" name="phase_name[]" class="form-control" value="Phase '+($phasecount++)+'" /></div><div class="col-md-2"><input type="button" class="btn btn-sl btn-primary btnRemove col-md-2" value="X"></div>'); // end append
					$('div .btnRemove').last().click (function () {      
						$(this).parent().last().remove();    
					}); // end click
                }); // end click                

            }); // end ready
        </script></div></div>
        
        <div class="buttons">
             <div  class="col-md-8"> 
            <div class="form_group">
           <input type="text" name="phase_name[]" class="form-control" id="phase_name" placeholder="Phase Name" > 
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         
           <input type="button"  class="btnAdd" value="Add phases"></td></tr><br>
       </div></div></div>
         <div class="form-group">
		<label for="grant_source" class="col-md-4" >Grant Source</label>
		<div  class="col-md-8">
		<select name="grant_source" id="grant_source" class="form-control">
		<option value="">--SELECT--</option>
		<?php foreach($grant_sources as $grant_source){
			echo "<option value='$grant_source->grant_source_id'>$grant_source->grant_source</option>";
		}
		?>
		</select>		
	</div>
	</div>
   <div class="form_group">
        <label for="date" class="col-md-4">Date</label>
        <div  class="col-md-8">
        <input type="text" class="form-control" placeholder=" Date" id="date" name="date" />
        </div>
    </div>
       <div class="col-md-3 col-md-offset-4"> 
    <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
    </div>
</div>