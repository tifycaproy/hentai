<?php
header('Content-Type: application/json');
  $pin= rand(1000, 9999)
?>
<header>
	
</header>
<form action="{{url('api/registro')}}" method="post">
	 {{ csrf_field() }}
	<input type="email" name="email" value="yoe318@gmail.com">
	<input type="nombre" name="nombre" value="yoelis">
	<input type="password" name="password" value="123456">
	<input type="hidden" name="pin" value="<?php echo $pin;?>">
	<input type="submit">
</form>