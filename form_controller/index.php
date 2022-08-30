<?php
include('../Database/config.php');
ini_set('memory_limit','2048M');
if(isset($_POST['submit_excel_file']) && $_POST['submit_excel_file'] == 'Import'){
	
	$fileName = $_FILES["upload_excel_file"]["tmp_name"];
	$row_count = 0;
	$seconds=2;

	if($_FILES["upload_excel_file"]["size"] > 0) {
        $file = fopen($fileName, "r");		// read file

        $insert_rows = "Insert INTO `Bulk_Ledger` Set";

        // loop through file data
        while (($column = fgetcsv($file, 1000, ",")) !== FALSE) {
        	//print_r($column);
        	//echo "<br/><br/>";
        	$row_count++;		// to track rows count        	

        	if($row_count > 6){			// to avoid initial details
        		if (isset($column[0])) {
	                $sr = mysqli_real_escape_string($connect, $column[0]);
	                if($sr > 0){
	                	$insert_rows .= " sr=".$sr;
	                }
	            }

	            if (isset($column[1])) {
	                $date = mysqli_real_escape_string($connect, $column[1]);
	                if($date !== ""){
	                	$insert_rows .= " date=".$date;
	                }
	            }

	            if (isset($column[2])) {
	                $academic_year = mysqli_real_escape_string($connect, $column[2]);
	                if($academic_year !== ""){
	                	$insert_rows .= " academic_year=".$academic_year;
	                }
	            }

	            if (isset($column[3])) {
	                $session = mysqli_real_escape_string($connect, $column[3]);
	                if($session !== ""){
	                	$insert_rows .= " session=".$session;
	                }
	            }

	            if (isset($column[4])) {
	                $alloted_category = mysqli_real_escape_string($connect, $column[4]);
	                if($alloted_category !== ""){
	                	$insert_rows .= " alloted_category=".$alloted_category;
	                }
	            }

	            if (isset($column[5])) {
	                $voucher_type = mysqli_real_escape_string($connect, $column[5]);
	                if($voucher_type !== ""){
	                	$insert_rows .= " voucher_type=".$voucher_type;

	                	// check if voucher_type id exists
	                	$select_entry_mode = $connect->query("SELECT entry_modename, crdr, entry_mode FROM entry_mode WHERE entry_modename='".$voucher_type."'");
	                	if($select_entry_mode && mysqli_num_rows($select_entry_mode) > 0){
	                		while($row = $select_entry_mode->fetch_assoc()) {
	                			$crdr = $row['crdr'];
	                			$entry_mode = $row['entry_mode'];
	                		}
	                	}
	                	else{
	                		$insert_entry_mode = $connect->query("Insert INTO entry_mode SET entry_modename='".$voucher_type."'");
	                		$entry_mode_id = $connect->insert_id;
	                	}
	                }
	            }

	            if (isset($column[6])) {
	                $voucher_no = mysqli_real_escape_string($connect, $column[6]);
	                if($voucher_no !== ""){
	                	$insert_rows .= " voucher_no=".$voucher_no;
	                }
	            }

	            if (isset($column[7])) {
	                $roll_no = mysqli_real_escape_string($connect, $column[7]);
	                if($roll_no !== ""){
	                	$insert_rows .= " roll_no=".$roll_no;
	                }
	            }

	            if (isset($column[8])) {
	                $asmission_no = mysqli_real_escape_string($connect, $column[8]);
	                if($asmission_no !== ""){
	                	$insert_rows .= " asmission_no=".$asmission_no;
	                }
	            }

	            if (isset($column[9])) {
	                $status = mysqli_real_escape_string($connect, $column[9]);
	                if($status !== ""){
	                	$insert_rows .= " status=".$status;
	                }
	            }

	            if (isset($column[11])) {
	                $faculty = mysqli_real_escape_string($connect, $column[11]);
	                if($faculty !== ""){
	                	$insert_rows .= " faculty=".$faculty;

	                	// check if branch id exists
	                	$select_branch = $connect->query("SELECT id FROM branches WHERE branch_name='".$faculty."'");
	                	if($select_branch && mysqli_num_rows($select_branch) > 0){
	                		while($row = $select_branch->fetch_assoc()) {
	                			$branch_id = $row['id'];
	                		}
	                	}
	                	else{
	                		$insert_branch = $connect->query("Insert INTO branches SET branch_name='".$faculty."'");
	                		$branch_id = $connect->insert_id;

	                		// adding fee collcetion types here for each branch at a time
	                		$insert_branch = $connect->query("Insert INTO fee_collection_types SET collection_head='academic', collection_head='academic', branch_id='".$branch_id."'");
	                		$insert_branch = $connect->query("Insert INTO fee_collection_types SET collection_head='academicmisc', collection_head='academicmisc', branch_id='".$branch_id."'");
	                		$insert_branch = $connect->query("Insert INTO fee_collection_types SET collection_head='hostel', collection_head='hostel', branch_id='".$branch_id."'");
	                		$insert_branch = $connect->query("Insert INTO fee_collection_types SET collection_head='hostelmisc', collection_head='hostelmisc', branch_id='".$branch_id."'");
	                		$insert_branch = $connect->query("Insert INTO fee_collection_types SET collection_head='transport', collection_head='transport', branch_id='".$branch_id."'");
	                		$insert_branch = $connect->query("Insert INTO fee_collection_types SET collection_head='transportmisc', collection_head='transportmisc', branch_id='".$branch_id."'");
	                	}
	                }
	            }

	            if (isset($column[10])) {
	                $fee_category = mysqli_real_escape_string($connect, $column[10]);
	                if($fee_category !== ""){
	                	$insert_rows .= " fee_category=".$fee_category;

	                	// check if fee category exists with same branch name
	                	$select_fee_category = $connect->query("SELECT id FROM fee_category WHERE fee_category='".$fee_category."' AND branch_id='".$branch_id."'");
	                	if($select_fee_category && mysqli_num_rows($select_fee_category) > 0){
	                		while($row = $select_fee_category->fetch_assoc()) {
	                			$fee_category_id = $row['id'];
	                		}
	                	}
	                	else{
	                		$insert_fee_category = $connect->query("Insert INTO fee_category SET fee_category='".$fee_category."', branch_id='".$branch_id."'");
	                		$fee_category_id = $connect->insert_id;
	                	}
	                }
	            }

	            if (isset($column[12])) {
	                $program = mysqli_real_escape_string($connect, $column[12]);
	                if($program !== ""){
	                	$insert_rows .= " program=".$program;
	                }
	            }

	            if (isset($column[13])) {
	                $department = mysqli_real_escape_string($connect, $column[13]);
	                if($department !== ""){
	                	$insert_rows .= " department=".$department;
	                }
	            }

	            if (isset($column[14])) {
	                $batch = mysqli_real_escape_string($connect, $column[14]);
	                if($batch !== ""){
	                	$insert_rows .= " batch=".$batch;
	                }
	            }

	            if (isset($column[15])) {
	                $receipt_no = mysqli_real_escape_string($connect, $column[15]);
	                if($receipt_no !== ""){
	                	$insert_rows .= " receipt_no=".$receipt_no;
	                }
	            }

	            if (isset($column[16])) {
	                $fee_head = mysqli_real_escape_string($connect, $column[16]);
	                if($fee_head !== ""){
	                	$insert_rows .= " fee_head=".$fee_head;

	                	// check if fees_types id exists
	                	$select_fees_types = $connect->query("SELECT id FROM fees_types WHERE fees_types='".$fee_head."'");
	                	if($select_fees_types && mysqli_num_rows($select_fees_types) > 0){
	                		while($row = $select_fees_types->fetch_assoc()) {
	                			$seq_id = $row['id'];
	                		}
	                	}
	                	else{
	                		$insert_fees_types = $connect->query("Insert INTO fees_types SET fees_types='".$fee_head."'");
	                		$seq_id = $connect->insert_id;
	                	}

	                	// check if fees_types id exists
	                	$select_fee_types = $connect->query("SELECT id FROM fee_types WHERE fee_name='".$fee_head."', branch_id='".$branch_id."'");
	                	if($select_fee_types && mysqli_num_rows($select_fee_types) > 0){
	                		while($row = $select_fee_types->fetch_assoc()) {
	                			$fee_id = $row['id'];
	                		}
	                	}
	                	else{
	                		$insert_fee_types = $connect->query("Insert INTO fee_types SET fee_category_id='".$fee_category_id."', fee_name='".$fee_head."', collection_id='0', branch_id='".$branch_id."', sequence_id='".$seq_id."', fee_ledger_type='".$fee_head."', fee_head_type='0'");
	                		$fee_id = $connect->insert_id;
	                	}
	                }
	            }

	            if (isset($column[17])) {
	                $due_amount = mysqli_real_escape_string($connect, $column[17]);
	                if($due_amount !== ""){
	                	$insert_rows .= " due_amount=".$due_amount;
	                }
	            }

	            if (isset($column[18])) {
	                $paid_amount = mysqli_real_escape_string($connect, $column[18]);
	                if($paid_amount !== ""){
	                	$insert_rows .= " paid_amount=".$paid_amount;
	                }
	            }

	            if (isset($column[19])) {
	                $consession_amount = mysqli_real_escape_string($connect, $column[19]);
	                if($consession_amount !== ""){
	                	$insert_rows .= " consession_amount=".$consession_amount;
	                }
	            }

	            if (isset($column[20])) {
	                $scholarship_amount = mysqli_real_escape_string($connect, $column[20]);
	                if($scholarship_amount !== ""){
	                	$insert_rows .= " scholarship_amount=".$scholarship_amount;
	                }
	            }

	            if (isset($column[21])) {
	                $reverse_concession = mysqli_real_escape_string($connect, $column[21]);
	                if($reverse_concession !== ""){
	                	$insert_rows .= " reverse_concession=".$reverse_concession;
	                }
	            }

	            if (isset($column[22])) {
	                $write_of_amount = mysqli_real_escape_string($connect, $column[22]);
	                if($write_of_amount !== ""){
	                	$insert_rows .= " write_of_amount=".$write_of_amount;
	                }
	            }

	            if (isset($column[23])) {
	                $adjusted_amount = mysqli_real_escape_string($connect, $column[23]);
	                if($adjusted_amount !== ""){
	                	$insert_rows .= " adjusted_amount=".$adjusted_amount;
	                }
	            }

	            if (isset($column[24])) {
	                $refund_amount = mysqli_real_escape_string($connect, $column[24]);
	                if($refund_amount !== ""){
	                	$insert_rows .= " refund_amount=".$refund_amount;
	                }
	            }

	            if (isset($column[25])) {
	                $fund_tranc_fer_amount = mysqli_real_escape_string($connect, $column[25]);
	                if($fund_tranc_fer_amount !== ""){
	                	$insert_rows .= " fund_tranc_fer_amount=".$fund_tranc_fer_amount;
	                }
	            }

	            $insertId = $connect->query($insert_rows);

	            // check if financial transaction id already exists

	            /* as there is no specific details about the unique column to be created for financial transaction, i am taking vouchar no as one. */ 
            	$select_financial_transactions = $connect->query("SELECT id, amount FROM financial_transactions WHERE voucher_no='".$voucher_no."'");
            	if($select_financial_transactions && mysqli_num_rows($select_financial_transactions) > 0){
            		while($row = $select_financial_transactions->fetch_assoc()) {
            			$financial_transactions_id = $row['id'];
            			$financial_transactions_amount = $row['amount'] + $paid_amount;

            		$update_financial_transactions = $connect->query("UPDATE financial_transactions SET amount='".$financial_transactions_amount."' WHERE voucher_no='".$voucher_no."'");
            		}
            	}
            	else{
            		$insert_financial_transactions = $connect->query("Insert INTO financial_transactions SET module_id='0', 	transactions_id='0', admission_no='".$asmission_no."', amount='".$paid_amount."', crdr='".$crdr."', transaction_date='".$date."', acad_year='".$academic_year."', entry_mode='".$entry_mode."', voucher_no='".$voucher_no."', branch_id='".$branch_id."', types_of_consession='0'");
            		$financial_transactions_id = $connect->insert_id;
            	}

            	/* financial transaction details */        	
        		$insert_financial_transactions_details = $connect->query("Insert INTO financial_transaction_details SET financial_transactions_id='".$financial_transactions_id."', module_id='0', transactions_amont='".$paid_amount."', head_id='0', crdr='".$crdr."', branch_id='".$branch_id."', head_name='".$fee_head."'");
        		$financial_transactions_id = $connect->insert_id;

        		// check if Common fee collection id already exists

	            /* as there is no specific details about the unique column to be created for Common_fee_collection, i am taking admission no as one. */ 
            	$select_common_fee_collection = $connect->query("SELECT id, amount FROM common_fee_collection WHERE admission_no='".$asmission_no."'");
            	if($select_common_fee_collection && mysqli_num_rows($select_common_fee_collection) > 0){
            		while($row = $select_common_fee_collection->fetch_assoc()) {
            			$common_fee_collection_id = $row['id'];
            			$financial_common_fee_collection = $row['amount'] + $paid_amount;

            		$update_common_fee_collection = $connect->query("UPDATE common_fee_collection SET amount='".$financial_common_fee_collection."' WHERE voucher_no='".$voucher_no."'");
            		}
            	}
            	else{
            		$insert_common_fee_collection = $connect->query("Insert INTO common_fee_collection SET module_id='0', 	transactions_id='0', admission_no='".$asmission_no."', roll_no='".$roll_no."', amount='".$paid_amount."', branch_id='".$branch_id."', acadamic_year='".$academic_year."', financial_year='".$academic_year."', receipt_no='".$receipt_no."', entry_mode='".$entry_mode."', paid_date='".$date."', inactive='0'");
            		$common_fee_collection_id = $connect->insert_id;
            	}

            	/* Common_fee_collection per head details */        	
        		$insert_common_fee_collection_headwise = $connect->query("Insert INTO common_fee_collection_headwise SET module_id='0', receipt_id='".$receipt_no."', head_id='".$fee_id."', head_name='".$fee_head."', branch_id='".$branch_id."', amount='".$paid_amount."'");

        		sleep($seconds);
        	}
        }
    }
}

?>