<?php

class FormatData{

    public static function formatarData($data){
        return date("d/m/Y", strtotime($data));
    }
}
?>