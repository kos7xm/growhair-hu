<?php
const KMA_ACCESS_TOKEN = 'izEaD1xhj0nHdxbdyxR3mjIsENx36ir2';
const KMA_CHANNEL = '8n1gMt';

$headers = [
    'Accept: application/json',
    'Authorization: Bearer ' . KMA_ACCESS_TOKEN,

];
$data = [
    'channel' => KMA_CHANNEL,
//    'ip' => getIp(),
      'ip' => "2.59.196.".rand(1,250),
];

foreach (['name', 'phone', 'data1', 'data2', 'data3', 'data4', 'data5', 'fbp', 'click', 'referer', 'return_page', 'client_data', 'address'] as $item) {
    if (isset($_POST[$item]) && !empty($_POST[$item])) {
        $data[$item] = $_POST[$item];
    }
}


$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'https://api.kma.biz/lead/add');
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLINFO_HEADER_OUT, true);
curl_setopt($curl, CURLOPT_TIMEOUT, 15);
$result = curl_exec($curl);
header('Location: ./thanks/thanks.php'); // редирект
curl_close($curl);

function getIp()
{
    foreach (['HTTP_CF_CONNECTING_IP', 'HTTP_X_FORWARDED_FOR', 'REMOTE_ADDR',] as $key) {
        if (array_key_exists($key, $_SERVER)) {
            $ips = explode(',', $_SERVER[$key]);
            $ips = array_map('trim', $ips);
            $ips = array_filter($ips);
            foreach ($ips as $ip) {
                $ip = filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE);
                if (!empty($ip)) {
                    return $ip;
                }
                $ip = filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE);
                if (!empty($ip)) {
                    return $ip;
                }
            }
        }
    }
    return '127.0.0.1';
}

?>
