<?php

class XLSExporter {
    
    private $_filename;
    
    public function __construct($filename = "file") 
    {
        $this->_filename = $filename;
    }
    
    private function xlsBOF()
    {
        echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);
    }
    
    private function xlsEOF()
    {
        echo pack("ss", 0x0A, 0x00);
    }
    
    private function writeNumber($row, $col, $value)
    {
        echo pack("sssss", 0x203, 14, $row, $col, 0x0);
        echo pack("d", $value);
    }
    
    private function writeLabel($row, $col, $value)
    {
        $l = strlen($value);
        echo pack("ssssss", 0x204, 8 + $l, $row, $col, 0x0, $l);
        echo $value;
    }
    
    public function build($values = array())
    {
        if (empty($values)) return;
        $rows_count = count($values);
        $cols_count = count($values[0]);
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $this->_filename . ".xls");
        header("Content-Transfer-Encoding: binary");
        
        $this->xlsBOF();
        for ($i = 0; $i < $rows_count; $i++) {
            for ($j = 0; $j < $cols_count; $j++) {
                $this->writeLabel($i, $j, $values[$i][$j]);
            }
        }
        $this->xlsEOF();
    }
    
}
?>
