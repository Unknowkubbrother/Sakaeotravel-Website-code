<?php
    $host_addr = "localhost";
    $host_user = "root"; // ยูสเซอร์เนมของฐานข้อมูล
    $host_pw = ""; // รหัสผ่านของฐานข้อมูล
    $host_db = "test11"; // ชื่อของฐานข้อมูล
    $sql_con = mysqli_connect($host_addr,$host_user,$host_pw,$host_db) or die("Connect Database Error!");
    mysqli_set_charset($sql_con,"utf8");
	  
	// Client IP
	if (isset($_SERVER['HTTP_CLIENT_IP']) && filter_var($_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP)) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && filter_var($_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP)) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} elseif (isset($_SERVER['REMOTE_ADDR']) && filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP)) {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
    if (!empty($ip))
    {
    // get Geolocation from IP (Free API)
    $query = json_decode(file_get_contents('http://ip-api.com/json/'.$ip));
    if ($query) 
    {
        if ($query->status == 'success') {
            // success
            $ipaddress = $ip.' from '.$query->country.' ('.$query->countryCode.'), '.$query->regionName.', '.$query->city.', '.$query->zip.', '.$query->isp.'';
        } else {
            // error
            $ipaddress = $query->query.' '.$query->message;
        }
        
    }
    }


?>