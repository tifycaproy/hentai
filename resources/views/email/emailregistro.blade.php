<!DOCTYPE html>
<html>
<head>
    <title>PIN de Validación</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
</head>
<body style="width: 100%; position: absolute; font-family: sans-serif;">
    <div style="width: 100%; text-align:justify; margin-left: auto; margin-right: auto; padding-bottom: 50px;">
                  
        </div> 
        <div style="padding: 30px; border-radius: 15px">
            <div style="text-align: center;">

                <b style="text-transform: uppercase; "><h1>Gracias por completar tu proceso de registro, por favor ingresa el siguiente PIN en la APP para verificar tu cuenta: </h1></b> 
                       
            </div>
            
            <div>
                <h1>PIN <b>{{ $pin }}</b></h1>
                <h3>Email del Usuario: <b>{{ $email }}</b></h3>
               
                
            </div>
        </div>
    </div>
</body>
</html>