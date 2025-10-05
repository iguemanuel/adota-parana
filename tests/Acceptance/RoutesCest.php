<?php

namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;

class RoutesCest
{
    public function seeHomePage(AcceptanceTester $I): void
    {
        $I->amOnPage('/');
        $I->see('Adota Paraná');
    }

    public function seeRegisterPage(AcceptanceTester $I): void
    {
        $I->amOnPage('/register');
        $I->see('Criar Conta');
    }

    public function canRegister(AcceptanceTester $I): void
    {
        $I->amOnPage('/register');
        $I->fillField('name', 'Usuário Teste');
        $I->fillField('email', 'teste@example.com');
        $I->fillField('phone', '41999999999');
        $I->fillField('password', '123456');
        $I->fillField('password_confirmation', '123456');
        $I->click('Registrar');
        $I->see('Registro realizado com sucesso! Efetue o login.');
        $I->seeInCurrentUrl('/login');
    }

    public function seeLoginPage(AcceptanceTester $I): void
    {
        $I->amOnPage('/login');
    }

    public function canLogin(AcceptanceTester $I): void
    {
        $I->amOnPage('/login');
        $I->fillField('email', 'teste@example.com');
        $I->fillField('password', '123456');
        $I->click('Entrar');
        $I->seeInCurrentUrl('/');
    }

    public function canLogout(AcceptanceTester $I): void
{
    $I->amOnPage('/login');
    $I->fillField('email', 'teste@example.com');
    $I->fillField('password', '123456');
    $I->click('Entrar');
    $I->seeInCurrentUrl('/');
    $I->click('Sair');
    $I->seeInCurrentUrl('/');
}

    public function seeAdminDashboard(AcceptanceTester $I): void
    {
        $I->amOnPage('/login');
        $I->fillField('email', 'teste@example.com');
        $I->fillField('password', '123456');
        $I->click('Entrar');
        $I->seeInCurrentUrl('/');
        $I->click('Admin');
    }
}