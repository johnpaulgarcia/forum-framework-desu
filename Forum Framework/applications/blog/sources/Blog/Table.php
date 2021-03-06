<?php
/**
 * @brief		Blog Table Helper
 *
 * @copyright	(c) 2001 - SVN_YYYY Invision Power Services, Inc.
 *
 * @package		IPS Social Suite
 * @subpackage	Blog
 * @since		18 Mar 2014
 * @version		SVN_VERSION_NUMBER
 */

namespace IPS\blog\Blog;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * Blog Table Helper
 */
class _Table extends \IPS\Helpers\Table\Table
{
	/**
	 * @brief	Container
	 */
	protected $container;

	/**
	 * Constructor
	 *
	 * @param	\IPS\Http\Url	Base URL
	 * @return	void
	 */
	public function __construct( \IPS\Http\Url $url=NULL )
	{
		/* Init */	
		parent::__construct( $url );
		$this->rowsTemplate = array( \IPS\Theme::i()->getTemplate( 'browse', 'blog' ), 'rows' );
				
		/* Set available sort options */
		foreach ( array( 'last_edate', 'rating_total', 'num_views' ) as $k ) 
		{
			$this->sortOptions[ $k ] = 'blog_' . $k;
		}

		if ( !$this->sortBy )
		{
			$this->sortBy = 'blog_last_edate';
		}
	}

	/**
	 * Set owner
	 *
	 * @param	\IPS\Member	$member		The member to filter by
	 * @return	void
	 */
	public function setOwner( \IPS\Member $member )
	{
		$this->where[]	= array( '(' . \IPS\Db::i()->findInSet( 'blog_groupblog_ids', $member->groups ) . ' OR ' . 'blog_member_id=? )', $member->member_id );
	}

	/**
	 * Get rows
	 *
	 * @param	array	$advancedSearchValues	Values from the advanced search form
	 * @return	array
	 */
	public function getRows( $advancedSearchValues )
	{
		/* Init */
		$class		= "IPS\\blog\\Blog";
		$subquery	= NULL;
		
		/* Check sortBy */
		$this->sortBy	= in_array( $this->sortBy, $this->sortOptions ) ? $this->sortBy : 'blog_name';

		/* What are we sorting by? */
		$sortBy = 'blog_pinned DESC, ' . $this->sortBy . ' ' . ( mb_strtolower( $this->sortDirection ) == 'asc' ? 'asc' : 'desc' );

		/* Specify filter in where clause */
		$where = isset( $this->where ) ? is_array( $this->where ) ? $this->where : array( $this->where ) : array();
		$where[] = array( 'blog_disabled=0' );
		if ( $this->filter and isset( $this->filters[ $this->filter ] ) )
		{
			$where[] = is_array( $this->filters[ $this->filter ] ) ? $this->filters[ $this->filter ] : array( $this->filters[ $this->filter ] );
		}
		
		/* Exclude private blogs unless we have permission to view them */
		if ( \IPS\Member::loggedIn()->member_id )
		{
			$where[] = array( '( blog_social_group IS NULL OR blog_member_id=? OR blog_social_group IN(?) )', \IPS\Member::loggedIn()->member_id, \IPS\Db::i()->select( 'group_id', 'core_sys_social_group_members', array( 'member_id=?', \IPS\Member::loggedIn()->member_id ) ) );
		}
		else
		{
			$where[] = array( 'blog_social_group IS NULL' );
		}

		/* Get Count */
		$count = \IPS\Db::i()->select( 'COUNT(*) as cnt', 'blog_blogs', $where )->first();
  		$this->pages = ceil( $count / $this->limit );

		/* Get results */
		$it = \IPS\Db::i()->select( '*', 'blog_blogs', $where, $sortBy, array( ( $this->limit * ( $this->page - 1 ) ), $this->limit ) );
		$rows = iterator_to_array( $it );

		foreach( $rows as $index => $row )
		{
			$rows[ $index ]	= \IPS\blog\Blog::constructFromData( $row );
		}

		/* Return */
		return $rows;
	}

	/**
	 * Return the table headers
	 *
	 * @param	array|NULL	$advancedSearchValues	Advanced search values
	 * @return	array
	 */
	public function getHeaders( $advancedSearchValues )
	{
		return array();
	}
}