<?php

namespace App\Controllers;

use PHPUnit\Framework\Constraint\ExceptionCode;

class User extends BaseController
{
    /* роли
    админы
    1 Программист
    2 Администратор — пользователь системы с полными правами за искл программистских

    сотрудники
    3 Генеральный директор
    4 Главный налоговый эксперт
    5 Налоговый эксперт

    клиенты
    6 Клиент (юрлицо)
    7 Сотрудник Клиента (физлицо)
    */
    public const DEV_ROLES = [0];
    public const DEV_GROUP = 0;

    public const ADMIN_ROLES = [1,2];
    public const ADMIN_GROUP = 1;

    public const EMPLOYEE_ROLES = [1,2,3,4,5];
    public const EMPLOYEE_GROUP = 2;

    public const CLIENT_ROLES = [6,7];
    public const CLIENT_GROUP = 3;

    public $title = 'Пользователи';

    public function __construct() {
        //
    }


    private function getSession() {
        return (object) $this->session->get('user');
    }


    public function getIndex() {
        $data = [
            'title' => $this->title,
            'roleGroup' => self::getRoleGroup(),
            'rolename' => self::getRoleName(),
            'sess' => self::getSession(),
        ];

        return view('header')
            .view('admin', $data)
//            .view('users', $data)
            .view('footer')
            ;
    }


    private function getRoleName() {
        $roleId = self::getSession()->role;
//        $roleId = 8;
        return match (true) {
            in_array($roleId, self::DEV_ROLES) => 'dev',
            in_array($roleId, self::ADMIN_ROLES) => 'admin',
            in_array($roleId, self::EMPLOYEE_ROLES) => 'employee',
            in_array($roleId, self::CLIENT_ROLES) => 'client',
            default => redirect('logout'),
        };
    }


    private function getRoleGroup() {
        $roleId = self::getSession()->role;
        return match (true) {
            in_array($roleId, self::DEV_ROLES) => self::DEV_GROUP,
            in_array($roleId, self::ADMIN_ROLES) => self::ADMIN_GROUP,
            in_array($roleId, self::EMPLOYEE_ROLES) => self::EMPLOYEE_GROUP,
            in_array($roleId, self::CLIENT_ROLES) => self::CLIENT_GROUP,
            default => -1,
        };
    }


}