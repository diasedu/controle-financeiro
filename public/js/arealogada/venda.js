const inputPesquisa  = document.querySelector('#input-pesquisa');
const tabelaProdutos = document.querySelector('#tabela-produtos');
const btnAddItens = document.querySelector('#btn-add-itens');
const modal = document.getElementById('modalIncluirVenda');
const formBuscar = document.querySelector('#form-buscar');
const checkAll = document.querySelector('#check-all');
const formEditar = document.querySelector('#form-editar');
const $btnConsultar = document.querySelector('#btn-consultar');
const $formIncluirEditarItem = document.querySelector('#form-incluir-editar-item');
const $inputPesquisaProduto = document.querySelector('#input-pesquisa-produto');

inputPesquisa.addEventListener('keyup', function () {
	const busca = this.value.trim().toLowerCase();
	const produtos = document.querySelectorAll('.nome-produto');
	let localizados = 0;

	produtos.forEach(function (elemento) {
		const linha = elemento.closest('tr');
		const nome  = elemento.textContent.trim().toLowerCase();

		if (!nome.includes(busca)) {
			linha.classList.add('d-none');
		} else {
			linha.classList.remove('d-none');
			localizados++;
		}
	});

	// Se não encontrou nenhum → esconde tabela
	if (localizados === 0) {
		tabelaProdutos.classList.add('d-none');
	} else {
		tabelaProdutos.classList.remove('d-none');
	}
});

btnAddItens.addEventListener('click', function(e) {
	const itensSelecionados = getItensSelecionados();

	if (itensSelecionados.length === 0) {
		return alert('Selecione pelo menos um item');
	}

	const params = new URLSearchParams();
	
	itensSelecionados.forEach(id => params.append('ids[]', id));
	
	toggleLoader();

	fetch(
		`venda/incluir-itens?${params.toString()}`,
		{method: 'GET'}
	)
		.then(function(response) {
			return response.text();
		})
		.then(function(html) {
			if (html === '') {
				return alert('Não foi possível incluir seus produtos.');
			}

			document.querySelector('#conteudo-itens-adicionados').innerHTML = html;

			const tab = document.querySelector('#pills-itens-adicionados-tab');
			tab.classList.remove('disabled', 'text-secondary');
			tab.click();

		})
		.catch(function(error) {
			console.error(error.message);
		})
		.finally(function() {
			toggleLoader('hide');
		});
});

modal.addEventListener('hidden.bs.modal', function() {
    limparForm();
});

formBuscar.addEventListener('submit', function(evento) {
	evento.preventDefault();

	toggleLoader();

	const formData = new FormData(formBuscar);

	const options = {
		method: 'POST',
		headers: {
			'Content-Type': 'text/html'
		},
		body: formData
	}

	fetch(formBuscar.action, options)
		.then(function(response) {
			return response.text();
		})
		.then(function(html) {
			if (html === '') {
				return alert('Não foi possível buscar as vendas.');
			}

			document.querySelector('#conteudo-vendas').innerHTML = html;
		})
		.catch(function(error) {
			console.error(error.message);
		})
		.finally(function() {
			toggleLoader('hide');
		});

});

checkAll.addEventListener('change', function() {
	if (checkAll.checked) {
		selecionarTodosItens();
	} else {
		desmarcarTodosItens();
	}
});

formEditar.addEventListener('submit', function(evento) {
	evento.preventDefault();

	toggleLoader();
	
	const formData = new FormData(formEditar);

	const options = {
		method: formEditar.method,
		body: formData
	}
	
	fetch(formEditar.action, options)
		.then(function(response) {
			return response.json();
		})
		.then(function(json) {
			if (json.error) {
				return alert(json.message);
			}

			const msg = document.querySelector('#modal-editar-msg')
			msg.classList.add('alert', 'alert-success');
			msg.textContent = json.message;

			const $eModal = document.querySelector('#modalEditar');
			const modalEditar = bootstrap.Modal.getInstance($eModal) || new bootstrap.Modal($eModal);
			modalEditar.toggle();
		})
		.catch(function(error) {
			console.error(error.message);
		})
		.finally(function() {
			toggleLoader('hide');
		});
});

$formIncluirEditarItem.addEventListener('submit', function(evento) {
	evento.preventDefault();

	toggleLoader();
	
	const vendaId = document.querySelector('#id').value;

	const formData = new FormData($formIncluirEditarItem);
	formData.append('id', vendaId);

	const options = {
		method: $formIncluirEditarItem.method,
		body: formData
	}
	
	fetch($formIncluirEditarItem.action, options)
		.then(function(response) {
			return response.json();
		})
		.then(function(json) {
			if (json.error) {
				return alert(json.message);
			}

			const msg = document.querySelector('#modal-incluir-editar-item-msg')
			msg.classList.add('alert', 'alert-success');
			msg.textContent = json.message;

			const $eModal =  document.querySelector('#modalIncluirEditarItem');
			
			const modalIncluirEditarItem = (
				bootstrap.Modal.getInstance($eModal) || 
				new bootstrap.Modal($eModal)
			);

			modalIncluirEditarItem.toggle();
			getVenda(vendaId)
		})
		.catch(function(error) {
			console.error(error.message);
		})
		.finally(function() {
			toggleLoader('hide');
		});
});

