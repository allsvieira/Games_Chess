<?php

/**
 * API Unit tests for Games_Chess package.
 * 
 * @version    $Id$
 * @author     Laurent Laville <pear@laurent-laville.org> portions from HTML_CSS
 * @author     Greg Beaver
 * @package    Games_Chess
 */

/**
 * @package Games_Chess
 */

class Games_Chess_TestCase_getPieceTypes extends PHPUnit_TestCase
{
    /**
     * A Games_Chess_Standard object
     * @var        object
     */
    var $board;

    function Games_Chess_TestCase_getPieceTypes($name)
    {
        $this->PHPUnit_TestCase($name);
    }

    function setUp()
    {
        error_reporting(E_ALL);
        $this->errorOccured = false;
        set_error_handler(array(&$this, 'errorHandler'));

        $this->board = new Games_Chess_Standard();
        $this->board->blankBoard();
    }

    function tearDown()
    {
        unset($this->board);
    }

    function _stripWhitespace($str)
    {
        return preg_replace('/\\s+/', '', $str);
    }

    function _methodExists($name) 
    {
        if (in_array(strtolower($name), get_class_methods($this->board))) {
            return true;
        }
        $this->assertTrue(false, 'method '. $name . ' not implemented in ' . get_class($this->board));
        return false;
    }

    function errorHandler($errno, $errstr, $errfile, $errline) {
        //die("$errstr in $errfile at line $errline: $errstr");
        $this->errorOccured = true;
        $this->assertTrue(false, "$errstr at line $errline, $errfile");
    }
    
    function test1()
    {
        if (!$this->_methodExists('_getPieceTypes')) {
            return;
        }
        if (!$this->_methodExists('blankBoard')) {
            return;
        }
        if (!$this->_methodExists('addPiece')) {
            return;
        }
        $this->board->blankboard();
        $this->board->addPiece('W', 'B', 'a1');
        $this->board->addPiece('W', 'B', 'a2');
        $this->board->addPiece('W', 'P', 'a3');
        $err = $this->board->_getPieceTypes();
        $this->assertEquals(
            array(
                'B' => array(),
                'W' => array(
                         'B' => array('B', 'W'),
                         'P' => array('B')
                       )
            ),
            $err, 'wrong pieces');
    }
}

?>