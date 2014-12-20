<?
$mod_name="autossh";
$mod_version="1.1";
$mod_path="/usr/share/fruitywifi/www/modules/$mod_name";
$mod_logs="$log_path/$mod_name.log"; 
$mod_logs_history="$mod_path/includes/logs/";
$mod_logs_panel="disabled";
$mod_panel="show";
$mod_isup="ps auxww | grep $mod_name | grep -v -e 'grep $mod_name'";
$mod_alias="AutoSSH";
# EXEC
$bin_danger = "/usr/share/fruitywifi/bin/danger";
$bin_sudo = "/usr/bin/sudo";
$bin_sh = "/bin/sh";
$bin_echo = "/bin_echo";
$bin_tcpdump = "/usr/sbin/tcpdump";
$bin_killall = "/usr/bin/killall";
$bin_cp = "/bin/cp";
$bin_chmod = "/bin/chmod";
$bin_sed = "/bin/sed";
$bin_rm = "/bin/rm";
$bin_autossh = "/usr/bin/autossh";
$bin_ssh_keygen = "/usr/bin/ssh-keygen";
?>
