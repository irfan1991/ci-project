<?php namespace Config;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var array
	 */
	public $ruleSets = [
		\CodeIgniter\Validation\Rules::class,
		\CodeIgniter\Validation\FormatRules::class,
		\CodeIgniter\Validation\FileRules::class,
		\CodeIgniter\Validation\CreditCardRules::class,
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];

	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------

	public $category = [	
		'category_name' => 'required',
		'category_status' => 'required'
	];

	public $category_errors = [
		'category_name' => [
			'required' => 'Nama wajib diisi.'
		],
		'category_status' => [
			'required' => 'Status wajib diisi.'
		]
	];

	public $product = [	
		'product_name' => 'required',
		'product_stock' => 'required',
		'product_price' => 'required',
		'product_category' => 'required',
	];

	public $product_errors = [
		'product_name' => [
			'required' => 'Nama Produk wajib diisi.'
		],
		'product_stock' => [
			'required' => 'Stock Produk wajib diisi.'
		],
		'product_price' => [
			'required' => 'Harga Produk wajib diisi.'
		],
		'product_category' => [
			'required' => 'Kategori Produk wajib diisi.'
		],
	];

	public $customer = [	
		'customer_name' => 'required',
		'customer_phone' => 'required',
		'lat' => 'required',
		'long' => 'required',
		'street' => 'required',
		'city' => 'required',
		'country' => 'required',
	];

	public $customer_errors = [
		'customer_name' => [
			'required' => 'Nama Customer wajib diisi.'
		],
		'customer_phone' => [
			'required' => 'Nomor Telpon wajib diisi.'
		],
		'lat' => [
			'required' => 'Data latitude wajib diisi.'
		],
		'long' => [
			'required' => 'Data longitude wajib diisi.'
		],
		'street' => [
			'required' => 'Data street wajib diisi.'
		],
		'city' => [
			'required' => 'Data city wajib diisi.'
		],
		'country' => [
			'required' => 'Data country wajib diisi.'
		],
	];

	public $supplier = [	
		'supplier_name' => 'required',
		'supplier_phone' => 'required',
		'lat' => 'required',
		'long' => 'required',
		'street' => 'required',
		'city' => 'required',
		'country' => 'required',
		
	];

	public $supplier_errors = [
		'supplier_name' => [
			'required' => 'Nama Supplier wajib diisi.'
		],
		'supplier_phone' => [
			'required' => 'Nomor Supplier wajib diisi.'
		],
		'lat' => [
			'required' => 'Data latitude wajib diisi.'
		],
		'long' => [
			'required' => 'Data longitude wajib diisi.'
		],
		'street' => [
			'required' => 'Data street wajib diisi.'
		],
		'city' => [
			'required' => 'Data city wajib diisi.'
		],
		'country' => [
			'required' => 'Data country wajib diisi.'
		],
	];

	public $import = [
		'trx_file'         => 'uploaded[trx_file]|ext_in[trx_file,xls,xlsx]|max_size[trx_file,1000]',
	];
	 
	public $import_errors = [
		'trx_file'=> [
			'ext_in'    => 'File Excel hanya boleh diisi dengan xls atau xlsx.',
			'max_size'  => 'File Excel product maksimal 1mb',
			'uploaded'  => 'File Excel product wajib diisi'
		]
	];
}
