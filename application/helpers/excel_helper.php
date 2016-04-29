<?php
	function save_excel($obj,$data,$title,$totals){
			$obj->load->library('excel');
			$obj->excel->setActiveSheetIndex(0);
			$obj->excel->getActiveSheet()->setTitle($title);
			foreach($data as $e){
				$i='A';
				$k=1;
				foreach(array_keys(get_object_vars($e)) as $col){
					$obj->excel->getActiveSheet()->setCellValue($i.$k, $col);
					$i++;
				}
				break;
			}
			$k=2;
			foreach($data as $e){
				$i='A';
				foreach(array_values(get_object_vars($e)) as $col){
					$obj->excel->getActiveSheet()->setCellValue($i.$k, $col);
					$i++;
				}
				$k++;
			}
			foreach($totals as $key=>$value){
			$i='A';
				$obj->excel->getActiveSheet()->setCellValue($i.$k, "Total");
				for($temp=1;$temp<$key;$temp++){
					$i++;
				}
				$obj->excel->getActiveSheet()->setCellValue($i.$k, $value);
			}
			$lastColumn = $obj->excel->getActiveSheet()->getHighestColumn();
			$obj->excel->getActiveSheet()->getStyle("A1:$lastColumn"."1")->getFont()->setBold(true);
			$obj->excel->getActiveSheet()->getStyle("A$k:$lastColumn$k")->getFont()->setBold(true);

			$filename=str_replace(" ","_",$data[0]->Production).'_'.strtolower($title).'_'.date("d-M-Y_H-i").'.xls'; //save our workbook as obj file name
			header('Content-Type: application/vnd.ms-excel'); //mime type
			header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
			header('Cache-Control: max-age=0'); //no cache
						 
			$objWriter = PHPExcel_IOFactory::createWriter($obj->excel, 'Excel5');  
			$objWriter->save('php://output');
	}
?>