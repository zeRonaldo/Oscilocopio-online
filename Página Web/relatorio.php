<SECTION id="relatorio" Style="display: none">

<section class="tabela up-down">	
<div class="container">
	<div class="row">
		<div class="col s12 offset-l2 l8">
			<table class="highlight">
					<thead>
						<tr>
							<th class="center">Dados da Conexão</th>
						</tr>
					</thead>
					<tbody>					
						<tr>
							<th>IP</th>
							<td><span class="ipShow">http://192.168.0.1/</span></td>
							<th>Porta</th>
							<td>(<span class="portaShow">81</span>)</td>
						</tr>
						<tr>
							<th>Taxa de Atualização</th>
							<td><span class="taxaShow">500</span> millis</td>
							<th>Status</th>
							<td><span class="activeShow">Desativado</span></td>
						</tr>
				    </tbody>

				</table>
		</div>
	</div>
</div>
	
</section>

<section class="graficodiv nomb">
	<div class="container">
		<div class="row">
			<div class="col s12 offset-l1 l10">
				
					<div class="grafico red darken-3 center" id="chartContainer">
						
						
					</div>			
			</div>
		</div>
	</div>
</section>
<div id="aviso" class="modal">
    <div class="modal-content">
      <h4>Algo não parece certo</h4>
      <p>A conexão não pode ser mantida, erro <span class="error"></span></p>
    </div>
    <div class="modal-footer">
      <a onclick="closeModal()" class=" modal-action modal-close waves-effect waves-green btn-flat">OK</a>
    </div>
  </div>
  </SECTION>