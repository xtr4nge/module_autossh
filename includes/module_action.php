<? 
/*
    Copyright (C) 2013-2014 xtr4nge [_AT_] gmail.com

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/ 
?>
<?
//include "../login_check.php";
include "../../../config/config.php";
include "../_info_.php";
include "../../../functions.php";

include "options_config.php";

// Checking POST & GET variables...
if ($regex == 1) {
    regex_standard($_GET["service"], "../msg.php", $regex_extra);
    regex_standard($_GET["action"], "../msg.php", $regex_extra);
    regex_standard($_GET["page"], "../msg.php", $regex_extra);
    regex_standard($io_action, "../msg.php", $regex_extra);
    regex_standard($_GET["install"], "../msg.php", $regex_extra);
    regex_standard($_POST["ssh_cert"], "../msg.php", $regex_extra);
}

$service = $_GET['service'];
$action = $_GET['action'];
$page = $_GET['page'];
$install = $_GET['install'];

$ssh_cert = $_POST['ssh_cert'];

if($service != "") {
    
    if ($action == "start") {
        
        // COPY LOG
        if ( 0 < filesize( $mod_logs ) ) {
            $exec = "$bin_cp $mod_logs $mod_logs_history/".gmdate("Ymd-H-i-s").".log";
            //exec("$bin_danger \"$exec\"" ); //DEPRECATED
            exec_fruitywifi($exec);
            
            $exec = "$bin_echo '' > $mod_logs";
            //exec("$bin_danger \"$exec\"" ); //DEPRECATED
            exec_fruitywifi($exec);
        }
            
            $exec = "$bin_autossh -M 0 -o 'ServerAliveInterval 60' -o 'ServerAliveCountMax 3' -N -R $autossh_listen:localhost:$autossh_port $autossh_user@$autossh_host -i id_rsa > /dev/null &";
            //exec("$bin_danger \"$exec\"" ); //DEPRECATED
            exec_fruitywifi($exec);
        
    } else if($action == "stop") {
        // STOP MODULE
        $exec = "$bin_killall $mod_name";
        //exec("$bin_danger \"$exec\"" ); //DEPRECATED
        exec_fruitywifi($exec);
        
        // COPY LOG
        if ( 0 < filesize( $mod_logs ) ) {
            $exec = "$bin_cp $mod_logs $mod_logs_history/".gmdate("Ymd-H-i-s").".log";
            //exec("$bin_danger \"$exec\"" ); //DEPRECATED
            exec_fruitywifi($exec);
            
            $exec = "$bin_echo '' > $mod_logs";
            //exec("$bin_danger \"$exec\"" ); //DEPRECATED
            exec_fruitywifi($exec);
        }

    }

}

if ($ssh_cert == "gen_certificate") {
    $exec = "$bin_rm id_rsa";
    //exec("$bin_danger \"$exec\"" ); //DEPRECATED
    exec_fruitywifi($exec);
    
    $exec = "$bin_rm id_rsa.pub";
    //exec("$bin_danger \"$exec\"" ); //DEPRECATED
    exec_fruitywifi($exec);
    
    $exec = "$bin_ssh_keygen -t rsa -f id_rsa -C @FruityWifi";
    //exec("$bin_danger \"$exec\"" ); //DEPRECATED
    exec_fruitywifi($exec);
    
    header('Location: ../index.php');
    exit;
}

if ($install == "install_$mod_name") {

    $exec = "chmod 755 install.sh";
    //exec("$bin_danger \"$exec\"" ); //DEPRECATED
    exec_fruitywifi($exec);

    $exec = "$bin_sudo ./install.sh > $log_path/install.txt &";
    //exec("$bin_danger \"$exec\"" ); //DEPRECATED
    exec_fruitywifi($exec);

    header('Location: ../../install.php?module='.$mod_name);
    exit;
}

if ($page == "status") {
    header('Location: ../../../action.php');
} else {
    header('Location: ../../action.php?page='.$mod_name);
}

?>
