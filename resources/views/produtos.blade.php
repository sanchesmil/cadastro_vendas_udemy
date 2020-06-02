@extends('layouts.app',['urlAtual'=>'produtos'])

@section('body')

    <h4>Página de Produtos</h4>
    <hr>

    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Cadastro de Produtos</h5>

            <table class="table table-ordered table-hover" id="tabelaProdutos">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Quantidade</th>
                        <th>Preço</th>
                        <th>Categoria</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Os produtos serão adicionados via JavaScript --}}
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary btn-sm" role="button" onclick="novoProduto()" >Novo Produto</button>
        </div>
    </div>

    {{-- modal que cadastra novos usuários --}}
    <div class="modal" tabindex="-1" role="dialog" id="dlgProdutos">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="formProduto">
                    <div class="modal-header">
                        <h5>Novo Produto</h5>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id" class="form-control">

                        <div class="form-group">
                            <label for="nomeProduto" class="control-label">Nome do Produto</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="nomeProduto" placeholder="Nome do Produto">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="precoProduto" class="control-label">Preço</label>
                            <div class="input-group">
                                <input type="float" class="form-control" id="precoProduto" placeholder="Preço do Produto">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="quantidadeProduto" class="control-label">Quantidade</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="quantidadeProduto" placeholder="Quantidade do Produto">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="categoriaProduto" class="control-label">Categoria</label>
                            <div class="input-group">
                                <select class="form-control" id="categoriaProduto">
                                    {{-- As opções serão adicionadas via JavaScript --}}
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        {{-- o atributo 'data-dissmiss' fecha a modal --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

{{-- Cria uma seção de javascript p/ exibir produtos e categorias, e p/ abrir a modal que cadastra novos produtos --}}
@section('javascript')
    <script>

        // O método 'ajaxSetup()' do JQuery permite definir a configuração inicial do JavaScript
        // Ele permite definir valores padrão para qualquer evento AJAX em sua aplicação.
        $.ajaxSetup({
            headers:{
                // Adiciona o Token gerado pelo laravel a todos os cabeçalhos de solicitação.
                // Isso fornece proteção CSRF p/ apps baseados em ajax
                'X-CSRF-TOKEN': "{{ csrf_token() }}"  
            }

        })  

        // Mostra a modal de novoProduto
        function novoProduto(event){
            // Sempre que abrir a modal limpa os campos inputs
            /*
            $('#id').val('');
            $('#nomeProduto').val('');
            $('#precoProduto').val('');
            $('#quantidadeProduto').val('');
            */

            // ou 
            
            //Antes de abrir a modal, limpa todos os inputs usando 'for'
            $('#dlgProdutos input').each(function() {
                $(this).val(''); 
             });

            // Mostra a modal
            $('#dlgProdutos').modal('show');
        }

        // Método que monta uma 'tr' com os dados do produto
        function montarLinha(produto){
            var linha = '<tr> ' +
                        '<td>' + produto.id + '</td>' +
                        '<td>' + produto.nome + '</td>' +
                        '<td>' + produto.estoque + '</td>' +
                        '<td>' + produto.price + '</td>' +
                        '<td>' + produto.categoria_id + '</td>' +
                        '<td>' + 
                            '<button class="btn btn-primary btn-sm" onclick="editar('+ produto.id +')">Editar</button>' +
                            '<button class="btn btn-danger btn-sm" onclick="remover('+ produto.id +')">Apagar</button>' +
                        '</td>'+
                        '</tr>';
            return linha;
        }

        // Exibe a modal 'dlgProdutos' populada
        function editar(id){

            // 2 FORMAS de popular a Modal: 

            // 1ª FORMA: Pegando os valores da própria tabela, sem consultar o banco
            linhasDaTabela = $('#tabelaProdutos>tbody>tr'); // Pega todas as tr's

            linhasDaTabela.filter(function(i, elemento){  // Filtra a 'tr' desejada pelo 'id'
                if(elemento.cells[0].textContent == id){  

                    //Popula os campos da modal com os valores da tr selecionada
                    $('#id').val(elemento.cells[0].textContent),
                    $('#nomeProduto').val(elemento.cells[1].textContent),
                    $('#quantidadeProduto').val(elemento.cells[2].textContent),
                    $('#precoProduto').val(elemento.cells[3].textContent),                   
                    $('#categoriaProduto').val(elemento.cells[4].textContent),
                    
                    $('#dlgProdutos').modal('show')  // Exibe a modal                
                }
            });

            // 2ª FORMA: Consultando o banco 
            /*
            $.getJSON('api/produtos/'+ id,function(produto){
                //console.log(produto);

                //Popula os campos da modal com os valores retornados do banco
                $('#id').val(produto.id),
                $('#nomeProduto').val(produto.nome),
                $('#precoProduto').val(produto.price),
                $('#quantidadeProduto').val(produto.estoque),
                $('#categoriaProduto').val(produto.categoria_id),

                $('#dlgProdutos').modal('show')  // Exibe a modal

            });

            */
        }

        // Método que remove o produto via Ajax
        function remover(id){
            $.ajax({
                type: "DELETE",
                url: "api/produtos/" + id,
                context: this,
                success: function(data){
                    //console.log('Apagou: ' + data);
                    removeLinha(id);
                },
                error: function(error){
                    console.log(error);
                }
            });
        }

        function removeLinha(id){
            linhasDaTabela = $('#tabelaProdutos>tbody>tr'); // Obtém todas as tr's

            linha = linhasDaTabela.filter(function(i, elemento){  // Filtra a 'tr' através do id
                return elemento.cells[0].textContent == id
            })

            if(linha) {
                linha.remove();
            }
        }


        function carregarProdutos(){
            $.getJSON('api/produtos',function(produtos){
                for(i=0;i<produtos.length;i++){
                    //console.log(produtos);
                    linha = montarLinha(produtos[i]);
                    $('#tabelaProdutos>tbody').append(linha);
                }
            });
        }

        function carregarCategorias(){
            //Recupera as categorias via javascript
            $.getJSON('/api/categorias', function (categorias){
                //console.log(categorias);
                for(i=0; i<categorias.length; i++){
                    opcao = '<option value="'+ categorias[i].id + '">'+ categorias[i].nome + '</option>';
                    $('#categoriaProduto').append(opcao);
                }
            });
        }

        function criarProduto(){
            // Cria um produto com os dados da modal
            prod = {
               nome: $('#nomeProduto').val(),
               preco: $('#precoProduto').val(),
               estoque: $('#quantidadeProduto').val(),
               categoria_id: $('#categoriaProduto').val()
           }

           // Envia requisição ajax com método 'post' para o Laravel 
           $.post('api/produtos', prod, function(data){ 
               produto = JSON.parse(data); // Converte 'data' (dado serializado) em objeto

               // Popula a tabela com o novo produto
               linha = montarLinha(produto);
               $('#tabelaProdutos>tbody').append(linha);
            })
        }
        
        function salvarProduto(id){
            // Cria um produto com os dados da modal
            prod = {
                id: $('#id').val(),
                nome: $('#nomeProduto').val(),
                preco: $('#precoProduto').val(),
                estoque: $('#quantidadeProduto').val(),
                categoria_id: $('#categoriaProduto').val()
            }

            $.ajax({
                type: "PUT",
                url: "api/produtos/" + id,
                context: this,
                data: prod,  // recebe o produto
                success: function(data){
                    //console.log('Editar OK');

                    produto = JSON.parse(data); // Converte 'data' (string) em objeto json

                    linhas = $('#tabelaProdutos>tbody>tr');  // Pega todas as linhas de produto da tabela
                   
                    linhaProduto = linhas.filter(function(i,elemento){ // Pega a linha que contem o produto a ser alterado
                        return (elemento.cells[0].textContent == produto.id);  
                    }); 

                    // Se achou o produto, atualiza seus valores
                    if(linhaProduto){
                        linhaProduto[0].cells[0].textContent = produto.id,
                        linhaProduto[0].cells[1].textContent = produto.nome,
                        linhaProduto[0].cells[2].textContent = produto.estoque,
                        linhaProduto[0].cells[3].textContent = produto.price,
                        linhaProduto[0].cells[4].textContent = produto.categoria_id
                    }

                },
                error: function(error){
                    console.log('Deu erro: ');
                    console.log(error);
                }
            });
        }

        // Ao submeter o form CRIA ou EDITA o produto
        $('#formProduto').submit(function(event){

            event.preventDefault();  // Previne o comportamento padrão do botão submit que é recarregar a página

            id = $('#id').val(); // obtém o campo 'id'

            //Verifica se 'id' possui valor, isto é, se já existe um produto.
            if(id != ''){  
                salvarProduto(id); // Salva as alterações do produto
            }else{
                criarProduto();  // Criar produto 
            }

            $('#dlgProdutos').modal('hide'); // Fecha a modal
        })
        
    
        //Função executada sempre que a página é carregada
        $(function(){
            carregarProdutos();
            carregarCategorias();
        })

    </script>
@endsection