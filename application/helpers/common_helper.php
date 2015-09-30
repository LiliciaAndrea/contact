<?php

//获取用户真实IP
function get_ip()
{
    static $realip = NULL;

    if ($realip !== NULL)
    {
        return $realip;
    }

    if (isset($_SERVER))
    {
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        {
            $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);

            /* 取X-Forwarded-For中第一个非unknown的有效IP字符串 */
            foreach ($arr AS $ip)
            {
                $ip = trim($ip);

                if ($ip != 'unknown')
                {
                    $realip = $ip;

                    break;
                }
            }
        }
        elseif (isset($_SERVER['HTTP_CLIENT_IP']))
        {
            $realip = $_SERVER['HTTP_CLIENT_IP'];
        }
        else
        {
            if (isset($_SERVER['REMOTE_ADDR']))
            {
                $realip = $_SERVER['REMOTE_ADDR'];
            }
            else
            {
                $realip = '0.0.0.0';
            }
        }
    }
    else
    {
        if (getenv('HTTP_X_FORWARDED_FOR'))
        {
            $realip = getenv('HTTP_X_FORWARDED_FOR');
        }
        elseif (getenv('HTTP_CLIENT_IP'))
        {
            $realip = getenv('HTTP_CLIENT_IP');
        }
        else
        {
            $realip = getenv('REMOTE_ADDR');
        }
    }

    preg_match("/[\d\.]{7,15}/", $realip, $onlineip);
    $realip = !empty($onlineip[0]) ? $onlineip[0] : '0.0.0.0';

    return $realip;
}
//将String型IP转为Int型
function ipToInt($sIP)  
{  
    $aIP = explode('.',$sIP);  
    $iIP = ($aIP[0] << 24) | ($aIP[1] << 16) | ($aIP[2] << 8) | $aIP[3] ;
    if($iIP < 0) $iIP += 4294967296;  
    return $iIP;  
} 
//将Int型IP转为String型
function intToIP($iIP)  
{  
    $xor = array(0x000000ff,0x0000ff00,0x00ff0000,0xff000000);  
    for($i=0; $i<4; $i++)  
    {  
        ${s.$i} = ($iIP & $xor[$i]) >> $i*8;  
        if (${s.$i} < 0) ${s.$i} += 256;  
    }  
    return $s3.'.'.$s2.'.'.$s1.'.'.$s0;  
}
//发送邮件
function send_mail($email,$subject,$content)
{
      $url = 'http://sendcloud.sohu.com/webapi/mail.send.json';
      //不同于登录SendCloud站点的帐号，您需要登录后台创建发信子帐号，使用子帐号和密码才可以进行邮件的发送。
      $param = array('api_user' => 'CDEmail',
              'api_key' => 'dgwrjn5tq7RyT9ax',
              'from' => 'server@mail.cde-express.com',
              'fromname' => 'CDEmail',
              'to' => $email,
              'subject' => $subject,
              'html' => $content);
      $options = array('http' => array('method'  => 'POST','content' => http_build_query($param)));
      $context  = stream_context_create($options);
      $result = @file_get_contents($url, false, $context);

      return $result;
}
//获取用户地理位置
function get_loc_QQ($queryIP){ 
    $url = 'http://ip.qq.com/cgi-bin/searchip?searchip1='.$queryIP; 
    $ch = curl_init($url); 
    curl_setopt($ch,CURLOPT_ENCODING ,'gb2312'); 
    curl_setopt($ch, CURLOPT_TIMEOUT, 10); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回 
    $result = curl_exec($ch); 
    $result = mb_convert_encoding($result, "utf-8", "gb2312"); // 编码转换，否则乱码 
    curl_close($ch); 
    preg_match("@<span>(.*)</span></p>@iU",$result,$ipArray); 
    $loc = $ipArray[1]; 
    return $loc; 
}
//转码性别
function sex_to_string($sex)
{
    switch($sex){
        case 1 : 
            $string = '男生';
            break;
        case 2 :
            $string = '女生';
            break;
        default :
            $string = '未知';
            break;
    }
    return $string;
}