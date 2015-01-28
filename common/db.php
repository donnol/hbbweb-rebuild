<?php
require_once(dirname(__FILE__).'/security.php');
class DB{

	var $dbconnect = false;
	var $security;
	public function __construct(){
		$this->security = new Security();
	}
	private function connect(){
		if( $this->dbconnect != false )
			return array(
				'code'=>0,
				'msg'=>'',
				'data'=>$this->dbconnect//在使用mysqli_connect链接数据库之前先看看是否已连接，已连接则返回dbconnect
			);
		$this->dbconnect = mysqli_connect("localhost:3306", "root","jd123","book");
		if( $this->dbconnect == false )//链接失败
			return array(
				'code'=>1,
				'msg'=>'连接数据库失败',
				'data'=>''
			);
		return array(//链接成功
				'code'=>0,
				'msg'=>'',
				'data'=>$this->dbconnect
			);
	}

	public function select($table,$data){
		$result = $this->connect();//建立链接，返回数组
		if( $result['code'] != 0 )//如果条件成立，无链接
			return $result;
		$db = $result['data'];//数据库指针
		
		$sql = 'select * from '.$this->security->sqlEncode($table);//建立sql语句，参数table是表名，对其进行转义
		if( count($data) != 0 ){//参数data属于where条件
			$sql .= ' where ';//存在where条件
			$isFirst = true;//判断有几个条件
			foreach($data as $key=>$value ){//该条件必然有等号，等号左边为键，右边为值
				if( $isFirst == false )
					$sql .= ' and ';//条件多则and多
				$sql .= $this->security->sqlEncode($key)." = '".$this->security->sqlEncode($value)."' ";
				$isFirst = false;
			}
		}
		$query = mysqli_query($db,$sql);
		if( $query == false )
			return array(
				'code'=>1,
				'msg'=>'执行sql语句失败 '.$sql,
				'data'=>''
			);
			
		$data = array();
		while( $singleData = mysqli_fetch_array($query,MYSQL_ASSOC) ){//一次即一行
			//singleData is an array
			$data[] = $singleData;//所有数据
		}
		return array(
			'code'=>0,
			'msg'=>'',
			'data'=>$data
		);
	}

	public function insert($table,$data){
		$result = $this->connect();
		if( $result['code'] != 0 )
			return $result;
		$db = $result['data'];
		
		$sql = 'insert into '.$this->security->sqlEncode($table).'( ';
		$isFirst = true;
		foreach( $data as $key=>$value ){
			if( $isFirst == false )
				$sql .= ',';
			$sql .= $this->security->sqlEncode($key);
			$isFirst = false;
		}
		$sql .= ')values(';
		$isFirst = true;
		foreach( $data as $key=>$value ){
			if( $isFirst == false )
				$sql .= ',';
			$sql .= "'".$this->security->sqlEncode($value)."'";
			$isFirst = false;
		}
		$sql .= ')';
		$query = mysqli_query($db,$sql);
		if( $query == false )
			return array(
				'code'=>1,
				'msg'=>'执行sql语句失败 '.$sql,
				'data'=>''
			);
		
		return array(
			'code'=>0,
			'msg'=>'',
			'data'=>''
		);
	}

	public function delete($table,$data){
		$result = $this->connect();
		if( $result['code'] != 0 )
			return $result;
		$db = $result['data'];
		
		$sql = 'delete from '.$this->security->sqlEncode($table);
		if( count($data) != 0 ){
			$sql .= ' where ';
			$isFirst = true;
			foreach($data as $key=>$value ){
				if( $isFirst == false )
					$sql .= ' and ';
				$sql .= $this->security->sqlEncode($key)." = '".$this->security->sqlEncode($value)."'";
				$isFirst = false;
			}
		}
		$query = mysqli_query($db,$sql);
		if( $query == false )
			return array(
				'code'=>1,
				'msg'=>'执行sql语句失败 '.$sql,
				'data'=>''
			);
		
		return array(
			'code'=>0,
			'msg'=>'',
			'data'=>''
		);
	}
	
	public function update($table, $data, $condition){
		$result = $this->connect();
		if($result['code'] != 0)
			return $result;
		$db = $result['data'];
		
		$sql = 'update '.$this->security->sqlEncode($table).' set ';
		$isFirst = true;
		foreach( $data as $key=>$value){
			if($isFirst == false)
				$sql .= ',';
			$sql .= $this->security->sqlEncode($key)."='".$this->security->sqlEncode($value)."'";
			$isFirst = false;
		}
		if($isFirst == false){
			$isFirst = true;
		}
		$sql .= ' where ';
		foreach( $condition as $key=>$value){
			if($isFirst == false)
				$sql .= ' and ';
			$sql .= $this->security->sqlEncode($key)."='".$this->security->sqlEncode($value)."'";
			$isFirst = false;
		}
		$query = mysqli_query($db,$sql);
		if( $query == false )
			return array(
				'code'=>1,
				'msg'=>'执行sql语句失败 '.$sql,
				'data'=>''
			);
		
		return array(
			'code'=>0,
			'msg'=>'',
			'data'=>''
		);
	}

};
?>
