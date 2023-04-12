<!-- BEGIN btn-scroll-top -->
<a href="#" data-click="scroll-top" class="btn-scroll-top fade"><i class="fa fa-arrow-up"></i></a>
<!-- END btn-scroll-top -->
</div>
<!-- END #app -->

<!-- ================== BEGIN core-js ================== -->
<script src="<?php echo base_url(); ?>/assets-cms/js/vendor.min.js"></script>
<script src="<?php echo base_url(); ?>/assets-cms/js/app.min.js"></script>
<script>
	$(function() {
		$('.select2').select2();
	});
	var timeout = 3000; // in miliseconds (3*1000)
	$('.tutup').delay(timeout).fadeOut(300);
	let base_url = '<?php echo base_url(); ?>';
</script>
<!-- ================== END core-js ================== -->

<!-- ================== BEGIN page-js ================== -->
<script src="<?php echo base_url(); ?>/assets-cms/plugins/jquery-migrate/jquery-migrate.min.js"></script>
<script src="<?php echo base_url(); ?>/assets-cms/plugins/moment.min.js"></script>
<script src="<?php echo base_url(); ?>/assets-cms/plugins/moment-hijri.js"></script>
<script src="<?php echo base_url(); ?>/assets-cms/plugins/jquery.inview.min.js"></script>
<script src="<?php echo base_url(); ?>/assets-cms/plugins/infinite-scroll.pkgd.min.js"></script>
<script src="<?php echo base_url(); ?>/assets-cms/plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script src="<?php echo base_url(); ?>/assets-cms/plugins/popover/jquery.webui-popover.min.js"></script>
<script src="<?php echo base_url(); ?>/assets-cms/plugins/EasyAutocomplete-1.3.5/jquery.easy-autocomplete.min.js"></script>
<script src="<?php echo base_url(); ?>/assets-cms/plugins/photoswipe/photoswipe.min.js"></script>
<script src="<?php echo base_url(); ?>/assets-cms/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url(); ?>/assets-cms/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="<?php echo base_url(); ?>/assets-cms/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script src="<?php echo base_url(); ?>/assets-cms/plugins/bootstrap-material-datetimepicker/bootstrap-material-datetimepicker.js"></script>
<script src="<?php echo base_url(); ?>/assets-cms/plugins/bootstrap-3-typeahead/bootstrap3-typeahead.js"></script>
<!-- <script src="<?php echo base_url(); ?>/assets-cms/plugins/bootstrap-select/js/bootstrap-select.js"></script> -->
<script src="<?php echo base_url(); ?>/assets-cms/plugins/jquery.maskedinput/src/jquery.maskedinput.js"></script>
<script src="<?php echo base_url(); ?>/assets-cms/plugins/select2/select2.js"></script>
<script src="<?php echo base_url(); ?>/assets-cms/plugins/tag-it/js/tag-it.min.js"></script>
<script src="<?php echo base_url(); ?>/assets-cms/plugins/summernote/summernote-lite.min.js"></script>
<script src="<?php echo base_url(); ?>/assets-cms/plugins/jquery-validate/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>/assets-cms/plugins/jquery-validate/additional.methods.min.js"></script>
<!-- Include a polyfill for ES6 Promises (optional) for IE11 -->
<script src="<?php echo base_url(); ?>/assets-cms/plugins/sweetalert2/polyfill.js"></script>
<script src="<?php echo base_url(); ?>/assets-cms/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="<?php echo base_url(); ?>/assets-cms/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url(); ?>/assets-cms/plugins/jquery-migrate/jquery-migrate.min.js"></script>
<script src="<?php echo base_url(); ?>/assets-cms/js/tagify.min.js"></script>
<!-- ================== END page-js ================== -->
<?php if (isset($vendorjs)) : foreach ($vendorjs as $j) : ?>
		<script src="<?php echo base_url(); ?>/assets-cms/plugins/<?php echo $j ?>"></script>
<?php endforeach;
endif; ?>

<?php if (isset($tag)) : ?>
	<script> let listTag = <?= $tag ?>; </script>;
<?php endif; ?>

<?php if (isset($js)) : foreach ($js as $j) : ?>
		<script src="<?php echo base_url() ?>/assets-cms/js/myjs/<?php echo $j ?>"></script>
<?php endforeach;
endif; ?>
<script src="<?php echo base_url(); ?>/assets-cms/js/digitalazhar.js"></script>
<script>
	$('.datepicker').datepicker({
		autoclose: true
	});
</script>
</body>

</html>