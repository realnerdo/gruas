<?php
	$numItems = count($infoPadres);
	if($numItems):?>
		<div class="migas sitio-<?php echo $idSitio?>">
	    	<a href="">Home</a> &raquo;
			<?php
				foreach($infoPadres as $padre):
					//if($padre['tipo'] == "section minisitio"):
						$href = $padre['slug']."/";
					//endif;
					
					if($padre['tipo']!="menu"):
						if($padre['idCat']!="31"):?>
                    
							<a href="<?php echo $href?>"><?php echo $padre['titulo']?></a> &raquo;
			<?php
						endif;
					endif;
				endforeach;?>
		</div><!--.migas-->
<?php
	endif;?>
