<?php
/*
Plugin Name: Horoscope Plugin Widget
Plugin URI: http://wordpress.org/extend/plugins/horoscope-plugin-widget/
Description: Let your visitors read daily horoscope in your wordpress site.
Version: 1.0.2
Author: unaproject
Author URI: http://www.bzodiac.com/
*/


class HoroscopeWidget extends WP_Widget {
    /** constructor */
    function HoroscopeWidget() {
        parent::WP_Widget(false, $name = 'Horoscope Widget');	
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
		if ($title == '') $title = 'Daily Horoscope';
        ?>

              <?php echo $before_widget; ?>
                  <?php if ( $title )
                        echo $before_title . $title . $after_title; ?>
<?php
$params = "imageSet=" . urlencode($instance['imageSet']) . "&backgroundColor=" . urlencode($instance['backgroundColor']) . "&textColor=" . urlencode($instance['textColor']) . "&srcUrl=" . urlencode(get_bloginfo ('wpurl')) . "&linkColor=" . urlencode($instance['linkColor']) . "&width=" . urlencode($instance['width']);
?>

<?php

$acceptWidget = $instance['acceptWidget'];

if($acceptWidget != "1")
{
?>
<center><p>The widget is disabled</p></center>
<?php
}
else
{


$srcUrl = get_bloginfo ('wpurl');

$imageSet = $instance['imageSet'];
if ($imageSet != '1' && $imageSet != '2' && $imageSet != '3' && $imageSet != '4' & $imageSet != '5' & $imageSet != '6' & $imageSet != 'None')
	$imageSet = '1';
	
if ($imageSet == 'None')
	$width = '140';
else
	$width = '180';
	
$backgroundColor = $instance['backgroundColor'];
if (!is_numeric('0x' . $backgroundColor)) // If not hex
	$backgroundColor = '';
	
$textColor = $instance['textColor'];
if (!is_numeric('0x' . $textColor)) // If not hex
	$textColor = '';
	
$linkColor = $instance['linkColor'];
if (!is_numeric('0x' . $linkColor)) // If not hex
	$linkColor = '';
	
$imageDir = htmlspecialchars($srcUrl) . '/wp-content/plugins/horoscope-plugin-widget/images' . $imageSet . '/';


$randIdPredix = 'id' . rand() . '_';
?>

<script type="text/javascript">
function toggle(obj)
{
	var item = document.getElementById(obj);
	
	if(item.style.display == 'inline' || item.style.display == '') { item.style.display = 'none'; }
	else { item.style.display = 'inline'; }
}
function displayZodiac(strname)
{
	toggle('<?php echo $randIdPredix; ?>zodiac_table');
	toggle('<?php echo $randIdPredix; ?>zodiac_' + strname);
}
function toggleTomorrow(strname)
{
	toggle('<?php echo $randIdPredix; ?>zodiac_' + strname);
	toggle('<?php echo $randIdPredix; ?>tomorrow_zodiac_' + strname);
}
</script>

<style type="text/css">
.widgetCssClass {padding:0px;margin:0px;border-width:0px}
.widgetCssClass table{padding:0px;margin:0px;border-width:0px;border-collapse:collapse;border-spacing:0px;}
.widgetCssClass div{padding:0px;margin:0px;border-width:0px;width:<?php echo $width; ?>px;}
.widgetCssClass p{padding:0px;margin:0px;border-width:0px}
.widgetCssClass b{padding:0px;margin:0px;border-width:0px}
.widgetCssClass td{padding:1px;margin:0px;border-width:0px;vertical-align:middle;}

<?php if($linkColor)
{
?>
.widgetCssClass a:link{color:#<?php echo $linkColor; ?>;}
.widgetCssClass a:visited{color:#<?php echo $linkColor; ?>;}
.widgetCssClass a:hover{color:#<?php echo $linkColor; ?>;}
.widgetCssClass a:active{color:#<?php echo $linkColor; ?>;}
<?php
}
?>

<?php if($textColor)
{
?>
.widgetCssClass {color:#<?php echo $textColor; ?>;}
.widgetCssClass div{color:#<?php echo $textColor; ?>;}
.widgetCssClass p{color:#<?php echo $textColor; ?>;}
.widgetCssClass td{color:#<?php echo $textColor; ?>;}
.widgetCssClass b{color:#<?php echo $textColor; ?>;}
<?php
}
?>

</style>	
<div id="<?php echo $randIdPredix; ?>widget_div_id" class="widgetCssClass">
<center>
<table cellspacing="0" cellpadding="0" width="<?php echo $width; ?>px" <?php if($backgroundColor) {echo 'bgcolor="#' . $backgroundColor . '"';}?>>
<tr><td>
<div id="<?php echo $randIdPredix; ?>zodiac_table"  align="center" width="100%" >
<center>
<table cellspacing="0" cellpadding="0">
<tr>
	<td align="center" width="<?php echo ($width-120)/2; ?>px"><a href="#" onclick="javascript:displayZodiac('Aries'); return false;"><img src="<?php echo $imageDir; ?>aries.png" border=0></a></td>
	<td align="left" width="60px"><a href="#" onclick="javascript:displayZodiac('Aries'); return false;">Aries</a></td>
	<td align="center" width="<?php echo ($width-120)/2; ?>px"><a href="#" onclick="javascript:displayZodiac('Taurus'); return false;"><img src="<?php echo $imageDir; ?>taurus.png" border=0></a></td>
	<td align="left" width="60px"><a href="#" onclick="javascript:displayZodiac('Taurus'); return false;">Taurus</a></td>
</tr>
<tr>
	<td align="center" width="<?php echo ($width-120)/2; ?>px"><a href="#" onclick="javascript:displayZodiac('Gemini'); return false;"><img src="<?php echo $imageDir; ?>gemini.png" border=0></a></td>
	<td align="left" width="60px"><a href="#" onclick="javascript:displayZodiac('Gemini'); return false;">Gemini</a></td>
	<td align="center" width="<?php echo ($width-120)/2; ?>px"><a href="#" onclick="javascript:displayZodiac('Cancer'); return false;"><img src="<?php echo $imageDir; ?>cancer.png" border=0></a></td>
	<td align="left" width="60px"><a href="#" onclick="javascript:displayZodiac('Cancer'); return false;">Cancer</a></td>
</tr>
<tr>
	<td align="center" width="<?php echo ($width-120)/2; ?>px"><a href="#" onclick="javascript:displayZodiac('Leo'); return false;"><img src="<?php echo $imageDir; ?>leo.png" border=0></a></td>
	<td align="left" width="60px"><a href="#" onclick="javascript:displayZodiac('Leo'); return false;">Leo</a></td>
	<td align="center" width="<?php echo ($width-120)/2; ?>px"><a href="#" onclick="javascript:displayZodiac('Virgo'); return false;"><img src="<?php echo $imageDir; ?>virgo.png" border=0></a></td>
	<td align="left" width="60px"><a href="#" onclick="javascript:displayZodiac('Virgo'); return false;">Virgo</a></td>
</tr>
<tr>
	<td align="center" width="<?php echo ($width-120)/2; ?>px"><a href="#" onclick="javascript:displayZodiac('Libra'); return false;"><img src="<?php echo $imageDir; ?>libra.png" border=0></a></td>
	<td align="left" width="60px"><a href="#" onclick="javascript:displayZodiac('Libra'); return false;">Libra</a></td>
	<td align="center" width="<?php echo ($width-120)/2; ?>px"><a href="#" onclick="javascript:displayZodiac('Scorpio'); return false;"><img src="<?php echo $imageDir; ?>scorpio.png" border=0></a></td>
	<td align="left" width="60px"><a href="#" onclick="javascript:displayZodiac('Scorpio'); return false;">Scorpio</a></td>
</tr>
<tr>
	<td align="center" width="<?php echo ($width-120)/2; ?>px"><a href="#" onclick="javascript:displayZodiac('Sagittarius'); return false;"><img src="<?php echo $imageDir; ?>sagittarius.png" border=0></a></td>
	<td align="left" width="60px"><a href="#" onclick="javascript:displayZodiac('Sagittarius'); return false;">Sagittarius</a></td>
	<td align="center" width="<?php echo ($width-120)/2; ?>px"><a href="#" onclick="javascript:displayZodiac('Capricorn'); return false;"><img src="<?php echo $imageDir; ?>capricorn.png" border=0></a></td>
	<td align="left" width="60px"><a href="#" onclick="javascript:displayZodiac('Capricorn'); return false;">Capricorn</a></td>
</tr>
<tr>
	<td align="center" width="<?php echo ($width-120)/2; ?>px"><a href="#" onclick="javascript:displayZodiac('Aquarius'); return false;"><img src="<?php echo $imageDir; ?>aquarius.png" border=0></a></td>
	<td align="left" width="60px"><a href="#" onclick="javascript:displayZodiac('Aquarius'); return false;">Aquarius</a></td>
	<td align="center" width="<?php echo ($width-120)/2; ?>px"><a href="#" onclick="javascript:displayZodiac('Pisces'); return false;"><img src="<?php echo $imageDir; ?>pisces.png" border=0></a></td>
	<td align="left" width="60px"><a href="#" onclick="javascript:displayZodiac('Pisces'); return false;">Pisces</a></td>
</tr>
</table>
</center>
</div>
</td></tr>

<?php
if ($imageSet == 'None')
	$titleWidth = $width;
else
	$titleWidth = $width-30;
?>

<tr><td>
<div id="<?php echo $randIdPredix; ?>zodiac_Aries" style="display:none">
<table width="<?php echo $width; ?>px"><tr><td width="<?php echo ($width - $titleWidth); ?>px"><img src="<?php echo $imageDir; ?>aries.png" border=0></td><td width="<?php echo ($titleWidth); ?>px"><b id="todayHoroscopeTitleAries"></b></td></tr></table>
<p style="text-align: justify;" id="todayHoroscopeTextAries">
</p>
<p  align="left"><a href="#" onclick="javascript:toggleTomorrow('Aries'); return false;">&rArr; Tomorrow Horoscope</a><br/>
<a href="#" onclick="javascript:displayZodiac('Aries'); return false;">&lArr; back</a></p>
</div>
<div id="<?php echo $randIdPredix; ?>tomorrow_zodiac_Aries" style="display:none">
<table width="<?php echo $width; ?>px"><tr><td width="<?php echo ($width - $titleWidth); ?>px"><img src="<?php echo $imageDir; ?>aries.png" border=0></td><td width="<?php echo $titleWidth; ?>px"><b id="tomorrowHoroscopeTitleAries"></b></td></tr></table>
<p style="text-align: justify;" id="tomorrowHoroscopeTextAries">
</p>
<p  align="left"><a href="#" onclick="javascript:toggleTomorrow('Aries'); return false;">&lArr; back</a></p>
</div>

<div id="<?php echo $randIdPredix; ?>zodiac_Taurus" style="display:none;">
<table width="<?php echo $width; ?>px"><tr><td width="<?php echo ($width - $titleWidth); ?>px"><img src="<?php echo $imageDir; ?>taurus.png" border=0></td><td width="<?php echo $titleWidth; ?>px"><b id="todayHoroscopeTitleTaurus"></b></td></tr></table>
<p style="text-align: justify;" id="todayHoroscopeTextTaurus">
</p>
<p  align="left"><a href="#" onclick="javascript:toggleTomorrow('Taurus'); return false;">&rArr; Tomorrow Horoscope</a><br/>
<a href="#" onclick="javascript:displayZodiac('Taurus'); return false;">&lArr; back</a></p>
</div>
<div id="<?php echo $randIdPredix; ?>tomorrow_zodiac_Taurus" style="display:none;">
<table width="<?php echo $width; ?>px"><tr><td width="<?php echo ($width - $titleWidth); ?>px"><img src="<?php echo $imageDir; ?>taurus.png" border=0></td><td width="<?php echo $titleWidth; ?>px"><b id="tomorrowHoroscopeTitleTaurus"></b></td></tr></table>
<p style="text-align: justify;" id="tomorrowHoroscopeTextTaurus">
</p>
<p  align="left"><a href="#" onclick="javascript:toggleTomorrow('Taurus'); return false;">&lArr; back</a></p></div>

<div id="<?php echo $randIdPredix; ?>zodiac_Gemini" style="display:none;">
<table width="<?php echo $width; ?>px"><tr><td width="<?php echo ($width - $titleWidth); ?>px"><img src="<?php echo $imageDir; ?>gemini.png" border=0></td><td width="<?php echo $titleWidth; ?>px"><b id="todayHoroscopeTitleGemini"></b></td></tr></table>
<p style="text-align: justify;" id="todayHoroscopeTextGemini">
</p>
<p  align="left"><a href="#" onclick="javascript:toggleTomorrow('Gemini'); return false;">&rArr; Tomorrow Horoscope</a><br/>
<a href="#" onclick="javascript:displayZodiac('Gemini'); return false;">&lArr; back</a></p>
</div>
<div id="<?php echo $randIdPredix; ?>tomorrow_zodiac_Gemini" style="display:none;">
<table width="<?php echo $width; ?>px"><tr><td width="<?php echo ($width - $titleWidth); ?>px"><img src="<?php echo $imageDir; ?>gemini.png" border=0></td><td width="<?php echo $titleWidth; ?>px"><b id="tomorrowHoroscopeTitleGemini"></b></td></tr></table>
<p style="text-align: justify;" id="tomorrowHoroscopeTextGemini">
</p>
<p align="left"><a href="#" onclick="javascript:toggleTomorrow('Gemini'); return false;">&lArr; back</a></p>
</div>

<div id="<?php echo $randIdPredix; ?>zodiac_Cancer" style="display:none;">
<table width="<?php echo $width; ?>px"><tr><td width="<?php echo ($width - $titleWidth); ?>px"><img src="<?php echo $imageDir; ?>cancer.png" border=0></td><td width="<?php echo $titleWidth; ?>px"><b id="todayHoroscopeTitleCancer"></b></td></tr></table>
<p style="text-align: justify;" id="todayHoroscopeTextCancer">
</p>
<p align="left"><a href="#" onclick="javascript:toggleTomorrow('Cancer'); return false;">&rArr; Tomorrow Horoscope</a><br/>
<a href="#" onclick="javascript:displayZodiac('Cancer'); return false;">&lArr; back</a></p>
</div>
<div id="<?php echo $randIdPredix; ?>tomorrow_zodiac_Cancer" style="display:none;">
<table width="<?php echo $width; ?>px"><tr><td width="<?php echo ($width - $titleWidth); ?>px"><img src="<?php echo $imageDir; ?>cancer.png" border=0></td><td width="<?php echo $titleWidth; ?>px"><b id="tomorrowHoroscopeTitleCancer"></b></td></tr></table>
<p style="text-align: justify;" id="tomorrowHoroscopeTextCancer">
</p>
<p align="left"><a href="#" onclick="javascript:toggleTomorrow('Cancer'); return false;">&lArr; back</a></p>
</div>

<div id="<?php echo $randIdPredix; ?>zodiac_Leo" style="display:none;">
<table width="<?php echo $width; ?>px"><tr><td width="<?php echo ($width - $titleWidth); ?>px"><img src="<?php echo $imageDir; ?>leo.png" border=0></td><td width="<?php echo $titleWidth; ?>px"><b id="todayHoroscopeTitleLeo"></b></td></tr></table>
<p style="text-align: justify;" id="todayHoroscopeTextLeo">
</p>
<p align="left"><a href="#" onclick="javascript:toggleTomorrow('Leo'); return false;">&rArr; Tomorrow Horoscope</a><br/>
<a href="#" onclick="javascript:displayZodiac('Leo'); return false;">&lArr; back</a></p>
</div>
<div id="<?php echo $randIdPredix; ?>tomorrow_zodiac_Leo" style="display:none;">
<table width="<?php echo $width; ?>px"><tr><td width="<?php echo ($width - $titleWidth); ?>px"><img src="<?php echo $imageDir; ?>leo.png" border=0></td><td width="<?php echo $titleWidth; ?>px"><b id="tomorrowHoroscopeTitleLeo"></b></td></tr></table>
<p style="text-align: justify;" id="tomorrowHoroscopeTextLeo">
</p>
<p align="left"><a href="#" onclick="javascript:toggleTomorrow('Leo'); return false;">&lArr; back</a></p>
</div>

<div id="<?php echo $randIdPredix; ?>zodiac_Virgo" style="display:none;">
<table width="<?php echo $width; ?>px"><tr><td width="<?php echo ($width - $titleWidth); ?>px"><img src="<?php echo $imageDir; ?>virgo.png" border=0></td><td width="<?php echo $titleWidth; ?>px"><b id="todayHoroscopeTitleVirgo"></b></td></tr></table>
<p style="text-align: justify;" id="todayHoroscopeTextVirgo">
</p>
<p align="left"><a href="#" onclick="javascript:toggleTomorrow('Virgo'); return false;">&rArr; Tomorrow Horoscope</a><br/>
<a href="#" onclick="javascript:displayZodiac('Virgo'); return false;">&lArr; back</a></p>
</div>
<div id="<?php echo $randIdPredix; ?>tomorrow_zodiac_Virgo" style="display:none;">
<table width="<?php echo $width; ?>px"><tr><td width="<?php echo ($width - $titleWidth); ?>px"><img src="<?php echo $imageDir; ?>virgo.png" border=0></td><td width="<?php echo $titleWidth; ?>px"><b id="tomorrowHoroscopeTitleVirgo"></b></td></tr></table>
<p style="text-align: justify;" id="tomorrowHoroscopeTextVirgo">
</p>
<p align="left"><a href="#" onclick="javascript:toggleTomorrow('Virgo'); return false;">&lArr; back</a></p>
</div>

<div id="<?php echo $randIdPredix; ?>zodiac_Libra" style="display:none;">
<table width="<?php echo $width; ?>px"><tr><td width="<?php echo ($width - $titleWidth); ?>px"><img src="<?php echo $imageDir; ?>libra.png" border=0></td><td width="<?php echo $titleWidth; ?>px"><b id="todayHoroscopeTitleLibra"></b></td></tr></table>
<p style="text-align: justify;" id="todayHoroscopeTextLibra">
</p>
<p align="left"><a href="#" onclick="javascript:toggleTomorrow('Libra'); return false;">&rArr; Tomorrow Horoscope</a><br/>
<a href="#" onclick="javascript:displayZodiac('Libra'); return false;">&lArr; back</a></p>
</div>
<div id="<?php echo $randIdPredix; ?>tomorrow_zodiac_Libra" style="display:none;">
<table width="<?php echo $width; ?>px"><tr><td width="<?php echo ($width - $titleWidth); ?>px"><img src="<?php echo $imageDir; ?>libra.png" border=0></td><td width="<?php echo $titleWidth; ?>px"><b id="tomorrowHoroscopeTitleLibra"></b></td></tr></table>
<p style="text-align: justify;" id="tomorrowHoroscopeTextLibra">
</p>
<p align="left"><a href="#" onclick="javascript:toggleTomorrow('Libra'); return false;">&lArr; back</a></p>
</div>

<div id="<?php echo $randIdPredix; ?>zodiac_Scorpio" style="display:none;">
<table width="<?php echo $width; ?>px"><tr><td width="<?php echo ($width - $titleWidth); ?>px"><img src="<?php echo $imageDir; ?>scorpio.png" border=0></td><td width="<?php echo $titleWidth; ?>px"><b id="todayHoroscopeTitleScorpio"></b></td></tr></table>
<p style="text-align: justify;" id="todayHoroscopeTextScorpio">
</p>
<p align="left"><a href="#" onclick="javascript:toggleTomorrow('Scorpio'); return false;">&rArr; Tomorrow Horoscope</a><br/>
<a href="#" onclick="javascript:displayZodiac('Scorpio'); return false;">&lArr; back</a></p>
</div>
<div id="<?php echo $randIdPredix; ?>tomorrow_zodiac_Scorpio" style="display:none;">
<table width="<?php echo $width; ?>px"><tr><td width="<?php echo ($width - $titleWidth); ?>px"><img src="<?php echo $imageDir; ?>scorpio.png" border=0></td><td width="<?php echo $titleWidth; ?>px"><b id="tomorrowHoroscopeTitleScorpio"></b></td></tr></table>
<p style="text-align: justify;" id="tomorrowHoroscopeTextScorpio">
</p>
<p align="left"><a href="#" onclick="javascript:toggleTomorrow('Scorpio'); return false;">&lArr; back</a></p>
</div>

<div id="<?php echo $randIdPredix; ?>zodiac_Sagittarius" style="display:none;">
<table width="<?php echo $width; ?>px"><tr><td width="<?php echo ($width - $titleWidth); ?>px"><img src="<?php echo $imageDir; ?>sagittarius.png" border=0></td><td width="<?php echo $titleWidth; ?>px"><b id="todayHoroscopeTitleSagittarius"></b></td></tr></table>
<p style="text-align: justify;" id="todayHoroscopeTextSagittarius">
</p>
<p align="left"><a href="#" onclick="javascript:toggleTomorrow('Sagittarius'); return false;">&rArr; Tomorrow Horoscope</a><br/>
<a href="#" onclick="javascript:displayZodiac('Sagittarius'); return false;">&lArr; back</a></p>
</div>
<div id="<?php echo $randIdPredix; ?>tomorrow_zodiac_Sagittarius" style="display:none;">
<table width="<?php echo $width; ?>px"><tr><td width="<?php echo ($width - $titleWidth); ?>px"><img src="<?php echo $imageDir; ?>sagittarius.png" border=0></td><td width="<?php echo $titleWidth; ?>px"><b id="tomorrowHoroscopeTitleSagittarius"></b></td></tr></table>
<p style="text-align: justify;" id="tomorrowHoroscopeTextSagittarius">
</p>
<p align="left"><a href="#" onclick="javascript:toggleTomorrow('Sagittarius'); return false;">&lArr; back</a></p>
</div>

<div id="<?php echo $randIdPredix; ?>zodiac_Capricorn" style="display:none;">
<table width="<?php echo $width; ?>px"><tr><td width="<?php echo ($width - $titleWidth); ?>px"><img src="<?php echo $imageDir; ?>capricorn.png" border=0></td><td width="<?php echo $titleWidth; ?>px"><b id="todayHoroscopeTitleCapricorn"></b></td></tr></table>
<p style="text-align: justify;" id="todayHoroscopeTextCapricorn">
</p>
<p align="left"><a href="#" onclick="javascript:toggleTomorrow('Capricorn'); return false;">&rArr; Tomorrow Horoscope</a><br/>
<a href="#" onclick="javascript:displayZodiac('Capricorn'); return false;">&lArr; back</a></p>
</div>
<div id="<?php echo $randIdPredix; ?>tomorrow_zodiac_Capricorn" style="display:none;">
<table width="<?php echo $width; ?>px"><tr><td width="<?php echo ($width - $titleWidth); ?>px"><img src="<?php echo $imageDir; ?>capricorn.png" border=0></td><td width="<?php echo $titleWidth; ?>px"><b id="tomorrowHoroscopeTitleCapricorn"></b></td></tr></table>
<p style="text-align: justify;" id="tomorrowHoroscopeTextCapricorn">
</p>
<p align="left"><a href="#" onclick="javascript:toggleTomorrow('Capricorn'); return false;">&lArr; back</a></p>
</div>

<div id="<?php echo $randIdPredix; ?>zodiac_Aquarius" style="display:none;">
<table width="<?php echo $width; ?>px"><tr><td width="<?php echo ($width - $titleWidth); ?>px"><img src="<?php echo $imageDir; ?>aquarius.png" border=0></td><td width="<?php echo $titleWidth; ?>px"><b id="todayHoroscopeTitleAquarius"></b></td></tr></table>
<p style="text-align: justify;" id="todayHoroscopeTextAquarius">
</p>
<p align="left"><a href="#" onclick="javascript:toggleTomorrow('Aquarius'); return false;">&rArr; Tomorrow Horoscope</a><br/>
<a href="#" onclick="javascript:displayZodiac('Aquarius'); return false;">&lArr; back</a></p>
</div>
<div id="<?php echo $randIdPredix; ?>tomorrow_zodiac_Aquarius" style="display:none;">
<table width="<?php echo $width; ?>px"><tr><td width="<?php echo ($width - $titleWidth); ?>px"><img src="<?php echo $imageDir; ?>aquarius.png" border=0></td><td width="<?php echo $titleWidth; ?>px"><b id="tomorrowHoroscopeTitleAquarius"></b></td></tr></table>
<p style="text-align: justify;" id="tomorrowHoroscopeTextAquarius">
</p>
<p align="left"><a href="#" onclick="javascript:toggleTomorrow('Aquarius'); return false;">&lArr; back</a></p>
</div>

<div id="<?php echo $randIdPredix; ?>zodiac_Pisces" style="display:none;">
<table width="<?php echo $width; ?>px"><tr><td width="<?php echo ($width - $titleWidth); ?>px"><img src="<?php echo $imageDir; ?>pisces.png" border=0></td><td width="<?php echo $titleWidth; ?>px"><b id="todayHoroscopeTitlePisces"></b></td></tr></table>
<p style="text-align: justify;" id="todayHoroscopeTextPisces">
</p>
<p align="left"><a href="#" onclick="javascript:toggleTomorrow('Pisces'); return false;">&rArr; Tomorrow Horoscope</a><br/>
<a href="#" onclick="javascript:displayZodiac('Pisces'); return false;">&lArr; back</a></p>
</div>
<div id="<?php echo $randIdPredix; ?>tomorrow_zodiac_Pisces" style="display:none;">
<table width="<?php echo $width; ?>px"><tr><td width="<?php echo ($width - $titleWidth); ?>px"><img src="<?php echo $imageDir; ?>pisces.png" border=0></td><td width="<?php echo $titleWidth; ?>px"><b id="tomorrowHoroscopeTitlePisces"></b></td></tr></table>
<p style="text-align: justify;" id="tomorrowHoroscopeTextPisces">
</p>
<p align="left"><a href="#" onclick="javascript:toggleTomorrow('Pisces'); return false;">&lArr; back</a></p>
</div>

</td></tr>
<?php
eval(base64_decode('DQokdHh0ID0gJyc7DQokbG5rID0gImh0dHA6Ly93d3cuYnpvZGlhYy5jb20iOw0Kc3dpdGNoIChoZXhkZWMoIHN1YnN0cihtZDUoJHNyY1VybCksIC01KSApICUgMTApIHsNCiAgICBjYXNlIDA6DQogICAgICAgICR0eHQgPSAnWm9kaWFjIFNpZ25zJzsNCiAgICAgICAgYnJlYWs7DQogICAgY2FzZSAxOg0KICAgICAgICAkdHh0ID0gJ1pvZGlhYyBTaWduJzsNCiAgICAgICAgYnJlYWs7DQogICAgY2FzZSAyOg0KICAgICAgICAkdHh0ID0gJ0hvcm9zY29wZSBTaWducyc7DQogICAgICAgIGJyZWFrOw0KCWNhc2UgMzoNCiAgICAgICAgJHR4dCA9ICdBc3Ryb2xvZ3kgU2lnbnMnOw0KICAgICAgICBicmVhazsNCgljYXNlIDQ6DQogICAgICAgICR0eHQgPSAnWm9kaWFjIEhvcm9zY29wZSc7DQoJJGxuayA9ICJodHRwOi8vd3d3LmJ6b2RpYWMuY29tL2hvcm9zY29wZSI7DQogICAgICAgIGJyZWFrOw0KCWNhc2UgNToNCiAgICAgICAgJHR4dCA9ICdBc3Ryb2xvZ3kgSG9yb3Njb3BlJzsNCgkkbG5rID0gImh0dHA6Ly93d3cuYnpvZGlhYy5jb20vaG9yb3Njb3BlIjsNCiAgICAgICAgYnJlYWs7DQoJY2FzZSA2Og0KICAgICAgICAkdHh0ID0gJ0FzdHJvbG9naWNhbCBTaWducyc7DQogICAgICAgIGJyZWFrOw0KCWNhc2UgNzoNCiAgICAgICAgJHR4dCA9ICcxMiBab2RpYWMgU2lnbnMnOw0KICAgICAgICBicmVhazsNCgljYXNlIDg6DQogICAgICAgICR0eHQgPSAnWm9kaWFjIFNpZ25zJzsNCiAgICAgICAgYnJlYWs7DQoJY2FzZSA5Og0KICAgICAgICAkdHh0ID0gJ1pvZGlhYyBNZWFuaW5ncyc7DQogICAgICAgIGJyZWFrOw0KfQ0KDQplY2hvICcNCjx0cj4NCgk8dGQgd2lkdGg9IicgLiAkd2lkdGggLiAncHgiPjxjZW50ZXI+PGEgaHJlZj0iJyAuICRsbmsgLiAnIj4nIC4gJHR4dCAuICc8L2E+PC9jZW50ZXI+PC90ZD4NCjwvdHI+Jzs='));
?>
</table>
</center>
</div>


<script type="text/javascript">
  (function() {
    var scrObj = document.createElement('script');
	scrObj.type = 'text/javascript'; scrObj.async = true;
    scrObj.src = "http://www.bzodiac.com/publish/horoscopeWidget/contentV101.js.php?<?php echo $params;?>";
    var s0 = document.getElementsByTagName('script')[0];
	s0.parentNode.insertBefore(scrObj, s0);
  })();
</script>
<?php
}
?>
              <?php echo $after_widget; ?>
        <?php
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['imageSet'] = strip_tags($new_instance['imageSet']);
		$instance['backgroundColor'] = strip_tags($new_instance['backgroundColor']);
		$instance['textColor'] = strip_tags($new_instance['textColor']);
		$instance['linkColor'] = strip_tags($new_instance['linkColor']);
		$instance['width'] = strip_tags($new_instance['width']);
		$instance['acceptWidget'] = strip_tags($new_instance['acceptWidget']);
        return $instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {				
        $title = esc_attr($instance['title']);
		if ($title == '') $title = 'Daily Horoscope';
		
		$imageSet = esc_attr($instance['imageSet']);
		if ($imageSet == '') $imageSet = '1';
		
		$backgroundColor = esc_attr($instance['backgroundColor']);
		$textColor = esc_attr($instance['textColor']);
		$linkColor = esc_attr($instance['linkColor']);
		
		if ($width == '') $width = '190';
		
		$acceptWidget = esc_attr($instance['acceptWidget']);
	
if ($acceptWidget != "1")
{	
        ?>

<div id="horoscopeAcceptMessage">
<p>In order to enable the Widget you need to accept the "powered by" link that will be displayed in the bottom of the widget.<br/>
You can see it and then disable the widget whenever you want.
</p>
<table cellpadding="3px">
<tr>
<td>
<input type="radio" id="<?php echo $this->get_field_id('acceptWidget1'); ?>" name="<?php echo $this->get_field_name('acceptWidget'); ?>" value="1">
</td>
<td>
<label for="<?php echo $this->get_field_id('acceptWidget1'); ?>" >Enable</label>
</td>
</tr>
<tr>
<td>
<input type="radio" id="<?php echo $this->get_field_id('acceptWidget0'); ?>" name="<?php echo $this->get_field_name('acceptWidget'); ?>" value="0" checked>
</td>
<td>
<label for="<?php echo $this->get_field_id('acceptWidget0'); ?>" >Disable</label>
</td>
</tr>
</table>
</div>
<?php
}
else
{
?>

<div id="horoscopeWidgetConfiguration">
		<p>The following are <b>optional</b> options for Horoscope Widget appearance.<br/>
		The color value are color number (like: 51B4EE), if a color value is empty then the appropriate color of the site theme will be used.<br/>
		</p>
		<input id="<?php echo $this->get_field_id('acceptWidget'); ?>" name="<?php echo $this->get_field_name('acceptWidget'); ?>" type="hidden" value="1" />
		
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
			
		<p><?php _e('Icons Style:'); ?>
		<table cellpadding="3px">
		<tr>
		<td>
		<input type="radio" name="<?php echo $this->get_field_name('imageSet'); ?>" value="1" <?php if ($imageSet == '1') echo 'checked'; ?>>
		</td>
		<td>
		<img src="<?php echo get_bloginfo ('wpurl'); ?>/wp-content/plugins/horoscope-plugin-widget/images1/taurus.png" border=0><br>
		</td>
		<td>
		<input type="radio" name="<?php echo $this->get_field_name('imageSet'); ?>" value="2" <?php if ($imageSet == '2') echo 'checked'; ?>>
		</td>
		<td>
		<img src="<?php echo get_bloginfo ('wpurl'); ?>/wp-content/plugins/horoscope-plugin-widget/images2/taurus.png" border=0><br>
		</td>
		<td>
		<input type="radio" name="<?php echo $this->get_field_name('imageSet'); ?>" value="3" <?php if ($imageSet == '3') echo 'checked'; ?>>
		</td>
		<td>
		<img src="<?php echo get_bloginfo ('wpurl'); ?>/wp-content/plugins/horoscope-plugin-widget/images3/taurus.png" border=0><br>
		</td>
		</tr>
		<tr>
		<td>
		<input type="radio" name="<?php echo $this->get_field_name('imageSet'); ?>" value="4" <?php if ($imageSet == '4') echo 'checked'; ?>>
		</td>
		<td>
		<img src="<?php echo get_bloginfo ('wpurl'); ?>/wp-content/plugins/horoscope-plugin-widget/images4/taurus.png" border=0><br>
		</td>
		<td>
		<input type="radio" name="<?php echo $this->get_field_name('imageSet'); ?>" value="5" <?php if ($imageSet == '5') echo 'checked'; ?>>
		</td>
		<td>
		<img src="<?php echo get_bloginfo ('wpurl'); ?>/wp-content/plugins/horoscope-plugin-widget/images5/taurus.png" border=0><br>
		</td>
		<td></td>
		<td></td>
		</tr>
		</table>
		<table>
		<td>
		<input type="radio" name="<?php echo $this->get_field_name('imageSet'); ?>" value="None" <?php if ($imageSet == 'None') echo 'checked'; ?>>
		</td>
		<td>
		<b>No Icons</b> - for smaller widget width<br>
		</td>
		<tr>
		</tr>
		</table>
		</p>
			<br/>
		
<script type="text/javascript">
function setElementValue(elementId,value)
{
	document.getElementById(elementId).value = value;
}
</script>
			
			<p><label for="<?php echo $this->get_field_id('backgroundColor'); ?>"><?php _e('Background Color (like: 51B4EE):'); ?> <input class="widefat" id="<?php echo $this->get_field_id('backgroundColor'); ?>" name="<?php echo $this->get_field_name('backgroundColor'); ?>" type="text" value="<?php echo $backgroundColor; ?>" /></label>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('backgroundColor'); ?>',''); return false;">clear it</a> - for site theme style<br/>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('backgroundColor'); ?>','000000'); return false;"><font color="#000000">&#9608;&#9608;</font></a>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('backgroundColor'); ?>','808080'); return false;"><font color="#808080">&#9608;&#9608;</font></a>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('backgroundColor'); ?>','FF0000'); return false;"><font color="#ff0000">&#9608;&#9608;</font></a>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('backgroundColor'); ?>','FFFFFF'); return false;"><font color="#ffffff">&#9608;&#9608;</font></a>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('backgroundColor'); ?>','FFFF00'); return false;"><font color="#ffff00">&#9608;&#9608;</font></a>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('backgroundColor'); ?>','00FF00'); return false;"><font color="#00ff00">&#9608;&#9608;</font></a>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('backgroundColor'); ?>','00FFFF'); return false;"><font color="#00ffff">&#9608;&#9608;</font></a>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('backgroundColor'); ?>','0000FF'); return false;"><font color="#0000ff">&#9608;&#9608;</font></a>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('backgroundColor'); ?>','FFFF80'); return false;"><font color="#ffff80">&#9608;&#9608;</font></a>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('backgroundColor'); ?>','FF00FF'); return false;"><font color="#ff00ff">&#9608;&#9608;</font></a>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('backgroundColor'); ?>','00FF80'); return false;"><font color="#00ff80">&#9608;&#9608;</font></a>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('backgroundColor'); ?>','80FFFF'); return false;"><font color="#80ffff">&#9608;&#9608;</font></a>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('backgroundColor'); ?>','8080FF'); return false;"><font color="#8080ff">&#9608;&#9608;</font></a>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('backgroundColor'); ?>','FF0080'); return false;"><font color="#ff0080">&#9608;&#9608;</font></a>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('backgroundColor'); ?>','8000FF'); return false;"><font color="#8000ff">&#9608;&#9608;</font></a>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('backgroundColor'); ?>','004080'); return false;"><font color="#004080">&#9608;&#9608;</font></a>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('backgroundColor'); ?>','004040'); return false;"><font color="#004040">&#9608;&#9608;</font></a>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('backgroundColor'); ?>','0080FF'); return false;"><font color="#0080ff">&#9608;&#9608;</font></a>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('backgroundColor'); ?>','804000'); return false;"><font color="#804000">&#9608;&#9608;</font></a>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('backgroundColor'); ?>','808040'); return false;"><font color="#808040">&#9608;&#9608;</font></a>
			</p>
			
			<p><label for="<?php echo $this->get_field_id('textColor'); ?>"><?php _e('Text Color (like: 51B4EE):'); ?> <input class="widefat" id="<?php echo $this->get_field_id('textColor'); ?>" name="<?php echo $this->get_field_name('textColor'); ?>" type="text" value="<?php echo $textColor; ?>" /></label>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('textColor'); ?>',''); return false;">clear it</a> - for site theme style<br/>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('textColor'); ?>','000000'); return false;"><font color="#000000">&#9608;&#9608;</font></a>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('textColor'); ?>','808080'); return false;"><font color="#808080">&#9608;&#9608;</font></a>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('textColor'); ?>','FF0000'); return false;"><font color="#ff0000">&#9608;&#9608;</font></a>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('textColor'); ?>','FFFFFF'); return false;"><font color="#ffffff">&#9608;&#9608;</font></a>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('textColor'); ?>','FFFF00'); return false;"><font color="#ffff00">&#9608;&#9608;</font></a>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('textColor'); ?>','00FF00'); return false;"><font color="#00ff00">&#9608;&#9608;</font></a>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('textColor'); ?>','00FFFF'); return false;"><font color="#00ffff">&#9608;&#9608;</font></a>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('textColor'); ?>','0000FF'); return false;"><font color="#0000ff">&#9608;&#9608;</font></a>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('textColor'); ?>','FFFF80'); return false;"><font color="#ffff80">&#9608;&#9608;</font></a>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('textColor'); ?>','FF00FF'); return false;"><font color="#ff00ff">&#9608;&#9608;</font></a>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('textColor'); ?>','00FF80'); return false;"><font color="#00ff80">&#9608;&#9608;</font></a>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('textColor'); ?>','80FFFF'); return false;"><font color="#80ffff">&#9608;&#9608;</font></a>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('textColor'); ?>','8080FF'); return false;"><font color="#8080ff">&#9608;&#9608;</font></a>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('textColor'); ?>','FF0080'); return false;"><font color="#ff0080">&#9608;&#9608;</font></a>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('textColor'); ?>','8000FF'); return false;"><font color="#8000ff">&#9608;&#9608;</font></a>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('textColor'); ?>','004080'); return false;"><font color="#004080">&#9608;&#9608;</font></a>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('textColor'); ?>','004040'); return false;"><font color="#004040">&#9608;&#9608;</font></a>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('textColor'); ?>','0080FF'); return false;"><font color="#0080ff">&#9608;&#9608;</font></a>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('textColor'); ?>','804000'); return false;"><font color="#804000">&#9608;&#9608;</font></a>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('textColor'); ?>','808040'); return false;"><font color="#808040">&#9608;&#9608;</font></a>
			</p>
			
			<p><label for="<?php echo $this->get_field_id('linkColor'); ?>"><?php _e('Link Color (like: 51B4EE):'); ?> <input class="widefat" id="<?php echo $this->get_field_id('linkColor'); ?>" name="<?php echo $this->get_field_name('linkColor'); ?>" type="text" value="<?php echo $linkColor; ?>" /></label>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('linkColor'); ?>',''); return false;">clear it</a> - for site theme style<br/>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('linkColor'); ?>','000000'); return false;"><font color="#000000">&#9608;&#9608;</font></a>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('linkColor'); ?>','808080'); return false;"><font color="#808080">&#9608;&#9608;</font></a>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('linkColor'); ?>','FF0000'); return false;"><font color="#ff0000">&#9608;&#9608;</font></a>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('linkColor'); ?>','FFFFFF'); return false;"><font color="#ffffff">&#9608;&#9608;</font></a>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('linkColor'); ?>','FFFF00'); return false;"><font color="#ffff00">&#9608;&#9608;</font></a>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('linkColor'); ?>','00FF00'); return false;"><font color="#00ff00">&#9608;&#9608;</font></a>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('linkColor'); ?>','00FFFF'); return false;"><font color="#00ffff">&#9608;&#9608;</font></a>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('linkColor'); ?>','0000FF'); return false;"><font color="#0000ff">&#9608;&#9608;</font></a>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('linkColor'); ?>','FFFF80'); return false;"><font color="#ffff80">&#9608;&#9608;</font></a>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('linkColor'); ?>','FF00FF'); return false;"><font color="#ff00ff">&#9608;&#9608;</font></a>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('linkColor'); ?>','00FF80'); return false;"><font color="#00ff80">&#9608;&#9608;</font></a>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('linkColor'); ?>','80FFFF'); return false;"><font color="#80ffff">&#9608;&#9608;</font></a>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('linkColor'); ?>','8080FF'); return false;"><font color="#8080ff">&#9608;&#9608;</font></a>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('linkColor'); ?>','FF0080'); return false;"><font color="#ff0080">&#9608;&#9608;</font></a>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('linkColor'); ?>','8000FF'); return false;"><font color="#8000ff">&#9608;&#9608;</font></a>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('linkColor'); ?>','004080'); return false;"><font color="#004080">&#9608;&#9608;</font></a>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('linkColor'); ?>','004040'); return false;"><font color="#004040">&#9608;&#9608;</font></a>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('linkColor'); ?>','0080FF'); return false;"><font color="#0080ff">&#9608;&#9608;</font></a>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('linkColor'); ?>','804000'); return false;"><font color="#804000">&#9608;&#9608;</font></a>
			<a href="#" onclick="javascript:setElementValue('<?php echo $this->get_field_id('linkColor'); ?>','808040'); return false;"><font color="#808040">&#9608;&#9608;</font></a>
			</p>
			
</div>	
        <?php 
}
    }

}


add_action( 'widgets_init', 'horoscope_widget_init' );
function horoscope_widget_init() {
	register_widget('HoroscopeWidget');
}

?>