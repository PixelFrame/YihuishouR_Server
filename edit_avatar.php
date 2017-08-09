<?php
	require_once("db_config.php");

	$fileUp  = new FileUp();
	$fileUp->uploadFile();

	$id = $fileUp->fid;
	$ext = $fileUp->ext;
	$network_path = "http://115.159.188.117/img/avatar/".$id.$ext;
	
	$sql = "update user set avatar = '$network_path' where id = '$id'";
	$rs = mysqli_query($con, $sql);
	if($rs == false) { echo "数据库错误"; }
	else if(mysqli_num_rows($rs) != 1) { echo "数据库异常"; }
	else echo "头像上传成功";
	
	exit();
	
	class FileUp {
		public $target_path = "../img/avatar/";
		public $fid;
		public $ext;
		
		function uploadFile() {
			$this->fid = $_GET['fid'];
			$this->ext = $_GET['ext'];
			
			$handleRead = null;
			$fid = "";
			$handleWrite = null;
			
			if(!empty($_FILES['uploadedfile']['tmp_name'])) {
				$handleRead = fopen($_FILES['uploadedfile']['tmp_name'],'rb');
				if(!empty($this->fid)) $fid = $this->fid;	
				else $fid = time().'_'.mt_rand(1,22222);
				$target_path = $target_path.$fid.$this->ext;
				$handleWrite = fopen($target_path,'a');
				$buffer = '';
				while (!feof($handleRead)) {
					$buffer = fread($handleRead, 1024*128);
					if(strlen($buffer)<=0)
						break;
					fwrite($handleWrite,$buffer);
				}
				fclose($handleWrite);
				fclose($handleRead);
				echo $fid;
				$this->saveLog("$fid 上传成功");
			} else {
				echo "fail";
				$this->saveLog(" 上传失败");
			}
		}
		function saveLog($content) {
			$logpath = "http://localhost/Log/upload/".date("Y-m-d",time()).".log";
			$result = fopen($logpath,'a');
			fwrite($result,date("Y-m-d H:i:s",time())." ========== ".$content."\r\n");
			fclose($result);
		}
	}
		
?>