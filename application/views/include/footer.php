<div class="container">
	<?php print_r($this -> session -> all_userdata()); ?>
</div>

<!-- MODAL -->
<div class="modal fade my-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<form method="post" action="#" id="link">
				
				<!-- title of modal -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel"></h4>
				</div>
				
				<!-- body of modal -->
				<div class="modal-body"></div>
				
				<!-- footer of modal -->
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">
						ยกเลิก
					</button>
					<button type="submit" class="btn btn-success">
						บันทึก
					</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	$(document).on("click", ".open-ConfirmDialog", function() {
		var urlId = $(this).data('id');
		var bodyMsg = $(this).data('msg');
		var bodyTitle = $(this).data('title');
		$(".modal-content #link").attr("action", urlId);
		$(".modal-body").html(bodyMsg);
		$(".modal-title").html(bodyTitle);
	}); 
</script>
</body>
</html>
