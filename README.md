# **📌 Logcomex Case - Aplicação PHP + Vue.js + Docker**

Este projeto é uma aplicação BI desenvolvida com **PHP (Laravel) para o backend**, **Vue.js para o frontend** e **Docker para ambiente de desenvolvimento**.

---

## **🚀 Passo a Passo para Rodar a Aplicação**

### **1️⃣ Requisitos Mínimos**
Antes de iniciar, você precisa ter instalado na sua máquina:
- **Docker** e **Docker Compose** ([Instalar Docker](https://docs.docker.com/get-docker/))
- **Git** ([Instalar Git](https://git-scm.com/downloads))
- **Node.js (mínimo v18)** ([Instalar Node.js](https://nodejs.org/))
- **Composer (gerenciador do PHP)** ([Instalar Composer](https://getcomposer.org/))

### **2️⃣ Clonar o Repositório**
```bash
git clone https://github.com/filipe-abreu/logcomex-case.git
cd logcomex-case
```

### **3️⃣ Configurar o Arquivo `.env`**
Antes de rodar a aplicação, é necessário configurar as variáveis de ambiente do Laravel.

1. Copie o arquivo `.env.example` para `.env`:
   ```bash
   cp backend/.env.example backend/.env
   ```
2. Edite o arquivo `.env` para configurar o banco de dados:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=db
   DB_PORT=3306
   DB_DATABASE=logcomex
   DB_USERNAME=user
   DB_PASSWORD=123
   ```

### **4️⃣ Subir a Aplicação com Docker**
```bash
docker-compose up -d --build
```

Este comando:
- **Constrói e sobe os containers** do backend (Laravel), frontend (Vue.js) e banco de dados (MySQL).
- **Expõe a aplicação**:
  - Backend Laravel rodando em `http://localhost:80`
  - Frontend Vue.js rodando em `http://localhost:8080`

### **5️⃣ Gerar a Chave da Aplicação**
Após subir os containers, execute:
```bash
docker-compose exec app php artisan key:generate
```
Isso garante que o Laravel tenha uma chave única para criptografia.

### **6️⃣ Configurar o Banco de Dados e Rodar Migrations**
```bash
docker-compose exec app php artisan migrate --seed
```
Isso cria as tabelas do banco e insere dados fake para testes.

### **7️⃣ Acessar a Aplicação**
- **Frontend:** `http://localhost:8080`
- **Backend (API):** `http://localhost:80/api`

---

## **📌 Endpoints do Backend (Laravel API)**

### **1️⃣ Dashboard**
- `GET /api/dashboard`
- **Descrição:** Retorna os 10 itens com maior quantidade de forma dinâmica.

### **2️⃣ Listagem de Itens com Filtros e Paginação**
- `GET /api/items`
- **Parâmetros opcionais:**
  - `codigo` → Filtra por código do item.
  - `nome` → Filtra por nome do item.
  - `page` → Define a página a ser carregada (padrão: 1).
- **Exemplo de requisição:**
```bash
curl -X GET "http://localhost:80/api/items?codigo=ABC123&page=2"
```

---

## **📌 Páginas do Frontend (Vue.js)**

### **1️⃣ Página Inicial** (`/`)
Tela de boas-vindas com links para:
- `/dashboard` (Gráficos)
- `/details` (Lista de Itens)

### **2️⃣ Dashboard** (`/dashboard`)
- Exibe **gráficos de barras e pizza** com os **10 itens mais relevantes**.
- Dados vêm de `GET /api/dashboard`.

### **3️⃣ Lista de Itens com Filtros** (`/details`)
- Lista todos os itens com **filtros por Código e Nome**.
- Suporta **paginação** (50 itens por página).
- Permite **navegar entre páginas**.
- Botão de **Limpar filtros**.

---

## **📌 Comandos Úteis**

### **⏳ Resetar Banco de Dados**
Se precisar resetar o banco:
```bash
docker-compose exec app php artisan migrate:fresh --seed
```

### **🛠️ Limpar Cache do Laravel**
```bash
docker-compose exec app php artisan cache:clear
```

### **📋 Listar Rotas Disponíveis**
```bash
docker-compose exec app php artisan route:list
```

### **🐳 Reiniciar os Containers**
```bash
docker-compose down && docker-compose up -d --build
```

### **📝 Ver Logs do Backend**
```bash
docker-compose logs -f app
```

### **📝 Ver Logs do Frontend**
```bash
docker-compose logs -f frontend
```

---

## **🛑 Possíveis Erros e Soluções**

### **1️⃣ Erro: "Base table or view already exists: 1050 Table 'items' already exists"**
**Solução:** Resetar as migrations:
```bash
docker-compose exec app php artisan migrate:fresh --seed
```

### **2️⃣ Erro: "Cannot find module 'vue-router'"**
**Solução:** Instalar dependências dentro do container:
```bash
docker-compose exec frontend npm install
```

### **3️⃣ Erro: "Frontend não carrega"**
**Solução:** Reiniciar o container do frontend:
```bash
docker-compose restart frontend
```

---

## **🎉 Conclusão**
Agora a aplicação está pronta e totalmente funcional! 🚀
Se precisar de suporte, entre em contato com o desenvolvedor responsável.

---

**📌 Autor:** Filipe Abreu | [GitHub](https://github.com/filipe-abreu)

🚀 _Projeto desenvolvido como parte do processo seletivo da Logcomex._

