<?php

/**
 * Actions
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

use Hospitalplugin\Entities\PatientPED;
use Hospitalplugin\Entities\PatientCRUD;
use Hospitalplugin\Entities\PatientBuilder;
use Hospitalplugin\Entities\Patient;

/**
 * Actions
 *
 * @category Wp
 * @package Punction
 * @author Andrzej Marcinkowski <andrzej.max.marcinkowski@gmail.com>
 * @copyright 2014 Wojewódzki Szpital Zespolony, Kalisz
 * @license MIT http://opensource.org/licenses/MIT
 * @version 1.0 $Format:%H$
 * @link http://
 * @since File available since Release 1.0.0
 *       
 */
class Actions {
	
	/**
	 * init
	 *
	 * fires all the WP actions and filters
	 */
	static function init() {
		add_action ( 'init', array (
				__CLASS__,
				'create_post_type' 
		) );
		add_action ( 'admin_head', array (
				__CLASS__,
				'hideAdminMenu' 
		) );
		add_action ( 'wp_login', array (
				__CLASS__,
				'afterLogin' 
		) );
		add_filter ( 'login_redirect', array (
				__CLASS__,
				'puctionLoginRedirect' 
		), 10, 3 );
		add_action ( 'wp_ajax_my_action', array (
				__CLASS__,
				'myActionCallback' 
		) );
		add_action ( 'wp_ajax_delete_action', array (
				__CLASS__,
				'deleteActionCallback' 
		) );
	}
	static function create_post_type() {
		register_post_type ( 'pacjent', array (
				'labels' => array (
						'name' => __ ( 'Pacjenci' ),
						'singular_name' => __ ( 'Pacjent' ) 
				),
				'public' => true,
				'has_archive' => false 
		) );
	}
	/**
	 * hide admin menu
	 *
	 * hide some elements for plugin user role
	 */
	static function hideAdminMenu() {
		// move left + hide unnecessary el
		if (! current_user_can ( 'administrator' )) {
			echo <<<HTML
        <script type="text/javascript">
        jQuery(document).ready( function($) {
            //#adminmenuback, #adminmenuwrap
            $('#wp-admin-bar-wp-logo, #global-data-placeholder, #wpfooter, #a-wp-admin-bar-view-site').remove();
            // FOLD ADMIN MENU
            $( 'body' ).addClass('folded');
        });
        </script>
HTML;
		}
	}
	
	/**
	 * after login
	 *
	 * currently does nothing
	 */
	static function afterLogin() {
		$current_user = wp_get_current_user ();
		$id_user = $current_user->ID;
	}
	
	/**
	 * getRedirectURLParam
	 *
	 * returns element if exists in wp-login param
	 *
	 * @param unknown $redirect_to        	
	 * @param unknown $param        	
	 * @return string
	 */
	private static function getRedirectURLParam($redirect_to, $param) {
		$pattern = '/' . $param . '[a-z\-]+/';
		preg_match ( $pattern, $redirect_to, $matched, PREG_OFFSET_CAPTURE );
		if ($matched != null) {
			$elementToHide = '&' . $param . '=' . substr ( $matched [0] [0], strlen ( $param ) );
		} else {
			$elementToHide = "";
		}
		return $elementToHide;
	}
	
	/**
	 * puctionLoginRedirect
	 *
	 * redirects plugin users to main page
	 *
	 * @param string $redirect_to
	 *        	redirection url
	 * @param string $request
	 *        	req
	 * @param unknown $user
	 *        	usr
	 * @return string
	 */
	static function puctionLoginRedirect($redirect_to, $request, $user) {
		global $user;
		if (isset ( $user->roles ) && is_array ( $user->roles )) {
			if (in_array ( 'pielegniarka', $user->roles )) {
				$url = 'wp-admin/edit.php?post_type=pacjent&page=moi-pacjenci';
				$url .= self::getRedirectURLParam ( $redirect_to, 'hide' );
				$url .= self::getRedirectURLParam ( $redirect_to, 'important' );
				return $url;
			} else {
				return $redirect_to;
			}
		} else {
			return $redirect_to;
		}
	}
	
	/**
	 * myActionCallback
	 *
	 * AJAX action callback
	 */
	static function myActionCallback() {
		// TODO add nonce secutrity
		$data = $_POST ['data'];
		$tempData = stripslashes ( $data );
		$obj = json_decode ( $tempData );
		try {
			$patient = PatientCRUD::setPatientCategories ( $obj, $obj->typ );
		} catch ( Exception $e ) {
			// FIXME Logger
			echo "zonk";
			die ();
			// TODO HANDLE err
		}
		echo $patient->toDatatablesJSONString (); // $patients;
		die ();
	}
	
	/**
	 * deleteActionCallback
	 *
	 * AJAX action callback
	 */
	static function deleteActionCallback() {
		// TODO add nonce secutrity
		$id = $_POST ['id'];
		try {
			$userId = wp_get_current_user ()->ID;
			PatientCRUD::deletePatient ( $id, $userId );
		} catch ( Exception $e ) {
			// FIXME Logger
			echo "zonk";
			die ();
			// TODO HANDLE err
		}
		echo $id;
		die ();
	}
}
?>
