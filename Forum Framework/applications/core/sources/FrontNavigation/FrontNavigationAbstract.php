<?php
/**
 * @brief		Abstract Front Navigation Extension
 *
 * @copyright	(c) 2001 - SVN_YYYY Invision Power Services, Inc.
 *
 * @package		IPS Social Suite
 * @subpackage	Core
 * @since		30 Jun 2015
 * @version		SVN_VERSION_NUMBER
 */

namespace IPS\core\FrontNavigation;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * Front Navigation Extension: Custom Item
 */
abstract class _FrontNavigationAbstract
{
	/**
	 * Get sub items of an item
	 *
	 * @return	array
	 */
	public function subItems()
	{
		$frontNavigation = \IPS\core\FrontNavigation::frontNavigation();
		$return = array();
		if ( isset( $frontNavigation[ $this->id ] ) )
		{
			foreach ( $frontNavigation[ $this->id ] as $item )
			{
				$class = 'IPS\\' . $item['app'] . '\extensions\core\FrontNavigation\\' . $item['extension'];
				if ( class_exists( $class ) )
				{
					$return[ $item['id'] ] = new $class( json_decode( $item['config'], TRUE ), $item['id'], $item['permissions'] );
				}
			}
		}
		return $return;
	}
	
	/**
	 * Allow multiple instances?
	 *
	 * @return	string
	 */
	public static function allowMultiple()
	{
		return FALSE;
	}
	
	/**
	 * Get configuration fields
	 *
	 * @param	array	$configuration	The existing configuration, if editing an existing item
	 * @param	int		$id				The ID number of the existing item, if editing
	 * @return	array
	 */
	public static function configuration( $existingConfiguration, $id = NULL )
	{
		return array();
	}
	
	/**
	 * Parse configuration fields
	 *
	 * @param	array	$configuration	The values received from the form
	 * @return	array
	 */
	public static function parseConfiguration( $configuration, $id )
	{
		return $configuration;
	}
	
	/**
	 * @brief	The configuration
	 */
	protected $configuration;
	
	/**
	 * @brief	The ID number
	 */
	public $id;
	
	/**
	 * @brief	The permissions
	 */
	public $permissions;
	
	/**
	 * Constructor
	 *
	 * @param	array	$configuration	The configuration
	 * @param	int		$id				The ID number
	 * @param	string	$permissions	The permissions (* or comma-delimited list of groups)
	 * @return	void
	 */
	public function __construct( $configuration, $id, $permissions )
	{
		$this->configuration = $configuration;
		$this->id = $id;
		$this->permissions = $permissions;
	}
	
	/**
	 * Permissions can be inherited?
	 *
	 * @return	bool
	 */
	public static function permissionsCanInherit()
	{
		return TRUE;
	}
	
	/**
	 * Can access?
	 *
	 * @return	bool
	 */
	public function canView()
	{
		if ( $this->permissions and $this->permissions != '*' )
		{
			return \IPS\Member::loggedIn()->inGroup( explode( ',', $this->permissions ) );
		}
		return TRUE;
	}
	
	/**
	 * Get Title
	 *
	 * @return	string
	 */
	abstract public function title();
	
	/**
	 * Get Link
	 *
	 * @return	\IPS\Http\Url
	 */
	abstract public function link();

	/**
	 * Get Attributes
	 *
	 * @return	string
	 */
	public function attributes()
	{
		return '';
	}
		
	/**
	 * Is Active?
	 *
	 * @return	bool
	 */
	public function active()
	{
		foreach ( $this->subItems() as $item )
		{
			if ( $item->active() )
			{
				return TRUE;
			}
		}
		
		return FALSE;
	}
	
	/**
	 * Children
	 *
	 * @return	array
	 */
	public function children()
	{
		return NULL;
	}
}