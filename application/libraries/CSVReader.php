<?php
	class CSVReader {

		var $fields;            /** columns names retrieved after parsing */ 
		var $separator = ',';    /** separator used to explode each line */
		var $enclosure = '"';    /** enclosure used to decorate each field */

		var $max_row_size = 0;    /** maximum row size to be used for decoding */

		function parse_file($p_Filepath) {
			$file = fopen($p_Filepath, 'r');
			$this->fields = fgetcsv($file, $this->max_row_size, $this->separator, $this->enclosure);
			
			//$keys_values = explode(',',$this->fields[0]);
			$keys_values = $this->fields;
			
			$content =  array();
			$keys    =  $this->escape_string($keys_values);
			
			$i  =   1;
			while( ($row = fgetcsv($file, $this->max_row_size, $this->separator, $this->enclosure)) != false ) {            
				if( $row != null ) { // skip empty lines
					//$values = explode(',',$row[0]);
					//$values = $row[0];
					$values = $row;
					
					if(count($keys) == count($values)){
						$arr    =   array();
						$new_values =   array();
						$new_values =   $this->escape_string($values);
						for($j=0;$j<count($keys);$j++){
							if($keys[$j] != ""){
								$arr[$keys[$j]] =   $new_values[$j];
							}
						}
						$content[$i]=   $arr;
						$i++;
					}
				}
			}
			fclose($file);
			return $content;
		}

		function escape_string($data){
			$result =   array();
			foreach($data as $row){
				$result[]   =   str_replace('"', '',$row);
			}
			return $result;
		}   
	}
?>