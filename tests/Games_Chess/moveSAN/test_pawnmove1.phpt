--TEST--
Games_Chess->moveSAN() pawn move #1
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->_halfMoves = 6;
$board->_moveNumber = 1;
$board->_move = 'W';
$board->_enPassantSquare = 'e6';
$err = $board->addPiece('W', 'P', 'e4');
$phpunit->assertFalse(is_object($err), 'adding pawn failed');
$err = $board->moveSAN('e5');
$phpunit->assertFalse(is_object($err), 'moving pawn failed');
$phpunit->assertEquals(1, $board->_halfMoves, 'half moves did not reset');
$phpunit->assertEquals('B', $board->_move, 'move color did not increment');
$phpunit->assertEquals(1, $board->_moveNumber, 'move number changed');
$phpunit->assertEquals('-', $board->_enPassantSquare, 'en passant not reset');
echo 'tests done';
?>
--EXPECT--
tests done