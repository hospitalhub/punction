<?php
use Punction\Entities\PatientZZ;
use Punction\Entities\PatientDIA;
use Punction\Entities\PatientPED;
use Punction\Entities\PatientPSY;
use Hospitalplugin\DB\DoctrineBootstrap;
use Hospitalplugin\utils\Utils;

require_once ('/var/www/vendor/autoload.php');
Logger::configure ( __DIR__ . '/../resources/log4php.xml' );
$log = Logger::getLogger ( "migration" );

/**
 * migration log4php logger
 */
function get_typ() {
	return array (
			"CH2" => "ZZ",
			"CH3" => "ZZ",
			"CHIDZ" => "PED",
			"CHORDZ" => "PED",
			"GASTD" => "PED",
			"GINEK" => "ZZ",
			"INT1" => "ZZ",
			"INT2" => "ZZ",
			"KARD" => "ZZ",
			"LARYN" => "ZZ",
			"NEF" => "ZZ",
			"NEUR" => "ZZ",
			"NEURO" => "ZZ",
			"OIOM" => "OIOM",
			"OKUL" => "ZZ",
			"ORTOP" => "ZZ",
			"PATOL" => "ZZ",
			"POLOZ" => "ZZ",
			"PSYCH" => "PSY",
			"RATUN" => "OIOM",
			"REHAB" => "ZZ",
			"REHDZ" => "PED",
			"REHNEU" => "ZZ",
			"REUM" => "ZZ",
			"SZCZ" => "ZZ",
			"UDARO" => "ZZ",
			"UROL" => "ZZ",
			"ZAKDO" => "ZZ" 
	);
}
function get_oddzialy_arr() {
	return array (
			"CH2" => 1647,
			"CH3" => 1646,
			"CHIDZ" => 1645,
			"CHORDZ" => 1649,
			"GASTD" => 1652,
			"GINEK" => 5190,
			"INT1" => 1650,
			"INT2" => 1651,
			"KARD" => 1653,
			"LARYN" => 1659,
			"NEF" => 1654,
			"NEUR" => 1655,
			"NEURO" => 1656,
			"OIOM" => 1644,
			"OKUL" => 1658,
			"ORTOP" => 1666,
			"PATOL" => 1660,
			"POLOZ" => 1661,
			"PSYCH" => 1662,
			"RATUN" => 34856,
			"REHAB" => 1664,
			"REHDZ" => 1663,
			"REHNEU" => 2957,
			"REUM" => 1665,
			"SZCZ" => 1648,
			"UDARO" => 3262,
			"UROL" => 1667,
			"ZAKDO" => 1657 
	);
}
function import_pacjentow($plik, $oddzialy, $data_importu) {
	$entityManager = ( object ) DoctrineBootstrap::getEntityManager ();
	global $log;
	$log->info ( "IMPORT: " . $data_importu );
	$oddzialy_arr = get_oddzialy_arr ();
	$row = 1;
	if (($uchwyt = fopen ( $plik, "r" )) !== FALSE) {
		while ( ($data = fgetcsv ( $uchwyt, 1000, "," )) !== FALSE ) {
			$num = count ( $data );
			$row ++;
			// CSV
			$nr = $data [1];
			$pesel = $data [2];
			$naz_imie = Utils::w1250_to_utf8 ( $data [3] . " " . $data [4] );
			$oddz = $data [0];
			$wypisany = false;
			if ($data [5] != "") {
				$data_wypisu_date = DateTime::createFromFormat ( "y/m/d", $data [5] );
				$teraz = new \DateTime ();
				if ($teraz > $data_wypisu_date) {
					// data wypisu w przeszłości -> wypisany
					$wypisany = true;
				}
			}
			// oddzialy
			if (in_array ( $oddz, $oddzialy ) && ! $wypisany) {
				$typ = 'Punction\Entities\Patient' . get_typ () [$oddz];
				$p = new $typ ( 0 );
				$d = DateTime::createFromFormat ( "Y-m-d", $data_importu );
				$p->setDataKategoryzacji ( $d );
				$p->setOddzialId ( $oddzialy_arr [$oddz] );
				$p->setName ( $naz_imie );
				$p->setPesel ( $pesel );
				$p->setNumerHistorii ( $nr );
				$p->setKategoriaPacjenta ( 0 );
				$log->info ( "pac " . $p->toString () );
				$entityManager->persist ( $p );
				$entityManager->flush ();
			} else {
				// $log->trace ( "WYPISANY LUB NIE Z ODDZIALU " . $oddz . ' ' . $data [5] );
			}
		}
		fclose ( $uchwyt );
	}
}
function patients_import($plik, $data_importu) {
	global $log;
	$log->info ( "patients import" );
	$oddzialy = array (
			'REHAB',
			'REHNEU',
			'REUM',
			'NEUR',
			'NEURO',
			'OKUL',
			'UDARO',
			'UROL',
			'LARYN',
			'ORTOP',
			'SZCZ',
			'KARD',
			'GINEK',
			'ZAKDO',
			'INT1',
			'CH2',
			'CH3',
			'INT2',
			'CHORDZ',
			'CHIDZ',
			'GASTD',
			'PSYCH',
			'NEF' 
	);
	if (file_exists ( $plik )) {
		$new_plik = $plik . 'ok';
		$success = rename ( $plik, $new_plik );
		if ($success) {
			import_pacjentow ( $plik . 'ok', $oddzialy, $data_importu );
		}
	}
}
$log->info ( "Pobieram parametry" );
if (! isset ( $argv [1] )) {
	$plik = '/mnt/pacjenci/pac' . date ( 'Y-m-d' ) . "_13.csv";
} else {
	$plik = $argv [1];
}
if (! file_exists ( $plik )) {
	$log->info ( "Brak pliku " . $plik );
	return;
} else {
	$log->info ( "Plik: " . $plik );
}
$data_importu = date ( 'Y-m-d' ); // 2014-08-13
$log->info ( "Data: " . $data_importu );
patients_import ( $plik, $data_importu );

$log->info ( "Stop!" );
