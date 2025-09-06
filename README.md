# Sistema de Carrinho de compras.

Integrantes:

- Alani Rodrigues  RA: 1986006
- Giovanna Batista RA:1991571


Passos a passo para iniciar e executar o XAMPP:
1. No Painel de Controle do XAMPP, inicie os módulos "Apache" e "MySQL" clicando em "Start" nos respetivos botões.
2. Navegue até a pasta de instalação do XAMPP (normalmente C:\xampp no Windows). 
3. Baixe e adicione os seus arquivos PHP dentro da pasta htdocs para que possam ser executados no servidor local.
4. Abra um navegador da web e digite http://localhost seguido do nome do seu arquivo PHP (por exemplo, http://localhost/index.php) na barra de endereços. 
5. O navegador exibirá o resultado da execução do script, permitindo que você veja os teste do código.

  _Documentação:_
  
Classe: Carrinho

Funções publicas:

@AdicionarCarrinho:
_A a função @encontrarProduto, valida buscando pelo $indiceCatalogo(ID) se o produto existe no catalogo_
_$estoqueDisponivel ele valida se a quantidade passada tem disponivel no estoque, caso valor seja maior o processo para,
caso não ele remove a quantidade solicitada e altera o estoque do $catalogoProdutos(estoque)_
_Retorna ao usuario a atualização do carrinho_

@removerProduto:
_As validações são feitas por True e False, ele valida pelo Id do prroduto se ele está no carrinho,
se a quantidade solicitada de remover não for nula ou menor que a quantidade existente, ele retira e adiciona novamente ao estoque_

@listarProdutos:
_Valida se há itens, mostra caso tenha, trás caso esteja nulo não retorna, também trás a soma dos produtos, e também exibe a aplicação do cupom sob o valor total_

Funções privadas:

@getSubTotal:
_valida os valores em float, soma todos os itens dentro do carrinho pela quantidade_

@encontrarProduto:
_busca o indice por posição do id dentro do array do catalogoProduto, trás o retirno do ID sendo diferente de nullo_


  
