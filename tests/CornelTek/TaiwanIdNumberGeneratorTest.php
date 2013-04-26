<?php

class TaiwanIdNumberGeneratorTest extends PHPUnit_Framework_TestCase
{


    public function test() {
        $generator = new CornelTek\TaiwanIdNumberGenerator;
        ok($generator->generate('台北市'));
    }

    public function testUnique()
    {
        $generator = new CornelTek\TaiwanIdNumberGenerator;
        foreach( range(1,10) as $i ) {
            $idNumber = $generator->generateUnique();
            ok($idNumber);
        }
    }
}

