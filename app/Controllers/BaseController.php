<?php

namespace App\Controllers;

use App\Models\System;
use CodeIgniter\Controller;
use Psr\Log\LoggerInterface;
use CodeIgniter\HTTP\CLIRequest;
use App\Models\Developer\Developer;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = ['url'];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    protected $system;
    protected $developer;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        $systemModel = new System();
        $this->system = $systemModel->first();

        $developerModel = new Developer();
        $this->developer = $developerModel->first();

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = service('session');
         // Optional: Share with views globally
         service('renderer')->setVar('systems', $this->system);
         service('renderer')->setVar('developer', $this->developer);
    }
}
