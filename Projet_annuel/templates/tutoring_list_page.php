<?php

echo "<h2>Comptes</h2>
	<table>
		<thead>
			<tr>
				<th>Category</th>
			</tr>
		</thead>

		<tbody>
			
	";
		

foreach ($data as $key) {
	echo "<tr><td>{$key['login']}</td><td>{$key['status']}</td></tr>";
}

echo "</tbody>
	  </table>";

?>