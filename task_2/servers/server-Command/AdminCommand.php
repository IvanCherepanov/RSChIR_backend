<?php
class AdminCommand{
    const commands = ['ls', 'ps', 'whoami', 'id', 'pwd','echo %cd%'];

    public static function getAnswerCommand($command){
        $result = array();
        if (in_array($command,self::commands)==1){
            exec($command, $result);
            }
        else{
            $result="Smth wrong";
        }
        return $result;
    }

    public static function printResultArray($arr){
        foreach ($arr as $arrItem){
            echo $arrItem."</br>";
        }
    }
}
#print_r(in_array('whoami',AdminCommand::commands));
#print_r(AdminCommand::getAnswerCommand("whoami"));