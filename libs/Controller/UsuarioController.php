<?php
/** @package    desafioDitech::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/Usuario.php");

/**
 * UsuarioController is the controller class for the Usuario object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package desafioDitech::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class UsuarioController extends AppBaseController
{

	/**
	 * Override here for any controller-specific functionality
	 *
	 * @inheritdocs
	 */
	protected function Init()
	{
		parent::Init();
		
		/**
		 * Informe o tipo de permissao
		 */
		$this->RequirePermission(User::$PERMISSION_READ, 
			'Secure.LoginForm', 
			'Login requerido para acessar esta pagina',
			'Permissao de leitura e obrigatoria');
	}

	/**
	 * Displays a list view of Usuario objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for Usuario records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new UsuarioCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('IdUsuario,Nome,Senha,Aniversario,DataDeCadastro,Apelido,Empresa,Observacoes,Endereco,Email,Fone,Fone1,Fone2,Imagem,IdAdmin'
				, '%'.$filter.'%')
			);

			// TODO: this is generic query filtering based only on criteria properties
			foreach (array_keys($_REQUEST) as $prop)
			{
				$prop_normal = ucfirst($prop);
				$prop_equals = $prop_normal.'_Equals';

				if (property_exists($criteria, $prop_normal))
				{
					$criteria->$prop_normal = RequestUtil::Get($prop);
				}
				elseif (property_exists($criteria, $prop_equals))
				{
					// this is a convenience so that the _Equals suffix is not needed
					$criteria->$prop_equals = RequestUtil::Get($prop);
				}
			}

			$output = new stdClass();

			// if a sort order was specified then specify in the criteria
 			$output->orderBy = RequestUtil::Get('orderBy');
 			$output->orderDesc = RequestUtil::Get('orderDesc') != '';
 			if ($output->orderBy) $criteria->SetOrder($output->orderBy, $output->orderDesc);

			$page = RequestUtil::Get('page');

			if ($page != '')
			{
				// if page is specified, use this instead (at the expense of one extra count query)
				$pagesize = $this->GetDefaultPageSize();

				$usuarios = $this->Phreezer->Query('Usuario',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $usuarios->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $usuarios->TotalResults;
				$output->totalPages = $usuarios->TotalPages;
				$output->pageSize = $usuarios->PageSize;
				$output->currentPage = $usuarios->CurrentPage;
			}
			else
			{
				// return all results
				$usuarios = $this->Phreezer->Query('Usuario',$criteria);
				$output->rows = $usuarios->ToObjectArray(true, $this->SimpleObjectParams());
				$output->totalResults = count($output->rows);
				$output->totalPages = 1;
				$output->pageSize = $output->totalResults;
				$output->currentPage = 1;
			}


			$this->RenderJSON($output, $this->JSONPCallback());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method retrieves a single Usuario record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('idUsuario');
			$usuario = $this->Phreezer->Get('Usuario',$pk);
			$this->RenderJSON($usuario, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new Usuario record and render response as JSON
	 */
	public function Create()
	{
		try
		{
						
			$json = json_decode(RequestUtil::GetBody());

			if (!$json)
			{
				throw new Exception('The request body does not contain valid JSON');
			}

			$usuario = new Usuario($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $usuario->IdUsuario = $this->SafeGetVal($json, 'idUsuario');

			$usuario->Nome = $this->SafeGetVal($json, 'nome');
			$usuario->Senha = $this->SafeGetVal($json, 'senha');
			$usuario->Aniversario = date('Y-m-d H:i:s',strtotime($this->SafeGetVal($json, 'aniversario')));
			$usuario->DataDeCadastro = date('Y-m-d H:i:s',strtotime($this->SafeGetVal($json, 'dataDeCadastro')));
			$usuario->Apelido = $this->SafeGetVal($json, 'apelido');
			$usuario->Empresa = $this->SafeGetVal($json, 'empresa');
			$usuario->Observacoes = $this->SafeGetVal($json, 'observacoes');
			$usuario->Endereco = $this->SafeGetVal($json, 'endereco');
			$usuario->Email = $this->SafeGetVal($json, 'email');
			$usuario->Fone = $this->SafeGetVal($json, 'fone');
			$usuario->Fone1 = $this->SafeGetVal($json, 'fone1');
			$usuario->Fone2 = $this->SafeGetVal($json, 'fone2');
			$usuario->Imagem = $this->SafeGetVal($json, 'imagem');
			$usuario->IdAdmin = $this->SafeGetVal($json, 'idAdmin');

			$usuario->Validate();
			$errors = $usuario->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Por Favor, verifique os erros',$errors);
			}
			else
			{
				$usuario->Save();
				$this->RenderJSON($usuario, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing Usuario record and render response as JSON
	 */
	public function Update()
	{
		try
		{
						
			$json = json_decode(RequestUtil::GetBody());

			if (!$json)
			{
				throw new Exception('The request body does not contain valid JSON');
			}

			$pk = $this->GetRouter()->GetUrlParam('idUsuario');
			$usuario = $this->Phreezer->Get('Usuario',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $usuario->IdUsuario = $this->SafeGetVal($json, 'idUsuario', $usuario->IdUsuario);

			$usuario->Nome = $this->SafeGetVal($json, 'nome', $usuario->Nome);
			$usuario->Senha = $this->SafeGetVal($json, 'senha', $usuario->Senha);
			$usuario->Aniversario = date('Y-m-d H:i:s',strtotime($this->SafeGetVal($json, 'aniversario', $usuario->Aniversario)));
			$usuario->DataDeCadastro = date('Y-m-d H:i:s',strtotime($this->SafeGetVal($json, 'dataDeCadastro', $usuario->DataDeCadastro)));
			$usuario->Apelido = $this->SafeGetVal($json, 'apelido', $usuario->Apelido);
			$usuario->Empresa = $this->SafeGetVal($json, 'empresa', $usuario->Empresa);
			$usuario->Observacoes = $this->SafeGetVal($json, 'observacoes', $usuario->Observacoes);
			$usuario->Endereco = $this->SafeGetVal($json, 'endereco', $usuario->Endereco);
			$usuario->Email = $this->SafeGetVal($json, 'email', $usuario->Email);
			$usuario->Fone = $this->SafeGetVal($json, 'fone', $usuario->Fone);
			$usuario->Fone1 = $this->SafeGetVal($json, 'fone1', $usuario->Fone1);
			$usuario->Fone2 = $this->SafeGetVal($json, 'fone2', $usuario->Fone2);
			$usuario->Imagem = $this->SafeGetVal($json, 'imagem', $usuario->Imagem);
			$usuario->IdAdmin = $this->SafeGetVal($json, 'idAdmin', $usuario->IdAdmin);

			$usuario->Validate();
			$errors = $usuario->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Por Favor, verifique os erros',$errors);
			}
			else
			{
				$usuario->Save();
				$this->RenderJSON($usuario, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing Usuario record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('idUsuario');
			$usuario = $this->Phreezer->Get('Usuario',$pk);

			$usuario->Delete();

			$output = new stdClass();

			$this->RenderJSON($output, $this->JSONPCallback());

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}
}

?>
