<?php

namespace App\Controllers;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use CodeIgniter\Controller;

use App\Models\LoginModel;
use App\Models\JabatanModel;
use App\Models\KlasifikasiModel;
use App\Models\JenisModel;
use App\Models\SifatModel;
use App\Models\IsiDisposModel;
use App\Models\UserModel;
use App\Models\ConAppModel;
use App\Models\SuratModel;
use App\Models\CompanyModel;

class BaseController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = ['form', 'url', 'date'];

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		// $this->session = \Config\Services::session();
		date_default_timezone_set('Asia/Jakarta');
		$this->db = \Config\Database::connect();
		$this->validation = \Config\Services::validation();

		$this->logs = new LoginModel();
		$this->jabs = new JabatanModel();
		$this->klas = new KlasifikasiModel();
		$this->jnis = new JenisModel();
		$this->sfat = new SifatModel();
		$this->isi  = new IsiDisposModel();
		$this->user = new UserModel();
		$this->conf = new ConAppModel();
		$this->srt  = new SuratModel();
		$this->comp = new CompanyModel();
	}
}
