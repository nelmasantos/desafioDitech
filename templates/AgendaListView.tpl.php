<?php
	$this->assign('title','desafioDitech | Agendas');
	$this->assign('nav','agendas');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/agendas.js").wait(function(){
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
	<i class="icon-th-list"></i> Agendas
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Buscar..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="agendaCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_IdAgendamento">Id Agendamento<% if (page.orderBy == 'IdAgendamento') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_IdUsuario">Id Usuario<% if (page.orderBy == 'IdUsuario') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_IdSala">Id Sala<% if (page.orderBy == 'IdSala') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Data">Data<% if (page.orderBy == 'Data') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Horario">Horario<% if (page.orderBy == 'Horario') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<th id="header_Situacao">Situacao<% if (page.orderBy == 'Situacao') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Valor">Valor<% if (page.orderBy == 'Valor') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Observacoes">Observacoes<% if (page.orderBy == 'Observacoes') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_IdTipoAgendamento">Id Tipo Agendamento<% if (page.orderBy == 'IdTipoAgendamento') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
-->
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('idAgendamento')) %>">
				<td><%= _.escape(item.get('idAgendamento') || '') %></td>
				<td><%= _.escape(item.get('idUsuario') || '') %></td>
				<td><%= _.escape(item.get('idSala') || '') %></td>
				<td><%if (item.get('data')) { %><%= _date(app.parseDate(item.get('data'))).format('MMM D, YYYY') %><% } else { %>NULL<% } %></td>
				<td><%= _.escape(item.get('horario') || '') %></td>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<td><%= _.escape(item.get('situacao') || '') %></td>
				<td><%= _.escape(item.get('valor') || '') %></td>
				<td><%= _.escape(item.get('observacoes') || '') %></td>
				<td><%= _.escape(item.get('idTipoAgendamento') || '') %></td>
-->
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="agendaModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="idAgendamentoInputContainer" class="control-group">
					<label class="control-label" for="idAgendamento">Id Agendamento</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="idAgendamento"><%= _.escape(item.get('idAgendamento') || '') %></span>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="idUsuarioInputContainer" class="control-group">
					<label class="control-label" for="idUsuario">Id Usuario</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="idUsuario" placeholder="Id Usuario" value="<%= _.escape(item.get('idUsuario') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="idSalaInputContainer" class="control-group">
					<label class="control-label" for="idSala">Id Sala</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="idSala" placeholder="Id Sala" value="<%= _.escape(item.get('idSala') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="dataInputContainer" class="control-group">
					<label class="control-label" for="data">Data</label>
					<div class="controls inline-inputs">
						<div class="input-append date date-picker" data-date-format="yyyy-mm-dd">
							<input id="data" type="text" value="<%= _date(app.parseDate(item.get('data'))).format('YYYY-MM-DD') %>" />
							<span class="add-on"><i class="icon-calendar"></i></span>
						</div>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="horarioInputContainer" class="control-group">
					<label class="control-label" for="horario">Horario</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="horario" placeholder="Horario" value="<%= _.escape(item.get('horario') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="situacaoInputContainer" class="control-group">
					<label class="control-label" for="situacao">Situacao</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="situacao" placeholder="Situacao" value="<%= _.escape(item.get('situacao') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="valorInputContainer" class="control-group">
					<label class="control-label" for="valor">Valor</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="valor" placeholder="Valor" value="<%= _.escape(item.get('valor') || '') %>">
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
				<div id="idTipoAgendamentoInputContainer" class="control-group">
					<label class="control-label" for="idTipoAgendamento">Id Tipo Agendamento</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="idTipoAgendamento" placeholder="Id Tipo Agendamento" value="<%= _.escape(item.get('idTipoAgendamento') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deleteAgendaButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteAgendaButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Remover Agenda</button>
						<span id="confirmDeleteAgendaContainer" class="hide">
							<button id="cancelDeleteAgendaButton" class="btn btn-mini">Cancelar</button>
							<button id="confirmDeleteAgendaButton" class="btn btn-mini btn-danger">Confirmar</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="agendaDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Editar Agenda
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="agendaModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="saveAgendaButton" class="btn btn-primary">Salvar Altera&ccedil;&otilde;es</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="agendaCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newAgendaButton" class="btn btn-primary">Adicionar Agenda</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
