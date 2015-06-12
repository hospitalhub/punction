<?php
use Punction\Entities\PatientCRUD;
use Symfony\Component\Yaml\Yaml;
use Hospitalplugin\Twig\EscapePLCharsExtension;
use Hospitalplugin\Twig\GetPropertiesExtension;
use Hospitalplugin\utils\Utils;
use Hospitalplugin\Entities\WardCRUD;
use Hospitalplugin\Entities\HospitalForm;

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
 * @category Wp
 * @package Punction
 * @author Andrzej Marcinkowski <andrzej.max.marcinkowski@gmail.com>
 * @copyright 2014 Wojewódzki Szpital Zespolony, Kalisz
 * @license MIT http://opensource.org/licenses/MIT
 * @version 1.0 $Format:%H$
 * @link http://
 * @since File available since Release 1.0.0
 *        PHP Version 5
 */

Twig_Autoloader::register ();
$loader = new Twig_Loader_Filesystem ( __DIR__ . '/../views/' );
$twig = new Twig_Environment ( $loader, array () );
$twig->addExtension ( new EscapePLCharsExtension () );
$twig->addExtension ( new GetPropertiesExtension () );
$userId = wp_get_current_user ()->ID;
$oddzial = WardCRUD::getWardForUser ( $userId );

$patientClass = 'Punction\Entities\Patient' . $oddzial->getTypOddzialu ();
HospitalForm::load ( __DIR__ . '/../../resources/Patient.yml', $patientClass, __DIR__ . '/../views/' );

if (! empty ( $_POST )) {
	echo "
	<table class=table>
	<tr>
		<td class='alert alert-info' style='width: 100px;'>
			<h2><div class='label label-primary'>Dziękuję za dopisanie pacjenta.</div></h2>
		</td>
	<tr></tr>
		<td><a href=" . $_SERVER ['REQUEST_URI'] . " class='btn btn-default navbar-btn'>Dodaj kolejnego pacjenta</a></td>
	<tr></tr>
		<td><a href=\"/wp-admin/edit.php?post_type=pacjent&page=moi-pacjenci\" class='btn btn-default navbar-btn'>Przejdź do kategoryzacji</a></td>
	</tr>
	</table>
";
}

?>