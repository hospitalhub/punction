<?php

/**
 * PatientPOR
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
namespace Punction\Entities;

/**
 * PatientPOR
 *
 * @category Wp
 * @package Punction
 * @author Andrzej Marcinkowski <andrzej.max.marcinkowski@gmail.com>
 * @copyright 2014 Wojewódzki Szpital Zespolony, Kalisz
 * @license MIT http://opensource.org/licenses/MIentT
 * @version 1.0 $Format:%H$
 * @link http://
 * @since File available since Release 1.0.0
 *    
 *     @Entity
 */
class PatientPOR extends Patient {
	
	/*
	 * I Ciąża;
	 * I Wywiad;
	 * I Pozycja;
	 * I Higiena;
	 * I Dieta;
	 * I Pomiar parametrów życiowych;
	 * I ASP;
	 * I Postęp porodu;
	 * I Wydalanie;
	 * I Pęcherz płodowy;
	 * I Ćwiczenia oddechowe;
	 * I Leki;
	 * I Edukacja zdrowotna i wsparcie psychiczne;
	 * II Czas;
	 * II Pozycja;
	 * II Czystość krocza;
	 * II Nacięcie;
	 * II Aktywność;
	 * II Higiena;
	 * II Dieta;
	 * II Pomiar parametrów życiowych;
	 * II ASP;
	 * II Wydalanie;
	 * II Leki;
	 * II Edukacja zdrowotna i wsparcie psychiczne;
	 * III Apgar;
	 * III Waga;
	 * III Kontakt;
	 * III Zabiegi;
	 * III Krwawienie;
	 * III Nacięcie;
	 * III Higiena;
	 * III Dieta;
	 * III Pomiar parametrów życiowych;
	 * III Wydalanie;
	 * III Leki;
	 * III Edukacja zdrowotna i wsparcie psychiczne;
	 * IV Obserwacja;
	 * IV Pomiar parametrów życiowych;
	 * IV Karmienie;
	 * IV Edukacja zdrowotna i wsparcie psychiczne;
	 */
	/**
	 *
	 * @var string $typ typ pacjenta
	 */
	protected $typ = "POR";
	
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iCiaza;
	
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iWywiad;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iPozycja;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iHigiena;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iDieta;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iPomiarParametrowZyciowych;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iAsp;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iPostepPorodu;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iWydalanie;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iPecherzPlodowy;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iCwiczeniaOddechowe;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iLeki;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iEdukacjaZdrowotnaIWsparciePsychiczne;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iiCzas;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iiPozycja;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iiCzystoscKrocza;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iiNaciecie;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iiAktywnosc;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iiHigiena;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iiDieta;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iiPomiarParametrowZyciowych;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iiASP;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iiWydalanie;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iiLeki;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iiEdukacjaZdrowotnaIWsparciePsychiczne;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iiiApgar;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iiiWaga;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iiiKontakt;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iiiZabiegi;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iiiKrwawienie;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iiiNaciecie;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iiiHigiena;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iiiDieta;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iiiPomiarParametrowZyciowych;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iiiWydalanie;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iiiLeki;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iiiEdukacjaZdrowotnaIWsparciePsychiczne;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $ivObserwacja;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $ivPomiarParametrowZyciowych;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $ivKarmienie;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $ivEdukacjaZdrowotnaIWsparciePsychiczne;
	
	
	
	
	
	
	
	
	
	
	/**
	 * getFields
	 *
	 * @return multitype:string
	 */
	public static function getFields() {
		$superFields = parent::getFields ();
		$fields = array_merge ( $superFields, array (
				"iCiaza",
				"iWywiad",
				"iPozycja",
				"iHigiena",
				"iDieta",
				"iPomiarParametrowZyciowych",
				"iAsp",
				"iPostepPorodu",
				"iWydalanie",
				"iPecherzPlodowy",
				"iCwiczeniaOddechowe",
				"iLeki",
				"iEdukacjaZdrowotnaIWsparciePsychiczne",
				"iiCzas",
				"iiPozycja",
				"iiCzystoscKrocza",
				"iiNaciecie",
				"iiAktywnosc",
				"iiHigiena",
				"iiDieta",
				"iiPomiarParametrowZyciowych",
				"iiASP",
				"iiWydalanie",
				"iiLeki",
				"iiEdukacjaZdrowotnaIWsparciePsychiczne",
				"iiiApgar",
				"iiiWaga",
				"iiiKontakt",
				"iiiZabiegi",
				"iiiKrwawienie",
				"iiiNaciecie",
				"iiiHigiena",
				"iiiDieta",
				"iiiPomiarParametrowZyciowych",
				"iiiWydalanie",
				"iiiLeki",
				"iiiEdukacjaZdrowotnaIWsparciePsychiczne",
				"ivObserwacja",
				"ivPomiarParametrowZyciowych",
				"ivKarmienie",
				"ivEdukacjaZdrowotnaIWsparciePsychiczne" 
		) );
		return $fields;
	}
	public function getICiaza() {
		return $this->iCiaza;
	}
	public function setICiaza($iCiaza) {
		$this->iCiaza = $iCiaza;
		return $this;
	}
	public function getIWywiad() {
		return $this->iWywiad;
	}
	public function setIWywiad($iWywiad) {
		$this->iWywiad = $iWywiad;
		return $this;
	}
	public function getIPozycja() {
		return $this->iPozycja;
	}
	public function setIPozycja($iPozycja) {
		$this->iPozycja = $iPozycja;
		return $this;
	}
	public function getIHigiena() {
		return $this->iHigiena;
	}
	public function setIHigiena($iHigiena) {
		$this->iHigiena = $iHigiena;
		return $this;
	}
	public function getIDieta() {
		return $this->iDieta;
	}
	public function setIDieta($iDieta) {
		$this->iDieta = $iDieta;
		return $this;
	}
	public function getIPomiarParametrowZyciowych() {
		return $this->iPomiarParametrowZyciowych;
	}
	public function setIPomiarParametrowZyciowych($iPomiarParametrowZyciowych) {
		$this->iPomiarParametrowZyciowych = $iPomiarParametrowZyciowych;
		return $this;
	}
	public function getIAsp() {
		return $this->iAsp;
	}
	public function setIAsp($iAsp) {
		$this->iAsp = $iAsp;
		return $this;
	}
	public function getIPostepPorodu() {
		return $this->iPostepPorodu;
	}
	public function setIPostepPorodu($iPostepPorodu) {
		$this->iPostepPorodu = $iPostepPorodu;
		return $this;
	}
	public function getIWydalanie() {
		return $this->iWydalanie;
	}
	public function setIWydalanie($iWydalanie) {
		$this->iWydalanie = $iWydalanie;
		return $this;
	}
	public function getIPecherzPlodowy() {
		return $this->iPecherzPlodowy;
	}
	public function setIPecherzPlodowy($iPecherzPlodowy) {
		$this->iPecherzPlodowy = $iPecherzPlodowy;
		return $this;
	}
	public function getICwiczeniaOddechowe() {
		return $this->iCwiczeniaOddechowe;
	}
	public function setICwiczeniaOddechowe($iCwiczeniaOddechowe) {
		$this->iCwiczeniaOddechowe = $iCwiczeniaOddechowe;
		return $this;
	}
	public function getILeki() {
		return $this->iLeki;
	}
	public function setILeki($iLeki) {
		$this->iLeki = $iLeki;
		return $this;
	}
	public function getIEdukacjaZdrowotnaIWsparciePsychiczne() {
		return $this->iEdukacjaZdrowotnaIWsparciePsychiczne;
	}
	public function setIEdukacjaZdrowotnaIWsparciePsychiczne($iEdukacjaZdrowotnaIWsparciePsychiczne) {
		$this->iEdukacjaZdrowotnaIWsparciePsychiczne = $iEdukacjaZdrowotnaIWsparciePsychiczne;
		return $this;
	}
	public function getIiCzas() {
		return $this->iiCzas;
	}
	public function setIiCzas($iiCzas) {
		$this->iiCzas = $iiCzas;
		return $this;
	}
	public function getIiPozycja() {
		return $this->iiPozycja;
	}
	public function setIiPozycja($iiPozycja) {
		$this->iiPozycja = $iiPozycja;
		return $this;
	}
	public function getIiCzystoscKrocza() {
		return $this->iiCzystoscKrocza;
	}
	public function setIiCzystoscKrocza($iiCzystoscKrocza) {
		$this->iiCzystoscKrocza = $iiCzystoscKrocza;
		return $this;
	}
	public function getIiNaciecie() {
		return $this->iiNaciecie;
	}
	public function setIiNaciecie($iiNaciecie) {
		$this->iiNaciecie = $iiNaciecie;
		return $this;
	}
	public function getIiAktywnosc() {
		return $this->iiAktywnosc;
	}
	public function setIiAktywnosc($iiAktywnosc) {
		$this->iiAktywnosc = $iiAktywnosc;
		return $this;
	}
	public function getIiHigiena() {
		return $this->iiHigiena;
	}
	public function setIiHigiena($iiHigiena) {
		$this->iiHigiena = $iiHigiena;
		return $this;
	}
	public function getIiDieta() {
		return $this->iiDieta;
	}
	public function setIiDieta($iiDieta) {
		$this->iiDieta = $iiDieta;
		return $this;
	}
	public function getIiPomiarParametrowZyciowych() {
		return $this->iiPomiarParametrowZyciowych;
	}
	public function setIiPomiarParametrowZyciowych($iiPomiarParametrowZyciowych) {
		$this->iiPomiarParametrowZyciowych = $iiPomiarParametrowZyciowych;
		return $this;
	}
	public function getIiASP() {
		return $this->iiASP;
	}
	public function setIiASP($iiASP) {
		$this->iiASP = $iiASP;
		return $this;
	}
	public function getIiWydalanie() {
		return $this->iiWydalanie;
	}
	public function setIiWydalanie($iiWydalanie) {
		$this->iiWydalanie = $iiWydalanie;
		return $this;
	}
	public function getIiLeki() {
		return $this->iiLeki;
	}
	public function setIiLeki($iiLeki) {
		$this->iiLeki = $iiLeki;
		return $this;
	}
	public function getIiEdukacjaZdrowotnaIWsparciePsychiczne() {
		return $this->iiEdukacjaZdrowotnaIWsparciePsychiczne;
	}
	public function setIiEdukacjaZdrowotnaIWsparciePsychiczne($iiEdukacjaZdrowotnaIWsparciePsychiczne) {
		$this->iiEdukacjaZdrowotnaIWsparciePsychiczne = $iiEdukacjaZdrowotnaIWsparciePsychiczne;
		return $this;
	}
	public function getIiiApgar() {
		return $this->iiiApgar;
	}
	public function setIiiApgar($iiiApgar) {
		$this->iiiApgar = $iiiApgar;
		return $this;
	}
	public function getIiiWaga() {
		return $this->iiiWaga;
	}
	public function setIiiWaga($iiiWaga) {
		$this->iiiWaga = $iiiWaga;
		return $this;
	}
	public function getIiiKontakt() {
		return $this->iiiKontakt;
	}
	public function setIiiKontakt($iiiKontakt) {
		$this->iiiKontakt = $iiiKontakt;
		return $this;
	}
	public function getIiiZabiegi() {
		return $this->iiiZabiegi;
	}
	public function setIiiZabiegi($iiiZabiegi) {
		$this->iiiZabiegi = $iiiZabiegi;
		return $this;
	}
	public function getIiiKrwawienie() {
		return $this->iiiKrwawienie;
	}
	public function setIiiKrwawienie($iiiKrwawienie) {
		$this->iiiKrwawienie = $iiiKrwawienie;
		return $this;
	}
	public function getIiiNaciecie() {
		return $this->iiiNaciecie;
	}
	public function setIiiNaciecie($iiiNaciecie) {
		$this->iiiNaciecie = $iiiNaciecie;
		return $this;
	}
	public function getIiiHigiena() {
		return $this->iiiHigiena;
	}
	public function setIiiHigiena($iiiHigiena) {
		$this->iiiHigiena = $iiiHigiena;
		return $this;
	}
	public function getIiiDieta() {
		return $this->iiiDieta;
	}
	public function setIiiDieta($iiiDieta) {
		$this->iiiDieta = $iiiDieta;
		return $this;
	}
	public function getIiiPomiarParametrowZyciowych() {
		return $this->iiiPomiarParametrowZyciowych;
	}
	public function setIiiPomiarParametrowZyciowych($iiiPomiarParametrowZyciowych) {
		$this->iiiPomiarParametrowZyciowych = $iiiPomiarParametrowZyciowych;
		return $this;
	}
	public function getIiiWydalanie() {
		return $this->iiiWydalanie;
	}
	public function setIiiWydalanie($iiiWydalanie) {
		$this->iiiWydalanie = $iiiWydalanie;
		return $this;
	}
	public function getIiiLeki() {
		return $this->iiiLeki;
	}
	public function setIiiLeki($iiiLeki) {
		$this->iiiLeki = $iiiLeki;
		return $this;
	}
	public function getIiiEdukacjaZdrowotnaIWsparciePsychiczne() {
		return $this->iiiEdukacjaZdrowotnaIWsparciePsychiczne;
	}
	public function setIiiEdukacjaZdrowotnaIWsparciePsychiczne($iiiEdukacjaZdrowotnaIWsparciePsychiczne) {
		$this->iiiEdukacjaZdrowotnaIWsparciePsychiczne = $iiiEdukacjaZdrowotnaIWsparciePsychiczne;
		return $this;
	}
	public function getIvObserwacja() {
		return $this->ivObserwacja;
	}
	public function setIvObserwacja($ivObserwacja) {
		$this->ivObserwacja = $ivObserwacja;
		return $this;
	}
	public function getIvPomiarParametrowZyciowych() {
		return $this->ivPomiarParametrowZyciowych;
	}
	public function setIvPomiarParametrowZyciowych($ivPomiarParametrowZyciowych) {
		$this->ivPomiarParametrowZyciowych = $ivPomiarParametrowZyciowych;
		return $this;
	}
	public function getIvKarmienie() {
		return $this->ivKarmienie;
	}
	public function setIvKarmienie($ivKarmienie) {
		$this->ivKarmienie = $ivKarmienie;
		return $this;
	}
	public function getIvEdukacjaZdrowotnaIWsparciePsychiczne() {
		return $this->ivEdukacjaZdrowotnaIWsparciePsychiczne;
	}
	public function setIvEdukacjaZdrowotnaIWsparciePsychiczne($ivEdukacjaZdrowotnaIWsparciePsychiczne) {
		$this->ivEdukacjaZdrowotnaIWsparciePsychiczne = $ivEdukacjaZdrowotnaIWsparciePsychiczne;
		return $this;
	}
	
}
