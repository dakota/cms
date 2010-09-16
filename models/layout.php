<?php
	/**
	 *
	 *
	 */
	class Layout extends CmsAppModel{
		public $name = 'Layout';

		public $useTable = 'content_layouts';

		public $hasMany = array(
			'Content' => array(
				'className' => 'Cms.Content',
				'foreignKey' => 'layout_id',
			),
		);

		public $belongsTo = array(
		);
	}