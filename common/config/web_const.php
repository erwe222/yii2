<?php 


/**
 * 检测值有效性
 * @param String $name 变量名称
 * @return String NULL则返回空值(空字符串)
 */
function checkNull($name, $defaultValue = '') {
    $result = isset($_GET[$name]) ? $_GET[$name] : (isset($_POST[$name]) ? $_POST[$name] : $defaultValue);
    if (is_numeric($defaultValue)) {
        $defaultValue = strval($defaultValue);
    }
    if (is_string($result)) {
        return addslashes(trim($result));
    } else {
        return $result;
    }
}


/**
 * 打印并高亮函数(推荐使用)
 * @param Mixed $target 待输出的对象
 * @param Boolean $bool 是否终止到当前位置退出(默认为true)
 */
function dump($target, $bool = true) {
    static $i = 0;
    if ($i == 0) {
        header('Content-Type:text/html;charset=utf-8');
        echo '<pre>';
    }
    
    yii\helpers\VarDumper::dump($target);
    $i++;
    echo '</pre>';
    if ($bool) {
        
        exit;
    } else {
        echo nl2br(PHP_EOL);
    }
}


/**
 * 判断是否为手机访问2
 * @return boolean
 */
function isMobile() {
    // 如果有HTTP_X_WAP_PROFILE则一定是移动设备  
    if (isset($_SERVER['HTTP_X_WAP_PROFILE'])) {
        return true;
    }
    // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息  
    if (isset($_SERVER['HTTP_VIA'])) {
        return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
    }
    // 野蛮方法，判断手机发送的客户端标志,兼容性有待提高  
    if (isset($_SERVER['HTTP_USER_AGENT'])) {
        $clientkeywords = array('nokia', 'sony', 'ericsson', 'mot', 'samsung', 'htc', 'sgh', 'lg', 'sharp', 'sie-', 'philips', 'panasonic', 'alcatel', 'lenovo', 'iphone', 'ipod', 'blackberry', 'meizu', 'android', 'netfront', 'symbian', 'ucweb', 'windowsce', 'palm', 'operamini', 'operamobi', 'openwave', 'nexusone', 'cldc', 'midp', 'wap', 'mobile');
        // 从HTTP_USER_AGENT中查找手机浏览器的关键字  
        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
            return true;
        }
    }
    // 协议法，因为有可能不准确，放到最后判断  
    if (isset($_SERVER['HTTP_ACCEPT'])) {
        // 如果只支持wml并且不支持html那一定是移动设备  
        // 如果支持wml和html但是wml在html之前则是移动设备  
        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) &&
            (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false ||
            (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
            return true;
        }
    }

    return false;
}


/* * 加密与解决算法
 * 用法：
 * ---------------------------------------
  $str = 'abc';
  $key = 'www.helloweba.com';
  $token = encryptStr($str, 'E', $key);
  echo '加密:'.encryptStr($str, 'E', $key);
  echo '解密：'.encryptStr($str, 'D', $key);
 * ---------------------------------------
 * @param String $str         待加密的字符串内容
 * @param String $operation   操作方式(E:加密,D:解密，默认为D)
 * @param String $str_key     密钥
 * @return String             加密/解密后的字符串内容
 */

function encryptStr($str, $operation = 'D', $str_key = 'www.jretec.com') {
    $key = md5($str_key);
    $key_length = strlen($key);
    $string = strtoupper($operation) == 'D' ? base64_decode($str) : substr(md5($str . $key), 0, 8) . $str;
    $string_length = strlen($string);
    $rndkey = $box = array();
    $result = '';
    for ($i = 0; $i <= 255; $i++) {
        $rndkey[$i] = ord($key[$i % $key_length]);
        $box[$i] = $i;
    }
    for ($j = $i = 0; $i < 256; $i++) {
        $j = ($j + $box[$i] + $rndkey[$i]) % 256;
        $tmp = $box[$i];
        $box[$i] = $box[$j];
        $box[$j] = $tmp;
    }
    for ($a = $j = $i = 0; $i < $string_length; $i++) {
        $a = ($a + 1) % 256;
        $j = ($j + $box[$a]) % 256;
        $tmp = $box[$a];
        $box[$a] = $box[$j];
        $box[$j] = $tmp;
        $result.=chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
    }
    if ($operation == 'D') {
        if (substr($result, 0, 8) == substr(md5(substr($result, 8) . $key), 0, 8)) {
            return substr($result, 8);
        } else {
            return'';
        }
    } else {
        return str_replace('=', '', base64_encode($result));
    }
}

/**
 * 生成随机数
 * @param Int $length [default is 6]
 * @return String
 */
function getRand($length = 6) {
    $arr = array();
    while (count($arr) < $length) {
        $arr[] = rand(1, 9);
        $arr = array_unique($arr);
    }
    $randString = implode('', $arr);
    return $randString;
}

/**
 * 人性化时间显示
 * @param string $datetime  日期时间(如：'2017-06-16 18:11:01')
 * @return string 人性化时间提示(如：7分钟前)
 */
function formatHumanDateTime($datetime) {
    $unix_time = strtotime($datetime);
    $rtime = date("Y-m-d H:i:s", $unix_time);
    $htime = date("H:i", $unix_time);
    $time = time() - $unix_time;
    if ($time < 60) {
        $str = '刚刚';
    } elseif ($time < 60 * 60) {
        $min = floor($time / 60);
        $str = $min . '分钟前';
    } elseif ($time < 60 * 60 * 24) {
        $h = floor($time / (60 * 60));
        $str = $h . '小时前 ';
    } elseif ($time < 60 * 60 * 24 * 3) {
        $d = floor($time / (60 * 60 * 24));
        if ($d == 1) {
            $str = '昨天 ' . $htime;
        } else {
            $str = '前天 ' . $htime;
        }
    } else {
        $str = $rtime;
    }
    return $str;
}

/** 
* ****************** 
* 1、写入内容到文件,追加内容到文件 
* 2、打开并读取文件内容 
* ******************* 
*/  
function addLog($message){
    error_log('['.date('Y-m-d H:i:s').'] '.$message.PHP_EOL,   3,  "./log.txt");
};