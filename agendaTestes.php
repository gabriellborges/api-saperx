<?php

include 'crud.php';

use PHPUnit\Framework\TestCase;

class agendaTestes extends TestCase
{
    protected $crud;

    protected function setUp(): void
    {
        $this->crud = new CRUD();
    }

    public function testAdicionarContato()
    {
        $_POST['nome'] = "Gabriel Borges";
        $_POST['email'] = "gabriel@hotmail.com";
        $_POST['dataNascimento'] = '1997-08-01';
        $_POST['cpf'] = "1036919692";
        $_POST['telefones'] = "984142144";

        $resultado = $this->crud->create($_POST);
    
        $this->assertTrue($resultado);
    }
    
    public function testBuscarContato()
    {
        $_GET['id'] = 1;
    
        $contato = $this->crud->getUsers();
    
        $this->assertNotNull($contato);
        $this->assertEquals("Gabriel Borges", $contato['nome']);
        $this->assertEquals("gabriel@hotmail.com", $contato['email']);
    }
    
    public function testAtualizarContato()
    {
        $_POST['id'] = 1;
        $_POST['nome'] = "João Silva";
        $_POST['email'] = "joao.silva@example.com";
    
        $resultado = $this->crud->update();
    
        $this->assertTrue($resultado);
        
        $contato = $this->crud->getUsers(1);
        $this->assertEquals("João Silva", $contato['nome']);
        $this->assertEquals("joao.silva@example.com", $contato['email']);
    }
    
    public function testExcluirContato()
    {
        $_POST['id'] = 1;
    
        $resultado = $this->crud->delete();
    
        $this->assertTrue($resultado);
        
        $this->assertNull($this->crud->getUsers(1));
    }    
}