<?php
function hz_decode($s) {
	$len = strlen($s);
	$buf = '';
	$hz_mode = 0;
	for ($i=0;$i<$len;$i++) {
		if ($s[$i] == '~') {
			if ($i + 1 < $len) {
				switch ($s[$i+1]) {
					case '~':
						$buf += '~';
						break;
					case '{':
						$hz_mode = 128;
						break;
					case '}':
						$hz_mode = 0;
						break;
					default:
				}
				$i += 1;
			}
		}
		else $buf .= chr(ord($s[$i]) ^ $hz_mode);
	}
	return iconv('gb2312','utf-8',$buf);
}
?>
