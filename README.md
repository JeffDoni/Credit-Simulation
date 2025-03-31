# 📊 Credit Simulation API

Esta é uma API REST desenvolvida em Laravel com o objetivo de simular empréstimos usando arquivos `.json` como fonte de dados (substituindo o banco de dados tradicional).

---

## ✅ Requisitos

- PHP 8.1 ou superior
- Composer
- Laravel 12.x
- WSL ou terminal configurado no Windows
- Git

---

## 🚀 Como iniciar o projeto

### 1. Clone o repositório

```bash
git clone https://github.com/seu-usuario/seu-repo.git
cd seu-repo
```

### 2. Instale as dependências do projeto

Utilize o Composer para instalar todas as dependências do Laravel:

```bash
composer install
```

Esse comando cria a pasta `vendor/` com todas as bibliotecas necessárias.

---

### 3. Gere o arquivo `.env` e a chave da aplicação

Crie seu próprio arquivo `.env` com base no arquivo de exemplo:

```bash
cp .env.example .env
```

Agora, gere a chave da aplicação:

```bash
php artisan key:generate
```

Você verá a mensagem:

```
Application key set successfully.
```

> Isso insere automaticamente a variável `APP_KEY` no seu `.env`.

---

### 4. Inicie o servidor local do Laravel

Execute:

```bash
php artisan serve
```

O terminal exibirá algo como:

```
Starting Laravel development server: http://127.0.0.1:8000
```

Você pode acessar a API no navegador ou via Postman no endereço:

```
http://127.0.0.1:8000
```

---

## 📂 Estrutura de dados (substituindo banco de dados)

Os dados utilizados pela API estão localizados em:

```
resources/json/
```

Arquivos incluídos:

- `instituicoes.json`
- `convenios.json`
- `taxas_instituicoes.json`

Esses arquivos funcionam como o "banco de dados" da aplicação.

---

## 📬 Endpoints disponíveis

### 🔹 `GET /api/instituicoes`

Retorna todas as instituições disponíveis.

#### Exemplo de resposta:

```json
[
  { "chave": "PAN", "valor": "Pan" },
  { "chave": "OLE", "valor": "Ole" },
  { "chave": "BMG", "valor": "Bmg" }
]
```

---

### 🔹 `GET /api/convenios`

Retorna todos os convênios disponíveis.

#### Exemplo de resposta:

```json
[
  { "chave": "INSS", "valor": "INSS" },
  { "chave": "FEDERAL", "valor": "Federal" },
  { "chave": "SIAPE", "valor": "Siape" }
]
```

---

### 🔹 `POST /api/simulacao`

Realiza a simulação de crédito com base nos dados fornecidos.

#### Payload mínimo:

```json
{
  "valor_emprestimo": 10000
}
```

#### Payload completo (com filtros):

```json
{
  "valor_emprestimo": 10000,
  "instituicoes": ["BMG"],
  "convenios": ["INSS"],
  "parcela": 72
}
```

#### Observações:
- Se apenas `valor_emprestimo` for enviado, a API retorna simulações de **todas as instituições e convênios**.
- Ao aplicar filtros (`instituicoes`, `convenios`, `parcela`), a API retorna apenas os resultados compatíveis.

---

## 📌 Observações

- Nenhum banco de dados é utilizado
- Os dados são lidos diretamente de arquivos `.json` em `resources/json/`
- Ideal para desafios técnicos, protótipos ou estudos de API com Laravel
