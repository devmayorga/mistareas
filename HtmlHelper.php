<?php
class HtmlHelper
{
	static public function renderBackButton($label)
	{
	?>
		<script>
		function goBack() {
		  window.history.back();
		}
		</script> 
		<button onclick="goBack()">
		<?php echo $label ; ?>
		</button>
	<?php
	}
}
?>