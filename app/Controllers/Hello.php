<?php namespace App\Controllers;
use App\Models\Input_model;
use App\Models\Output_model;
use App\Models\Customer_model;
use App\Models\Product_model;
use App\Models\Supplier_model;
use Config\Services;

class Hello extends BaseController
{
	public function index()
	{
		$modelInput = new Input_model();
		$modelOutput = new Output_model();
		$modelCustomer = new Customer_model();
		$modelSupplier = new Supplier_model();
		$nilaiMonth = [];
		$month =  $modelInput->month();
		$nilaiAmount = [];
		$amount =  $modelInput->amount();
		foreach ($month as $key => $value) {
			array_push($nilaiMonth,$value['month']);
		}
		foreach ($amount as $key => $value) {
			array_push($nilaiAmount,$value['amount']);
		}
		
		$data['jminput'] =  count($modelInput->getInput());
		$data['amountinput'] =  $nilaiAmount;
		 $data['monthinput'] = $nilaiMonth;
		$data['jmoutput'] =  count($modelOutput->getOutput());
		$data['jmcustomer'] =  count($modelCustomer->getCustomer());
		$data['jmsupplier'] =  count($modelSupplier->getSupplier());
    
        Services::template('hello_view', $data);
    }
    

}
