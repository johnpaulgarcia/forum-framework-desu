<?php
/**
 * @brief		Facebook share link
 *
 * @copyright	(c) 2001 - SVN_YYYY Invision Power Services, Inc.
 *
 * @package		IPS Social Suite
 * @since		11 Sept 2013
 * @version		SVN_VERSION_NUMBER
 * @see			<a href='https://developers.facebook.com/docs/reference/plugins/like/'>Facebook like button documentation</a>
 */

namespace IPS\Content\ShareServices;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * Facebook share link
 */
class _Facebook
{
	/**
	 * @brief	URL to the content item
	 */
	protected $url		= NULL;
	
	/**
	 * @brief	Title of the content item
	 */
	protected $title	= NULL;
		
	/**
	 * Constructor
	 *
	 * @param	\IPS\Http\Url	$url	URL to the content [optional - if omitted, some services will figure out on their own]
	 * @param	string			$title	Default text for the content, usually the title [optional - if omitted, some services will figure out on their own]
	 * @return	void
	 */
	public function __construct( \IPS\Http\Url $url=NULL, $title=NULL )
	{
		$this->url		= $url;
		$this->title	= $title;
	}
	
	/**
	 * Determine whether the logged in user has the ability to autoshare
	 *
	 * @return	boolean
	 */
	public static function canAutoshare()
	{
		return (boolean) \IPS\Member::loggedIn()->fb_token AND \IPS\Member::loggedIn()->fb_uid;
	}
	
	/**
	 * Publish text or a URL to this service
	 *
	 * @param	string	$content	Text to publish
	 * @param	string	$url		[URL to publish]
	 * @return	@void
	 */
	public static function publish( $content, $url=null )
	{
		if ( static::canAutoshare() )
		{
			try
			{
				/* If we include a URL, we'll post it as a link to the wall, otherwise we'll just update the user's status */
				if ( $url !== NULL )
				{
					$response = \IPS\Http\Url::external( "https://graph.facebook.com/" . \IPS\Member::loggedIn()->fb_uid . "/links" )->request()->post( array(
						'message'		=> $content,
						'link'			=> (string) $url,
						'access_token'	=> \IPS\Member::loggedIn()->fb_token,
					) )->decodeJson();
					
					if ( ! isset( $response['id'] ) )
					{
						throw new \InvalidArgumentException( \IPS\Member::loggedIn()->language()->addToStack('facebook_publish_exception') );
					} 
				}
				else
				{
					$response = \IPS\Http\Url::external( "https://graph.facebook.com/" . \IPS\Member::loggedIn()->fb_uid . "/feed" )->request()->post( array(
						'message'		=> $content,
						'access_token'	=> \IPS\Member::loggedIn()->fb_token,
					) )->decodeJson();
						
					if ( ! isset( $response['id'] ) )
					{
						throw new \InvalidArgumentException( \IPS\Member::loggedIn()->language()->addToStack('facebook_publish_exception') );
					}
				}
			}
			catch( \IPS\Http\Request\Exception $e )
			{
				IPS\Log::i( LOG_WARNING )->write( \IPS\Member::loggedIn()->id . ': '. $e->getMessage(), 'facebook' );
				
				throw new \InvalidArgumentException( \IPS\Member::loggedIn()->language()->addToStack('facebook_publish_exception') );
			}
		}
		else
		{
			throw new \InvalidArgumentException( \IPS\Member::loggedIn()->language()->addToStack('facebook_publish_no_user') );
		}
	}
	
	/**
	 * Add any additional form elements to the configuration form. These must be setting keys that the service configuration form can save as a setting.
	 *
	 * @param	\IPS\Helpers\Form	$form	Configuration form for this service
	 * @return	void
	 */
	public static function modifyForm( \IPS\Helpers\Form &$form )
	{
		$form->add( new \IPS\Helpers\Form\Select( 'fbc_bot_group', \IPS\Settings::i()->fbc_bot_group, TRUE, array( 'options' => array_combine( array_keys( \IPS\Member\Group::groups() ), array_map( function( $_group ) { return (string) $_group; }, \IPS\Member\Group::groups() ) ) ) ) );
	}

	/**
	 * Return the HTML code to show the share link
	 *
	 * @return	string
	 */
	public function __toString()
	{
		return \IPS\Theme::i()->getTemplate( 'sharelinks', 'core' )->facebook( urlencode( $this->url ) );
	}
}