<?php
const VERSION_CSS = 'a1';
const VERSION_JS = 'a1';
function vCSS(){ if(empty(VERSION_CSS)){ return null; } return '?'.VERSION_CSS;}
function vJS(){ if(empty(VERSION_JS)){ return null; } return '?'.VERSION_JS;}
?>