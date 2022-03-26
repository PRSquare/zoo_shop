<div id="typelist">
	<?php 
	foreach ($types as $type) {
		print( renderTemplate("templates/type.php", ['type'=>$type, 'products'=>$products]) );
	}?>
</div>
<script src="templates/typelist.js"></script>