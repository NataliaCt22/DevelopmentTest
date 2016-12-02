<?php

use App\Convert;

class ConvertWordsNumbersTests extends TestCase
{
    public function testConvertWordNumber()
    {
      $convert = new Convert;
      
      $this->assertTrue(
        $convert->convertWordsNumber('one billion, four hundred eighty-one thousand, six hundred forty-one')>0,
        True
      );

      $this->assertFalse(
        $convert->convertWordsNumber('SSSSSSS ')>0,
        'zero'
      );

      $this->assertTrue(
        $convert->convertWordsNumber(' oNE Million ')>0,
        True
      );

      $this->assertTrue(
        $convert->convertWordsNumber('two')>0,
        True
      );

      $this->assertFalse(
        $convert->convertWordsNumber('')>0,
        'zero'
      );

      $this->assertFalse(
        $convert->convertWordsNumber('1234246')>0,
        'zero'
      );

      $this->assertTrue(
        $convert->convertWordsNumber(' ONE HUNDRED')>0,
        True
      );
    }
}