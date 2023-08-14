<footer class="main-footer text-sm">
	<div class="float-right d-none d-sm-block">
		<b>Version</b> 3.2.0-rc
	</div>
	<strong>Copyright &copy; <?php $date = "2022"; if ($date == date('Y')){ echo $date; }else if($date < date('Y')){ echo $date . " - " . date('Y'); }?> <a href="<?=base_url()?>"><?=base_name()?></a>.</strong> All rights reserved.
</footer>