<?php

// Ativa a exibição de todos os erros (útil para desenvolvimento)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inclui o arquivo da classe Carrinho
require_once 'carrinho.php';

// A tag <pre> ajuda a formatar a saída no navegador, respeitando as quebras de linha
echo '<pre>';

// Cria uma nova instância do carrinho
$meuCarrinho = new Carrinho();

echo "--- Iniciando Compras ---\n";
$meuCarrinho->adicionarProduto(1, 2);    // Adiciona 2 Camisetas
$meuCarrinho->adicionarProduto(3, 1);    // Adiciona 1 Tênis
$meuCarrinho->adicionarProduto(99, 1);   // Tenta adicionar um produto que não existe
$meuCarrinho->adicionarProduto(2, 10);   // Tenta adicionar com estoque insuficiente
echo "\n";

// Lista os produtos no carrinho
$meuCarrinho->listarProdutos();
echo "\n";

// Aplica um cupom de desconto
echo "--- Aplicando Desconto ---\n";
$meuCarrinho->aplicarDesconto('DESCONTO10');
echo "\n";

// Mostra a lista e o total com desconto
$meuCarrinho->listarProdutos();
echo "\n";

echo '</pre>';

?>