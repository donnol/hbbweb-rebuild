<?php
require_once(dirname(__FILE__).'/../common/db.php');
class Book{
	private $db;
	public function __construct(){
		$this->db = new DB();
	}
	public function get(){
		return $this->db->select('t_book',array());
	}
	public function add($name,$category,$page,$content){
		return $this->db->insert('t_book',array(
			'name'=>$name,
			'category'=>$category,
			'page'=>$page,
			'content'=>$content,
		));
	}
	public function del($id){
		return $this->db->delete('t_book',array(
			'id'=>$id,
		));
	}
	
	public function update($name,$category,$page,$content, $id){
		return $this->db->update('t_book',array(
			'name'=>$name,
			'category'=>$category,
			'page'=>$page,
			'content'=>$content,			
		), array(
			'id'=>$id,
		));
	}
	
	public function htmlEncode($val){
		return $this->db->security->htmlEncode($val);
	}
};
?>