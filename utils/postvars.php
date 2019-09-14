<?
function postvars() {
    foreach(func_get_args() as $var) {
        if(!isset($_POST[$var]) || $_POST[$var] === '') return false;
    }
    return true;
}
?>