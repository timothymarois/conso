<?php namespace Conso\Contracts;

/**
 * 
 * @author    <contact@lotfio.net>
 * @package   Conso PHP Console Creator
 * @version   0.1.0
 * @license   MIT
 * @category  CLI
 * @copyright 2019 Lotfio Lakehal
 */

interface OutputInterface
{ 
    /**
     * write line method
     *
     * @param string $line
     * @param string $color
     * @param string $bg
     * @param integer $bold
     * @return void
     */
    public function writeLn(string $line, string $color, string $backgrounf, int $bold);
}