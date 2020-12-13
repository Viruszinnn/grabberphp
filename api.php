<?php

error_reporting(0);


list($cpf) = explode("|", str_replace(array(",", "»", "|", ":"), "|", $_REQUEST['lista']));

$cpf = str_replace(" " , "" , $cpf);
$cpf = str_replace("-" , "" , $cpf);
$cpf = str_replace("." , "" , $cpf);

function inStr($string, $start, $end, $value) {
 $str = explode($start, $string);
 $str = explode($end, $str[$value]);
 return $str[0];
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://neobusca.xyz/root/modules/Complete/BuscarDocumento.php");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); 
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'accept: /',
'accept-language: pt-BR,pt;q=0.9,en-US;q=0.8,en;q=0.7',
'content-type: application/x-www-form-urlencoded; charset=UTF-8',
'cookie: __tawkuuid=e::neobusca.xyz::UT3cDweO5pBQPYI0kCEi9Pv66vScE7f/3J7QFE0YqxatpUcjSoTm7tf44sPL4B+M::2; sucuri_cloudproxy_uuid_a5cd231d9=356af9b470754c98f58c2f920918080a; sucuri_cloudproxy_uuid_c9069041f=bfaf5acd68a5da866474a32af4efa429; PHPSESSID=o2f0lkt3tmgt5nv6ce11t12h5l; TawkConnectionTime=0',
'origin: https://neobusca.xyz/',
'referer: https://neobusca.xyz/NeoComplete.php',
'sec-fetch-dest: empty',
'sec-fetch-mode: cors',
'sec-fetch-site: same-origin',
'user-agent: Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.102 Safari/537.36',
'x-requested-with: XMLHttpRequest'
)); 
curl_setopt($ch, CURLOPT_POSTFIELDS, 'cpf='.$cpf.'&rg=&titulo=&cnh=');
$r1 = curl_exec($ch);

$nome = inStr($r1, '<span class="text-dark">', '</span>', 1);
$mae = inStr($r1, '<span class="text-dark">', '</span>', 2);
$pai = inStr($r1, '<span class="text-dark">', '</span>', 3);
$data = inStr($r1, '<span class="text-dark">', '</span>', 4);
$nascimento = inStr($r1, '<span class="text-dark">', '</span>', 5);
$sexo = inStr($r1, '<span class="text-dark">', '</span>', 6);
$situcao = inStr($r1, '<span class="text-dark">', '</span>', 7);
$cep = inStr($r1, '<i class="fa fa-map-marker-alt fa-1x text-danger"></i><span class="text-dark enderecos">', '</span>', 1);

echo $json = '{"nome":"'.$nome.'", "mae":"'.$mae.'", "pai":"'.$pai.'", "data_nascimento":"'.$data.'", "nascimento":"'.$nascimento.'", "sexo":"'.$sexo.'", "cep":"'.$cep.'"}';


?>