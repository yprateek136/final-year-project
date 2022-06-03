<?php

class Public_model extends CI_Model {

	private $showOutOfStock;
	private $showInSliderProducts;
	private $multiVendor;

	public function __construct() {
		parent::__construct();
		$this->load->Model('Home_admin_model');
		$this->showOutOfStock = $this->Home_admin_model->getValueStore('outOfStock');
		$this->showInSliderProducts = $this->Home_admin_model->getValueStore('showInSlider');
		$this->multiVendor = $this->Home_admin_model->getValueStore('multiVendor');
	}

	public function productsCount($big_get) {
		$this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
		$this->db->where('products_translations.abbr', MY_LANGUAGE_ABBR);
		if (!empty($big_get) && isset($big_get['category'])) {
			$this->getFilter($big_get);
		}
		$this->db->where('visibility', 1);
		if ($this->showOutOfStock == 0) {
			$this->db->where('quantity >', 0);
		}
		if ($this->showInSliderProducts == 0) {
			$this->db->where('in_slider', 0);
		}
		if ($this->multiVendor == 0) {
			$this->db->where('vendor_id', 0);
		}
		return $this->db->count_all_results('products');
	}

	public function getNewProducts() {
		$this->db->select('vendors.url as vendor_url, products.id, products.quantity, products.image, products.url, products_translations.price, products_translations.title, products_translations.old_price');
		$this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
		$this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
		$this->db->where('products_translations.abbr', MY_LANGUAGE_ABBR);
		$this->db->where('products.in_slider', 0);
		$this->db->where('visibility', 1);
		if ($this->showOutOfStock == 0) {
			$this->db->where('quantity >', 0);
		}
		$this->db->order_by('products.id', 'desc');
		$this->db->limit(5);
		$query = $this->db->get('products');
		return $query->result_array();
	}

	public function getLastBlogs() {
		$this->db->limit(5);
		$this->db->join('blog_translations', 'blog_translations.for_id = blog_posts.id', 'left');
		$this->db->where('blog_translations.abbr', MY_LANGUAGE_ABBR);
		$query = $this->db->select('blog_posts.id, blog_translations.title, blog_translations.description, blog_posts.url, blog_posts.time, blog_posts.image')->get('blog_posts');
		return $query->result_array();
	}

	public function getPosts($limit, $page, $search = null, $month = null) {
		if ($search !== null) {
			$search = $this->db->escape_like_str($search);
			$this->db->where("(blog_translations.title LIKE '%$search%' OR blog_translations.description LIKE '%$search%')");
		}
		if ($month !== null) {
			$from = intval($month['from']);
			$to = intval($month['to']);
			$this->db->where("time BETWEEN $from AND $to");
		}
		$this->db->join('blog_translations', 'blog_translations.for_id = blog_posts.id', 'left');
		$this->db->where('blog_translations.abbr', MY_LANGUAGE_ABBR);
		$query = $this->db->select('blog_posts.id, blog_translations.title, blog_translations.description, blog_posts.url, blog_posts.time, blog_posts.image')->get('blog_posts', $limit, $page);
		return $query->result_array();
	}

