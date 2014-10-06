<?php
	session_start();
	
	if(! isset($_SESSION[Constants::$SESSION_USER_RECORD])){
		//tenemos un usuario en sesion, dibujamos su menu
?>
		<div id="myjquerymenu" class="jquerycssmenu" style="height: 25px;">
			<ul>
				<li>
					<a href="#" class="MenuBarItemSubmenu">Configuraci&oacute;n</a>
					<ul>
						<li>
							<a href="./prueba.php" class="MenuBarItemSubmenu">prueba</a>
						</li>
					</ul>
				</li>
			</ul>
		</div>
<?php
	} else {
		//no hay usuario en sesion, no dibujamos menu alguno
	}
?>