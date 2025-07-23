# 🛒 Mini ERP de Pedidos em Laravel

Este projeto é uma aplicação Laravel que simula um pequeno sistema de gestão de pedidos, produtos e cupons. Ele possui cadastro de produtos com variações e estoque, controle de carrinho, cálculo de frete com base em regras específicas, aplicação de cupons e integração com a API ViaCEP. Também é possível finalizar pedidos, enviar e-mail de confirmação e escutar um webhook para atualização de status do pedido.

---

## 🔧 Tecnologias

- PHP 8+
- Laravel 12
- MySQL
- Bootstrap (frontend simples)
- Mailtrap (para testes de e-mail)
- API ViaCEP (busca de endereço por CEP)

---

## 📦 Instalação

```bash
git clone https://github.com/seu-usuario/nome-do-repositorio.git
cd nome-do-repositorio
npm install && npm run build
composer run dev
```
Configure o .env com as suas configurações de banco de dados e Mailtrap

```bash
DB_DATABASE=mini_erp
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=seu_usuario_mailtrap
MAIL_PASSWORD=sua_senha_mailtrap
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=teste@example.com
MAIL_FROM_NAME="Mini ERP"
```
## 🧪 Rodando o Projeto

```bash
php artisan migrate --seed
php artisan serve
```

## 🗃️ Estrutura do Banco de Dados

- products: Armazena os produtos.
- stocks: Relacionado a cada variação de produto.
- coupons: Cupons de desconto com validade e valor mínimo.
- orders: Pedidos realizados com subtotal, frete, total e status.
- order_itens: Itens que compõe o pedido

Exemplo de criação das tabelas está incluído nas migrations.`

## 📋 Funcionalidades

✅ Cadastro de produtos com suas variações e quantidade por variação

✅ Carrinho de compras

✅ Validação de CEP

✅ Envio de e-mail na finalização do pedido

✅ Webhook para atualização do status do pedido

## 📄 Exemplo de Payload Webhook

```bash
{
  "id": 1,
  "status": "cancelado"
}
```
