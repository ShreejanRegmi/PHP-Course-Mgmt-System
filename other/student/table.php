<?php
class Table{
	public $groupProjectTable;

	function __construct($groupProjectTable){
		$this->groupProjectTable = $groupProjectTable;
	}

	function groupProjectSave($groupProjectRecord, $groupProjectpk = ''){
	    try{
	        $this->groupProjectInsert($groupProjectRecord);
	    }
	    catch(Exception $groupProjecte){
	        $this->groupProjectUpdate($groupProjectRecord, $groupProjectpk);
	    }
	}
	function countAll(){
		global $pdo;
		$gpstmt =$pdo->prepare('SELECT count(*) FROM '.$this->groupProjectTable);
		$gpstmt->execute();
		$count=$gpstmt->fetchColumn();
		return $count;
	}
	function countSpecific($groupProjectField, $groupProjectValue){
		global $pdo;
		$gpstmt =$pdo->prepare('SELECT count(*) FROM '.$this->groupProjectTable.'WHERE'.$groupProjectField.'=:groupProjectValue');
		$groupProjectCriteria =['groupProjectValue' => $groupProjectValue];
		$gpstmt->execute($groupProjectCriteria);
		$count=$gpstmt->fetchColumn();
		return $count;
	}



	function groupProjectInsert($groupProjectRecord) {
	    global $pdo;
	    $groupProjectKeys = array_keys($groupProjectRecord);
	    $groupProjectValues = implode(', ', $groupProjectKeys);
	    $groupProjectValuesWithColon = implode(', :', $groupProjectKeys);
	    $groupProjectQuery = 'INSERT INTO '.$this->groupProjectTable.'('.$groupProjectValues.') VALUE(:'.$groupProjectValuesWithColon.')';
	    $groupProjectStmt = $pdo->prepare($groupProjectQuery);
	    $groupProjectStmt->execute($groupProjectRecord);
	}

	function groupProjectUpdate($groupProjectRecord, $groupProjectpk) {
	    global $pdo;
	    $groupProjectParameters = [];
	    foreach ($groupProjectRecord as $groupProjectKey => $groupProjectValue) {
	        $groupProjectParameters[] = $groupProjectKey . '= :'  . $groupProjectKey;
	    }
	    $groupProjectParametersWithComma = implode(', ', $groupProjectParameters);
	    $groupProjectQuery = "UPDATE $this->groupProjectTable SET $groupProjectParametersWithComma WHERE $groupProjectpk = :groupProjectpk";
	    $groupProjectRecord['groupProjectpk'] = $groupProjectRecord[$groupProjectpk];
	    $groupProjectStmt = $pdo->prepare($groupProjectQuery);
	    $groupProjectStmt->execute($groupProjectRecord);
	}

	function groupProjectFind($groupProjectField, $groupProjectValue) {
	    global $pdo;
	    $groupProjectStmt = $pdo->prepare('SELECT * FROM '.$this->groupProjectTable.' WHERE '.$groupProjectField.'=:groupProjectValue');
	    $groupProjectCriteria = [
	            'groupProjectValue' => $groupProjectValue
	    ];
	    $groupProjectStmt->execute($groupProjectCriteria);
	    return $groupProjectStmt;
	}

	function groupProjectFindAll() {
	    global $pdo;
	    $groupProjectStmt = $pdo->prepare('SELECT * FROM ' . $this->groupProjectTable);
	    $groupProjectStmt->execute();
	    return $groupProjectStmt;
	}

	function groupProjectDelete($groupProjectField, $groupProjectValue){
	    global $pdo;
	    $groupProjectStmt = $pdo->prepare("DELETE FROM $this->groupProjectTable WHERE $groupProjectField = :groupProjectpk");
	    $criteria = [
	        'groupProjectpk' => $groupProjectValue
	    ];
	    $groupProjectStmt->execute($groupProjectCriteria);
	    return $groupProjectStmt;
	}
}