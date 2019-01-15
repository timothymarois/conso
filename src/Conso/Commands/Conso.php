<?php namespace Conso\Commands;

/**
 * 
 * @author    <contact@lotfio.net>
 * @package   Conso PHP Console Creator
 * @version   0.1.0
 * @license   MIT
 * @category  CLI
 * @copyright 2019 Lotfio Lakehal
 */

use Conso\Command;

class Conso extends Command
{

    public function capture($options, $flags) // play around with your captured inputs here
    {
    }

    public function execute($action) // execute your actions here and pass your flags
    {
        $this->logo();
        $this->basicInfo();
        $this->displayAvailableCommands(); // from parent
    }


    public function logo()
    {
        $this->output->writeLn("     ,gggg,                                                  
   ,88\"\"\"Y8b,                                                
  d8\"     `Y8                                                
 d8'   8b  d8                                                
,8I    \"Y88P'                                                
I8'            ,ggggg,    ,ggg,,ggg,     ,g,       ,ggggg,   
d8            dP\"  \"Y8ggg,8\" \"8P\" \"8,   ,8'8,     dP\"  \"Y8ggg
Y8,          i8'    ,8I  I8   8I   8I  ,8'  Yb   i8'    ,8I  
`Yba,,_____,,d8,   ,d8' ,dP   8I   Yb,,8'_   8) ,d8,   ,d8'  
  `\"Y8888888P\"Y8888P\"   8P'   8I   `Y8P' \"YY8P8PP\"Y8888P\"    \n 
");
    }

    public function basicInfo()
    {
        $this->output->writeLn(APP_NAME, 'yellow','black', 1);
        $this->output->writeLn(" version ".APP_VERSION);
        $this->output->writeLn(" " .APP_RELEASE_DATE."\n\n", "green");
        $this->output->writeLn("Usage :\n\n", 'yellow');
        $this->output->writeLn("  command:subcommand [options] [flags] \n\n");
        $this->output->writeLn("Options, flags :\n\n", 'yellow');
        $this->optionsAndFlags("-h, --help", " Display this help message");
        $this->optionsAndFlags("-q, --quiet", "Do not output any message\n");
    }

    public function optionsAndFlags($options, $message)
    {
        $this->output->writeLn("  $options", 'green');
        $this->output->writeLn("       ");
        $this->output->writeLn("$message\n");
    }
}