<?php
class HtmlHelper
{
	static public function renderBackButton($label, $link = null)
	{
		if($link != null)
		{
			$backButton = '<a class="btn btn-secondary" href="'. $link .'">'. $label .'</a>';
			echo $backButton ;
		}
		else
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

	static public function getHoraServidor()
	{
		include_once("db/dal.php");
		return getHoraServidor();
	}
	
	
}
?>