<?php
/**
 * Created by PhpStorm.
 * User: jay
 * Date: 07.01.16
 * Time: 19:56
 */
//https://cmdb.etadirect.com/rest/prod/server_view
//next example will recieve all messages for specific conversation
$service_url = 'https://cmdb.etadirect.com/rest/prod/server_view';
$curl = curl_init($service_url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$curl_response = curl_exec($curl);
//print_r($curl_response);

curl_close($curl);
$decoded = json_decode($curl_response);
//print_r($decoded);




//$fp = fopen("cmdb.txt", "a"); // Открываем файл в режиме записи
//$test = fwrite($fp, $curl_response); // Запись в файл
//if ($test) echo 'Данные в файл успешно занесены.';
//else echo 'Ошибка при записи в файл.';
//fclose($fp); //Закрытие файла



$fp = fopen("cmdb.txt", "r"); // Открываем файл в режиме чтения
list($db, $server) = explode(":", $fp);

echo $server;

//foreach ($fp as $k -> $va){
//	print_r($k['DB_Master']);
//}

