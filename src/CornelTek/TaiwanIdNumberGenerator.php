<?php
namespace CornelTek;

class TaiwanIdNumberGenerator
{
    public $sex = array( 
        "male" => 1,
        "female" => 2,
    );

    public $cities = array(
        "臺北市" => "10A",
        "臺中市" => "11B",
        "基隆市" => "12C",
        "臺南市" => "13D",
        "高雄市" => "14E",
        "臺北縣" => "15F",
        "宜蘭縣" => "16G",
        "桃園縣" => "17H",
        "新竹縣" => "18J",
        "苗栗縣" => "19K",
        "臺中縣" => "20L",
        "南投縣" => "21M",
        "彰化縣" => "22N",
        "雲林縣" => "23P",
        "嘉義縣" => "24Q",
        "臺南縣" => "25R",
        "高雄縣" => "26S",
        "屏東縣" => "27T",
        "花蓮縣" => "28U",
        "臺東縣" => "29V",
        "澎湖縣" => "30X",
        "陽明山" => "31Y",
        "金門縣" => "32W",
        "連江縣" => "33Z",
        "新竹市" => "35O",
        "嘉義市" => "34I",
    );

    private $_generated = array();

    public function newRandomSerialNumber() {
        return substr(strval(mt_rand()), 0, 7);
    }

    public function calculateSerialChecksum($serial)
    {
        $sum = 0;
        $len = strlen($serial);
        for ( $i = 0 ; $i < $len ; $i++ ) {
            $c = $serial[$i];
            $sum += (7-$i) * intval($c);
        }
        return $sum;
    }

    public function calculateCityChecksum($cityCode)
    {
        return intval(substr($cityCode,0,1)) + intval(substr($cityCode,1,1)) * 9;
    }

    public function calculateSexChecksum($sex) {
        return $sex * 8;
    }

    public function calculateChecksum($cityCode,$sex,$serial)
    {
        $ret = $this->calculateCityChecksum($cityCode) + $this->calculateSexChecksum($sex) + $this->calculateSerialChecksum($serial);
        return (10 - ($ret % 10)) % 10;
    }

    public function generate($cityCode = null, $sex = null, $serial = null) {

        if ( ! $cityCode ) {
            $cityName = array_rand($this->cities,1);
            $cityCode = $this->cities[ $cityName ];
        }

        if ( ! $sex ) {
            $sex = mt_rand(1,2);
        }

        if ( ! $serial ) {
            $serial = $this->newRandomSerialNumber();
        }

        $sum = $this->calculateChecksum($cityCode, $sex, $serial);
        return substr($cityCode,2,1) . strval($sex) . strval($serial) . strval($sum);
    }

    public function generateUnique($cityCode = null, $sex = null, $serial = null) {
        $idNumber = $this->generate($cityCode, $sex, $serial);
        if ( isset($this->_generated[ $idNumber ]) ) {
            // generate new
            return $this->generateUnique($cityCode, $sex);
        }
        $this->_generated[ $idNumber ] = true;
        return $idNumber;
    }
}


