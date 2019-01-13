<?php
/**
 * Created by PhpStorm.
 * User: mohmd
 * Date: 04/01/2019
 */

namespace App\console;

use App\classes\DataBase;

class AppInstall
{

    /*
     * install app
     */
    public function handle($version)
    {
        // connect to db
        $db = new DataBase();
        $conn = $db->connect();
        // migrate the database version
        foreach ($version as $command) {
            foreach ($command['sql'] as $sql) {
                if ($conn->query($sql) === TRUE)
                    echo $command['msg'] . "\n";
                else
                    echo "Error creating table: " . $conn->error;
            }
        }

        //message
        $message = [
            ".=========================================.",
            "                ,@@@@@@@,                  ",
            "        ,,,.   ,@@@@@@/@@,  .oo888o.      ",
            "      ,%%&%&&%,@@@@@/@@@@@@,8888\88/8     ",
            "     ,&%8                         8/8o     ",
            "    ,%&\  Created By Mohamad Asli  /88'    ",
            "    %&&%8                         8888'    ",
            "    %&&%/ %&%%&&@@\ V /@@' `88\8 `/88'     ",
            "    `&%\ ` /%&'    |.|        \ '|8'       ",
            "        |o|        | |         | |         ",
            "        |.|        | |         | |         ",
            "",
        ];
        foreach ($message as $msg) {
            echo "$msg \n";
        }
        return "`========= INSTALLATION COMPLETE ========='";
    }
}