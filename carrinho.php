<?php

class Carrinho
{

    private array $catalogoProdutos = [
        ['id' => 1, 'nome' => 'Camiseta', 'preco' => 59.90, 'estoque' => 10],
        ['id' => 2, 'nome' => 'Calça Jeans', 'preco' => 129.90, 'estoque' => 5],
        ['id' => 3, 'nome' => 'Tênis', 'preco' => 199.90, 'estoque' => 3]
    ];
    
    
    private array $itens = []; 
    private ?string $cupomDesconto = null;


    public function adicionarProduto(int $produtoId, int $quantidade): bool
    {
        $indiceCatalogo = $this->encontrarProduto($produtoId);
        if ($indiceCatalogo === null) {
            echo "Erro: Produto com ID $produtoId não encontrado no catálogo.\n";
            return false;
        }

        $produto = $this->catalogoProdutos[$indiceCatalogo];
        $estoqueDisponivel = $produto['estoque'];

        if ($quantidade > $estoqueDisponivel) {
            echo "Erro: Estoque insuficiente para o produto '{$produto['nome']}'. Disponível: $estoqueDisponivel.\n";
            return false;
        }

        if (isset($this->itens[$produtoId])) {
            $this->itens[$produtoId]['quantidade'] += $quantidade;
        } else {
            $this->itens[$produtoId] = [
                'quantidade' => $quantidade,
                'preco_unitario' => $produto['preco'],
                'nome' => $produto['nome']
            ];
        }

        $this->catalogoProdutos[$indiceCatalogo]['estoque'] -= $quantidade;
        echo "Produto '{$produto['nome']}' adicionado ao carrinho.\n";
        return true;
    }


    public function removerProduto(int $produtoId): bool
    {
        if (!isset($this->itens[$produtoId])) {
            echo "Erro: Produto com ID $produtoId não está no carrinho.\n";
            return false;
        }

        $quantidadeRemovida = $this->itens[$produtoId]['quantidade'];
        $nomeProduto = $this->itens[$produtoId]['nome'];

        $indiceCatalogo = $this->encontrarProduto($produtoId);
        if ($indiceCatalogo !== null) {
            $this->catalogoProdutos[$indiceCatalogo]['estoque'] += $quantidadeRemovida;
        }

        unset($this->itens[$produtoId]);

        echo "Produto '$nomeProduto' removido do carrinho.\n";
        return true;
    }

    public function listarProdutos(): void
    {
        if (empty($this->itens)) {
            echo "O carrinho está vazio.\n";
            return;
        }
        
        echo "--- Itens no Carrinho ---\n";
        foreach ($this->itens as $item) {
            $subtotal = $item['quantidade'] * $item['preco_unitario'];
            echo "Produto: {$item['nome']} | Qtd: {$item['quantidade']} | Preço Un.: R$ " . number_format($item['preco_unitario'], 2, ',', '.') . " | Subtotal: R$ " . number_format($subtotal, 2, ',', '.') . "\n";
        }
        echo "-------------------------\n";

        $subtotal = $this->getSubtotal();
        echo "Subtotal: R$ " . number_format($subtotal, 2, ',', '.') . "\n";

        if ($this->cupomDesconto === 'DESCONTO10') {
            $valorDesconto = $subtotal * 0.10;
            echo "Desconto (10%): - R$ " . number_format($valorDesconto, 2, ',', '.') . "\n";
        }

        echo "TOTAL A PAGAR: R$ " . number_format($this->calcularTotal(), 2, ',', '.') . "\n";
    }


    public function aplicarDesconto(string $cupom): void
    {
        if ($cupom === 'DESCONTO10') {
            $this->cupomDesconto = $cupom;
            echo "Cupom 'DESCONTO10' aplicado com sucesso!\n";
        } else {
            echo "Erro: Cupom inválido.\n";
        }
    }


    public function calcularTotal(): float
    {
        $total = $this->getSubtotal();
        
        if ($this->cupomDesconto === 'DESCONTO10') {
            $valorDesconto = $total * 0.10;
            $total -= $valorDesconto;
        }

        return $total;
    }


    private function getSubtotal(): float
    {
        $subtotal = 0.0;
        foreach ($this->itens as $item) {
            $subtotal += $item['quantidade'] * $item['preco_unitario'];
        }
        return $subtotal;
    }


    private function encontrarProduto(int $produtoId): ?int
    {
        $indice = array_search($produtoId, array_column($this->catalogoProdutos, 'id'));
        return $indice === false ? null : $indice;
    }
}

?>