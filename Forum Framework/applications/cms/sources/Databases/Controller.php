<?php
/**
 * @brief		Abstract class that Controllers should extend
 *
 * @copyright	(c) 2001 - SVN_YYYY Invision Power Services, Inc.
 *
 * @package		IPS Social Suite
 * @since		16 April 2014
 * @version		SVN_VERSION_NUMBER
 */

namespace IPS\cms\Databases;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * Abstract class that Controllers should extend
 */
abstract class _Controller extends \IPS\Dispatcher\Controller
{
	/** 
	 * @brief	Base URL
	 */
	public $url;
	
	/**
	 * Constructor
	 *
	 * @param	\IPS\Http\Url|NULL	$url		The base URL for this controller or NULL to calculate automatically
	 * @return	void
	 */
	public function __construct( $url=NULL )
	{
		if ( $url === NULL )
		{
			$class		= get_called_class();
			$exploded	= explode( '\\', $class );
			$this->url = \IPS\Http\Url::internal( "app=cms&module=database", 'front' ); /* @todo fix URL */
		}
		else
		{
			$this->url = $url;
		}
	}

}