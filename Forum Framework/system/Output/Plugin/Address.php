<?php
/**
 * @brief		Template Plugin - Address formatter
 *
 * @copyright	(c) 2001 - SVN_YYYY Invision Power Services, Inc.
 *
 * @package		IPS Social Suite
 * @since		6 Aug 2013
 * @version		SVN_VERSION_NUMBER
 */

namespace IPS\Output\Plugin;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * Template Plugin - Address formatting
 */
class _Address
{
	/**
	 * Run the plug-in
	 *
	 * @param	string 		$data	  The initial data from the tag
	 * @param	array		$options    Array of options
	 * @return	string		Code to eval
	 */
	public static function runPlugin( $data, $options )
	{
		if( mb_substr( $data, 0, 1 ) === '\\' OR mb_substr( $data, 0, 1 ) === '$' )
		{
			return '\IPS\GeoLocation::parseForOutput( ' . $data . ' )';
		}
		else
		{
			return '\IPS\GeoLocation::parseForOutput( \'' . $data . '\' )';
		}
	}
}