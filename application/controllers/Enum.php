<?php defined('BASEPATH') or exit('No direct script access allowed');
require BASE;
class Enum extends Base {
   
    function programs(){
        $arrPrograms = [
            array("display"=>"intrains", "store"=>"intrains"),
            array("display"=>"sgmmdlyt", "store"=>"sgmmdlyt")
        ];
        $this->output->set_output(json_encode($arrPrograms));
    }

    function timestamps(){
        $arrPrograms = [
            array("display"=>"1 Day", "store"=>"1"),
            array("display"=>"2 Days", "store"=>"2"),
            array("display"=>"3 Days", "store"=>"3"),
            array("display"=>"4 Days", "store"=>"4"),
            array("display"=>"5 Days", "store"=>"5"),
            array("display"=>"6 Days", "store"=>"6"),
            array("display"=>"7 Days", "store"=>"7")
        ];
        $this->output->set_output(json_encode($arrPrograms));
    }
}