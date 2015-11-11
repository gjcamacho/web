<?php
// we connect to example.com and port 3307
$link = mysql_connect('127.0.0.1:3306', 'root', '');
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
echo 'Connected successfully<br>';
mysql_select_db('prueba', $link) or die ('Could not select database.');
//var_dump($_POST);

if(isset($_POST['RFC'])){
	$result=mysql_query("SELECT * FROM tabla_prueba WHERE RFC='".$_POST['RFC']."';");
	$data=mysql_fetch_assoc($result);
	//var_dump($data);
	if($data['rfc'] == $_POST['RFC']){
		echo "El RFC ya existe!!!";
	}
	else{
		$sql="INSERT into tabla_prueba (id,nombre,apellido_paterno,rfc) values (0,'".$_POST['nombre']."','".$_POST['apellidoPat']."','".$_POST["RFC"]."');";
		echo "<br>Aplicando SQL: ".$sql;
		$result=mysql_query($sql);
	}
}

$result=mysql_query("SELECT * FROM tabla_prueba;");

?>

<html>
	<body>
		<form method="POST" action="prueba_5.php">
			
			
			Nombre: <input type="text" name="nombre"><br>
			AP:     <input type="text" name="apellidoPat"><br>
			AM:     <input type="text" name="apellidoMat"><br>
			RFC:     <input type="text" name="RFC"><br>

			<input type="submit" name="enviar" value="Enviar">
		</form>
		
		<div id="resultados">
			<table>
				<tr><th>ID</th><th>Nombre</th><th>Apellido Paterno</th><th>RFC</th></tr>
		<?php 
			while($data=mysql_fetch_assoc($result)){
				echo "<tr><td>".$data['id']."</td><td>".$data['nombre']."</td><td>".$data['apellido_paterno']."</td><td>".$data['rfc']."</td></tr>";
			}
		?>
			</table>
		</div>
	</body>
</html>