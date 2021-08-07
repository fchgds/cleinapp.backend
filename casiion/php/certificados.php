<?php



function getlistadoasistencias()
{
    global $database;
    $query = "SELECT idusuario, COUNT(`ingreso`) AS `cuentaingreso`, COUNT(`salida`) AS `cuentasalida`, COUNT(`ingreso`)+COUNT(`salida`) As `total` 
FROM `asistencia` GROUP BY idusuario ORDER BY `total` DESC";
    $data = $database->query($query)->fetchAll(PDO::FETCH_ASSOC);

    return $data;
}

function getcertificadosasistencia()
{
    global $database;
    $query = "SELECT usuarios.idusuario, usuarios.nombre,usuarios.apellido, usuarios.email, usuarios.pais, usuarios.estadopago, COUNT(`ingreso`)+COUNT(`salida`) As `asistencias` 
FROM `asistencia`
INNER JOIN usuarios ON usuarios.idusuario = asistencia.idusuario
GROUP BY idusuario 
HAVING asistencias >= 0
ORDER BY `asistencias` DESC";
    $data = $database->query($query)->fetchAll(PDO::FETCH_ASSOC);

    return $data;
}

function showcertificadosasistencia()
{
    global $database;
    $query = "SELECT certificados.idcertificado, usuarios.idusuario, usuarios.nombre,usuarios.apellido, usuarios.email, certificados.codigo 
FROM `certificados`
INNER JOIN usuarios ON usuarios.idusuario = certificados.idusuario
GROUP BY usuarios.idusuario 
ORDER BY certificados.generado";
    $data = $database->query($query)->fetchAll(PDO::FETCH_ASSOC);

    return $data;
}


function generarcertificadopantalla($nombre,$codigo)
{
    $archivo=htmlspecialchars($nombre);
    $url="https://app.clein.org/certificado.php?c=".$codigo;
    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8',
        'orientation' => 'L',
        'fontDir' => 'font/',
        'fontdata' => [
            'pristina' => [
                'R' => 'pristina.ttf',
            ]
        ],
        'default_font' => 'pristina'
    ]);
    $pagecount = $mpdf->SetSourceFile('CertificadoCASII-On.pdf');
    $tplId = $mpdf->ImportPage($pagecount);
    $mpdf->UseTemplate($tplId);
    $mpdf->SetTitle("Certificado CASII-On");
    $mpdf->SetAuthor("CLEIN");
    $mpdf->SetProtection(array('copy','print','print-highres'), '', 'invaosdufnfasdgf');
    $mpdf->WriteHTML('<div><h1>&nbsp;</h1></div>');
    $mpdf->WriteHTML('<div><h1 style="font-family:pristina;font-size:12mm;margin-top:35mm;width:100%;text-align: center;" >'.$nombre.'</h1></div>');
    $mpdf->WriteHTML('<div style="margin-left:245mm;margin-top:60mm;"><barcode code="'.$url.'" size="1" type="QR" error="M" class="barcode" /></div>');
    $mpdf->Output();
}

function generarcertificadoarchivo($nombre,$codigo,$archivo)
{
    $path="../certificados/cassion/";
    $url="https://app.clein.org/certificado.php?c=".$codigo;
    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8',
        'orientation' => 'L',
        'fontDir' => 'font/',
        'fontdata' => [
            'pristina' => [
                'R' => 'pristina.ttf',
            ]
        ],
        'default_font' => 'pristina'
    ]);
    $pagecount = $mpdf->SetSourceFile('CertificadoComoOrganizadorCASII-ON.pdf');
    $tplId = $mpdf->ImportPage($pagecount);
    $mpdf->UseTemplate($tplId);
    $mpdf->SetTitle("Certificado CASII-On");
    $mpdf->SetAuthor("CLEIN");
    $mpdf->SetProtection(array('copy','print','print-highres'), '', 'invaosdufnfasdgf');
    $mpdf->WriteHTML('<div><h1>&nbsp;</h1></div>');
    $mpdf->WriteHTML('<div><h1 style="font-family:pristina;font-size:12mm;margin-top:35mm;width:100%;text-align: center;" >'.$nombre.'</h1></div>');
    $mpdf->WriteHTML('<div style="margin-left:245mm;margin-top:60mm;"><barcode code="'.$url.'" size="1" type="QR" error="M" class="barcode" /></div>');
    $mpdf->Output($archivo,"F");
}

function getcertificadocodigo($codigo)
{
    global $database;
    $certificado=$database->select('certificados',
    "*",
    [
        'codigo'=>$codigo
    ]
    );

    if(isset($certificado[0]))
    {
        return $certificado[0];
    }
    else
    {
        return null;
    }
}

function guardarcertificado($idusuario,$nombrecompleto,$email,$url,$codigo,$archivo)
{
    global $database;
    $database->insert('certificados',
        [
            'idusuario'=>$idusuario,
            'nombrecompleto'=>$nombrecompleto,
            'email'=>$email,
            'codigo'=>$codigo,
            'url'=>$url,
            'archivo'=>$archivo
        ]
    );
}

function guardarcertificadoenviado($idusuario)
{
    global $database;
    $database->update('certificados',
        [
            'enviado'=>date("Y-m-d H.i.s"),
        ],
    [
        'idusuario'=>$idusuario,
    ]
    );
}

function getcertificados()
{
    global $database;
    $data = $database->select('certificados',
        "*",
        [
            'idusuario[>]'=>0,
        ]
    );

    return $data;
}

function getcertificado($idcertificado)
{
    global $database;
    $data = $database->select('certificados',
        "*",
        [
            '$idcertificado'=>$idcertificado,
        ]
    );

    return $data[0];
}

function getcertificadousuario($idusuario)
{
    global $database;
    $data = $database->select('certificados',
        "*",
        [
            'idusuario'=>$idusuario,
        ]
    );

    if(isset($data[0])) {
        return $data[0];
    }
    else
    {
        return false;
    }
}

function eliminarcertificado($idcertificado)
{
    global $database;
    $data = $database->delete('certificados',
        [
            'idcertificado'=>$idcertificado,
        ]
    );
}
