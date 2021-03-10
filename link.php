<?php
$id = trim($_GET['id']);
if ($id) {
$links = json_decode(sreadfile(‘linkdata.txt’), true);
if ($links[$id]) {
$links[$id]['click']++;
swritefile(‘linkdata.txt’, json_encode($links));
header("location: {$links[$id]['url']}");
}
}
function sreadfile($filename) {
$content = ”;
if(function_exists(‘file_get_contents’)) {
@$content = file_get_contents($filename);
} else {
if(@$fp = fopen($filename, ‘r’)) {
@$content = fread($fp, filesize($filename));
@fclose($fp);
}
}
return $content;
}
function swritefile($filename, $writetext, $openmod=’w') {
if(@$fp = fopen($filename, $openmod)) {
flock($fp, 2);
fwrite($fp, $writetext);
fclose($fp);
return true;
} else {
return false;
}
}
?>