document.getElementById('produto-qtd')
	.addEventListener('keyup', function(evento) {
		const $ePreco = document.getElementById('produto-preco');

		const qtd = this.value;
		const preco = $ePreco.value;

		$ePreco.value = qtd * preco;
	});

$inputPesquisaProduto.addEventListener('input', function() {
	const termo = this.value.toLowerCase();
    const select = document.getElementById('produto-id');
    const options = select.options;

    for (let i = 0; i < options.length; i++) {
        const texto = options[i].text.toLowerCase();
        options[i].style.display = texto.includes(termo) ? '' : 'none';
    }
});

$btnConsultar.click();

/**
 * Resgata a lista de produtos selecionados
 * @returns array
 */
function getItensSelecionados() {
	const itensSelecionados = document.querySelectorAll('.check-produto:checked');
	const lista = [];

	itensSelecionados.forEach(function(elemento) {
		lista.push(elemento.getAttribute('data-id'));
	});

	return lista;
}

/**
 * Seta o preço total de acordo com a quantidade.
 * @param {*} elemento 
 */
function recalcularPrecoTotalUnitario(elemento) {
	const produtoId     = elemento.getAttribute('data-id');
	const precoUnitario = elemento.getAttribute('data-preco');
	const qtd = elemento.value;

	const precoTotal = precoUnitario * qtd;

	document.querySelectorAll('.preco-total-por-produto')
		.forEach(function(elementoLoop) {
			if (produtoId == elementoLoop.getAttribute('data-id')) {
				elementoLoop.value = precoTotal;
				return;
			}
		});
}

/**
 * Seta o preço total de acordo com o total dos itens unitários.
 * @param {*} elemento 
 */
function recalcularPrecoTotal() {
	let precoTotal = 0;
	let precoTotalPorProd = 0;

	document.querySelectorAll('.preco-total-por-produto')
		.forEach(function(elemento) {
			precoTotalPorProd = parseFloat(elemento.value);
			precoTotal += precoTotalPorProd;
		});

	document.querySelector('#preco-total').value = precoTotal;
}

function salvarVenda() {
	toggleLoader();

	const precoTotal = document.querySelector('#preco-total').value;
	const prodDados = formatarDadosDeProd();

	const dados = {
		prod_dados : prodDados,
		preco_total: precoTotal
	}

	const options = {
		method: 'POST',
		headers: {
			'Content-Type': 'application/json'
		},
		body: JSON.stringify(dados)
	}
	
	fetch('venda/salvar', options)
		.then(function(response) {
			return response.json();
		})
		.then(function(json) {
			if (json.error) {
				return alert(json.message);
			}

			const msg = document.querySelector('#msg')
			msg.classList.add('alert', 'alert-success');
			msg.textContent = json.message;

			$btnConsultar.click();

			const $eModal = document.querySelector('#modalIncluirVenda');
			const modalIncluir = bootstrap.Modal.getInstance($eModal) || new bootstrap.Modal($eModal);
			modalIncluir.toggle();
		})
		.catch(function(error) {
			console.error(error.message);
		})
		.finally(function() {
			toggleLoader('hide');
		});
}

function excluir(elemento) {
	const confirma = window.confirm('Deseja realmente excluir esta venda?');
	if (!confirma) {
		return;
	}

	toggleLoader();

	const id = elemento.getAttribute('data-id');
	const options = {
		method: 'POST',
		headers: {
			'Content-Type': 'application/json'
		},
		body: JSON.stringify({id: id})
	}
	
	fetch('venda/excluir', options)
		.then(function(response) {
			return response.json();
		})
		.then(function(json) {
			alert(json.message);

			if (json.error) {
				return;
			}

			document.querySelector('#btn-consultar').click();
		})
		.catch(function(error) {
			console.error(error.message);
		})
		.finally(function() {
			toggleLoader('hide');
		});
}

