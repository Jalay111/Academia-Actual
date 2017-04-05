<?php
function reg($db_con, $Nom1, $Nom2, $Ape1, $Ape2, $DNI, $Correo, $Nacimiento, $Tele, $dire, $muni, $sexo){
        $sent= $db_con->prepare('
            INSERT INTO Usuarios
            (Cuenta, Contra, Correo, DNI, Nombre, Nombre2, Apellido, Apellido2,
                Fecha_Nacimiento, Telefono, Direccion, idMun, Sexo)
            VALUES (:v2, :v3, :v4, :v5, :v6, :v7, :v8, :v9, :v10, :v11, :v12, :v13, :v14)');
            
            $I2=substr($Ape2,0,1);
        if($Nom2){
            $I1=substr($Nom2,0,1);
            $cuenta = "{$Nom1}{$Ape1}{$I1}{$I2}";
        }else{
            $cuenta = "{$Nom1}{$Ape1}{$I2}";
        }
        
        $sentCuenta = $db_con->prepare('
            SELECT DNI FROM Usuarios WHERE Cuenta=:cue
        ');
        $sentCuenta->execute(array(':cue'=>strtolower($cuenta)));
        if($sentCuenta->rowCount()==0){
            $CuentaDef = strtolower($cuenta);
        }else{
            $CuentaDef = strtolower($cuenta).$sentCuenta->rowCount();
        }
        
        $sent->execute(array(':v2'=>$CuentaDef, ':v3'=>md5($DNI), ':v4'=>$Correo, ':v5'=>$DNI, ':v6'=>$Nom1,
        ':v7'=>$Nom2, ':v8'=>$Ape1, ':v9'=>$Ape2, ':v10'=>$Nacimiento, ':v11'=>$Tele, ':v12' => $dire, ':v13'=>$muni, ':v14'=>$sexo));
}