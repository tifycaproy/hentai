<?php

function codifica($valor){
	$valor+=1000;
	$mrcd=array( 0 =>'A', 1 =>'B', 2 =>'C', 3 =>'D', 4 =>'E', 5 =>'F', 6 =>'G', 7 =>'H', 8 =>'I', 9 =>'J',10 =>'K',11 =>'L',12 =>'M',13 =>'N',14 =>'O',15 =>'P',16 =>'Q',17 =>'R',18 =>'S',19 =>'T',20 =>'U',21 =>'V',22 =>'W',23 =>'X',24 =>'Y',25 =>'Z',26 =>'1',27 =>'2',28 =>'3',29 =>'4',30 =>'5',31 =>'6',32 =>'7',33 =>'8',34 =>'9',35 =>'0',36 =>'a',37 =>'b',38 =>'c',39 =>'d',40 =>'e',41 =>'f',42 =>'g',43 =>'h',44 =>'i',45 =>'j',46 =>'k',47 =>'l',48 =>'m',49 =>'n',50 =>'o',51 =>'p',52 =>'q',53 =>'r',54 =>'s',55 =>'t',56 =>'u',57 =>'v',58 =>'w',59 =>'x',60 =>'y',61 =>'z');
	$separador=rand(0,6);
	//$separador=0;
	$salida="";
    while($valor>55){
		@$division    = $valor/55;
		@$resultINT   = floor($valor/55);
		@$remnant     = $valor%55;
		$salida  = $mrcd[$remnant+$separador].
		$mrcd[61-($remnant+$separador)].$salida;
		$valor=$resultINT;
	}
	$salida  = $mrcd[$separador*5] . $mrcd[$valor+$separador]. $mrcd[61-($valor+$separador)].$salida;
	return $salida;
}
function decodifica($valor){
	$mrcd=array( 0 =>'A', 1 =>'B', 2 =>'C', 3 =>'D', 4 =>'E', 5 =>'F', 6 =>'G', 7 =>'H', 8 =>'I', 9 =>'J',10 =>'K',11 =>'L',12 =>'M',13 =>'N',14 =>'O',15 =>'P',16 =>'Q',17 =>'R',18 =>'S',19 =>'T',20 =>'U',21 =>'V',22 =>'W',23 =>'X',24 =>'Y',25 =>'Z',26 =>'1',27 =>'2',28 =>'3',29 =>'4',30 =>'5',31 =>'6',32 =>'7',33 =>'8',34 =>'9',35 =>'0',36 =>'a',37 =>'b',38 =>'c',39 =>'d',40 =>'e',41 =>'f',42 =>'g',43 =>'h',44 =>'i',45 =>'j',46 =>'k',47 =>'l',48 =>'m',49 =>'n',50 =>'o',51 =>'p',52 =>'q',53 =>'r',54 =>'s',55 =>'t',56 =>'u',57 =>'v',58 =>'w',59 =>'x',60 =>'y',61 =>'z');
	$separador=0;
	$mvalor=str_split($valor);
	$resultado1=0;
	$resultado2=0;
	for($i=0;$i<=61;$i++)
		if($mvalor[0]==$mrcd[$i])
			$separador=$i/5;
			
	$contexp=((count($mvalor)-1)/2)-1;
	for($l=1;$l<count($mvalor);$l+=2){
		for($i=0;$i<=61;$i++){
			if($mvalor[$l]==$mrcd[$i]){
				$resultado1+=($i-$separador)*pow(55,$contexp);
			}
			if($mvalor[$l+1]==$mrcd[$i]){
				$resultado2+=(61-($i+$separador))*pow(55,$contexp);
			}
		}
		$contexp--;
	}
	if($resultado1==$resultado2 and is_int($separador)){
		return $resultado1 - 1000;
	}else{
		return "";
	}
}
function crea_token($valor){
	$posicion=rand(1,3);
	$respuesta=codifica(100000 + $posicion);
	for($l=1; $l<=3; $l++){
		if($l==$posicion)
			$respuesta.= "$" . codifica(100000 + $valor);
		else
			$respuesta.= "$" . codifica(rand(100000,999999));
	}
	return $respuesta;
}
function decodifica_token($valor){
	$mvalor=explode("$",$valor);
	if (count($mvalor)<4) return '';
	$posicion=decodifica($mvalor[0]);
	if($posicion<>''){
		$posicion-=100000;
	}else{
		return '';
	}
	return decodifica($mvalor[$posicion]) - 100000;
}

	


?>