<?php

/**
 * Método utilizado para ver una traza determinada por pantalla
 *
 * @param $dato Dato sobre el cual se quiere ver la traza
 */
function traza($dato){

    echo "<pre>";
    print_r($dato);
    echo "</pre>";

}

/**
 * Método para comprobar la viabilidad de la imagen a subir (peso, formato, etc) y adapta la ruta si se repite
 *
 * @param $archivoFoto Nombre de la imagen a subir
 * @param $carpeta Carpeta donde se guardará la imagen
 * @param int $tamanoMaxArchivo Tamaño máximo permitido para la imagen
 * @return mixed|string|null retornará el nombre para la imagen en el caso que se pueda subir
 */
function subirFoto($archivoFoto,$carpeta,$tamanoMaxArchivo = 5000000){

    $ruta = "";
    $nombreArchivo = $archivoFoto['name'];
    $tipo = $archivoFoto['type'];
    $tamano = $archivoFoto['size'];

    //Valido que el formato de imagen sea un jpeg o un png
    if((strpos($tipo, "jpeg") || strpos($tipo, "png")) && $tamano < $tamanoMaxArchivo ){
        $nombreArchivo = limpiar_caracteres_especiales($nombreArchivo);

        // reviso si ya existe algun archivo con el mismo nombre en la carpeta.
        if(file_exists($carpeta.$nombreArchivo)){

            $nombreCortado = cortarCadenaFinal($nombreArchivo,$caracter='.');
            $numeroAletario = time();

            if(strpos($tipo, "jpeg")){

                $extension = ".jpg";

            }else{

                $extension = ".png";

            }

            $nombreArchivo = $nombreCortado."_".$numeroAletario.$extension;

        }
        if(move_uploaded_file($archivoFoto['tmp_name'], $carpeta.$nombreArchivo)){

            $ruta = $nombreArchivo;

        }else{

            echo "<script>alert('No se ha podido guardar el archivo. Contacte con el administrador')</script>";

        }
    }else{

        echo "<script>alert('No es un formato de imagen permitido o tiene un tamaño superior al permitido')</script>";

        $ruta = null;

    }

    return $ruta;

}

/**
 * Método para limpiar de carácteres especiales los nombres de las imagenes a subir
 *
 * @param $cadena Nombre de la imagen a subir
 * @return mixed retorna el nombre de la imagen sin los caracteres especiales
 */
function limpiar_caracteres_especiales($cadena) {
    //preg_replace($patrones, $sustituciones, $cadena);
    //$archivo =  preg_replace("/[^a-zA-Z0-9\_\-]+/", "", $archivo);
    $cadena = str_replace(
        array('?', '¿'),
        array('_', '_'),
        $cadena
    );
    $cadena = str_replace(
        array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
        array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
        $cadena
    );
    $cadena = str_replace(
        array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
        array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
        $cadena );
    $cadena = str_replace(
        array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
        array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
        $cadena );
    $cadena = str_replace(
        array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
        array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
        $cadena );
    $cadena = str_replace(
        array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
        array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
        $cadena );
    $cadena = str_replace(
        array('ñ', 'Ñ', 'ç', 'Ç'),
        array('n', 'N', 'c', 'C'),
        $cadena
    );
//para ampliar los caracteres a reemplazar agregar lineas de este tipo:
//$archivo = str_replace("caracter-que-queremos-cambiar","caracter-por-el-cual-lo-vamos-a-cambiar",$archivo);
    return $cadena;
}

/**
 * Método para cortar el nombre de la imagen a subir
 *
 * @param $cadena Nombre de la imagen a subir
 * @param string $caracter '.' marca donde comienza la extensión del archivo
 * @return false|string retorna el nuevo nombre para la imagen
 */
function cortarCadenaFinal($cadena,$caracter='.'){
    $posicionsubcadena = strrpos ($cadena,$caracter);
    $nombre = substr ($cadena, 0, ($posicionsubcadena));
    return $nombre;
}