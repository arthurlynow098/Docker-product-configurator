<p align="center">
  <img src="assets/banner-v2.png" alt="Docker-product-configurator" width="100%">
</p>

<p align="center">Ambiente em containers para um configurador de produtos com aplicação web e banco de dados.</p>

<p align="center"><img src="assets/docs/tags.svg" alt="Docker · PHP · MySQL" width="100%"></p>

<p align="center"><a href="#visão-geral">Visão geral</a> &nbsp;·&nbsp; <a href="#recursos">Recursos</a> &nbsp;·&nbsp; <a href="#como-executar">Como executar</a></p>

---

<a id="explore-o-projeto"></a>

![Explore o projeto](assets/docs/section-01.svg)

![Mapa visual dos arquivos e responsabilidades](assets/docs/map.svg)

<table width="100%">
<tr><th align="left">Área</th><th align="left">O que você encontra</th><th align="left">Acesso direto</th></tr>
<tr><td><strong>Serviços</strong></td><td>Configuração dos containers do ambiente.</td><td><a href="docker-compose.yml">Abrir serviços →</a></td></tr>
<tr><td><strong>Imagem</strong></td><td>Etapas de construção da imagem.</td><td><a href="Dockerfile">Abrir imagem →</a></td></tr>
<tr><td><strong>Aplicação</strong></td><td>Página PHP executada no ambiente.</td><td><a href="src/index.php">Abrir aplicação →</a></td></tr>
</table>

<a id="visão-geral"></a>

![Visão geral](assets/docs/section-02.svg)

Desenvolvido como projeto prático da certificação **Docker Essentials: A Developer Introduction (IBM)**, o repositório combina um Dockerfile customizado com orquestração via docker-compose.yml, redes internas isoladas e persistência de dados em volumes nomeados.

<a id="recursos"></a>

![Recursos](assets/docs/section-03.svg)

| Recurso | Como funciona |
|---|---|
| Orquestração Multi-Container | docker-compose.yml coordena a inicialização conjunta do servidor Apache/PHP e do banco MySQL. |
| Imagem PHP Customizada | Dockerfile baseado em php:8.2-apache com instalação automática de mysqli, pdo_mysql e ativação do mod_rewrite. |
| Persistência com Named Volume | O volume db_data preserva as tabelas e registros do MySQL mesmo que os contêineres sejam recriados. |
| Hot-Reload via Bind Mount | O mapeamento ./src:/var/www/html reflete edições no código-fonte instantaneamente sem novo build. |
| Isolamento em Rede Bridge | A rede dedicada app-network permite resolução DNS interna pelo hostname db, mantendo o banco seguro. |
| Variáveis de Ambiente | Arquivo .env.example documenta as credenciais de banco desacopladas do código-fonte. |

<a id="tecnologias"></a>

![Tecnologias](assets/docs/section-04.svg)

- **Docker Engine & Docker Compose** para construção de imagem, rede e ciclo de vida dos serviços;
- **PHP 8.2 + Apache** com extensões de conectividade relacional pré-compiladas;
- **MySQL** operando em contêiner dedicado com armazenamento persistente.

<details>
<summary>Arquitetura</summary>

```mermaid
flowchart LR
    A["Máquina Hospedeira :8080"] -->|Port Mapping| B["Contêiner Web · PHP 8.2 Apache"]
    C["Código Local ./src"] <-->|Bind Mount| B
    B -->|Rede Bridge app-network · host: db| D["Contêiner MySQL"]
    D <-->|Named Volume db_data| E["(Dados Persistentes)"]
```

O tráfego externo entra apenas pela porta 8080 mapeada para o Apache, enquanto a comunicação entre aplicação e banco de dados trafega exclusivamente dentro da rede interna app-network.

</details>

<a id="certificação"></a>

![Certificação](assets/docs/section-05.svg)

<p align="center">
  <img src="src/docker-essentials-a-developer-introduction.png" width="420" alt="Certificado Docker Essentials">
</p>

<details>
<summary>Estrutura do repositório</summary>

```text
Docker-product-configurator/
├── assets/
│   └── banner-v2.png               Banner do projeto
├── src/
│   ├── index.php                                           Aplicação PHP conectada ao serviço MySQL
│   └── docker-essentials-a-developer-introduction.png      Certificado de conclusão
├── Dockerfile                                              Imagem customizada PHP 8.2 + extensões
├── docker-compose.yml                                      Orquestração de serviços, volumes e rede
├── .env.example                                            Modelo de variáveis de ambiente
└── README.md
```

</details>

<a id="como-executar"></a>

![Como executar](assets/docs/section-06.svg)

1. Clone o repositório e configure o arquivo .env:
   ```bash
   git clone https://github.com/arthurlynow098/Docker-product-configurator.git
   cd Docker-product-configurator
   cp .env.example .env
   ```
2. Construa e inicie os contêineres em segundo plano:
   ```bash
   docker compose up -d --build
   ```
3. Acesse a aplicação no navegador em http://localhost:8080.

<a id="decisões-técnicas"></a>

![Decisões técnicas](assets/docs/section-07.svg)

- **Dockerfile próprio em vez de imagem crua:** evita ter que instalar extensões pdo_mysql e mysqli manualmente a cada inicialização do contêiner.
- **DNS interno por nome de serviço:** conectar o PHP ao host db em vez de localhost desacopla a aplicação de endereços IP dinâmicos.

---

<p align="center">
  <a href="https://github.com/arthurlynow098">GitHub</a> &nbsp;·&nbsp;
  <a href="https://arthurentsev.vercel.app/">Portfólio</a> &nbsp;·&nbsp;
  <a href="https://www.linkedin.com/in/entsevarthur/">LinkedIn</a>
</p>
