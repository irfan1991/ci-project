<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\Customer_model;
use Config\Services;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Customer extends Controller
{
    protected $modul = "customer";
    protected $helpers = [];
 
    public function __construct()
    {
        helper(['form']);
    }
    
    public function index()
    {
        $model = new Customer_model();
        $data['customers'] =  $model->getCustomer();
        $data['title'] = 'Customer List';
        $data['arr'] = 'List';
        Services::template('customers/index', $data);
    }
    
    public function add()
    {
        $data['urlmethod'] = $this->modul.'/save';
        $data['arr'] = 'Add';
        $data['title'] = 'Form Customer';
        Services::template('customers/form', $data);
    }

    public function save()
    {
        $model = new Customer_model();
        $data = array(
            'customer_name' => $this->request->getPost('customer_name'),
            'customer_phone' => $this->request->getPost('customer_phone'),
            'lat' => $this->request->getPost('lat'),
            'long' => $this->request->getPost('long'),
            'street' => $this->request->getPost('street'),
            'city' => $this->request->getPost('city'),
            'country' => $this->request->getPost('country'),
        );
        $model->saveCustomer($data);
        session()->setFlashData('success', 'Data is saved successfully!');
        return redirect()->to('/customer');
    }

    public function edit($id)
    {
        $model = new Customer_model();
        $data['customer'] = $model->getCustomer($id)->getRow();
        $data['urlmethod'] = $this->modul.'/update';
        $data['arr'] = 'Edit';
        $data['title'] = 'Form Customer';
        Services::template('customers/form', $data);
    }


    public function view($id)
    {
        $model = new Customer_model();
        $data['customer'] = $model->getCustomer($id)->getRow();
        $data['arr'] = 'View';
        $data['urlmethod'] = $this->modul;
        $data['v'] = "";
        $data['title'] = 'Customer Detail';
        Services::template('customers/form', $data);
    }

    public function update()
    {
        $model = new Customer_model();
        $id = $this->request->getPost('id');
        $data = array(
            'customer_name' => $this->request->getPost('customer_name'),
            'customer_phone' => $this->request->getPost('customer_phone'),
            'lat' => $this->request->getPost('lat'),
            'long' => $this->request->getPost('long'),
            'street' => $this->request->getPost('street'),
            'city' => $this->request->getPost('city'),
            'country' => $this->request->getPost('country'),
        );
        $model->updateCustomer($data,$id);
        session()->setFlashData('success', 'Data is updated successfully!');
        return redirect()->to('/customer');
    }

    public function delete($id)
    {
        
        try {
            $model =  new Customer_model();
            $model->deleteCustomer($id);
        } catch (\Throwable $th) {
            //throw $th;
            session()->setFlashData('error', 'Something wrongs because '.$th->getMessage());
            return redirect()->to('/customer');
        }
       
        return redirect()->to('/customer');
    }

    public function import()
    {
        $data['urlmethod'] = $this->modul.'/proses_import';
        $data['arr'] = 'Import Excel';
        $data['title'] = 'Form Customer';
        Services::template('customers/form_proses', $data);
    }

    public function proses_import()
    {
        $validation = \Config\Services::validation();
        $file = $this->request->getFile('trx_file');
       // var_dump($file);die();
        $model = new Customer_model();
        $data = array(
            'trx_file' => $file
        );

        if ($validation->run($data, 'import') == FALSE) {
            session()->setFlashdata('error', $validation->getErrors());
            return redirect()->to(base_url('customer/import'));
        } else {
            
            //ambil extensi dari excel 
            $extension = $file->getClientExtension();

            //format excel 2007 ke bawah
            if ('xls' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            //format excel 2010 ke atas
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
            
            $spradesheet = $reader->load($file);
            $data_sheet = $spradesheet->getActiveSheet()->toArray();

            foreach ($data_sheet as $idx => $row) {
                
                // melewati baris ke 0 pada file excel
                // pada kasus ini array 0 adalah customer_name

                if ($idx == 0) {
                    continue;
                }

                $customer_name = $row[0];
                $customer_phone = $row[1];
                $lat = $row[2];
                $long = $row[3];
                $street = $row[4];
                $city = $row[5];
                $country = $row[6];

                $data = array(
                    'customer_name' => $customer_name,
                    'customer_phone' => $customer_phone,
                    'lat' => $lat,
                    'long' => $long,
                    'street' => $street,
                    'city' => $city,
                    'country' => $country,
                );
                $simpan = $model->saveCustomer($data);
                
            }

            if ($simpan) {
                session()->setFlashData('success', 'Data is saved successfully!');
                return redirect()->to('/customer');

            }
            
        }

    }

    public function export()
    {
        // ambil data customer
        $model = new Customer_model();
        $customers =  $model->getCustomer();
        //panggil class Spreadsheet baru
        $spradesheet = new Spreadsheet();
        //Buat custome header pada file excel 
        $spradesheet->setActiveSheetIndex(0)
        ->setCellValue('A1','No')
        ->setCellValue('B1','Customer Name')
        ->setCellValue('C1','Phone Number')
        ->setCellValue('D1','Lat')
        ->setCellValue('F1','Long')
        ->setCellValue('G1','Street')
        ->setCellValue('H1','City')
        ->setCellValue('J1','Country');

        //efine kolom dan nomor
        $kolom = 2;
        $nomor = 1;
        //tambahkan data ke dalam file 
        foreach ($customers as $data) {
            $spradesheet->setActiveSheetIndex(0)
                ->setCellValue('A'.$kolom,$nomor)
                ->setCellValue('B'.$kolom, $data['customer_name'])
                ->setCellValue('C'.$kolom, $data['customer_phone'])
                ->setCellValue('D'.$kolom, $data['lat'])
                ->setCellValue('F'.$kolom, $data['long'])
                ->setCellValue('G'.$kolom, $data['street'])
                ->setCellValue('H'.$kolom, $data['city'])
                ->setCellValue('J'.$kolom, $data['country']);

                $kolom++;
                $nomor++;
        }

        //download file 
        $writer = new Xlsx($spradesheet);
        header('Content-Type:application/vnd.ms-excel');
        header('Content-Disposition:attachment;filename="Laporan_Customers.xlsx"');
        header('Cache-Control : max-age=0');

        $writer->save('php://output');
    }
}


?>