<?php
	final class CmsEvents extends AppEvents{
		public function onPluginRollCall(){
			return array(
				'name' => 'Cms',
				'description' => 'Content Management',
				'icon' => '/cms/img/icon.png',
				'author' => 'Infinitas',
				'dashboard' => array(
					'plugin' => 'cms',
					'controller' => 'cms',
					'action' => 'dashboard'
				)
			);
		}

		public function onAdminMenu($event){
			$menu['main'] = array(
				'Dashboard' => array('controller' => 'cms', 'action' => 'dashboard'),
				'Content' => array('controller' => 'contents', 'action' => 'index'),
				'Front Pages' => array('controller' => 'frontpages', 'action' => 'index'),
				'Featured' => array('controller' => 'features', 'action' => 'index'),
			);

			return $menu;
		}
		
		public function onSetupConfig(){
			return Configure::load('cms.config');
		}
		
		public function onSetupCache(){
			return array(
				'name' => 'cms',
				'config' => array(
					'duration' => 3600,
					'probability' => 100,
					'prefix' => 'cms.',
					'lock' => false,
					'serialize' => true
				)
			);
		}

		public function onSlugUrl($event, $data){
			$data['data'] = isset($data['data']) ? $data['data'] : $data;
			$data['type'] = isset($data['type']) ? $data['type'] : 'contents';
			switch(strtolower($data['type'])){
				case 'contents':					
					$url = array(
						'plugin'     => 'cms',
						'controller' => 'contents',
						'action'     => 'view',
						'id'         => $data['data']['Content']['id'],
						'slug'       => $data['data']['Content']['slug'],
						'category'   => isset($data['data']['Category']['slug']) ? $data['data']['Category']['slug'] : __('news-item',true)
					);
					break;
			} // switch

			return $url;
		}
	}