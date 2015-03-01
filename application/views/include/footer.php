<div class="container">
	<?php print_r($this -> session -> all_userdata()); ?>
</div>

<!-- CONFIRM MODAL -->
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">คำเตือน</h4>
				</div>
				<div class="modal-body"></div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">
						ยกเลิก
					</button>
					<a class="btn btn-danger" name="userId" id="userId" href="#">ยืนยัน</a>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).on("click", ".open-ConfirmDialog", function() {
		var userId = $(this).data('id');
		var bodyMsg = $(this).data('msg')
		$(".modal-footer #userId").attr("href", userId);
		$(".modal-body").html(bodyMsg);
	}); 
</script>
</body>
</html>
