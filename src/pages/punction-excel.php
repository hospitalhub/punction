<?php
use Hospitalplugin\DB\DoctrineBootstrap;
use Hospitalplugin\Entities\Patient;
use Hospitalplugin\DQLFunctions\DateFunction;
use Hospitalplugin\Entities\PatientRaport;
use Hospitalplugin\Entities\WardCRUD;
use Hospitalplugin\utils\ExcelExport;

$wards = WardCRUD::getWardsArray ();
$wardId = (! empty ( $_POST ['wardId'] ) ? $_POST ['wardId'] : 0);
$wardType = (! empty ( $_POST ['wardType'] ) ? $_POST ['wardType'] : 0);
$date = (! empty ( $_POST ['date'] ) ? $_POST ['date'] : (new DateTime ())->format ( "Y-m" ));
$raport = PatientRaport::getRaport ( $wardId, $date, $wardType );

Twig_Autoloader::register ();
$loader = new Twig_Loader_Filesystem ( __DIR__ . '/../views/' );
$twig = new Twig_Environment ( $loader, array () );
echo $twig->render ( 'pExcel.twig', array (
		'raport' => $raport,
		'wards' => $wards,
		'date' => $date,
		'wardId' => $wardId,
		'wardType' => $wardType
) );

