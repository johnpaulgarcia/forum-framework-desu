<?php
/**
 * @brief		[Database] Category List Controller
 *
 * @copyright	(c) 2001 - SVN_YYYY Invision Power Services, Inc.
 *
 * @package		IPS Social Suite
 * @since		16 April 2014
 * @version		SVN_VERSION_NUMBER
 */

namespace IPS\cms\modules\front\database;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * List
 */
class _index extends \IPS\cms\Databases\Controller
{

	/**
	 * Determine which method to load
	 *
	 * @return void
	 */
	public function manage()
	{
		$database = \IPS\cms\Databases::load( \IPS\cms\Databases\Dispatcher::i()->databaseId );

		/* Not using categories? */
		if ( ! $database->use_categories AND $database->cat_index_type === 0 )
		{
			$controller = new \IPS\cms\modules\front\database\category( $this->url );
			return $controller->view();
		}
		
		$this->view();
	}

	/**
	 * Display database category list.
	 *
	 * @return	void
	 */
	protected function view()
	{
		$database    = \IPS\cms\Databases::load( \IPS\cms\Databases\Dispatcher::i()->databaseId );
		$recordClass = 'IPS\cms\Records' . \IPS\cms\Databases\Dispatcher::i()->databaseId;
		$url         = \IPS\Http\Url::internal( "app=cms&module=pages&controller=page&path=" . \IPS\cms\Pages\Page::$currentPage->full_path, 'front', 'content_page_path', \IPS\cms\Pages\Page::$currentPage->full_path );

		/* RSS */
		if ( $database->rss )
		{
			/* Show the link */
			\IPS\Output::i()->rssFeeds[ $database->_title ] = $url->setQueryString( 'rss', 1 );

			/* Or actually show RSS feed */
			if ( isset( \IPS\Request::i()->rss ) )
			{
				$document     = \IPS\Xml\Rss::newDocument( $url, \IPS\Member::loggedIn()->language()->get('content_db_' . $database->id ), \IPS\Member::loggedIn()->language()->get('content_db_' . $database->id . '_desc' ) );
				$contentField = 'field_' . $database->field_content;
				
				foreach ( $recordClass::getItemsWithPermission( array(), $database->field_sort . ' ' . $database->field_direction, $database->rss, 'read' ) as $record )
				{
					$document->addItem( $record->_title, $record->url(), $record->$contentField, \IPS\DateTime::ts( $record->_publishDate ), $record->_id );
				}
		
				/* @note application/rss+xml is not a registered IANA mime-type so we need to stick with text/xml for RSS */
				\IPS\Output::i()->sendOutput( $document->asXML(), 200, 'text/xml' );
			}
		}

		$page = isset( \IPS\Request::i()->page ) ? intval( \IPS\Request::i()->page ) : 1;

		if( $page < 1 )
		{
			$page = 1;
		}

		if ( $database->cat_index_type === 1 and ! isset( \IPS\Request::i()->show ) )
		{
			/* Featured */
			$limit = 0;
			$count = 0;

			if ( isset( \IPS\Request::i()->page ) )
			{
				$limit = $database->featured_settings['perpage'] * ( $page - 1 );
			}

			$where = ( $database->featured_settings['featured'] ) ? array( array( 'record_featured=?', 1 ) ) : NULL;

			$articles = $recordClass::getItemsWithPermission( $where, 'record_pinned DESC, ' . $database->featured_settings['sort'] . ' ' . $database->featured_settings['direction'], array( $limit, $database->featured_settings['perpage'] ), 'read', NULL, 0, NULL, FALSE, FALSE, FALSE, FALSE );

			if ( $database->featured_settings['pagination'] )
			{
				$count = $recordClass::getItemsWithPermission( $where, 'record_pinned DESC, ' . $database->featured_settings['sort'] . ' ' . $database->featured_settings['direction'], $database->featured_settings['perpage'], 'read', NULL, 0, NULL, FALSE, FALSE, FALSE, TRUE );
			}

			/* Pagination */
			$pagination = array(
				'page'  => $page,
				'pages' => ( $count > 0 ) ? ceil( $count / $database->featured_settings['perpage'] ) : 1
			);

			\IPS\Output::i()->cssFiles = array_merge( \IPS\Output::i()->cssFiles, \IPS\Theme::i()->css( 'database_index/featured.css', 'cms', 'front' ) );

			\IPS\cms\Databases\Dispatcher::i()->output .= \IPS\Output::i()->output = \IPS\cms\Theme::i()->getTemplate( $database->template_featured, 'cms', 'database' )->index( $database, $articles, $url, $pagination );
		}
		else
		{
			/* Category view */
			$class = '\IPS\cms\Categories' . $database->id;
			$categories = $class::roots('view', \IPS\Member::loggedIn(), null, $database->_id );

			\IPS\Output::i()->cssFiles = array_merge( \IPS\Output::i()->cssFiles, \IPS\Theme::i()->css( 'records/index.css', 'cms', 'front' ) );

			\IPS\cms\Databases\Dispatcher::i()->output .= \IPS\Output::i()->output = \IPS\cms\Theme::i()->getTemplate( $database->template_categories, 'cms', 'database' )->index( $database, $categories, $url );
		}
	}

	/**
	 * Show the pre add record form. This is used when no category is set.
	 *
	 * @return	void
	 */
	protected function form()
	{
		$form = new \IPS\Helpers\Form( 'select_category', 'continue' );
		$form->class = 'ipsForm_vertical ipsForm_noLabels';
		$form->add( new \IPS\Helpers\Form\Node( 'category', NULL, TRUE, array(
			'url'					=> \IPS\cms\Pages\Page::$currentPage->url()->setQueryString('do', 'form'),
			'class'					=> 'IPS\cms\Categories' . \IPS\cms\Databases\Dispatcher::i()->databaseId,
			'permissionCheck'		=> function( $node )
			{
				if ( $node->can( 'view' ) )
				{
					if ( $node->can( 'add' ) )
					{
						return TRUE;
					}

					return FALSE;
				}

				return NULL;
			},
		) ) );

		if ( $values = $form->values() )
		{
			\IPS\Output::i()->redirect( $values['category']->url()->setQueryString( 'do', 'form' ) );
		}

		\IPS\Output::i()->title			= \IPS\Member::loggedIn()->language()->addToStack( 'cms_select_category' );
		\IPS\Output::i()->breadcrumb[]	= array( NULL, \IPS\Member::loggedIn()->language()->addToStack( 'cms_select_category' ) );
		\IPS\Output::i()->output		= \IPS\Theme::i()->getTemplate( 'records' )->categorySelector( $form );
	}
}
