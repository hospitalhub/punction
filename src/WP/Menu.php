<?php
/**
 * Menu
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
namespace Punction\WP;

/**
 * Menu
 *
 * @category  Wp
 * @package   Punction
 * @author    Andrzej Marcinkowski <andrzej.max.marcinkowski@gmail.com>
 * @copyright 2014 Wojewódzki Szpital Zespolony, Kalisz
 * @license   MIT http://opensource.org/licenses/MIT
 * @version   1.0  $Format:%H$
 * @link      http://
 * @since     File available since Release 1.0.0
 *
 */
class Menu
{

    /**
     * class
     *
     * @return string
     */
    public static function getClass()
    {
        return __CLASS__;
    }

    /**
     * mypatientsPageCallback
     */
    static function mypatientsPageCallback()
    {
        include __DIR__ . '/../pages/' . 'punction-mypatients.php';
    }
    
    /**
     * mypatientsPageCallback
     */
    static function addPatientPageCallback()
    {
    	include __DIR__ . '/../pages/' . 'punction-add-patient.php';
    }

    /**
     * mypatientsPageCallback
     */
    static function raportCallback()
    {
    	include __DIR__ . '/../pages/' . 'punction-raport.php';
    }
    

    /**
     * mypatientsPageCallback
     */
    static function excelCallback()
    {
    	include __DIR__ . '/../pages/' . 'punction-excel.php';
    }
}
?>
