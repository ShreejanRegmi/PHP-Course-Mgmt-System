<?php
	function templateLoad($file, $variables){
		extract($variables);
		ob_start();
		require $file;
		$contentForPage = ob_get_clean();
		return $contentForPage;
	}

	

?>