 
 <?php

//ini_set("display_errors", On);  
//error_reporting(E_ALL);

session_start(); //����session

$image = imagecreatetruecolor(100,30);//����һ����100���߶�30��ͼƬ
$bgcolor=imagecolorallocate($image,255,255,255);//ͼƬ�����ǰ�ɫ
imagefill($image,0,0,$bgcolor);//ͼƬ����ɫ
//������������������ֻ�����ֵ���֤��
/**
for($i=0;$i<4;$i++){
  $fontsize=6;
  $fontcolor=imagecolorallocate($image,rand(0,120),rand(0,120),rand(0,120));
  $fontcontent=rand(0,9);
  $x=($i*100/4)+ rand(5,10);
  $y=rand(5,10);
  imagestring($image,$fontsize,$x,$y,$fontcontent,$fontcolor);
}
**/
//������ݣ������������������ݣ�������ĸ������
$captch_code='';
for($i=0;$i<4;$i++){
  $fontsize=6;
  $fontcolor=imagecolorallocate($image,rand(0,120),rand(0,120),rand(0,120));
  $data='asdfdfglfg74erf21854hgfhgfhkg4ljkghjtrtywiqpoqpwepdfgvnjytyut12313345645667686797800';
  $fontcontent=substr($data,rand(0,strlen($data)),1);
  $captch_code.=$fontcontent;

  $x=($i*100/4)+ rand(5,10);
  $y=rand(5,10);
  imagestring($image,$fontsize,$x,$y,$fontcontent,$fontcolor);
}
$_SESSION['check_auth']=$captch_code;

//����㣬���ɸ��ŵ�
for($i=0;$i<200;$i++){
  $pointcolor=imagecolorallocate($image,rand(50,120),rand(50,120),rand(50,120));
  imagesetpixel($image,rand(1,99),rand(1,99),$pointcolor);
}
//����ߣ����ɸ�����
for($i=0;$i<3;$i++){
  $linecolor=imagecolorallocate($image,rand(80,220),rand(80,220),rand(80,220));
  imageline($image,rand(1,99),rand(1,29),rand(1,99),rand(1,29),$linecolor);
}
ob_clean();//ԭ���ĳ���û����һ��
header("content-type:image/png");
imagepng($image);

imagedestory($image);


?>