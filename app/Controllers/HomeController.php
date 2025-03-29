<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Libraries\Report\TotalService;

class HomeController extends BaseController
{   
    private const  VIEWS_DIRECTORY = 'Home/';

    
    public function index(): string
    {

        $totalService = new TotalService();

        $this->dataToView['title'] = 'Você está na home';
       
        $this->dataToView['totalTeachers'] = $totalService->totalTeachers();
        $this->dataToView['totalClasses'] = $totalService->totalClasses();
        $this->dataToView['totalSubjects'] = $totalService->totalSubjects();

        
        
        return view(self::VIEWS_DIRECTORY . 'index', $this->dataToView);
    }

   
}
