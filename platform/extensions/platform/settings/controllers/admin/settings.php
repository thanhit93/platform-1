<?php
/**
 * Part of the Platform application.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the 3-clause BSD License.
 *
 * This source file is subject to the 3-clause BSD License that is
 * bundled with this package in the LICENSE file.  It is also available at
 * the following URL: http://www.opensource.org/licenses/BSD-3-Clause
 *
 * @package    Platform
 * @version    1.0
 * @author     Cartalyst LLC
 * @license    BSD License (3-clause)
 * @copyright  (c) 2011 - 2012, Cartalyst LLC
 * @link       http://cartalyst.com
 */

class Settings_Admin_Settings_Controller extends Admin_Controller
{

	/**
	 * Alias for general
	 *
	 * @return View
	 */
	public function get_index()
	{
		return $this->get_general();
	}

	/**
	 * General Site Settings
	 *
	 * @return View
	 */
	public function get_general()
	{
		// get extension settings from db
		// $settings = Api::get('settings', array(
		// 	'where' => array(
		// 		array('extension', '=', 'settings')
		// 	),
		// 	'organize' => true
		// ));

		// $data['options'] = array(
		// 	'maintenance' => array(
		// 		'0' => 'off',
		// 		'1' => 'on',
		// 	),
		// );

		// if ($settings['status'])
		// {
		// 	$data['has_settings'] = true;
		// 	$data['settings'] = $settings['settings'];
		// }
		// else
		// {
		// 	$data['has_settings'] = false;
		// 	$data['message'] = $settings['message'];
		// }

		return Theme::make('settings::index');
	}

	public function post_general()
	{
		// remove csrf token
		$post = Input::get();

		$update = Api::post('settings', array(
			'extension'  => 'settings',
			'settings'   => $post,
			'validation' => array(
				'store_name'  => 'required',
			),
			'labels' => array(
				'store_name'         => 'Store Name',
				'store_brand'        => 'Store Brand',
				'store_maintenance'  => 'Store Maintenance',
			),
		));

		if ($update['status'])
		{
			Platform::messages()->success($update['updated']);
			Platform::messages()->error($update['errors']);
		}

		return Redirect::to(ADMIN.'/settings/general');
	}

}