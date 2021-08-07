<?php
try{
    $idusuario=$_POST['idusuario'];
    if($_FILES['fotoComprobante']['size'] != 0 && $_FILES['fotoComprobante']['error'] == 0){
        $locationComprobante=guardarimagenes($_FILES['fotoComprobante'],'comprobante',$idusuario);
    }else
    {
        $locationComprobante="";
    }

    global $database;
    $data=$database->update("usuarios",
        [
            "pago" => $locationComprobante,
        ],
        [
                "idusuario" => $idusuario
        ]);


}catch(Exception $exception)
{
    $respuesta=array('error'=>"Hubo un error al guardar");
    echo json_encode($respuesta);
    exit;
}



function guardarimagenes($file,$tipo,$user_id)
{
    if (isset($file) && $file['size'] < 10000000) {
        $uniqid=uniqid("_img_");
        $pos = strpos($file['name'], ".");
        $ext=substr($file['name'],$pos);
        if(move_uploaded_file($file['tmp_name'], '..' . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR . $tipo . DIRECTORY_SEPARATOR . $user_id.$uniqid.$ext))
        {
            $locationfordb = "/upload/" . $tipo . "/" . $user_id.$uniqid.$ext;
            return $locationfordb;
        }
        else {
            throw new Exception('Error en el archivo');
            return "Error";
        }
    }
    else
    {
        return null;
    }
}
