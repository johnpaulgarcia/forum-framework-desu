<?php
/**
 * @brief		Terms of Use
 *
 * @copyright	(c) 2001 - SVN_YYYY Invision Power Services, Inc.
 *
 * @package		IPS Social Suite
 * @since		25 Sept 2013
 * @version		SVN_VERSION_NUMBER
 */

namespace IPS\core\modules\front\system;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * Terms of Use
 */
class _terms extends \IPS\Dispatcher\Controller
{
	/**
	 * Terms of Use
	 *
	 * @return	void
	 */
	protected function manage()
	{
		\IPS\Session::i()->setLocation( \IPS\Http\Url::internal( 'app=core&module=system&controller=terms', NULL, 'terms' ), array(), 'loc_viewing_reg_terms' );
		
		\IPS\Output::i()->title = \IPS\Member::loggedIn()->language()->addToStack('reg_terms');
		\IPS\Output::i()->sidebar['enabled'] = FALSE;
		\IPS\Output::i()->bodyClasses[] = 'ipsLayout_minimal';
		\IPS\Output::i()->output = \IPS\Theme::i()->getTemplate( 'system' )->terms();
	}
}