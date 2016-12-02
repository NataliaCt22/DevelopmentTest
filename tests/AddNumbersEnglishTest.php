<?php


class AddNumbersEnglishTest extends TestCase
{
    public function testAddNumbersEnglish()
    {
      $this->visit('/')
       ->type('one million, four hundred eighty-one thousand, six hundred forty-one', 'numberOne')
       ->type('seven hundred fifty thousand, two hundred', 'numberTwo')
       ->press('Go')
       ->seePageIs('/add');
      
      $this->visit('/')
       ->type('', 'numberOne')
       ->type('seven hundred fifty thousand, two hundred', 'numberTwo')
       ->press('Go')
       ->seePageIs('/add'); 

      $this->visit('/')
       ->type('asdfsdfsdfsd', 'numberOne')
       ->type('7894321', 'numberTwo')
       ->press('Go')
       ->seePageIs('/add'); 

      $this->visit('/')
       ->type('ONE HUNDRED FIFTY', 'numberOne')
       ->type('TWO THOUSAND, FIVE HUNDRED', 'numberTwo')
       ->press('Go')
       ->seePageIs('/add');  

      $this->visit('/')
       ->type('oNE Millon', 'numberOne')
       ->type('two hunDred', 'numberTwo')
       ->press('Go')
       ->seePageIs('/add'); 
    }
}