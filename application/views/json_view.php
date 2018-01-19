<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">  
	<script type="text/javascript" src="<?php echo base_url() ?>vendor/bootstrap.js"></script>
 	<script type="text/javascript" src="<?php echo base_url() ?>1.js"></script>
	<link rel="stylesheet" href="<?php echo base_url() ?>vendor/bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>vendor/font-awesome.css">
 	<link rel="stylesheet" href="<?php echo base_url() ?>1.css">
</head>
<body>
	<div class="container">
		<div class="card-deck-wrapper">
			<div class="card-deck">
				<?php foreach ($ketquachuyenvao as $value): ?>
					<div class="card">
						<div class="card-block">
						<!-- 
						* Do giá trị của $ketquachuyenvao là dạng object sau khi decode
						* nen khi muốn lấy dữ liệu ten, sdt lấy ra từ mạng $value thì ta phải viết
						* dưới dạng $value->ten, $value->sdt thay cho cách viết $value['ten'], $value['sdt'] -->
							<h4 class="card-title">Tên:<?= $value->ten ?></h4>
							<p class="card-text">Số điện thoại:<?= $value->sdt ?></p>
							<a href="<?= base_url() ?>json_controller/xoa_json/<?= $value->sdt ?>" class="btn btn-danger btn-center">Xoá <i class="fa fa-remove"></i></a>
						</div>
					</div>
				<?php endforeach ?>
			</div>
		</div>
	</div>

<!-- Tạo form để nhập dữ liệu -->
	<div class="container">
		<form method="post" enctype="multipart/form-data" action="<?= base_url() ?>json_controller/add_Data">
			<fieldset class="form-group">
				<label for="formGroupExampleInput">Tên</label>
				<input name="ten" type="text" class="form-control" id="ten" placeholder="Họ và tên">
			</fieldset>
			<fieldset class="form-group">
				<label for="formGroupExampleInput2">Số điện thoại</label>
				<input name="sdt" type="text" class="form-control" id="sdt" placeholder="Số điện thoại">
			</fieldset>
			<fieldset class="form-group">
				<label for="formGroupExampleInput2"></label>
				<input type="submit" class="form-control btn btn-danger" id="formGroupExampleInput2" value="Tạo mới">
			</fieldset>
		</form>
	</div>
	
</body>
</html>