<?php
use Hospitalplugin\DB\DoctrineBootstrap;
use Punction\Entities\Patient;
use Hospitalplugin\DQLFunctions\DateFunction;
use Punction\Entities\PatientRaport;
use Hospitalplugin\Entities\WardCRUD;
use Punction\utils\ExcelExport;

$wards = WardCRUD::getWardsArray();
$wardId = (! empty($_POST['wardId']) ? $_POST['wardId'] : 0);
$date = (! empty($_POST['date']) ? $_POST['date'] : (new DateTime())->format("Y-m"));
$raport = PatientRaport::getRaport($wardId, $date);

Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem(__DIR__ . '/../views/');
$twig = new Twig_Environment($loader, array());

echo $twig->render('pWykresy.twig', array(
    'raport' => $raport,
    'wards' => $wards,
    'date' => $date,
    'wardId' => $wardId
));

ExcelExport::excel_export();