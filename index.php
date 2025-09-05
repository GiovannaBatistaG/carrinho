<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once 'carrinho.php';


echo '<pre>';


$meuCarrinho = new Carrinho();

echo "--- Iniciando Compras ---\n";
$meuCarrinho->adicionarProduto(1, 2);  
$meuCarrinho->adicionarProduto(3, 1);   
$meuCarrinho->adicionarProduto(99, 1);   
$meuCarrinho->adicionarProduto(2, 10);  
echo "\n";


$meuCarrinho->listarProdutos();
echo "\n";


echo "--- Aplicando Desconto ---\n";
$meuCarrinho->aplicarDesconto('DESCONTO10');
echo "\n";

// Mostra a lista e o total com desconto
$meuCarrinho->listarProdutos();
echo "\n";

echo '</pre>';


?>
