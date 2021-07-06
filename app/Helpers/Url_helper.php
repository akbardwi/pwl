<?php
function render_page($dirTheme, $content, $data = NULL){
	echo view($dirTheme.'/'.$content, $data);
}
function render_content($dirTheme, $content, $data = NULL){
	echo view($dirTheme.'/'.$content, $data);
}
?>