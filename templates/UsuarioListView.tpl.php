<?php
	$this->assign('title','desafioDitech | Usuarios');
	$this->assign('nav','usuarios');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/usuarios.js").wait(function(){
		$(document).ready(function(){
			page.init();
		});
		
		// hack for IE9 which may respond inconsistently with document.ready
		setTimeout(function(){
			if (!page.isInitialized) page.init();
		},1000);
	});
</script>

<div class="container">

<h1>
	<i class="icon-th-list"></i> Usuarios
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Buscar..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="usuarioCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_IdUsuario">Id Usuario<% if (page.orderBy == 'IdUsuario') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Nome">Nome<% if (page.orderBy == 'Nome') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Senha">Senha<% if (page.orderBy == 'Senha') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Aniversario">Aniversario<% if (page.orderBy == 'Aniversario') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_DataDeCadastro">Data De Cadastro<% if (page.orderBy == 'DataDeCadastro') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<th id="header_Apelido">Apelido<% if (page.orderBy == 'Apelido') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Empresa">Empresa<% if (page.orderBy == 'Empresa') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Observacoes">Observacoes<% if (page.orderBy == 'Observacoes') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Endereco">Endereco<% if (page.orderBy == 'Endereco') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Email">Email<% if (page.orderBy == 'Email') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Fone">Fone<% if (page.orderBy == 'Fone') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Fone1">Fone1<% if (page.orderBy == 'Fone1') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Fone2">Fone2<% if (page.orderBy == 'Fone2') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Imagem">Imagem<% if (page.orderBy == 'Imagem') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_IdAdmin">Id Admin<% if (page.orderBy == 'IdAdmin') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
-->
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('idUsuario')) %>">
				<td><%= _.escape(item.get('idUsuario') || '') %></td>
				<td><%= _.escape(item.get('nome') || '') %></td>
				<td><%= _.escape(item.get('senha') || '') %></td>
				<td><%if (item.get('aniversario')) { %><%= _date(app.parseDate(item.get('aniversario'))).format('MMM D, YYYY') %><% } else { %>NULL<% } %></td>
				<td><%if (item.get('dataDeCadastro')) { %><%= _date(app.parseDate(item.get('dataDeCadastro'))).format('MMM D, YYYY h:mm A') %><% } else { %>NULL<% } %></td>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<td><%= _.escape(item.get('apelido') || '') %></td>
				<td><%= _.escape(item.get('empresa') || '') %></td>
				<td><%= _.escape(item.get('observacoes') || '') %></td>
				<td><%= _.escape(item.get('endereco') || '') %></td>
				<td><%= _.escape(item.get('email') || '') %></td>
				<td><%= _.escape(item.get('fone') || '') %></td>
				<td><%= _.escape(item.get('fone1') || '') %></td>
				<td><%= _.escape(item.get('fone2') || '') %></td>
				<td><%= _.escape(item.get('imagem') || '') %></td>
				<td><%= _.escape(item.get('idAdmin') || '') %></td>
-->
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="usuarioModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="idUsuarioInputContainer" class="control-group">
					<label class="control-label" for="idUsuario">Id Usuario</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="idUsuario"><%= _.escape(item.get('idUsuario') || '') %></span>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="nomeInputContainer" class="control-group">
					<label class="control-label" for="nome">Nome</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="nome" placeholder="Nome" value="<%= _.escape(item.get('nome') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="senhaInputContainer" class="control-group">
					<label class="control-label" for="senha">Senha</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="senha" placeholder="Senha" value="<%= _.escape(item.get('senha') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="aniversarioInputContainer" class="control-group">
					<label class="control-label" for="aniversario">Aniversario</label>
					<div class="controls inline-inputs">
						<div class="input-append date date-picker" data-date-format="yyyy-mm-dd">
							<input id="aniversario" type="text" value="<%= _date(app.parseDate(item.get('aniversario'))).format('YYYY-MM-DD') %>" />
							<span class="add-on"><i class="icon-calendar"></i></span>
						</div>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="dataDeCadastroInputContainer" class="control-group">
					<label class="control-label" for="dataDeCadastro">Data De Cadastro</label>
					<div class="controls inline-inputs">
						<div class="input-append date date-picker" data-date-format="yyyy-mm-dd">
							<input id="dataDeCadastro" type="text" value="<%= _date(app.parseDate(item.get('dataDeCadastro'))).format('YYYY-MM-DD') %>" />
							<span class="add-on"><i class="icon-calendar"></i></span>
						</div>
						<div class="input-append bootstrap-timepicker-component">
							<input id="dataDeCadastro-time" type="text" class="timepicker-default input-small" value="<%= _date(app.parseDate(item.get('dataDeCadastro'))).format('h:mm A') %>" />
							<span class="add-on"><i class="icon-time"></i></span>
						</div>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="apelidoInputContainer" class="control-group">
					<label class="control-label" for="apelido">Apelido</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="apelido" placeholder="Apelido" value="<%= _.escape(item.get('apelido') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="empresaInputContainer" class="control-group">
					<label class="control-label" for="empresa">Empresa</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="empresa" placeholder="Empresa" value="<%= _.escape(item.get('empresa') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="observacoesInputContainer" class="control-group">
					<label class="control-label" for="observacoes">Observacoes</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="observacoes" placeholder="Observacoes" value="<%= _.escape(item.get('observacoes') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="enderecoInputContainer" class="control-group">
					<label class="control-label" for="endereco">Endereco</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="endereco" placeholder="Endereco" value="<%= _.escape(item.get('endereco') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="emailInputContainer" class="control-group">
					<label class="control-label" for="email">Email</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="email" placeholder="Email" value="<%= _.escape(item.get('email') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="foneInputContainer" class="control-group">
					<label class="control-label" for="fone">Fone</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="fone" placeholder="Fone" value="<%= _.escape(item.get('fone') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="fone1InputContainer" class="control-group">
					<label class="control-label" for="fone1">Fone1</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="fone1" placeholder="Fone1" value="<%= _.escape(item.get('fone1') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="fone2InputContainer" class="control-group">
					<label class="control-label" for="fone2">Fone2</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="fone2" placeholder="Fone2" value="<%= _.escape(item.get('fone2') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="imagemInputContainer" class="control-group">
					<label class="control-label" for="imagem">Imagem</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="imagem" placeholder="Imagem" value="<%= _.escape(item.get('imagem') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="idAdminInputContainer" class="control-group">
					<label class="control-label" for="idAdmin">Id Admin</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="idAdmin" placeholder="Id Admin" value="<%= _.escape(item.get('idAdmin') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deleteUsuarioButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteUsuarioButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Remover Usuario</button>
						<span id="confirmDeleteUsuarioContainer" class="hide">
							<button id="cancelDeleteUsuarioButton" class="btn btn-mini">Cancelar</button>
							<button id="confirmDeleteUsuarioButton" class="btn btn-mini btn-danger">Confirmar</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="usuarioDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Editar Usuario
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="usuarioModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="saveUsuarioButton" class="btn btn-primary">Salvar Altera&ccedil;&otilde;es</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="usuarioCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newUsuarioButton" class="btn btn-primary">Adicionar Usuario</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