	public function getProductDetails($field, $search) {
		if ($limit !== null && $start !== null) {
			$this->db->limit($limit, $start);
		}

		$this->db->select('vendors.url as vendor_url, products.id,products.test_id,products.image, products.shop_categorie, products.quantity,products.risk_area_id as risk_area,
		products_translations.title, products_translations.price, products_translations.old_price,products_translations.sample_type,
		products_translations.sample_collection,products_translations.description,products_translations.basic_description,products_translations.reporting_time,
		products_translations.fasting_time,products_translations.total_tests,products_translations.parameters, products.url');
		$this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
		$this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
		$this->db->where('products_translations.abbr', MY_LANGUAGE_ABBR);
		$this->db->where('visibility', 1);
		$this->db->where('products_translations.status', 1);

		if (!empty($field)) {
			$this->db->like($field, str_replace("_", " ", $search));
		}

		$query = $this->db->get('products');
		//echo $this->db->last_query();die;
		return $query->result_array();
	}

	public function getProducts($limit = null, $start = null, $big_get=null, $vendor_id = false) {
		if ($limit !== null && $start !== null) {
			$this->db->limit($limit, $start);
		}
		if ($big_get['price'] !== null) {
			$ord = explode('=', $big_get['price']);
			if (isset($ord[0]) && isset($ord[1])) {
				$this->db->order_by('products_translations.' . $ord[0], $ord[1]);
			}
		}
		if ($big_get['letter'] !== null) {
			$ord = explode('=', $big_get['letter']);
			if (isset($ord[0]) && isset($ord[1])) {
				$this->db->order_by('products_translations.title', $ord[1]);
			}
		} else {
			$this->db->order_by('products_translations.title', 'asc');
		}

		if (!empty($big_get)) {
			unset($big_get['price']);
			unset($big_get['letter']);
			$this->getFilter($big_get);
			//print_r($big_get);die;
		}
		$this->db->select('vendors.url as vendor_url, products.id,products.image, products.shop_categorie, products.quantity,
		products_translations.title, products_translations.price, products_translations.old_price,products_translations.sample_type,products_translations.sample_collection,
		products_translations.reporting_time,products_translations.fasting_time,products_translations.total_tests,products_translations.parameters,
		products_translations.includes, products.url');
		$this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
		$this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
		$this->db->where('products_translations.abbr', MY_LANGUAGE_ABBR);
		$this->db->where('visibility', 1);
		$this->db->where('products_translations.status', 1);
		if ($vendor_id !== false) {
			$this->db->where('vendor_id', $vendor_id);
		}
		/* if ($this->showOutOfStock == 0) {
			            $this->db->where('quantity >', 0);
			        }
			        if ($this->showInSliderProducts == 0) {
			            $this->db->where('in_slider', 0);
			        }
			        if ($this->multiVendor == 0) {
			            $this->db->where('vendor_id', 0);
		*/

		if (isset($big_get['price'])) {
			$this->db->order_by('position', 'asc');
		}
		$query = $this->db->get('products');
		//echo $this->db->last_query();die;
		return $query->result_array();
	}

	public function getOneLanguage($myLang) {
		return null;
	}

	private function getFilter($big_get) {

		if ($big_get['category'] != '') {
			(int) $big_get['category'];
			$findInIds = array();
			$findInIds[] = $big_get['category'];
			$query = $this->db->query('SELECT id FROM shop_categories WHERE sub_for = ' . $this->db->escape($big_get['category']));
			foreach ($query->result() as $row) {
				$findInIds[] = $row->id;
			}
			$this->db->where_in('products.shop_categorie', $findInIds);
		}

		if ($big_get['shop_categorie'] != '') {
			$this->db->where_in('products.shop_categorie', $big_get['shop_categorie']);
		}

		if ($big_get['risk_area_id'] != '') {

			$riskAreaArray = explode(",", $big_get['risk_area_id']);
			$whereArray = array();
			foreach (array_filter($riskAreaArray) as $risk_area) {
				if ($risk_area != '') {
					$whereArray[] = " FIND_IN_SET('" . $risk_area . "', products.risk_area_id) ";
				}
			}

			if (!empty($whereArray)) {
				$where = implode(" OR ", $whereArray);
			}

			$this->db->where($where);

			// $this->db->where('find_in_set('.$riskAreaArray.',products.risk_area_id)');
		}

		if ($big_get['in_stock'] != '') {
			if ($big_get['in_stock'] == 1) {
				$sign = '>';
			} else {
				$sign = '=';
			}

			$this->db->where('products.quantity ' . $sign, '0');
		}

		if ($big_get['search_in_title'] != '') {
			$this->db->like('products_translations.title', trim($big_get['search_in_title']));
			$this->db->or_like('products_translations.description', trim($big_get['search_in_title']));
		}

		if ($big_get['search_in_body'] != '') {
			$this->db->like('products_translations.description', trim($big_get['search_in_body']));
			$this->db->or_like('products_translations.title', trim($big_get['search_in_body']));
		}
		if ($big_get['order_price'] != '') {
			$this->db->order_by('products_translations.price', $big_get['order_price']);
		}
		if ($big_get['order_procurement'] != '') {
			$this->db->order_by('products.procurement', $big_get['order_procurement']);
		}
		if ($big_get['order_new'] != '') {
			$this->db->order_by('products.id', $big_get['order_new']);
		} else {
			$this->db->order_by('products.id', 'DESC');
		}
		if ($big_get['quantity_more'] != '') {
			$this->db->where('products.quantity > ', $big_get['quantity_more']);
		}
		if ($big_get['quantity_more'] != '') {
			$this->db->where('products.quantity > ', $big_get['quantity_more']);
		}
		if ($big_get['brand_id'] != '') {
			$this->db->where('products.brand_id = ', $big_get['brand_id']);
		}
		if ($big_get['added_after'] != '') {
			$time = strtotime($big_get['added_after']);
			$this->db->where('products.time > ', $time);
		}
		if ($big_get['added_before'] != '') {
			$time = strtotime($big_get['added_before']);
			$this->db->where('products.time < ', $time);
		}
		if ($big_get['price_from'] != '') {
			$this->db->where('products_translations.price >= ', $big_get['price_from']);
		}
		if ($big_get['price_to'] != '') {
			$this->db->where('products_translations.price <= ', $big_get['price_to']);
		}
	}

	/*
		* Function getCourseOffered
	*/
	// public function getCourseOffered($limit = '', $field, $value) {

	// 	$this->db->select('*');

	// 	if (!empty($field) && !empty($value)) {
	// 		$this->db->where($field, $value);
	// 	}
	// 	$this->db->where('is_deleted', '0');
	// 	$this->db->order_by('position', 'asc');
	// 	if ($limit > 0) {
	// 		$this->db->limit(4);
	// 	}

	// 	$query = $this->db->get('courses_offered');
	// 	$arr = array();
	// 	if ($query !== false) {
	// 		foreach ($query->result_array() as $row) {
	// 			$arr[] = $row;
	// 		}
	// 	}

	// 	return $arr;

	// }

	/*
		* Function getRiskCategories
	*/

	// public function getRiskCategories($table_name = 'risk_categories', $field, $value, $limit) {

	// 	$this->db->select('*');
	// 	if (!empty($field) && !empty($value)) {
	// 		$this->db->where($field, $value);
	// 	}
	// 	$this->db->where('is_deleted', '0');
	// 	$this->db->order_by('position', 'asc');

	// 	if ($limit > 0) {
	// 		$this->db->limit($limit);
	// 	}

	// 	$query = $this->db->get('risk_categories');
	// 	$arr = array();
	// 	if ($query !== false) {
	// 		foreach ($query->result_array() as $row) {
	// 			$arr[] = $row;
	// 		}
	// 	}

	// 	return $arr;

	// }

	public function getSeo($page) {
		$this->db->where('slug', $page);
		// $this->db->where('abbr', MY_LANGUAGE_ABBR);
		$query = $this->db->get('seoPages');
		$arr = array();
		if ($query !== false) {
			foreach ($query->result_array() as $row) {
				$arr['title'] = $row['title'];
				$arr['description'] = $row['description'];
			}
		}
		//echo $this->db->last_query();die;
		return $arr;
	}

	public function getOneProduct($id) {
		$this->db->where('products.id', $id);

		$this->db->select('vendors.url as vendor_url, products.*, products_translations.title,products_translations.description, products_translations.price,
		products_translations.old_price, products.url, shop_categories_translations.name as categorie_name');

		$this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
		$this->db->where('products_translations.abbr', MY_LANGUAGE_ABBR);

		$this->db->join('shop_categories_translations', 'shop_categories_translations.for_id = products.shop_categorie', 'inner');
		$this->db->where('shop_categories_translations.abbr', MY_LANGUAGE_ABBR);
		$this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
		$this->db->where('visibility', 1);
		$query = $this->db->get('products');
		return $query->row_array();
	}

	public function getCountQuantities() {
		$query = $this->db->query('SELECT SUM(IF(quantity<=0,1,0)) as out_of_stock, SUM(IF(quantity>0,1,0)) as in_stock FROM products WHERE visibility = 1');
		return $query->row_array();
	}

	public function setToCart($post) {
		if (!is_numeric($post['article_id'])) {
			return false;
		}
		$query = $this->db->insert('shopping_cart', array(
			'session_id' => session_id(),
			'article_id' => $post['article_id'],
			'time' => time(),
		));
		return $query;
	}

	public function getShopItems($array_items) {
		$this->db->select('products.id, products.image, products.url, products.quantity, products_translations.price, products_translations.title');
		$this->db->from('products');
		if (count($array_items) > 1) {
			$i = 1;
			$where = '';
			foreach ($array_items as $id) {
				$i == 1 ? $open = '(' : $open = '';
				$i == count($array_items) ? $or = '' : $or = ' OR ';
				$where .= $open . 'products.id = ' . $id . $or;
				$i++;
			}
			$where .= ')';
			$this->db->where($where);
		} else {
			$this->db->where('products.id =', current($array_items));
		}
		$this->db->join('products_translations', 'products_translations.for_id = products.id', 'inner');
		$this->db->where('products_translations.abbr', MY_LANGUAGE_ABBR);
		$query = $this->db->get();
		return $query->result_array();
	}

	/*
		     * Users for notification by email
	*/

	public function getNotifyUsers() {
		$result = $this->db->query('SELECT email FROM users WHERE notify = 1');
		$arr = array();
		foreach ($result->result_array() as $email) {
			$arr[] = $email['email'];
		}
		return $arr;
	}

	public function setOrder($post) {
		$q = $this->db->query('SELECT MAX(order_id) as order_id FROM orders');
		$rr = $q->row_array();
		if ($rr['order_id'] == 0) {
			$rr['order_id'] = 20180714;
		}
		$post['order_id'] = $rr['order_id'] + 1;

		$post['date'] = date('Y-m-d h:i:s');
		$this->db->trans_begin();

		if (!$this->db->insert('orders', array(
			'order_id' => $post['order_id'],
			'user_id' => $post['user_details']['id'],
			'products' => $post['products'],
			'our_price' => $post['our_price'],
			'offer_price' => $post['offer_price'],
			'order_date' => $post['date'],
			'discount' => $post['discount'],
			'order_otp' => $post['order_otp'],
			'total_packages' => $post['total_packages'],
			'heard_copy_required' => $post['post']['heard_copy_required'],
			'referrer' => 'Sharda Diagnostics',
			'clean_referrer' => $post['clean_referrer'],
			'payment_type' => $post['post']['payment_type'],
			'payment_status' => '1',
			'order_status' => '1',
			'is_deleted' => '0',
			'discount_code' => @$post['coupon_code'],
		))) {
			log_message('error', print_r($this->db->error(), true));
		}
		//echo $this->db->last_query();die;
		$lastId = $this->db->insert_id();
		$nameArray = explode(" ", $post['user_details']['name']);

		if (!$this->db->insert('orders_clients', array(
			'for_id' => $lastId,
			'first_name' => ucwords(trim($nameArray[0])),
			'last_name' => ucwords(trim(str_replace($nameArray[0], "", $post['user_details']['name']))),
			'email' => $post['user_details']['email'],
			'phone' => $post['user_details']['phone'],
			'address' => trim($post['booking_details']['locality'] . ', ' . $post['booking_details']['house_no'] . ', ' . $post['booking_details']['landmark']),
			'city' => $post['city'],
			'booking_date' => $post['booking_slot']['booking_date'],
			'booking_time' => $post['booking_slot']['booking_time'],
			'post_code' => $post['post_code'],
			'notes' => $post['notes'],
		))) {
			log_message('error', print_r($this->db->error(), true));
		}
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return false;
		} else {
			$this->db->trans_commit();
			return $post['order_id'];
		}
	}

	public function setVendorOrder($post) {
		$i = 0;
		$post['products'] = array();
		foreach ($post['id'] as $product) {
			$post['products'][$product] = $post['quantity'][$i];
			$i++;
		}

		/*
			         * Loop products and check if its from vendor - save order for him
		*/
		foreach ($post['products'] as $product_id => $product_quantity) {
			$productInfo = $this->getOneProduct($product_id);
			if ($productInfo['vendor_id'] > 0) {

				$q = $this->db->query('SELECT MAX(order_id) as order_id FROM vendors_orders');
				$rr = $q->row_array();
				if ($rr['order_id'] == 0) {
					$rr['order_id'] = 1233;
				}
				$post['order_id'] = $rr['order_id'] + 1;

				unset($post['id'], $post['quantity']);
				$post['date'] = time();
				$post['products'] = serialize(array($product_id => $product_quantity));
				$this->db->trans_begin();
				if (!$this->db->insert('vendors_orders', array(
					'order_id' => $post['order_id'],
					'products' => $post['products'],
					'date' => $post['date'],
					'referrer' => $post['referrer'],
					'clean_referrer' => $post['clean_referrer'],
					'payment_type' => $post['payment_type'],
					'paypal_status' => @$post['paypal_status'],
					'discount_code' => @$post['discountCode'],
					'vendor_id' => $productInfo['vendor_id'],
				))) {
					log_message('error', print_r($this->db->error(), true));
				}
				$lastId = $this->db->insert_id();
				if (!$this->db->insert('vendors_orders_clients', array(
					'for_id' => $lastId,
					'first_name' => $post['first_name'],
					'last_name' => $post['last_name'],
					'email' => $post['email'],
					'phone' => $post['phone'],
					'address' => $post['address'],
					'city' => $post['city'],
					'post_code' => $post['post_code'],
					'notes' => $post['notes'],
				))) {
					log_message('error', print_r($this->db->error(), true));
				}
				if ($this->db->trans_status() === FALSE) {
					$this->db->trans_rollback();
					return false;
				} else {
					$this->db->trans_commit();
				}
			}
		}
	}

	public function setActivationLink($link, $orderId) {
		$result = $this->db->insert('confirm_links', array('link' => $link, 'for_order' => $orderId));
		return $result;
	}

	public function getSliderProducts() {
		$this->db->select('vendors.url as vendor_url, products.id, products.quantity, products.image, products.url, products_translations.price, products_translations.title, products_translations.basic_description, products_translations.old_price');
		$this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
		$this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
		$this->db->where('products_translations.abbr', MY_LANGUAGE_ABBR);
		$this->db->where('visibility', 1);
		$this->db->where('in_slider', 1);
		if ($this->showOutOfStock == 0) {
			$this->db->where('quantity >', 0);
		}
		$query = $this->db->get('products');
		return $query->result_array();
	}

	public function getbestSellers($categorie = 0, $noId = 0) {
		$this->db->select('vendors.url as vendor_url, products.id, products.quantity, products.image, products.url, products_translations.price, products_translations.title, products_translations.old_price');
		$this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
		$this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
		if ($noId > 0) {
			$this->db->where('products.id !=', $noId);
		}
		$this->db->where('products_translations.abbr', MY_LANGUAGE_ABBR);
		if ($categorie != 0) {
			$this->db->where('products.shop_categorie !=', $categorie);
		}
		$this->db->where('visibility', 1);
		if ($this->showOutOfStock == 0) {
			$this->db->where('quantity >', 0);
		}
		$this->db->order_by('products.procurement', 'desc');
		$this->db->limit(5);
		$query = $this->db->get('products');
		return $query->result_array();
	}

	public function sameCagegoryProducts($categorie, $noId, $vendor_id = false) {
		$this->db->select('vendors.url as vendor_url, products.id, products.quantity, products.image, products.url, products_translations.price, products_translations.title, products_translations.old_price');
		$this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
		$this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
		$this->db->where('products.id !=', $noId);
		if ($vendor_id !== false) {
			$this->db->where('vendor_id', $vendor_id);
		}
		$this->db->where('products.shop_categorie =', $categorie);
		$this->db->where('products_translations.abbr', MY_LANGUAGE_ABBR);
		$this->db->where('visibility', 1);
		if ($this->showOutOfStock == 0) {
			$this->db->where('quantity >', 0);
		}
		$this->db->order_by('products.id', 'desc');
		$this->db->limit(5);
		$query = $this->db->get('products');
		return $query->result_array();
	}

	public function getOnePost($id) {
		$this->db->select('blog_translations.title, blog_translations.description, blog_posts.image, blog_posts.time');
		$this->db->where('blog_posts.id', $id);
		$this->db->join('blog_translations', 'blog_translations.for_id = blog_posts.id', 'left');
		$this->db->where('blog_translations.abbr', MY_LANGUAGE_ABBR);
		$query = $this->db->get('blog_posts');
		return $query->row_array();
	}

	public function getArchives() {
		$result = $this->db->query("SELECT DATE_FORMAT(FROM_UNIXTIME(time), '%M %Y') as month, MAX(time) as maxtime, MIN(time) as mintime FROM blog_posts GROUP BY DATE_FORMAT(FROM_UNIXTIME(time), '%M %Y')");
		if ($result->num_rows() > 0) {
			return $result->result_array();
		}
		return false;
	}



	public function getFooterCategories() {
		$arr = array();
		return $arr;
	}

	public function setSubscribe($array) {
		$num = $this->db->where('email', $arr['email'])->count_all_results('subscribed');
		if ($num == 0) {
			$this->db->insert('subscribed', $array);
		}
	}

	public function getDynPagesLangs($dynPages) {
		if (!empty($dynPages)) {
			$this->db->join('textual_pages_tanslations', 'textual_pages_tanslations.for_id = active_pages.id', 'left');
			$this->db->where_in('active_pages.name', $dynPages);
			$this->db->where('textual_pages_tanslations.abbr', MY_LANGUAGE_ABBR);
			$this->db->order_by('textual_pages_tanslations.name', 'asc');
			$result = $this->db->select('textual_pages_tanslations.name as lname, active_pages.name as pname')->get('active_pages');
			$ar = array();
			$i = 0;
			foreach ($result->result_array() as $arr) {
				$ar[$i]['lname'] = $arr['lname'];
				$ar[$i]['pname'] = $arr['pname'];
				$i++;
			}
			return $ar;
		} else {
			return $dynPages;
		}

	}

	public function getOnePage($page) {
		$this->db->join('textual_pages_tanslations', 'textual_pages_tanslations.for_id = active_pages.id', 'left');
		//$this->db->where('textual_pages_tanslations.abbr', MY_LANGUAGE_ABBR);
		$this->db->where('active_pages.name', $page);
		$result = $this->db->select('textual_pages_tanslations.description as content, textual_pages_tanslations.name')->get('active_pages');
		return $result->row_array();
	}

	public function changePaypalOrderStatus($order_id, $status) {
		$processed = 0;
		if ($status == 'canceled') {
			$processed = 2;
		}
		$this->db->where('order_id', $order_id);
		if (!$this->db->update('orders', array(
			'paypal_status' => $status,
			'processed' => $processed,
		))) {
			log_message('error', print_r($this->db->error(), true));
		}
	}

	public function getCookieLaw() {
		$this->db->join('cookie_law_translations', 'cookie_law_translations.for_id = cookie_law.id', 'inner');
		$this->db->where('cookie_law_translations.abbr', MY_LANGUAGE_ABBR);
		$this->db->where('cookie_law.visibility', '1');
		$query = $this->db->select('link, theme, message, button_text, learn_more')->get('cookie_law');
		if ($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return false;
		}
	}

	public function confirmOrder($md5) {
		$this->db->limit(1);
		$this->db->where('link', $md5);
		$result = $this->db->get('confirm_links');
		$row = $result->row_array();
		if (!empty($row)) {
			$orderId = $row['for_order'];
			$this->db->limit(1);
			$this->db->where('order_id', $orderId);
			$result = $this->db->update('orders', array('confirmed' => '1'));
			return $result;
		}
		return false;
	}

	public function getValidDiscountCode($code) {
		$time = time();
		$this->db->select('type, amount');
		$this->db->where('code', $code);
		$this->db->where($time . ' BETWEEN valid_from_date AND valid_to_date');
		$query = $this->db->get('discount_codes');
		return $query->row_array();
	}

	public function countPublicUsersWithEmail($email, $id = 0) {
		if ($id > 0) {
			$this->db->where('id !=', $id);
		}
		$this->db->where('email', $email);
		return $this->db->count_all_results('users_public');
	}

	public function registerUser($post) {
		$this->db->insert('users_public', array(
			'name' => $post['name'],
			'phone' => $post['phone'],
			'email' => $post['email'],
			'password' => md5($post['pass']),
		));
		return $this->db->insert_id();
	}

	public function updateProfile($post) {
		$array = array(
			'name' => $post['name'],
			'phone' => $post['phone'],
			'email' => $post['email'],
		);
		if (trim($post['pass']) != '') {
			$array['password'] = md5($post['pass']);
		}
		$this->db->where('id', $post['id']);
		$this->db->update('users_public', $array);
	}

	public function checkPublicUserIsValid($post) {
		$this->db->where('email', $post['email']);
		$this->db->where('password', md5($post['pass']));
		$query = $this->db->get('users_public');
		$result = $query->row_array();
		if (empty($result)) {
			return false;
		} else {
			return $result['id'];
		}
	}

	/*
		* Function checkPublicUserOTP
	*/

	public function checkPublicUserOTP($post) {
		if (!empty($post)) {
			$this->db->select('users_public.*, family_member.member_id');
			$this->db->join('family_member', 'family_member.user_id = users_public.id', 'left');

			$this->db->where('phone', $post['mobile']);
			$this->db->where('otp', $post['otp']);
			$query = $this->db->get('users_public');
			$result = $query->row_array();
			if (empty($result)) {
				return false;
			} else {
				return $result;
			}
		} else {
			return false;
		}
	}

//Function gmail login

	function addGmaillogin($params) {

		$id = '';
		$result = array();
		$user_id = '';

		$result = $this->userInfo($params['U3']);
		$user_id = $result['id'];

		if ($user_id > 0) {
			if (!$this->db->set('email', $params['U3'])->set('last_login_time', date('Y-m-d h:i:s'))->set('name', $params['ofa'])
				->set('profile_image', $params['Paa'])->set('login_src', 'Gmail')->set('login_src__id', $params['Eea'])
				->where('id', $user_id)->update('users_public')) {
				print_r($this->db->error());die;
				log_message('error', print_r($this->db->error(), true));
			}
			//echo $this->db->last_query();die;
			$id = $user_id;
		} else {
			$params = array('email' => $params['U3'], 'last_login_time' => date('Y-m-d h:i:s'), 'name' => $params['ofa'], 'profile_image' => $params['Paa']
				, 'login_src' => 'Gmail', 'login_src__id' => $params['Eea']);
			if (!$this->db->insert('users_public', $params)) {
				print_r($this->db->error());die;
				log_message('error', print_r($this->db->error(), true));
			}

			$id = $this->db->insert_id();
			// Add User to Family Member Tables
			$fparams = array();
			if ($params['ofa']) {
				$name = $params['ofa'];} else { $name = 'User';}
			$fparams = array('user_id' => $id, 'relation' => 'Self', 'full_name' => $name, 'email_id' => $params['U3'], 'status' => '1',
				'is_deleted' => '0', 'createdon' => date('Y-m-d h:i:s'), 'modified_on' => date('Y-m-d h:i:s'));
			if (!$this->db->insert('family_member', $fparams)) {
				print_r($this->db->error());die;
				log_message('error', print_r($this->db->error(), true));
			}

			$result = $this->userInfo($params['U3']);
			//log_message('error', print_r($this->db->error(), true));
		}

		return $result;
	}

	private function userInfo($user_email) {
		$this->db->select('users_public.*, family_member.member_id');
		$this->db->join('family_member', 'family_member.user_id = users_public.id', 'left');
		$this->db->where('users_public.email', $user_email);
		if (!$query = $this->db->get('users_public')) {
			print_r($this->db->error());die;
			log_message('error', print_r($this->db->error(), true));
		}
		$result = $query->row_array();
		return $result;
	}

	public function getUserProfileInfo($id) {
		$this->db->where('id', $id);
		$query = $this->db->get('users_public');
		return $query->row_array();
	}

	public function sitemap() {
		$query = $this->db->select('url')->get('products');
		return $query;
	}

	public function sitemapBlog() {
		$query = $this->db->select('url')->get('blog_posts');
		return $query;
	}

	/*
		* Function addToCart
	*/
	public function addToCart($product_id, $user_id, $session_id, $member_id) {

		if ($product_id > 0 && $user_id > 0 && $member_id > 0) {

			$this->db->where('user_id', $user_id);
			$this->db->where('member_id', $member_id);
			$this->db->where('product_id', $product_id);
			$this->db->where('status', '1');

			$query = $this->db->get('shopping_cart');
			$resp = $query->row_array();

			if (empty($resp)) {
				$this->db->insert('shopping_cart', array(
					'user_id' => $user_id,
					'product_id' => $product_id,
					'member_id' => $member_id,
					'added_on' => date('Y-m-d h:i:s'),
					'session_id' => $session_id)
				);

				$response = $this->db->insert_id();
			} else {
				$response = 'msg_' . $product_id;
			}

			return $response;
		}
	}

	/*
		* Function: getMyCartItems
		* Parameters:
		* Purpose:
		* CreatedOn:
		* CreatedBy:
		* ModifiedOn:
		* Modified By:
		* Return:
	*/

	public function getMyCartItems($user_id) {
		if ($user_id > 0) {
			$this->db->select('shopping_cart.id as cart_id, shopping_cart.user_id,shopping_cart.member_id, products_translations.price, products_translations.title, products_translations.old_price, products_translations.total_tests');
			$this->db->join('products_translations', 'products_translations.for_id = shopping_cart.product_id', 'left');
			$this->db->where('user_id', $user_id);
			$this->db->where('shopping_cart.status', '1');
			$query = $this->db->get('shopping_cart');
			$result = $query->result_array();

			$resultArray = array();
			foreach ($result as $key => $value) {
				if (array_key_exists($resultArray, $value['member_id'])) {
					$resultArray[$value['member_id']][] = $value;
				} else {
					$resultArray[$value['member_id']][] = $value;
				}
			}

			if (empty($resultArray)) {

				return false;

			} else {

				return $resultArray;

			}

		}

	}

	/*
		* Function: removeAllItemsFromCart
		* Parameters:
		* Purpose:
		* CreatedOn:
		* CreatedBy:
		* ModifiedOn:
		* Modified By:
		* Return:
	*/

	// public function removeAllItemsFromCart($table_name = "shopping_cart", $user_id) {

	// 	if ($user_id > 0) {

	// 		$this->db->where('user_id', $user_id);
	// 		$this->db->delete($table_name);

	// 		return true;
	// 	}
	// }

	/*
		* Function: removeItemsFromCart
		* Parameters:
		* Purpose:
		* CreatedOn:
		* CreatedBy:
		* ModifiedOn:
		* Modified By:
		* Return:
	*/

	// public function removeItemsFromCart($table_name = "shopping_cart", $cart_id, $member_id) {

	// 	if ($cart_id > 0) {

	// 		$this->db->where('id', $cart_id);
	// 		$this->db->where('member_id', $member_id);
	// 		$this->db->delete($table_name);

	// 		return true;
	// 	}
	// }

	/*
		* Function: clearBookingTime
		* Parameters:
		* Purpose:
		* CreatedOn:
		* CreatedBy:
		* ModifiedOn:
		* Modified By:
		* Return:
	*/
	public function clearBookingTime($table_name, $user_id) {

		if ($user_id > 0) {

			$bookingArray = array('booking_date' => '', 'booking_time' => '', 'modified_on' => date('Y-m-d h:i:s'));
			$this->db->where('user_id', $user_id);
			$this->db->update($table_name, $bookingArray);

			return true;
		}
	}

	/*
		* Function: registerFamilyMembers
		* Parameters:
		* Purpose:
		* CreatedOn:
		* CreatedBy:
		* ModifiedOn:
		* Modified By:
		* Return:
	*/

	public function registerFamilyMembers($post) {

		$membersArray = array();
		$mobile_number = $post['mobile_number'];
		$member_id = @$post['member_id'];

		if ($member_id > 0) {

			$membersArray = array('full_name' => $post['full_name'], 'relation' => $post['relation'], 'gender' => $post['gender'], 'dob' => $post['dob'], 'age' => $post['age'], 'status' => '1', 'is_deleted' => '0', 'modified_on' => date('Y-m-d h:i:s'));

			$this->db->where('member_id', $member_id);
			$this->db->update('family_member', $membersArray);
			$response = $member_id;

		} else {

			$membersArray = array('user_id' => $post['user_id'], 'full_name' => $post['full_name'], 'relation' => $post['relation'], 'mobile_number' => $post['mobile_number'], 'gender' => $post['gender'], 'dob' => $post['dob'], 'age' => $post['age'], 'status' => '1', 'is_deleted' => '0', 'createdon' => date('Y-m-d h:i:s'), 'modified_on' => date('Y-m-d h:i:s'));

			// Check Mobile Number
			$this->db->where('mobile_number', $mobile_number);
			$this->db->where('status', '1');
			$query = $this->db->get('family_member');
			$resp = $query->row_array();

			if (empty($resp)) {

				$this->db->insert('family_member', $membersArray);
				$response = $this->db->insert_id();

			} else {

				$response = '101';

			}
		}
		return $response;
	}

	/*
		* Function: getAllFamilyMembers
		* Parameters:
		* Purpose:
		* CreatedOn:
		* CreatedBy:
		* ModifiedOn:
		* Modified By:
		* Return:
	*/
	public function getAllFamilyMembers($user_id) {

		if ($user_id > 0) {

			// Check Mobile Number
			$this->db->where('user_id', $user_id);
			$this->db->where('status', '1');
			$query = $this->db->get('family_member');
			$result = $query->result_array();
			if (empty($result)) {

				return false;

			} else {

				return $result;

			}

		}

	}

	/*
		* Function: getPublicDetails
		* Parameters:
		* Purpose:
		* CreatedOn:
		* CreatedBy:
		* ModifiedOn:
		* Modified By:
		* Return:
	*/
	public function getPublicDetails($table_name, $field, $value, $return_type = '') {
		if (!empty($field) && $value > 0) {

			$this->db->where($field, $value);
			$query = $this->db->get($table_name);
			if ($return_type == "array") {
				return $query->result_array();
			} else {
				return $query->row_array();
			}

		} else {

			return '101';

		}
	}

	/*
		* Function: getDoctors
		* Parameters:
		* Purpose:
		* CreatedOn:
		* CreatedBy:
		* ModifiedOn:
		* Modified By:
		* Return:
	*/
	public function getDoctors() {

		$this->db->where('is_deleted', '0');
		$query = $this->db->get('doctors');
		$result = $query->result_array();
		if (empty($result)) {

			return false;

		}
		return $result;
	}

	/*
		* fruntion : countNumRows
	*/

	public function countNumRows($table_name, $field, $value) {
		return $this->db->where($field, $value)->where('status', '1')->count_all_results($table_name);
	}

	/*
		* Function : applyForNewCourse
	*/
	public function applyForNewCourse($post) {

		if (!empty($post)) {

			$membersArray = array('course_id' => $post['course_id'], 'full_name' => $post['full_name'], 'email_id' => $post['email_id'], 'contact_no' => $post['mobile_number'], 'message' => $post['remarks'], 'status' => '1', 'is_deleted' => '0', 'enquiry_createdon' => date('Y-m-d h:i:s'));

			// Check Mobile Number
			$this->db->where('contact_no', $post['mobile_number']);
			$this->db->where('course_id', $post['course_id']);
			$this->db->where('status', '1');
			$query = $this->db->get('courses_enquiry');
			$resp = $query->row_array();

			if (empty($resp)) {

				$this->db->insert('courses_enquiry', $membersArray);
				$response = $this->db->insert_id();

			} else {

				$response = 'ERROR';

			}

			return $response;
		}
	}

	/*
		* function : applyCuponCode
	*/
	public function applyCuponCode($post) {

		if (!empty($post)) {

			$this->db->where('coupon_code', $post['coupon_code']);
			$this->db->where('user_id', $post['user_id']);
			$this->db->where('cupon_status', '1');
			$query = $this->db->get('coupon_master');
			$resp = $query->row_array();

			if (empty($resp)) {

				$response = 'ERROR';

			} else {

				$response = $resp['coupon_amount'];

			}
		}

		return $response;
	}

	/*
		* function : addNewAddress
	*/
	public function addNewAddress($post) {
		if (!empty($post)) {

			$this->db->where('package_id', $post['package_id']);
			$this->db->where('user_id', $post['user_id']);
			$this->db->where('is_deleted', '0');
			$this->db->where('address_status', '1');
			$query = $this->db->get('user_booking');
			$resp = $query->row_array();
			$bookingArray = array();
			$resp = array();

			if (empty($resp)) {

				$bookingArray = array('user_id' => $post['user_id'], 'locality' => $post['locality'], 'house_no' => $post['house_no'],
					'landmark' => $post['landmark'], 'booking_remark' => $post['booking_remark'], 'booking_date' => $post['booking_date'],
					'package_id' => $post['package_id'], 'member_id' => $post['member_id'], 'booking_time' => $post['booking_time'], 'address_status' => '1',
					'is_deleted' => '0', 'created_on' => date('Y-m-d h:i:s'), 'modified_on' => date('Y-m-d h:i:s'));

				$this->db->insert('user_booking', $bookingArray);
				$response = $this->db->insert_id();

			} else {

				$booking_id = $resp['booking_id'];

				$bookingArray = array('user_id' => $post['user_id'], 'locality' => $post['locality'], 'house_no' => $post['house_no'],
					'landmark' => $post['landmark'], 'booking_remark' => $post['booking_remark'], 'booking_date' => $post['booking_date'],
					'booking_time' => $post['booking_time'], 'package_id' => $post['package_id'], 'member_id' => $post['member_id'],
					'address_status' => '1', 'is_deleted' => '0', 'modified_on' => date('Y-m-d h:i:s'));

				$this->db->where('booking_id', $booking_id);
				$this->db->update('user_booking', $bookingArray);
				$response = $booking_id;

			}
		}

		return $response;
	}

	/*
		* Function: getPublicDetails
	*/
	public function getBookkingAddress($table_name, $field, $value) {
		if (!empty($field) && $value > 0) {

			$this->db->where($field, $value);
			$this->db->where('address_status', '1');
			$this->db->where('is_deleted', '0');
			$this->db->order_by('booking_id', 'desc');
			$query = $this->db->get($table_name);
			return $query->row_array();

		} else {

			return '101';

		}
	}

	/*
		* Empty cart items of current users
	*/

	public function updateUserInfo($post) {

		$id = $post['user_id'];
		$height = serialize(array('feet' => $post['height_feet'], 'inches' => $post['height_inches']));
		if ($post['email']) {

			$userArray = array('name' => $post['full_name'], 'email' => $post['email'], 'blood_group' => $post['bloodgroup'], 'age' => $post['age'], 'company' => $post['company_name'], 'health_insaurance' => $post['health_inc_company'], 'weight' => $post['weight'], 'height' => $height, 'waist' => $post['waist'], 'gender' => $post['gender']);

			//family members array_items
			$family_member = array('full_name' => $post['full_name'], 'email_id' => $post['email']);

		} else {

			$userArray = array('name' => $post['full_name'], 'blood_group' => $post['bloodgroup'], 'age' => $post['age'], 'company' => $post['company_name'], 'health_insaurance' => $post['health_inc_company'], 'weight' => $post['weight'], 'height' => $height, 'waist' => $post['waist'], 'gender' => $post['gender']);

			//family members array_items
			$family_member = array('full_name' => $post['full_name']);

		}

		$this->db->where('id', $id);
		$resp = $this->db->update('users_public', $userArray);

		//Update Family_member table records
		$this->db->where('member_id', $post['member_id']);
		$this->db->update('family_member', $family_member);

		if ($resp) {
			$details = $this->getPublicDetails('users_public', 'id', $id);
		} else {
			$details = 'Invalid';
		}

		return $response = $details;

	}

	/*
		* userinfo update
	*/

	public function updateUser($post) {

		$id = $post['user_id'];
		$num_exist = $this->if_exist($post['phone'], $id);
		$email_exist = $this->if_exist($post['email'], $id);
		//print_r($email_exist['login_src']);die;
		if ((empty($num_exist)) || (empty($email_exist))) {
			$userArray = array('name' => $post['name'], 'email' => $post['email'], 'phone' => $post['phone']);

			//family members array_items
			$family_member = array('full_name' => $post['name'], 'email_id' => $post['email'], 'mobile_number' => $post['phone']);

			$this->db->where('id', $id);
			$resp = $this->db->update('users_public', $userArray);

			//Update Family_member table records
			$this->db->where('member_id', $post['member_id']);
			$this->db->update('family_member', $family_member);

			if ($resp) {
				$details = $this->getPublicDetails('users_public', 'id', $id);
			} else {
				$details = 'Invalid';
			}
			return $response = $details;
		} else {
			echo $response = 'already used information!';
		}

	}
	/*
		* id email or number already exist
	*/

	public function if_exist($value, $id) {

		$this->db->where("(phone='$value' or email='$value')");
		$this->db->where('id!=', $id);
		if (!$query = $this->db->select('login_src')->get('users_public')) {
			print_r($this->db->error());die;
			log_message('error', print_r($this->db->error(), true));
		}
		//echo $this->db->last_query; die;
		$response = $query->row_array();
		return $response;
	}

	/*
		* Function: addNewUserAddress
		* Params:
		* return : last inserted Id
	*/
	public function addNewUserAddress($post) {

		$bookingArray = array();
		$bookingArray = array('user_id' => $post['user_id'], 'full_name' => $post['full_name'], 'house_no' => $post['house_no'], 'address' => $post['address'], 'city' => $post['city'], 'state' => $post['state'], 'pincode' => $post['pincode'], 'status' => '1', 'is_deleted' => '0', 'created_on' => date('Y-m-d h:i:s'), 'modified_on' => date('Y-m-d h:i:s'));

		if (!empty($bookingArray)) {

			$this->db->insert('user_address_master', $bookingArray);
			$response = $this->db->insert_id();

			return $response;
		}

	}

	/*
		* Function: editUserAddress
		* Params:
		* return : last inserted Id
	*/
	public function editUserAddress($post) {

		$bookingArray = array();
		$address_id = $post['address_key'];
		$bookingArray = array('full_name' => $post['full_name'], 'house_no' => $post['house_no'], 'address' => $post['address'], 'city' => $post['city'], 'state' => $post['state'], 'pincode' => $post['pincode'], 'modified_on' => date('Y-m-d h:i:s'));

		if (!empty($bookingArray)) {

			$this->db->where('address_id', $address_id);
			$this->db->update('user_address_master', $bookingArray);
			$response = $address_id;

			return $response;
		}

	}

	/*
		* Function: editUserProfileImage
		* Params:
		* return : user_id
	*/
	public function editUserProfileImage($profile_image, $user_id) {

		$updateArray = array();
		$updateArray = array('profile_image' => $profile_image, 'modified_on' => date('Y-m-d H:i:s'));

		if (!empty($updateArray)) {
			$this->db->where('id', $user_id);
			$this->db->update('users_public', $updateArray);
			return $response;
		}

	}

	/*
		* Function getOrderDetails
		* return : order summary
	*/

	public function getOrderDetails($user_id) {

		if ($user_id > 0) {
			$this->db->select('orders.*,orders_clients.first_name, orders_clients.last_name, orders_clients.email, orders_clients.phone, orders_clients.address, orders_clients.city, orders_clients.post_code');
			$this->db->join('orders_clients', 'orders_clients.for_id = orders.id', 'left');
			//$this->db->where('is_deleted', 0);
			$this->db->where('orders.user_id', $user_id);
			$this->db->where('orders.order_status>1');
			$this->db->order_by('orders.id', 'desc');
			$query = $this->db->get('orders');

			return $query->result_array();
		}
	}

	/*
		* Function:getReport
		* Return:user's reports
		* Author:
	*/

	public function getReport($id) {
		if ($id > 0) {
			$this->db->select('order_id, report_name, test_package_name, booking_date, member_id');
			$this->db->where('user_id', $id);
			$this->db->order_by('report_id', 'desc');
			if (!$query = $this->db->get('user_report')) {
				print_r($this->db->error());die;
				log_message('error', print_r($this->db->error(), true));
			}
			//echo $this->db->last_query();die;
			$results = $query->result_array();

			return $results;
		}
	}

	/*
		* Function getOrderDetails
		* return : order summary
	*/

	public function getCurrentOrderDetails($order_id) {

		if ($order_id > 0) {

			$this->db->select('orders.*,orders_clients.first_name, orders_clients.last_name, orders_clients.email, orders_clients.phone, orders_clients.address, orders_clients.city, orders_clients.post_code, orders_clients.booking_date, orders_clients.booking_time');
			$this->db->join('orders_clients', 'orders_clients.for_id = orders.id', 'left');
			$this->db->where('orders.order_id', $order_id);
			$query = $this->db->get('orders');

			return $query->row_array();

		}
	}

	/*
		* Function: getDoctorsProfile
		* Parameters:
		* Purpose:
		* CreatedOn:
		* CreatedBy:
		* ModifiedOn:
		* Modified By:
		* Return:
	*/
	// public function getDoctorsProfile($tbl_name = 'doctors', $field, $value) {

	// 	if (!empty($field) && $value > 0) {
	// 		$this->db->where($field, $value);
	// 	}

	// 	$this->db->where('is_deleted', '0');

	// 	$query = $this->db->get('doctors');
	// 	$result = $query->row_array();
	// 	if (empty($result)) {

	// 		return false;

	// 	}
	// 	return $result;
	// }
	/*
		* Function: getCurrentJobs
		* Parameters:
		* Purpose:
		* CreatedOn:
		* CreatedBy:
		* ModifiedOn:
		* Modified By:
		* Return:
	*/
	// public function getCurrentJobs($tbl_name = 'careers', $field, $value) {

	// 	if (!empty($field) && $value > 0) {
	// 		$this->db->where($field, $value);
	// 	}

	// 	$this->db->where('status', '1');
	// 	$this->db->where('isdeleted', '0');

	// 	$query = $this->db->get($tbl_name);
	// 	$result = $query->row_array();
	// 	if (empty($result)) {

	// 		return false;

	// 	}
	// 	return $result;
	// }

	/*
		* function : emailsubscribedNow
		* return   : Last_inserted_id
	*/

	public function emailsubscribedNow($post) {

		$subscribedArray = array();
		$this->db->where('email', $post['email_id']);
		$query = $this->db->get($tbl_name = 'subscribed');
		$result = $query->row_array();

		if (empty($result)) {

			$subscribedArray = array('email' => $post['email_id'], 'browser' => $this->ExactBrowserName(), 'ip' => $_SERVER['SERVER_ADDR'], 'time' => time());

			if (!empty($subscribedArray)) {

				$this->db->insert('subscribed', $subscribedArray);
				$response = $this->db->insert_id();

				return $response;
			}
		} else {
			return 'Already subscribed';
		}
	}

	/*
		* Function: ExactBrowserName
		* return : browser name
	*/
	function ExactBrowserName() {

		$ExactBrowserNameUA = $_SERVER['HTTP_USER_AGENT'];

		if (strpos(strtolower($ExactBrowserNameUA), "safari/") and strpos(strtolower($ExactBrowserNameUA), "opr/")) {
			// OPERA
			$ExactBrowserNameBR = "Opera";
		} elseIf (strpos(strtolower($ExactBrowserNameUA), "safari/") and strpos(strtolower($ExactBrowserNameUA), "chrome/")) {
			// CHROME
			$ExactBrowserNameBR = "Chrome";
		} elseIf (strpos(strtolower($ExactBrowserNameUA), "msie")) {
			// INTERNET EXPLORER
			$ExactBrowserNameBR = "Internet Explorer";
		} elseIf (strpos(strtolower($ExactBrowserNameUA), "firefox/")) {
			// FIREFOX
			$ExactBrowserNameBR = "Firefox";
		} elseIf (strpos(strtolower($ExactBrowserNameUA), "safari/") and strpos(strtolower($ExactBrowserNameUA), "opr/") == false and strpos(strtolower($ExactBrowserNameUA), "chrome/") == false) {
			// SAFARI
			$ExactBrowserNameBR = "Safari";
		} else {
			// OUT OF DATA
			$ExactBrowserNameBR = "OUT OF DATA";
		};

		return $ExactBrowserNameBR;
	}

	/*
		* Function : getOTP
	*/
	function getOTP($size = 6) {
		$random_number = '';
		$count = 0;
		while ($count < $size) {
			$random_digit = mt_rand(0, 9);
			$random_number .= $random_digit;
			$count++;
		}
		return $random_number;
	}

	function sendSMS($mobile_number, $sms_content) {

		$feedid = 363901;
		$senderid = urlencode('shardacom_trans');
		$username = "9015129267";
		$password = "wgtpt";
		$api_url = 'http://bulkpush.mytoday.com/BulkSms/SingleMsgApi';

		if (strlen($mobile_number) >= 10) {
			$params_url = '';
			//send OTP to user
			$params_url = 'feedid=' . $feedid . '&senderid=' . $senderid . '&username=' . $username . '&password=' . $password . '&To=' . $mobile_number . '&Text=' . $sms_content;
			$otpresponse = $this->sendOTP($api_url, $params_url); // Send OTP

			return $otpresponse;

		}
	}

	function sendOTP($url, $params_url) {

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $params_url);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		// DO NOT RETURN HTTP HEADERS
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		// RETURN THE CONTENTS OF THE CALL
		$return_val = curl_exec($ch);

		$response = true;
		//Print error if any
		if (curl_errno($ch)) {
			$response = 'error:' . curl_error($ch);
		}
		curl_close($ch);

		return $response;
	}
	/*
		* function: getValueStore
	*/
	public function getValueStore($key, $value) {

		$query = $this->db->select('id, thekey, value')->get('value_store');
		$results = array();
		foreach ($query->result_array() as $value) {
			$results[$value['thekey']] = $value['value'];
		}
		return $results;

	}
/*
 * saveTransactionDetails
 */

	function saveTransactionDetails($post) {
		if (!empty($post)) {
			$transactionsArray = array();
			$order_id = $post['ORDERID'];
			$transactionsArray = array('order_id' => $post['ORDERID'],
				'mid' => $post['MID'],
				'transaction_id' => $post['TXNID'],
				'transaction_amount' => $post['TXNAMOUNT'],
				'payment_mode' => $post['PAYMENTMODE'],
				'currency' => $post['CURRENCY'],
				'transaction_date' => $post['TXNDATE'],
				'transaction_status' => $post['STATUS'],
				'response_code' => $post['RESPCODE'],
				'response_msg' => $post['RESPMSG'],
				'gateway_name' => $post['GATEWAYNAME'],
				'bank_transaction_id' => $post['BANKTXNID'],
				'bank_name' => $post['BANKNAME'],
				'checksumhash' => $post['CHECKSUMHASH'],
				'status' => '1',
				'createdon' => date('Y-m-d h:i:s'),
				'modifiedon' => date('Y-m-d h:i:s'),
				'is_deleted' => '0',
				'ip_address' => $_SERVER['SERVER_ADDR'],
			);

			if (!empty($transactionsArray)) {

				$this->db->insert('payment_transactions', $transactionsArray);
				$response = $this->db->insert_id();
			}

			// Update records on orders table
			$STATUS = $post['STATUS'] == 'TXN_SUCCESS' ? '1' : '0';
			$ORDER_STATUS = $post['STATUS'] == 'TXN_SUCCESS' ? '1' : '0';
			$transaction_id = $post['TXNID'];
			$ordersArray = array();
			$ordersArray = array('transaction_status' => $STATUS,
				'order_status' => $ORDER_STATUS,
				'transaction_id' => $post['TXNID'],
			);
			if (!empty($ordersArray)) {
				$this->db->where('order_id', $order_id);
				$this->db->update('orders', $ordersArray);
			}

			return $response;
		}
	}
	function saveOrderstatus($order_id) {
		$ordersArray = array();
		$ordersArray = array('order_status' => '2',
		);
		if (!empty($ordersArray)) {
			$this->db->where('order_id', $order_id);
			$this->db->update('orders', $ordersArray);
		}

		return $response;
	}

	/*
		* setProductSearch
	*/

	function setProductsSearch($search_array, $search_by) {
		if ($search_array['search_in_title']) {
			$data = array();
			$data = array('search_string' => $search_array['search_in_title'],
				'search_by' => $search_by);
			$this->db->insert('product_search', $data);

		}

	}

	/*
		* Function getTestimonials
	*/

	public function getTestimonials($limit = '10') {

		$this->db->select('id,name, image, description, display');
		$this->db->where('display', '1');
		$this->db->order_by('id', 'asc');
		if ($limit > 0) {
			$this->db->limit($limit);
		}

		$query = $this->db->get('testimonials');
		$results = $query->result_array();

		return $results;

	}

	/*
		*Function:getHospitalsList
		*Author:
	*/

	public function getHospitalsList($limit = '10') {

		$this->db->select('id,hospital_name, hospital_url');
		$this->db->where('is_deleted', '0');
		$this->db->where('status', '1');
		$this->db->order_by('id', 'desc');
		if ($limit > 0) {
			$this->db->limit($limit);
		}

		$query = $this->db->get('tbl_hospital_master');
		$results = $query->result_array();

		return $results;

	}

	/*
		* Function: getAllRecords
		* Parameters:
		* Purpose:
		* CreatedOn:
		* CreatedBy:
		* ModifiedOn:
		* Modified By:
		* Return:
	*/
	public function getAllRecords($tbl_name, $col = ' * ', $condition = null, $order_by = NULL, $limit = NULL, $start = NULL) {
		$this->db->select($col);
		$this->db->where('is_deleted', '0');
		$this->db->where('status', '1');
		if (!empty($condition)) {
			foreach ($condition as $key => $val) {
				$this->db->where($key, $val);
			}
		}

		if (!empty($order_by)) {
			foreach ($order_by as $key => $val) {
				$this->db->order_by($key, $val);
			}
		}
		if ($limit !== null && $start !== null) {
			$query = $this->db->get($tbl_name, $limit, $start);
		} else {
			$query = $this->db->get($tbl_name);
		}
		//echo $this->db->last_query(); die;
		return $query->result_array();
	}
	public function saveinfo($tbl_name,$post) {
		$this->db->insert($tbl_name, $post);
		return $this->db->insert_id();
	}

	public function updateinfo($tbl_name, $post, $field, $value) {
		$this->db->where($field, $value);
		if (!$this->db->update($tbl_name, $post)) {
			log_message('error', print_r($this->db->error(), true));
		}
	}
}