function editarItem(elemento) {
	toggleLoader();

	abrirModalIncluirEditarItem();

	const id = elemento.getAttribute('data-id');
	const vendaId = elemento.getAttribute('data-venda-id');
	const options = {
		method: 'POST',
		body: JSON.stringify({
			id: id
		})
	}
	
	fetch('venda/get-item', options)
		.then(function(response) {
			return response.json();
		})
		.then(function(json) {
			if (json.error) {
				alert(json.message);
				return;
			}

			const $produtoId    = document.querySelector('#produto-id');
			const $produtoQtd   = document.querySelector('#produto-qtd');
			const $produtoPreco = document.querySelector('#produto-preco');
			
			$produtoId.value = json.data.produto_id;
			$produtoQtd.value = json.data.quantidade;
			$produtoPreco.value = json.data.preco_total;

			$inputPesquisaProduto.setAttribute('readonly', true);
			$produtoId.setAttribute('readonly', true);
			$produtoId.removeAttribute('size');

		})
		.catch(function(error) {
			console.error(error.message);
		})
		.finally(function() {
			toggleLoader('hide');
		});
}

function excluirItem(elemento) {
	const confirma = window.confirm('Deseja realmente excluir esta venda?');
	if (!confirma) {
		return;
	}

	toggleLoader();

	const id = elemento.getAttribute('data-id');
	const vendaId = elemento.getAttribute('data-venda-id');
	const options = {
		method: 'POST',
		body: JSON.stringify({
			id: id,
			venda_id: vendaId
		})
	}
	
	fetch('venda/excluir-item', options)
		.then(function(response) {
			return response.json();
		})
		.then(function(json) {
			alert(json.message);

			if (json.error) {
				return;
			}

			getVenda(vendaId);
		})
		.catch(function(error) {
			console.error(error.message);
		})
		.finally(function() {
			toggleLoader('hide');
		});
}

function formatarDadosDeProd() {
	const inputsPorQtd = document.querySelectorAll('.qtd');
	const inputsPorValorTotal = document.querySelectorAll('.preco-total-por-produto');

	const data = [];

	inputsPorQtd.forEach(function(elementoQtd) {
		inputsPorValorTotal.forEach(function(elementoValor) {
			if (elementoQtd.getAttribute('data-id') === elementoValor.getAttribute('data-id')) {
				data.push({
					id: elementoQtd.getAttribute('data-id'),
					qtd: elementoQtd.value,
					valor_unitario: elementoQtd.getAttribute('data-preco'),
					valor_total_por_item: elementoValor.value
				});
			}
		});
	});

	return data;
}

function toggleLoader(mode = '') {
	const loader = document.querySelector('#loader-overlay');

	if (mode === 'hide') {
		loader.classList.add('d-none');
	} else {
		loader.classList.remove('d-none');
	}
}

function limparForm() {
	desmarcarTodosItens();

	const primeiroTab = document.querySelector('#pills-selecao-itens');
	primeiroTab.click();

	document.querySelector('#conteudo-itens-adicionados').innerHTML = '';
	
	const segundoTab = document.querySelector('#pills-itens-adicionados-tab');
	segundoTab.classList.remove('text-primary');
	segundoTab.classList.add('disabled', 'text-secondary');
}

function selecionarTodosItens() {
    const checks = document.querySelectorAll('.check-produto');

    checks.forEach(function(elemento) {
        elemento.checked = true;
    });
}

function desmarcarTodosItens() {
    const checks = document.querySelectorAll('.check-produto');

    checks.forEach(function(elemento) {
        elemento.checked = false;
    });
}

function getVenda(id) {
	toggleLoader();
	
	const options = {
		method: 'POST',
		headers: {
			'Content-Type': 'text/html'
		},
		body: JSON.stringify({id})
	}

	fetch('venda/get-venda', options)
		.then(function(response) {
			return response.text();
		})
		.then(function(html) {
			if (html === '') {
				return alert('Não foi buscar as informações da venda.');
			}

			const eConteudoFormulario = document.querySelector('#conteudo-formulario');
			eConteudoFormulario.innerHTML = html;

			const $eModal = document.getElementById('modalEditar');
			const modal  = new bootstrap.Modal($eModal);
			modal.show();
		})
		.catch(function(error) {
			console.error(error.message);
		})
		.finally(function() {
			toggleLoader('hide');
		});
}

function abrirModalIncluirEditarItem() 
{
	const $produtoId = document.querySelector('#produto-id');
	
	$inputPesquisaProduto.removeAttribute('readonly');
	$produtoId.removeAttribute('readonly');
	$produtoId.setAttribute('size', 3);

	const $eModal = document.getElementById('modalIncluirEditarItem');
	const modal = new bootstrap.Modal($eModal);

	modal.show();
}

function buscarDadosDoProduto(id) {
	toggleLoader();
	
	const options = {
		method: 'POST',
		body: JSON.stringify({id})
	}

	fetch('venda/buscar-produto', options)
		.then(function(response) {
			return response.json();
		})
		.then(function(json) {
			if (json.error) {
				return alert(json.message);
			}

			document.querySelector('#produto-preco').value = json.data.preco;
			document.querySelector('#produto-qtd').value = json.data.qtd_padrao;
		})
		.catch(function(error) {
			console.error(error.message);
		})
		.finally(function() {
			toggleLoader('hide');
		});
}