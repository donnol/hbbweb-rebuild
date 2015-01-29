<?php
require_once(dirname(__FILE__).'/../common/db.php');
class User{
	private $hasSessionStart = false;
	private $db;
	public function __construct(){
		$this->db = new DB();
	}
	private function beginSession(){
		if( $this->hasSessionStart == false )
			session_start();
		$this->hasSessionStart = true;
	}
	public function add($name,$password,$tel,$addr,$cert){
		$re = $this->db->select('t_user', array('name'=>$name));
		if($re['code'] == 0 && count($re['data']) != 0){
				return array(
					'code'=>1,
					'msg'=>'name is already exists',
					'data'=>''
				);
				}
		else{
		return $this->db->insert('t_user',array(
			'name'=>$name,
			'pwd'=>sha1($password),
			'tel'=>$tel,
			'addr'=>$addr,
			'cert'=>$cert,
		));
		}
	}
	public function del($id){
		return $this->db->delete('t_user',array(
			'id'=>$id
		));
	}
	public function get(){
		return @$this->db->select('t_user');
	}
	public function getone($id){
			return $this->db->select('t_user', array('id'=>$id,));
			}
	public function listname(){
			return $this->db->listname('t_user');	
			}
	public function isLogin(){
		$this->beginSession();
		if (!isset ($_SESSION['shili']))
			return array(
				'code'=>1,
				'msg'=>'has not login',
				'data'=>''
			);
		return array(
			'code'=>0,
			'msg'=>'',
			'data'=>$_SESSION['shili']
		);
	}
	public function login($name,$password){
		$this->beginSession();
		$result = $this->db->select('t_user',array(
			'name'=>$name,
			'pwd'=>sha1($password)
		));
		if( $result['code'] != 0 )
			return $result;
		
		$users = $result['data'];
		if( count($users) == 0 )
			return array(
				'code'=>1,
				'msg'=>'name or password error',
				'data'=>''
			);
		
		$_SESSION['shili'] = $name;
		return array(
			'code'=>0,
			'msg'=>'',
			'data'=>''
		);
	}
	
	public function update($name,$tel,$addr,$cert,$id){
		$re = $this->db->update('t_user', array('name'=>$name));
		if($re['code'] == 0 && count($re['data'] != 0)){
					return array(
						'code'=>1,
						'msg'=>'name is already exist.',
						'data'=>''
					);
				}
		else{
		return $this->db->update('t_user', array(
			'name'=>$name,
			'tel'=>$tel,
			'addr'=>$addr,
			'cert'=>$cert,
		), array(
			'id'=>$id,
		));
		}
	}
	
	public function htmlEncode($val){
		return $this->db->security->htmlEncode($val);
	}
	
	public function logout(){
		$this->beginSession();
		session_destroy();
	}
};
?>
