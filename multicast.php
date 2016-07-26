<?php
/**
 * Created by PhpStorm.
 * User: kisstheraik
 * Date: 16/7/26
 * Time: 上午10:35
 * Description: 模拟IP多播
 */
//创建一个socket,加入一个多播组,然后向这个接口发送多播报文
//客户端socket
$rsocket=socket_create(AF_INET,SOCK_DGRAM,SOL_UDP);
//接收端口加入多播组
socket_set_option($rsocket,IPPROTO_IP,MCAST_JOIN_GROUP,array("group"=>'224.0.0.23'));

//这里要用0.0.0.0来表明本机所有的ip,使用localhost或者127.0.0.1是回环地址,收不到数据
socket_bind($rsocket,'0.0.0.0',3008);

$data='hello';
//服务器端socket
$ssocket=socket_create(AF_INET,SOCK_DGRAM,SOL_UDP);

socket_sendto($ssocket,$data,strlen($data),0,'224.0.0.23',3008);

socket_close($ssocket);

//客户端读取数据
socket_recvfrom($rsocket,$rec,65335,0,$host,$port);

echo $rec.PHP_EOL;

socket_close($rsocket);



