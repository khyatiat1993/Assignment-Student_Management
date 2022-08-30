<div class="main_css">
	
	<!-- Page Header -->
	<section class="page_header_css">
		<div class="site_logo">
			<?php
			$site_logo_img = "";
			if(file_exists("images/".$site_logo_img)){
				?>
				<img src="" title="iCloudCMS" class="site_logo_img"/>
				<?php
			}else{
				?>
				<span title="iCloudCMS" class="site_logo_img">iCloudCMS</span>
				<?php
			}
			?>
		</div>
	</section>

	<!-- Page Content -->
	<section class="page_content_css">
		<div class="file_upload_css">
			<form name="upload_excel_data" id="upload_excel_data" action="form_controller/index.php" method="POST" enctype="multipart/form-data">
				<span>Upload File:</span>
				<hr />
				<input type="file" name="upload_excel_file" id="upload_excel_file" accept=".csv" />
				<hr />
				<button type="submit" name="submit_excel_file" id="submit_excel_file" value="Import">Import</button>
			</form>
		</div>
	</section>

</div>