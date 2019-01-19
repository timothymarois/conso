<?php namespace Conso;

/**
 * 
 * @author    <contact@lotfio.net>
 * @package   Conso PHP Console Creator
 * @version   0.1.0
 * @license   MIT
 * @category  CLI
 * @copyright 2019 Lotfio Lakehal
 */

use Conso\Contracts\InputInterface;
use Conso\Contracts\OutputInterface;
use Conso\Contracts\CommandInterface;

class Command implements CommandInterface
{
    /**
     * inout 
     *
     * @var object
     */
    protected $input;

    /**
     * output
     *
     * @var object
     */
    protected $output;

    /**
     * available commands
     *
     * @var array
     */
    public $availableCommands = [];

    /**
     * inject the nedded objects to this base command class
     * so we can use them later on the commands
     *
     * @param OutputInterface $output
     */
    public function __construct(InputInterface $input ,OutputInterface $output)
    {
        $this->output = $output;
        $this->input  = $input;

        $this->listCommands(); // list defined commands 
        $this->standardCommands(); // trigger standard commands
    }

    /**
     * bstandard commands method
     *
     * @return void
     */
    public function standardCommands()
    {
       if((@$this->input->options[0] == "-h" || @$this->input->flags[0] == "--help")){ 
           
            if(method_exists(static::class, 'help')){ $this->output->helpMessage(static::class, static::help());}
        } 

       if((@$this->input->options[0] == "-v" || @$this->input->flags[0] == "--version")){ 

            die(
                $this->output->writeLn(static::version())
            );
        }

        if((@$this->input->options[0] == "-q" || @$this->input->flags[0] == "--quiet")){ 

            die(
                //$this->output->writeLn(static::version())
            );
        }
    }



    /**
     * list all commands with there description
     * 
     * TODO
     * This method needs to be checkd since we are directly calling 
     * static in a none static method
     * @return void
     */
    public function listCommands()
    {
        foreach (glob(COMMANDS . "*.php") as $commandFile) { // get all commands from Commands Dir

            $class = explode('/', str_replace(".php", NULL, $commandFile));
            $class = $class[count($class) - 1];

            $command = "Conso\\Commands\\" . ucfirst($class);

            if(class_exists($command))
            {
                $comm = new \ReflectionClass($command);

                $comm->hasMethod('description')  // if has description
                ? $this->availableCommands[strtolower($class)] = $command::description() // call
                : $this->availableCommands[strtolower($class)] = ""; // else

            }
        }
        return $this->availableCommands;
    }

    /**
     * display available commands
     *
     * @return void
     */
    public function displayAvailableCommands()
    {
        $i = 0;
        $this->output->writeLn("Available commands :\n\n", "yellow");
        foreach ($this->availableCommands as $command => $description) {
           
            $this->output->writeLn("  $command", "green");
            $this->output->whiteSpace($this->commandWhiteSpaceLength($i));
            $this->output->writeLn("$description\n");
            $i++;
        }
    }

    /**
     * get command line white space lenghth
     * this method helps to display commands
     * in a table way like
     *
     * @param [type] $key
     * @return void
     */
    public function commandWhiteSpaceLength($key)
    {
        $keys    = array_map('strlen', array_keys($this->availableCommands));
        $max     = max($keys);
        $keys    = array_map(function($elem)use($max){
            return $max - $elem + 5; // + desired number of white spaces
        }, $keys);
        return $keys[$key];
    }

}