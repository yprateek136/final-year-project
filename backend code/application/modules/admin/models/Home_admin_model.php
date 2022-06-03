<?php

class Home_admin_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function loginCheck($values) {

		$this->db->select("users.*, assign_role.module_ids");
		$arr = array(
			'username' => $values['username'],
			'password' => md5($values['password']),
			'users.status' => '1',
			'users.is_deleted' => '0',
			'assign_role.is_deleted' => '0',
		);
		$this->db->where($arr);
		$this->db->from('users');
		$this->db->join('assign_role', 'assign_role.role_id = users.role_id');
		$result = $this->db->get();

		$resultArray = $result->row_array();
		if ($result->num_rows() > 0) {
			$this->db->where('id', $resultArray['id']);
			$this->db->update('users', array('last_login' => time()));
		}
		return $resultArray;
	}

	/*
		     * Some statistics methods for home page of
		     * administration
		     * START
	*/
	function getModuleList($assignModule) {

		$this->db->select('id, module_name,display_icon, display_name');
		$this->db->where('status', '1');
		$this->db->where('is_deleted', '0');
		if (trim($assignModule) != 'ALL') {

			$assignArray = explode(",", $assignModule);
			$whereArray = array();
			foreach (array_filter($assignArray) as $assign) {
				if ($assign != '') {
					$whereArray[] = " FIND_IN_SET('" . $assign . "', id) ";
				}
			}

			if (!empty($whereArray)) {
				$where = implode(" OR ", $whereArray);
			}

			$this->db->where($where);
		}

		$queryResult = $this->db->get('module_list');
		$results = array();
		foreach ($queryResult->result_array() as $value) {
			$results[$value['module_name']] = $value['display_name'] . '+' . $value['display_icon'];
		}

		return $results;
	}

	/*
		     * Some statistics methods for home page of
		     * administration
		     * START
	*/

	public function countLowQuantityProducts() {
		//$this->db->where('requestedOn =', date('Y-m-d'));
		//return $this->db->count_all_results('health_advisor');
	}

	public function getHealthAdvisorInstantly($limit = 20) {
		/* $yesterday = strtotime('-1 day', time());
					$this->db->order_by('modified_on', 'desc');
			        $this->db->where('verify_status', '1');
			        $this->db->where('is_deleted', '0');
					$this->db->limit($limit);
					$queryResult = $this->db->get('health_advisor');
			        return $queryResult->result_array();
		*/
	}

	public function countTotalLeads() {
		$yesterday = strtotime('-1 day', time());
		$this->db->where('time > ', $yesterday);
		return $this->db->count_all_results('subscribed');
	}

	public function newInquiryCount() {
		$this->db->where('status ', '1');
		$this->db->where('is_deleted ', '0');
		return $this->db->count_all_results('su_enquiry');
	}

	public function lastSubscribedEmailsCount() {
		$yesterday = strtotime('-1 day', time());
		$this->db->where('time > ', $yesterday);
		return $this->db->count_all_results('subscribed');
	}

	public function getMostSoldProducts($limit = 10) {
		$this->db->select('url, procurement');
		$this->db->order_by('procurement', 'desc');
		$this->db->where('procurement >', 0);
		$this->db->limit($limit);
		$queryResult = $this->db->get('products');
		return $queryResult->result_array();
	}

	public function getReferralOrders() {

		$this->db->select('count(id) as num, clean_referrer as referrer');
		$this->db->group_by('clean_referrer');
		$queryResult = $this->db->get('orders');
		return $queryResult->result_array();
	}

	public function getOrdersByPaymentType($limit = 10) {
		$this->db->select('count(id) as num, payment_type');
		$this->db->group_by('payment_type');
		$this->db->limit($limit);
		$queryResult = $this->db->get('orders');
		$response = $queryResult->result_array();

		return $response;
	}

	public function getOrdersByMonth() {
		$result = $this->db->query("SELECT YEAR(order_date) as year, MONTH(order_date) as month, COUNT(id) as num FROM orders GROUP BY YEAR(order_date), MONTH(order_date) ASC");
		$result = $result->result_array();
		$orders = array();
		$years = array();
		foreach ($result as $res) {
			if (!isset($orders[$res['year']])) {
				for ($i = 1; $i <= 12; $i++) {
					$orders[$res['year']][$i] = 0;
				}
			}
			$years[] = $res['year'];
			$orders[$res['year']][$res['month']] = $res['num'];
		}

		return array(
			'years' => array_unique($years),
			'orders' => $orders,
		);
	}

	/*
		     * Some statistics methods for home page of
		     * administration
		     * END
	*/

	public function setValueStore($key, $value) {
		// $this->db->where('thekey', $key);
		// $query = $this->db->get('value_store');
		// if ($query->num_rows() > 0) {
		//     $this->db->where('thekey', $key);
		//     if (!$this->db->update('value_store', array('value' => $value))) {
		//         log_message('error', print_r($this->db->error(), true));
		//         show_error(lang('database_error'));
		//     }
		// } else {
		//     if (!$this->db->insert('value_store', array('value' => $value, 'thekey' => $key))) {
		//         log_message('error', print_r($this->db->error(), true));
		//         show_error(lang('database_error'));
		//     }
		// }
	}

	public function changePass($new_pass, $username) {
		$this->db->where('username', $username);
		$result = $this->db->update('users', array('password' => md5($new_pass)));
		return $result;
	}

	public function getValueStore($key) {
		// $query = $this->db->query("SELECT value FROM value_store WHERE thekey = '$key'");
		// $img = $query->row_array();
		// return $img['value'];
	}

	public function newOrdersCheck() {
		return 0;
	}

	public function setCookieLaw($post) {
		$query = $this->db->query('SELECT id FROM cookie_law');
		if ($query->num_rows() == 0) {
			$update = false;
		} else {
			$result = $query->row_array();
			$update = $result['id'];
		}

		if ($update === false) {
			$this->db->trans_begin();
			if (!$this->db->insert('cookie_law', array(
				'link' => $post['link'],
				'theme' => $post['theme'],
				'visibility' => $post['visibility'],
			))) {
				log_message('error', print_r($this->db->error(), true));
			}
			$for_id = $this->db->insert_id();
			$i = 0;
			foreach ($post['translations'] as $translate) {
				if (!$this->db->insert('cookie_law_translations', array(
					'message' => htmlspecialchars($post['message'][$i]),
					'button_text' => htmlspecialchars($post['button_text'][$i]),
					'learn_more' => htmlspecialchars($post['learn_more'][$i]),
					'abbr' => $translate,
					'for_id' => $for_id,
				))) {
					log_message('error', print_r($this->db->error(), true));
				}
				$i++;
			}
			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				show_error(lang('database_error'));
			} else {
				$this->db->trans_commit();
			}
		} else {
			$this->db->trans_begin();
			$this->db->where('id', $update);
			if (!$this->db->update('cookie_law', array(
				'link' => $post['link'],
				'theme' => $post['theme'],
				'visibility' => $post['visibility'],
			))) {
				log_message('error', print_r($this->db->error(), true));
			}
			$i = 0;
			foreach ($post['translations'] as $translate) {
				$this->db->where('for_id', $update);
				$this->db->where('abbr', $translate);
				if (!$this->db->update('cookie_law_translations', array(
					'message' => htmlspecialchars($post['message'][$i]),
					'button_text' => htmlspecialchars($post['button_text'][$i]),
					'learn_more' => htmlspecialchars($post['learn_more'][$i]),
				))) {
					log_message('error', print_r($this->db->error(), true));
				}
				$i++;
			}
			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				show_error(lang('database_error'));
			} else {
				$this->db->trans_commit();
			}
		}
	}

	public function getCookieLaw() {
		$arr = array('cookieInfo' => null, 'cookieTranslate' => null);
		$query = $this->db->query('SELECT * FROM cookie_law');
		if ($query->num_rows() > 0) {
			$arr['cookieInfo'] = $query->row_array();
			$query = $this->db->query('SELECT * FROM cookie_law_translations');
			$arrTrans = $query->result_array();
			foreach ($arrTrans as $trans) {
				$arr['cookieTranslate'][$trans['abbr']] = array(
					'message' => $trans['message'],
					'button_text' => $trans['button_text'],
					'learn_more' => $trans['learn_more'],
				);
			}
		}
		return $arr;
	}

}
