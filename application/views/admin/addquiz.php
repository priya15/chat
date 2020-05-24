<div class="col-md-6">
	<form action="<?php echo base_url()?>questiondata" method="post">
	<div class="form-class">
		<b>Add Quiz</b>
		<input type="text" name="quiz" class="form-control" required>
	</div>
	<input type="button" id="addques" value="AddQuestion" class="btn btn-default">
	<div class="form-class ques1">
		<b>Add Questions</b>
		<input type="text" name="question[]" class="form-control" required>
		<b>Add Answer1</b>
		<input type="text" name="answer1[]" class="form-control" required>
		<b>Add Answer2</b>
		<input type="text" name="answer2[]" class="form-control" required>
		<b>Add Answer3</b>
		<input type="text" name="answer3[]" class="form-control" required>
		<b>Add Anser4</b>
		<input type="text" name="answer4[]" class="form-control" required>
		<b>Add CorrectAnswer</b>
		<input type="text" name="c_answer1[]" class="form-control" required>

      
	</div>
	  
	<div id="ques2"></div>
	  
	<div id="ques3"></div>
	<div class="form-class">
		<input type="button" class="btn btn-primary" value="AddMore" id="addmore">
		<input type="submit" value="AddQUIZ" class="btn btn-danger">
	</div>

</div>
<script type="text/javascript">
	$(document).ready(function(){
       var i=2;
		$("#addmore").click(function(){
          i++;
          if(i ==3){
          $("#ques2").html("<b>Add Questions</b><input type='text' name='question[]' class='form-control' required><b>Add Answer1</b><input type='text' name='answer1[]' class='form-control' required><b>Add Answer2</b><input type='text' name='answer2[]' class='form-control' required><b>Add Answer3</b><input type='text' name='answer3[]' class='form-control' required><b>Add Anser4</b><input type='text' name='answer4[]' class='form-control' required><b>Add CorrectAnswer</b><input type='text' name='c_answer1[]' class='form-control' required>");
      }
      if(i==4){
      	$("#ques3").html("<b>Add Questions</b><input type='text' name='question[]' class='form-control' required><b>Add Answer1</b><input type='text' name='answer1[]' class='form-control' required><b>Add Answer2</b><input type='text' name='answer2[]' class='form-control' required><b>Add Answer3</b><input type='text' name='answer3[]' class='form-control' required><b>Add Anser4</b><input type='text' name='answer4[]' class='form-control' required><b>Add CorrectAnswer</b><input type='text' name='c_answer1[]' class='form-control' required>");

      }
      if(i>4){
      	alert("question limit out");
      }
		})
	})
</script>