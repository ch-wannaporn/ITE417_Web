<?php

class Cart_model extends CI_Model {

	public function __construct()
	{

	}

	public function getProducts($keyword='', $category_name='')
	{
		if(strlen($keyword) > 0){
            $this->db->like('product_name', $keyword, 'both');
        }

        if(strlen($category_name) > 0){
        	$this->db->like('category_name', $category_name, 'both');
        }

		$this->db->select('*');
		$this->db->from('product');
		$this->db->join('category', 'category.category_id = product.category_id');
		$this->db->order_by('product_id');

		$query = $this->db->get();
		return $query->result();
	}

	public function getaUser($Email, $Password)
	{
		$this->db->where('email', $Email);
		$this->db->where('password', $Password);

		$query = $this->db->get('user');
		return $query->row(0);
	}

	public function getCartbyID($id)
	{
		$this->db->select('*');
		$this->db->where('user_id', $id);
		$this->db->order_by('product_id');

		$query = $this->db->get('cart_product_sum');
		return $query->result();
	}

	public function getCartProduct($user_id, $product_id)
	{
		$this->db->select('*');
		$this->db->where('user_id', $user_id);
		$this->db->where('product_id', $product_id);

		$query = $this->db->get('cart_product_sum');
		return $query->row(0);
	}

	public function getLastOrderID($id)
	{
		$this->db->where('user_id', $id);
		$this->db->order_by('order_date', 'DESC');

		$query = $this->db->get('order');
		return $query->row(0);
	}

	public function getOrderbyID($id)
	{
		$this->db->select('*');
		$this->db->where('user_id', $id);
		$this->db->order_by('order_date', 'DESC');

		$query = $this->db->get('order');
		return $query->result();
	}

	public function getOrderItem($order_id)
	{
		$this->db->where('order_id', $order_id);
		$this->db->order_by('product_id');

		$query = $this->db->get('order_view_his');
		return $query->result();
	}
}