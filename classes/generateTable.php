<?php 
class createTable{ //class name is defined

public $headers; //headers/headings for table columns
public $values=[]; //row values 

public function setHeaders($headers){  //takes the list of headings into an array
    $this->headers=$headers;
}
public function addValues($values){//into the row values
$this->values[]=$values;
}

public function getValues(){
$tab='<table>';  //table is created
$tab.='<tr>';
        $tab.='<thead>'; //thead started
			foreach ($this->headers as $headers) { 
                //each heading/topic is displayed
				$tab .= '<th>'.$headers.'</th>';
            }
            $tab.='</thead>';
            $tab.='</tr>';
            $tab.='<tbody>'; //tbody started
		foreach ($this->values as $values) {
          
            $tab.='<tr>';
					foreach ($values as $key => $value) {
                                //values are properly assigned to particular row and column
                        $tab.= '<td>'.$value.'</td>';	
						
					}
                    $tab.= '</tr>';	
                
            }
            $tab.='</tbody>';
		$tab.= '</table>'; 
		return $tab;	
}

}
?>

 <style>
table{
border:1px solid #ccc;
width:100%; 

}


thead th{
text-align:center;
background-color:#004c4c; 
padding:20px;
color:#fff;
}

tbody{
    padding:10px;
}
table td {
    text-align: center;
    padding:5px;
    vertical-align: top;
    border-bottom:1px solid #ccc;
}


</style> 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 