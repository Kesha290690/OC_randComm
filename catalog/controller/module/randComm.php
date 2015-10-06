<?php
/**
 * Created by PhpStorm.
 * User: Kesha
 * Date: 05.09.2015
 * Time: 22:39
 */

class ControllerModuleRandComm extends Controller {
 
    public function index($setting) {

        $this->load->model('module/randComm');

        $this->load->model('tool/image');
		
		$this->load->model('catalog/category');

        $data = array();

        if($setting['status'] == 1)
        {
            if(isset($this->request->get['path']))
            {
                preg_match('/(\d+)(?!.*\d)/', $this->request->get['path'],$path);
				
				$category_info = $this->model_catalog_category->getCategory($path[0]);
				
				$data['category_name'] = $category_info['name'];
				
				$data['module_name'] = $setting['name'];
                
                $reviews = $this->model_module_randComm->getRandComment($setting['rating'],$setting['limit'],$path[0]);

                foreach($reviews as $review)
                {
                    $data['reviews'][] = array(
                      'author'      => $review['author'],
                      'text'        => $review['text'],
                      'date_added'  => $review['date_added'],
                      'rating'      => $review['rating'],
                      'image'       => $this->model_tool_image->resize($review['image'], $setting['width'], $setting['height']),
                      'name'        => $review['name'],
                      'href'        => $this->url->link('product/product', 'product_id=' . $review['product_id'])
                    );
                }
            }
        }
		

        if(isset($data['reviews']))
        {
            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/randComm.tpl')) {
                return $this->load->view($this->config->get('config_template') . '/template/module/randComm.tpl', $data);
            } else {
                return $this->load->view('default/template/module/randComm.tpl', $data);
            }
        }
    }

}