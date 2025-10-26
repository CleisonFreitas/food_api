<?php

namespace App\Support;

use App\Models\Client;
use Illuminate\Support\Str;

class Helper
{
    public static function registerNewToken(Client $cliente): array
    {
        $chaveToken = Str::snake($cliente->nome) . now()->format('d_m_Y');
        $token = $cliente->createToken(
            $chaveToken,
            ['*'],
            now()->endOfDay()
        )->plainTextToken;

        return [
            'cliente' => $cliente,
            'token' => $token,
        ];
    }

    public static function FoodFactory(): array
    {
        return [
            ['nome' => 'Pizza Margherita', 'categoria' => 'Pizza', 'valor' => 39.90, 'image' => 'images/pizzas/margherita.jpg'],
            ['nome' => 'Pizza Calabresa', 'categoria' => 'Pizza', 'valor' => 42.50, 'image' => 'images/pizzas/calabresa.jpg'],
            ['nome' => 'Pizza Quatro Queijos', 'categoria' => 'Pizza', 'valor' => 44.90, 'image' => 'images/pizzas/quatro-queijos.jpg'],
            ['nome' => 'Pizza Frango com Catupiry', 'categoria' => 'Pizza', 'valor' => 43.90, 'image' => 'images/pizzas/frango-catupiry.jpg'],
            ['nome' => 'Pizza Portuguesa', 'categoria' => 'Pizza', 'valor' => 45.90, 'image' => 'images/pizzas/portuguesa.jpg'],
            ['nome' => 'Pizza Napolitana', 'categoria' => 'Pizza', 'valor' => 41.90, 'image' => 'images/pizzas/napolitana.jpg'],
            ['nome' => 'Pizza Pepperoni', 'categoria' => 'Pizza', 'valor' => 46.90, 'image' => 'images/pizzas/pepperoni.jpg'],
            ['nome' => 'Hambúrguer Clássico', 'categoria' => 'Lanches', 'valor' => 24.90, 'image' => 'images/lanches/hamburguer-classico.jpg'],
            ['nome' => 'X-Bacon', 'categoria' => 'Lanches', 'valor' => 27.90, 'image' => 'images/lanches/x-bacon.jpg'],
            ['nome' => 'X-Tudo', 'categoria' => 'Lanches', 'valor' => 29.90, 'image' => 'images/lanches/x-tudo.jpg'],
            ['nome' => 'Hambúrguer Vegano', 'categoria' => 'Lanches', 'valor' => 25.90, 'image' => 'images/lanches/hamburguer-vegano.jpg'],
            ['nome' => 'Sanduíche Natural', 'categoria' => 'Lanches', 'valor' => 16.90, 'image' => 'images/lanches/sanduiche-natural.jpg'],
            ['nome' => 'Wrap de Frango', 'categoria' => 'Lanches', 'valor' => 21.90, 'image' => 'images/lanches/wrap-frango.jpg'],
            ['nome' => 'Cachorro-Quente Tradicional', 'categoria' => 'Lanches', 'valor' => 19.90, 'image' => 'images/lanches/cachorro-quente.jpg'],
            ['nome' => 'Batata Frita', 'categoria' => 'Acompanhamentos', 'valor' => 14.90, 'image' => 'images/acompanhamentos/batata-frita.jpg'],
            ['nome' => 'Batata Frita com Cheddar e Bacon', 'categoria' => 'Acompanhamentos', 'valor' => 18.90, 'image' => 'images/acompanhamentos/batata-cheddar.jpg'],
            ['nome' => 'Onion Rings', 'categoria' => 'Acompanhamentos', 'valor' => 16.90, 'image' => 'images/acompanhamentos/onion-rings.jpg'],
            ['nome' => 'Nuggets de Frango', 'categoria' => 'Acompanhamentos', 'valor' => 15.90, 'image' => 'images/acompanhamentos/nuggets.jpg'],
            ['nome' => 'Strogonoff de Frango', 'categoria' => 'Pratos', 'valor' => 32.90, 'image' => 'images/pratos/strogonoff-frango.jpg'],
            ['nome' => 'Strogonoff de Carne', 'categoria' => 'Pratos', 'valor' => 34.90, 'image' => 'images/pratos/strogonoff-carne.jpg'],
            ['nome' => 'Bife à Parmegiana', 'categoria' => 'Pratos', 'valor' => 36.90, 'image' => 'images/pratos/parmegiana.jpg'],
            ['nome' => 'Lasanha à Bolonhesa', 'categoria' => 'Massas', 'valor' => 33.90, 'image' => 'images/massas/lasanha-bolonhesa.jpg'],
            ['nome' => 'Lasanha de Frango', 'categoria' => 'Massas', 'valor' => 32.50, 'image' => 'images/massas/lasanha-frango.jpg'],
            ['nome' => 'Espaguete Carbonara', 'categoria' => 'Massas', 'valor' => 31.90, 'image' => 'images/massas/carbonara.jpg'],
            ['nome' => 'Nhoque de Batata', 'categoria' => 'Massas', 'valor' => 29.90, 'image' => 'images/massas/nhoque.jpg'],
            ['nome' => 'Salada Caesar', 'categoria' => 'Saladas', 'valor' => 22.90, 'image' => 'images/saladas/caesar.jpg'],
            ['nome' => 'Salada Tropical', 'categoria' => 'Saladas', 'valor' => 23.90, 'image' => 'images/saladas/tropical.jpg'],
            ['nome' => 'Caldo Verde', 'categoria' => 'Sopas', 'valor' => 19.90, 'image' => 'images/sopas/caldo-verde.jpg'],
            ['nome' => 'Sopa de Legumes', 'categoria' => 'Sopas', 'valor' => 17.90, 'image' => 'images/sopas/legumes.jpg'],
            ['nome' => 'Pão de Alho', 'categoria' => 'Entradas', 'valor' => 9.90, 'image' => 'images/entradas/pao-alho.jpg'],
            ['nome' => 'Pão de Queijo', 'categoria' => 'Entradas', 'valor' => 8.90, 'image' => 'images/entradas/pao-queijo.jpg'],
            ['nome' => 'Coxinha de Frango', 'categoria' => 'Salgados', 'valor' => 6.90, 'image' => 'images/salgados/coxinha.jpg'],
            ['nome' => 'Bolinha de Queijo', 'categoria' => 'Salgados', 'valor' => 5.90, 'image' => 'images/salgados/bolinha-queijo.jpg'],
            ['nome' => 'Pastel de Carne', 'categoria' => 'Salgados', 'valor' => 7.90, 'image' => 'images/salgados/pastel-carne.jpg'],
            ['nome' => 'Kibe Frito', 'categoria' => 'Salgados', 'valor' => 6.90, 'image' => 'images/salgados/kibe.jpg'],
            ['nome' => 'Açaí Tradicional', 'categoria' => 'Sobremesas', 'valor' => 19.90, 'image' => 'images/sobremesas/acai.jpg'],
            ['nome' => 'Açaí com Frutas', 'categoria' => 'Sobremesas', 'valor' => 22.90, 'image' => 'images/sobremesas/acai-frutas.jpg'],
            ['nome' => 'Pudim de Leite', 'categoria' => 'Sobremesas', 'valor' => 9.90, 'image' => 'images/sobremesas/pudim.jpg'],
            ['nome' => 'Mousse de Maracujá', 'categoria' => 'Sobremesas', 'valor' => 8.90, 'image' => 'images/sobremesas/mousse-maracuja.jpg'],
            ['nome' => 'Brigadeiro', 'categoria' => 'Sobremesas', 'valor' => 4.90, 'image' => 'images/sobremesas/brigadeiro.jpg'],
            ['nome' => 'Torta de Limão', 'categoria' => 'Sobremesas', 'valor' => 11.90, 'image' => 'images/sobremesas/torta-limao.jpg'],
            ['nome' => 'Brownie de Chocolate', 'categoria' => 'Sobremesas', 'valor' => 12.90, 'image' => 'images/sobremesas/brownie.jpg'],
            ['nome' => 'Milkshake de Chocolate', 'categoria' => 'Bebidas', 'valor' => 14.90, 'image' => 'images/bebidas/milkshake-chocolate.jpg'],
            ['nome' => 'Milkshake de Morango', 'categoria' => 'Bebidas', 'valor' => 14.90, 'image' => 'images/bebidas/milkshake-morango.jpg'],
            ['nome' => 'Suco Natural de Laranja', 'categoria' => 'Bebidas', 'valor' => 9.90, 'image' => 'images/bebidas/suco-laranja.jpg'],
            ['nome' => 'Suco de Maracujá', 'categoria' => 'Bebidas', 'valor' => 9.90, 'image' => 'images/bebidas/suco-maracuja.jpg'],
            ['nome' => 'Refrigerante Lata', 'categoria' => 'Bebidas', 'valor' => 6.00, 'image' => 'images/bebidas/refrigerante-lata.jpg'],
            ['nome' => 'Água Mineral', 'categoria' => 'Bebidas', 'valor' => 4.00, 'image' => 'images/bebidas/agua.jpg'],
            ['nome' => 'Cerveja Long Neck', 'categoria' => 'Bebidas', 'valor' => 9.90, 'image' => 'images/bebidas/cerveja.jpg'],
            ['nome' => 'Espetinho de Carne', 'categoria' => 'Churrasco', 'valor' => 11.90, 'image' => 'images/churrasco/espetinho-carne.jpg'],
            ['nome' => 'Espetinho de Frango', 'categoria' => 'Churrasco', 'valor' => 10.90, 'image' => 'images/churrasco/espetinho-frango.jpg'],
            ['nome' => 'Espetinho de Queijo Coalho', 'categoria' => 'Churrasco', 'valor' => 9.90, 'image' => 'images/churrasco/espetinho-frango.jpg']
        ];
    }
}
