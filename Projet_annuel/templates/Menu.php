<?php
echo "<nav>
		<ul>
			<li><a href = {$this->router->getConnectionPageURL()}>Se connecter</a></li>
			<li><a href = {$this->router->getDisconnectionURL()}>Se déconnecter</a></li>
		</ul>
	 </nav>";
?>