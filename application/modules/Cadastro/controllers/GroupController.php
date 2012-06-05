<?php

class Cadastro_GroupController extends Zend_Controller_Action
{

	public function init()
	{
		/* Initialize action controller here */
	}

	public function indexAction()
	{
	
		echo "<a href=\"/Cadastro/group/add\">Adicionar Grupo</a>";
                echo "<br>";
                echo "<a href=\"/Cadastro/group/list\">Listar Grupo</a>";
		

	}

	public function addAction()
	{
		// action body
		$form = new Cadastro_Form_Group();
		$request = $this->getRequest();

		if ($this->getRequest()->isPost()) 
		{
			if ($form->isValid($request->getPost())) 
			{
				$data = $form->getValues();
				
				$do = new Cadastro_Model_DbTable_Grupo();
				$do->insert($data);
				return $this->_helper->redirector('list');
			}
		}

		//echo $form;
                $this->view->form = $form;
	}

	public function deleteAction()
	{
		// action body
		$do = new Cadastro_Model_DbTable_Grupo();
		$request = $this->getRequest();
		$id = $this->_request->getParam('id');
		#$do->delete($id);
		$data = array();
		$data['enable'] = '0';
		$where = "id = {$id}";
		$do->update($data, $where);
		return $this->_helper->redirector('list');
	}
        public function delete1Action()
	{
		// action body
		$do = new Cadastro_Model_DbTable_Grupo();
		$request = $this->getRequest();
		$id = $this->_request->getParam('id');
		#$do->delete($id);
		$data = array();
		$data['enable'] = '1';
		$where = "id = {$id}";
		$do->update($data, $where);
		return $this->_helper->redirector('ativar');
	}
	public function updateAction()
	{
		$form = new Cadastro_Form_Group();
		$do = new Cadastro_Model_DbTable_Grupo();
		$request = $this->getRequest();
		$id = $this->_request->getParam('id');

		$dados = $do->find($id);
		$dados = $dados[0]->toArray();

		$form->populate($dados);
		if ($this->getRequest()->isPost()) 
		{
			if ($form->isValid($request->getPost())) 
			{
				$data = $form->getValues();
				#$data['password'] = md5($password);
				$where = "id = {$id}";
				$do->update($data, $where);
				return $this->_helper->redirector('list');
			}
		}
		echo $form;
	}
        public function listAction()
        {

               		// action body
		
                
		$sql  = "SELECT ";
 		$sql .= "usergroup.id, ";
		$sql .= "CONCAT('<a href=\"/Cadastro/Group/listuser/name/',name,'\">',name,'</a>') AS name, ";
		$sql .= "usergroup.comment AS Obs, ";
		$sql .= "CONCAT('<a href=\"/Cadastro/Group/update/id/',id,'\">editar</a>') AS editar, ";
		$sql .= "CONCAT('<a href=\"/Cadastro/Group/delete/id/',id,'\">apagar</a>') AS apagar ";
		$sql .= "FROM usergroup ";
                $sql .= "WHERE usergroup.enable = '1' ";
	
		$grid = new Application_Model_Grid();
		$this->view->grade =  $grid->MontarGrade($sql);
                
         }
         
        public function ativarAction()
        {

               		// action body
		
                
		$sql  = "SELECT ";
 		$sql .= "usergroup.id, ";
		$sql .= "CONCAT('<a href=\"/Cadastro/Group/listuser/name/',name,'\">',name,'</a>') AS name, ";
		$sql .= "usergroup.comment AS Obs, ";
                $sql .= "CONCAT('<a href=\"/Cadastro/Group/delete1/id/',id,'\">reativar</a>') AS apagar ";
		$sql .= "FROM usergroup ";
                $sql .= "WHERE usergroup.enable = '0' ";
	
		$grid = new Application_Model_Grid();
		$this->view->grade =  $grid->MontarGrade($sql);
                
         }
         public function listuserAction()
         {

               $usergroup = $this->_request->getParam('name');            

               echo "<h3>Grupo: {$usergroup} </h3>\n";
             # echo "<h3>Usuario: {$usergroup}</h3>\n";
               

               $sql = "SELECT ";
                
                $sql .= "usr.fullname AS 'nome', ";
		$sql .= "usr.user AS 'login', ";
#		$sql .= "usuario.password, ";
		$sql .= "usr.email AS 'e-mail', ";

                $sql .= "DATE_FORMAT(date,'%d/%m/%Y') AS 'Cadastrado em:' , ";
		$sql .= "CONCAT('<a href=\"/Cadastro/Index/update/id/',usr.id,'\">editar</a>') AS editar, ";
		$sql .= "CONCAT('<a href=\"/Cadastro/Index/delete/id/',usr.id,'\">apagar</a>') AS apagar ";

               $sql.= "FROM usuario AS usr JOIN usergroup AS grp ON (grp.id = usr.id_group)";
               $sql.= "WHERE name = '{$usergroup}' ";  



	       $grid = new Application_Model_Grid();
	       echo $grid->MontarGrade($sql); 

               	$form = new Cadastro_Form_retorn();
		$request = $this->getRequest();

		if ($this->getRequest()->isPost()) 
		{
			if ($form->isValid($request->getPost())) 
			{
				
				return $this->_helper->redirector('list');
			}
		}

		echo $form;


         }

}
