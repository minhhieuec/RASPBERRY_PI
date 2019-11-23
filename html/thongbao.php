<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Minh Hiếu EC</title>
<link rel="stylesheet" href="css/style.css">
</head>

<body>
 	<div id="header">
 	  <div class="wrapperheader">
    		<div class="logo">
        		<img src="logo1.png" width="450" height="80">
        	</div>   
      </div>
   </div>

  <div id="menu1">
            <nar>
 	           <ul><div class="left">
                    <li><a href="danhsach.php">DANH SÁCH</a></li>
            	    <li><a href="sms.php">HỘP THƯ ĐẾN</a></li>
                    <li><a class="active" href="thongbao.php">THÔNG BÁO</a><li>
                    </div>
                    <div class="right">
     	            <li><a href="#">  
									<?php
									if(isset($_SESSION['username'])){
 										   echo "xin chào <b><font size = 3 color = green>".$_SESSION['username']."</font>!</b>";
										}
									else
 									   header('Location: index.php');
									?></a>
                   </li>
                <li><a href="logout.php"><font color="red">Log out</font></a></li>
				</div>
                <div class="clear"></div>
            </ul>
           </nar>
	</div>

    <div id="wrapper"> 
    	<div class="content">
                <?php
$a = $_GET["sdt"];
if($a == 1){
	$sdt = $_COOKIE["user1"];
}
if($a == 2){
	$sdt = $_COOKIE["user2"];
}
if($a == 3){
	$sdt = $_COOKIE["user3"];
}
if($a == 4){
	$sdt = $_COOKIE["user4"];
}
if($a == 5){
	echo $_COOKIE["user5"];
}
if($a == 6){
	echo $_COOKIE["user6"];
}
if($a == 7){
	echo $_COOKIE["user7"];
}
if($a == 8){
	echo $_COOKIE["user8"];
}
if($a == 9){
	echo $_COOKIE["user9"];
}
if($a == 10){
	echo $_COOKIE["user10"];
}
?>

        
			<form name="frm" method="post">
				<h1>Nhập tên File cần thông báo :</h1>
				<input type="text" name="text" value="<?php echo $sdt; ?>"/>
  				<h1>Thông báo</h1>
  				<textarea name="area"></textarea>
				<input type="submit" name="submit_name" value="gui" />
			</form>
<?php
$txt = $_POST["text"];
$area = $_POST["area"];
$sub = $_POST["submit_name"];
//echo $sub;
if($sub == "gui"){
	if(file_exists("upload/$txt"))
	{
		if(!$txt){
 			echo "<font size = 5 color = red>Vui lòng nhập tên file! <br></font>";
			$tenfile = 0;
		}
		else{
			if(!$area){
 				echo "<font size = 5 color = red>Vui lòng nhập thông báo!</font>";
				$tenarea = 0;
			}
		else{	
			$dem = 0;
			$mang = array();
			$fp = "upload/$txt";
			$fo = fopen($fp,"r");
			while(!feof($fo)){
				$fr = fgets($fo);
				//echo $fr."<br>";
				$mang[]=$fr;
				$dem = $dem + 1;
			}
			echo "<font size = 5 color = blue>Số điện thoại đã gửi:</font> <br>";
			foreach($mang as $value)
			{
				echo $value."<br>";
			}
			
			//ghi sdt can gui vao file
			$sdt = "system/sdtsend.txt";
			$sdtopen = fopen($sdt, 'w');
			$sdtwrite = fwrite($sdtopen,$fp );
			$sdtclose = fclose($sdtopen);			
			
			echo "<font size = 5 color = blue>Với thông báo :</font> <br>";
			$tb = $_POST["area"];
			echo $tb;
			$fp = "system/thongbao.txt";
			$fo = fopen($fp, 'w');
			$fw = fwrite($fo, "$tb" );
			$fc = fclose($fo);
			
			$check = "system/check.txt";
			$checkopen = fopen($check, 'w');
			$checkwrite = fwrite($checkopen, "1" );
			$checkclose = fclose($checkopen);
			} //end kiem tra else nhap thong bao
		}//end else kiem tra file ton tai
	}//end kiem tra file ton tai
	
	else{
			echo "<font size = 5 color = red>Tệp tin số điện thoại không tồn tại, vui lòng upload!</font>";

	} // end else kiem tra
}//end kiem tra co nhan nut submit
?>
</div>
</div>
<div class="clear"></div>
<div id="topfooter">
<div class="left">Đã gửi xong lúc: 
<?php $fp ="system/time.txt";
	$fo = fopen($fp, 'r');
	$fr = fgets($fo);
	$fc = fclose($fo);
	echo $fr;
	?>
</div>
<div class="right">
 Time Now:
<?php
date_default_timezone_set("Asia/Ho_Chi_Minh");
$now = date("d/m/Y H:i:s"); // 26/09/2014 14:27:08
echo $now;
?>

</div>
<div class="clear"></div>
</div>
	<div id="footer">
		<font color="blue" size="+3"><b>TRƯỜNG ĐẠI HỌC VĂN HIẾN</b></font>
		<br />
		<font color="green" size="+2">KHOA KỸ THUẬT - CÔNG NGHỆ
		</font><BR />
		NGUYỄN MINH HIẾU- <i>THIẾT KẾ HỆ THỐNG TỔNG ĐÀI SINH VIÊN.</i> <br />
	</div>
</div>
</body>
</html>

