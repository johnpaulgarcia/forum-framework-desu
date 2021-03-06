<?php
/**
 * @brief		Outgoing Email Settings
 *
 * @copyright	(c) 2001 - SVN_YYYY Invision Power Services, Inc.
 *
 * @package		IPS Social Suite
 * @subpackage	Nexus
 * @since		18 Apr 2014
 * @version		SVN_VERSION_NUMBER
 */

namespace IPS\nexus\modules\admin\support;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * Outgoing Email Settings
 */
class _outgoingemail extends \IPS\Dispatcher\Controller
{
	/**
	 * Manage
	 *
	 * @return	void
	 */
	protected function manage()
	{
		\IPS\Dispatcher::i()->checkAcpPermission( 'autoresolve_manage' );
		
		$form = new \IPS\Helpers\Form;
		
		$form->add( new \IPS\Helpers\Form\Radio( 'nexus_sout_chrome', \IPS\Settings::i()->nexus_sout_chrome, FALSE, array(
			'options' 		=> array(
				0	=> \IPS\Theme::i()->resource( 'settings/email_no_chrome.png' ),
				1	=> \IPS\Theme::i()->resource( 'settings/email_chrome.png' )
			),
			'parse'			=> 'image',
			'descriptions'	=> array(
				0	=> \IPS\Member::loggedIn()->language()->addToStack('nexus_sout_chrome_no'),
				1	=> \IPS\Member::loggedIn()->language()->addToStack('nexus_sout_chrome_yes'),
			)
		) ) );
		
		$form->add( new \IPS\Helpers\Form\Radio( 'nexus_sout_from', \IPS\Settings::i()->nexus_sout_from, FALSE, array(
			'options'	=> array(
				'staff'	=> 'nexus_sout_from_staff',
				'dpt'	=> 'nexus_sout_from_department',
				'other'	=> 'nexus_sout_from_other',
			),
			'userSuppliedInput'	=> 'other',
			'toggles'	=> array(
				'other'	=> array( 'other_nexus_sout_from' )
			)
		) ) );
		
		$form->add( new \IPS\Helpers\Form\YesNo( 'nexus_sout_autoreply', \IPS\Settings::i()->nexus_sout_autoreply ) );
		
		if ( $form->values() )
		{
			$form->saveAsSettings();
			\IPS\Session::i()->log( 'acplogs__outgoingemail_settings' );
			\IPS\Output::i()->redirect( \IPS\Http\Url::internal( 'app=nexus&module=support&controller=settings&tab=outgoingemail' ), 'saved' );
		}
		
		\IPS\Output::i()->output = $form;
	}
}