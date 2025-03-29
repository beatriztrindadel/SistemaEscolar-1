<?php

use App\Controllers\Api\ApiParentsController;
use App\Controllers\ClassesController;
use CodeIgniter\Router\RouteCollection;
use App\Controllers\HomeController;
use App\Controllers\ParentsController;
use App\Controllers\StudentsController;
use App\Controllers\SubjectsController;
use App\Controllers\TeachersController;
use App\Controllers\SchedulesController;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', [HomeController::class, 'index'], ['as' => 'index']);

// responsáveis
$routes->get('/parents', [ParentsController::class, 'index'], ['as' => 'parents']);
$routes->get('/parents/new', [ParentsController::class, 'new'], ['as' => 'parents.new']);
$routes->post('/parents/create', [ParentsController::class, 'create'], ['as' => 'parents.create']);
$routes->get('parents/show/(:segment)', [ParentsController::class, 'show'], ['as' => 'parents.show']);
$routes->get('parents/edit/(:segment)', [ParentsController::class, 'edit'], ['as' => 'parents.edit']);
$routes->put('parents/update/(:segment)', [ParentsController::class, 'update'], ['as' => 'parents.update']);
$routes->delete('parents/destroy/(:segment)', [ParentsController::class, 'destroy'], ['as' => 'parents.destroy']);

//alunos

$routes->get('/students', [StudentsController::class, 'index'], ['as' => 'students']);
$routes->get('/students/new', [StudentsController::class, 'new'], ['as' => 'students.new']);
$routes->post('/students/create', [StudentsController::class, 'create'], ['as' => 'students.create']);
$routes->get('students/show/(:segment)', [StudentsController::class, 'show'], ['as' => 'students.show']);
$routes->get('students/edit/(:segment)', [StudentsController::class, 'edit'], ['as' => 'students.edit']);
$routes->put('students/update/(:segment)', [StudentsController::class, 'update'], ['as' => 'students.update']);
$routes->delete('students/destroy/(:segment)', [StudentsController::class, 'destroy'], ['as' => 'students.destroy']);

//api
$routes->group('api', static function ($routes) {
    $routes->get('get-by-cpf', [ApiParentsController::class, 'getByCpf'], ['as' => 'api.fetch.parent.by.cpf']);
});

//professores


$routes->get('/teachers', [TeachersController::class, 'index'], ['as' => 'teachers']);
$routes->get('/teachers/new', [TeachersController::class, 'new'], ['as' => 'teachers.new']);
$routes->post('/teachers/create', [TeachersController::class, 'create'], ['as' => 'teachers.create']);
$routes->get('teachers/show/(:segment)', [TeachersController::class, 'show'], ['as' => 'teachers.show']);
$routes->get('teachers/edit/(:segment)', [TeachersController::class, 'edit'], ['as' => 'teachers.edit']);
$routes->put('teachers/update/(:segment)', [TeachersController::class, 'update'], ['as' => 'teachers.update']);
$routes->delete('teachers/destroy/(:segment)', [TeachersController::class, 'destroy'], ['as' => 'teachers.destroy']);


//turmas


$routes->get('/classes', [ClassesController::class, 'index'], ['as' => 'classes']);
$routes->get('/classes/new', [ClassesController::class, 'new'], ['as' => 'classes.new']);
$routes->post('/classes/create', [ClassesController::class, 'create'], ['as' => 'classes.create']);
$routes->get('classes/show/(:segment)', [ClassesController::class, 'show'], ['as' => 'classes.show']);
$routes->get('classes/edit/(:segment)', [ClassesController::class, 'edit'], ['as' => 'classes.edit']);
$routes->put('classes/update/(:segment)', [ClassesController::class, 'update'], ['as' => 'classes.update']);
$routes->delete('classes/destroy/(:segment)', [ClassesController::class, 'destroy'], ['as' => 'classes.destroy']);

//disciplinas

$routes->get('/subjects', [SubjectsController::class, 'index'], ['as' => 'subjects']);
$routes->get('/subjects/new', [SubjectsController::class, 'new'], ['as' => 'subjects.new']);
$routes->post('/subjects/create', [SubjectsController::class, 'create'], ['as' => 'subjects.create']);
$routes->get('subjects/show/(:segment)', [SubjectsController::class, 'show'], ['as' => 'subjects.show']);
$routes->get('subjects/edit/(:segment)', [SubjectsController::class, 'edit'], ['as' => 'subjects.edit']);
$routes->put('subjects/update/(:segment)', [SubjectsController::class, 'update'], ['as' => 'subjects.update']);
$routes->delete('subjects/destroy/(:segment)', [SubjectsController::class, 'destroy'], ['as' => 'subjects.destroy']);


//horarios das turmas

$routes->get('schedules/get/(:segment)', [SchedulesController::class, 'index'], ['as' => 'schedules']);
$routes->put('schedules/store/(:segment)', [SchedulesController::class, 'store'], ['as' => 'schedules.store']);

service('auth')->routes($routes);

