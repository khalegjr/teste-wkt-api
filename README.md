# WKT-API

## Teste de backend WK Technology

Por falta de tempo só fiz as features de clientes e produtos.

- Cadastro de Clientes.
- Listagem de Clientes.
- Edição de um Cliente.
- Exclusão de um Cliente.

- Cadastro de Produtos.
- Listagem de Produtos.
- Edição de um Produto.
- Exclusão de um Produto.

## Docker

Se quiser utilizar docker para o ambiente de desenvolvimento basta utillizar a ferramenta `sail` do _Laravel_.

```bash
./vendor/bin/sail up -d # para subir todos os serviços em modo daemon
```
Execute esse comando somente atualizar as variáveis de ambiente.

## Configurando o ambiente
Copie o arquivo _.env.example_ para _.env_. Conforme a necessidade altere as variáveis de ambiente `DB_PORT`, `DB_USERNAME` e `DB_PASSWORD` no arquivo _.env_, para definir seu ambiente de banco de dados. E, para definir a porta de acesso da API altere a variável `APP_PORT`, por padrão a porta é a 80.

Após isso, basta os seguintes comandos para preparar o ambiente.
```bash
./vendor/bin/sail artisan key: generate  # para gerar uma chave única para a aplicaçào
./vendor/bin/sail artisan migrate  # para gerar o banco de dados da aplicação
```

Apenas isso e o ambiente já estará funcional.

Execute o seguinte comando para rodar os testes:

Após isso, basta os seguintes comandos para preparar o ambiente.
```bash
./vendor/bin/sail artisan test  # para rodar os testes da aplicação
```
