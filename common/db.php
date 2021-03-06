<?php
require_once(dirname(__FILE__).'/security.php');
class DB{

		var $dbconnect = false;
		var $security;
		public function __construct(){
				$this->security = new Security();
		}
		private function connect(){
				if( $this->dbconnect != false )//真真真真真真真�
						return array(
										'code'=>0,
										'msg'=>'',
										'data'=>$this->dbconnect//壓聞喘mysqli_connect全俊方象垂岻念枠心心頁倦厮銭俊��厮銭俊夸卦指dbconnect
									);
				$this->dbconnect = mysqli_connect("localhost:3306", "root","jd123","book");
				if( $this->dbconnect == false )//全俊払移
						return array(
										'code'=>1,
										'msg'=>'銭俊方象垂払移',
										'data'=>''
									);
				return array(//全俊撹孔
								'code'=>0,
								'msg'=>'',
								'data'=>$this->dbconnect
							);
		}
		private function close($db){
				if( $db != false ){
						mysqli_close($db);
						$this->dbconnect = false;
				}
		}
		public function select($table,$data){
				$result = $this->connect();//秀羨全俊��卦指方怏
				if( $result['code'] != 0 )//泌惚訳周撹羨��涙全俊
						return $result;
				$db = $result['data'];//方象垂峺寞

				$sql = 'select * from '.$this->security->sqlEncode($table);//秀羨sql囂鞘��歌方table頁燕兆��斤凪序佩廬吶
				if( count($data) != 0 ){//歌方data奉噐where訳周
						$sql .= ' where ';//贋壓where訳周
						$isFirst = true;//登僅嗤叱倖訳周
						foreach($data as $key=>$value ){//乎訳周駅隼嗤吉催��吉催恣円葎囚��嘔円葎峙
								if( $isFirst == false )
										$sql .= ' and ';//訳周謹夸and謹
								$sql .= $this->security->sqlEncode($key)." = '".$this->security->sqlEncode($value)."' ";
								$isFirst = false;
						}
				}
				$query = mysqli_query($db,$sql);
				if( $query == false ){
					//	$this->close($db);
						return array(
										'code'=>1,
										'msg'=>'峇佩sql囂鞘払移 '.$sql,
										'data'=>''
									);
				}

				$data = array();
				while( $singleData = mysqli_fetch_array($query,MYSQL_ASSOC) ){//匯肝軸匯佩
						//singleData is an array
						$data[] = $singleData;//侭嗤方象
				}
				//$this->close($db);
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
										if( $query == false ){
									//	$this->close($db);
										return array(
												'code'=>1,
												'msg'=>'峇佩sql囂鞘払移 '.$sql,
												'data'=>''
												);
										}
									//	$this->close($db);
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
				if( $query == false ){
						//$this->close($db);
						return array(
										'code'=>1,
										'msg'=>'峇佩sql囂鞘払移 '.$sql,
										'data'=>''
									);
				}
				//$this->close($db);
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
				if( $query == false ){
						//$this->close($db);
						return array(
										'code'=>1,
										'msg'=>'峇佩sql囂鞘払移 '.$sql,
										'data'=>''
									);
				}

				//$this->close($db);
				return array(
								'code'=>0,
								'msg'=>'',
								'data'=>''
							);
		}

};
?>
