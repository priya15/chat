<div class="container">
	<div class="col-md-6">
		<table class="table table-bordered">
			<thead><tr><th>Username</th><th>New Message</th><th></th></tr></thead>
			<tbody class="msgdata">
      <?php $data = $this->welcome_database->alluserlist();
           if(!empty($data)){
           	for ($i=0; $i <count($data) ; $i++) { ?>
           	<?php if($data[$i]["id"]!=$this->session->userdata["userid"]){?>
	         <tr>
	           <td><?php echo $data[$i]["username"]; ?></td>
	           <td class="countdata"><?php $count = $this->welcome_database->countnewmsg($data[$i]["id"],$this->session->userdata["userid"])?><div class="count"><?php echo $count[0]["count"];?></div></td>
	           <td><input type="button" value="StartChat" target="<?php echo $data[$i]["id"];?>" class="btn btn-primary schat"></td></tr>           		
           <?php
           	} }}
      ?>
  </tbody>
</table>
 <div class="modal fade" id="my-modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Message</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>
	</div>
</div>
<script type="text/javascript">
    var s_id=0;
    var mchatdata=0;
	window.setInterval(function(){
        $.ajax({
				url:"<?php echo base_url()?>countnewmsg",
				type:"post",
				success:function(data){
		          $(".msgdata").html(data);
				},
				error:function(data){

				}
			});
           if(mchatdata == 1){
           		$.ajax({
				url:"<?php echo base_url()?>chatdata",
				type:"post",
				data:{"id":s_id},
				success:function(data){
					    
					    $(".modal-body").html(data);
					console.log(data);
				},
				error:function(data){

				}
			});
           }
	
}, 10000);


$(document).on('click','.schat',function(){
	       mchatdata=1;
			var id = $(this).attr("target");
			s_id =id;
			$.ajax({
				url:"<?php echo base_url()?>chatdata",
				type:"post",
				data:{"id":id},
				success:function(data){
					    $('#my-modal').modal({
                         show: 'true'
                         }); 
					    $(".modal-body").html(data);
					console.log(data);
				},
				error:function(data){

				}
			});
		})

	$(document).on('click','.sendmessage',function(){
			var id = $(this).attr("target");
			var msg = $(".msg_"+id+"").val();
			console.log("dfdf",msg);
			$.ajax({
				url:"<?php echo base_url()?>addchatdata",
				type:"post",
				data:{"id":id,"msg":msg},
				success:function(data){
					if(data == 1){
						$.ajax({
				url:"<?php echo base_url()?>chatdata",
				type:"post",
				data:{"id":id},
				success:function(data){
					    $('#my-modal').modal({
                         show: 'true'
                         }); 
					    $(".modal-body").html(data);
					console.log(data);
				},
				error:function(data){

				}
			});

					}
					    
				},
				error:function(data){

				}
			});
	})
</script>
<style type="text/css">
	.count{
		border-radius:50%;
		background-color: red;
		width: 14%;/* 
		padding-left: 22%; */
		text-align: center;
	}
</style>