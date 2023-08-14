<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header"  style="background-color: white;">
		<div class="container-fluid">
			<div class="row mb-2" style="background-color: white;">
				<div class="col-sm-6" style="background-color: white;">
					<h1><?=@$headerTitle?></h1>
				</div>
				<div class="col-sm-6" style="background-color: white;">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active"><?=@$headerTitle?></li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<?=@$_mainContent?>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->