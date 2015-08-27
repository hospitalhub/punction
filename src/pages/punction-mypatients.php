<?php
use Hospitalplugin\Entities\PatientCRUD;
use Symfony\Component\Yaml\Yaml;
use Hospitalplugin\Twig\EscapePLCharsExtension;
use Hospitalplugin\Twig\GetPropertiesExtension;
use Hospitalplugin\utils\Utils;
use Hospitalplugin\Entities\WardCRUD;

/**
 * punction: my patients
 *
 * THIS MATERIAL IS PROVIDED AS IS, WITH ABSOLUTELY NO WARRANTY EXPRESSED
 * OR IMPLIED. ANY USE IS AT YOUR OWN RISK.
 *
 * Permission is hereby granted to use or copy this program
 * for any purpose, provided the above notices are retained on all copies.
 * Permission to modify the code and to distribute modified code is granted,
 * provided the above notices are retained, and a notice that the code was
 * modified is included with the above copyright notice.
 *
 * @category  Wp
 * @package   Punction
 * @author    Andrzej Marcinkowski <andrzej.max.marcinkowski@gmail.com>
 * @copyright 2014 Wojewódzki Szpital Zespolony, Kalisz
 * @license   MIT http://opensource.org/licenses/MIT
 * @version   1.0 $Format:%H$
 * @link      http://
 * @since     File available since Release 1.0.0
 * PHP Version 5
 */

Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem(__DIR__ . '/../views/');
$twig = new Twig_Environment($loader, array());
$twig->addExtension(new EscapePLCharsExtension());
$twig->addExtension(new GetPropertiesExtension());
$userId = wp_get_current_user()->ID;
$oddzial = WardCRUD::getWardForUser($userId);
$dateParam = (! empty($_GET['date']) ? $_GET['date'] : 0);
$date = Utils::getStartEndDate($dateParam);
$categoriesFile = __DIR__ . '/../../resources/categories.yml';
$categories = Yaml::parse(file_get_contents($categoriesFile));

// LISTA PACJ
$patientClass = 'Hospitalplugin\Entities\Patient' . $oddzial->getTypOddzialu();
echo $twig->render('pList.twig', array(
    'oddzial' => $oddzial->getName(),
    'kod' => $oddzial->getInfomedica(),
    'wardType' => $oddzial->getTypOddzialu(),
    'patientClass' => new $patientClass(0),
    'patients' => PatientCRUD::getPatientsDateRange($date['startDate'], $date['endDate'], $oddzial->getId()),
    'categories' => $categories[$oddzial->getTypOddzialu()]
));
?>