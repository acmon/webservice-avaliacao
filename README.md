# Webservice-avaliação
## Configuração da api
Para acessar os serviços da api, é necessário observar se o endereço do mongo está configurado corretamente. Você pode verificar através do arquivo de configuração (config/settings.php).

Nele, você vai encontrar o objeto que recebe o endereço do banco ('url') e o objeto que nomeia o database ('name').

## Endpoints

### Estados

#### [get] api/v1/estado

##### DESCRIÇÃO
Lista os estados cadastrados na base estados.

##### PARAMS
* 'ordenacao': 
  * Descrição: parâmetro utilizado para ordenar a lista
  * valor: 'id', 'nome', 'sigla', 'criado_em', 'atualizado_em'

* 'nome':
  * Descrição: filtra a busca pelo nome informado
  * Valor: string de nome
  
* 'id':
  * Descrição: filtra a busca pelo identificador único do registro
  * Valor: string com o identificador único do estado a ser buscado
  
* 'sigla':
  * Descrição: filtra a busca pela sigla (abreviação) do estado
  * Valor: string de sigla

* 'criado_em':
  * Descrição: filtra a busca pela data ou hora de criação do registro
  * Valor: string com a data e/ou hora

* 'atualizado_em':
  * Descrição: filtra a busca pela data ou hora de última atualização do registro
  * Valor: string com a data e/ou hora

#### [post] api/v1/estado

##### DESCRIÇÃO
Cadastra um estado na base estados

##### BODY
Exemplo:
{
	"nome" : "Rio de Janeiro",
	"sigla": "RJ"
}

* 'nome':
  * Descrição: Nome do estado a ser cadastrado
  * Valor: string com o nome do estado

* 'sigla':
  * Descrição: Sigla do estado a ser cadastrado
  * Valor: string com a sigla do estado

#### [put] api/v1/estado

##### DESCRIÇÃO
Altera um estado na base estados

##### BODY
Exemplo:
{
	"id": "5b2861cc7a39a90cc63f79b5",
	"nome" : "São Paulo",
	"sigla": "SP"
}

* 'id':
  * Descrição: Identificador único do registro a ser alterado na base estados
  * Valor: string com o identificador único do estado a ser alterado

* 'nome':
  * Descrição: Novo nome do estado
  * Valor: string com o novo nome do estado

* 'sigla':
  * Descrição: Nova sigla do estado
  * Valor: string com a nova sigla do estado

#### [delete] api/v1/estado

##### DESCRIÇÃO
Exclui um estado na base estados

##### BODY
Exemplo:
{
	"id": "5b271d697a39a90f69314b14"
}

* 'id':
  * Descrição: Identificador único do registro a ser excluído na base estados
  * Valor: string com o identificador único do estado a ser excluído
  

### Cidades

#### [get] api/v1/cidade

##### DESCRIÇÃO
Lista as cidades cadastradas na base cidades.

##### PARAMS
* 'ordenacao': 
  * Descrição: parâmetro utilizado para ordenar a lista
  * valor: 'id', 'nome', 'id_estado', 'criado_em', 'atualizado_em'

* 'nome':
  * Descrição: filtra a busca pelo nome informado
  * Valor: string de nome
  
* 'id':
  * Descrição: filtra a busca pelo identificador único do registro
  * Valor: string com o identificador único da cidade a ser buscada
  
* 'id_estado':
  * Descrição: filtra a busca pelo identificador único do estado
  * Valor: string com o identificador único do estado que a cidade faz referência

* 'criado_em':
  * Descrição: filtra a busca pela data ou hora de criação do registro
  * Valor: string com a data e/ou hora

* 'atualizado_em':
  * Descrição: filtra a busca pela data ou hora de última atualização do registro
  * Valor: string com a data e/ou hora

#### [post] api/v1/cidade

##### DESCRIÇÃO
Cadastra uma cidade na base cidades

##### BODY
Exemplo:
{
	"nome" : "Niterói",
	"id_estado": "5b2860b27a39a90cc63f79b2"
}

* 'nome':
  * Descrição: Nome da cidade a ser cadastrada
  * Valor: string com o nome da cidade

* 'id_estado':
  * Descrição: Identificador único do estado em que a cidade faz parte
  * Valor: string com o identificador único do estado referente a cidade a ser cadastrada

#### [put] api/v1/cidade

##### DESCRIÇÃO
Altera uma cidade na base cidades

##### BODY
Exemplo:
{
	"id": "5b2860f67a39a90cc63f79b3",
	"nome" : "rio de janeiro",
	"id_estado": "5b2846fc7a39a973511b42b4"
}

* 'id':
  * Descrição: Identificador único do registro a ser alterado na base cidades
  * Valor: string com o identificador único da cidade a ser alterada

* 'nome':
  * Descrição: Novo nome da cidade
  * Valor: string com o novo nome da cidade

* 'id_estado':
  * Descrição: Novo identificador único do estado eque a cidade faz parte
  * Valor: string com o identificador único do estado em que a cidade faz referência

#### [delete] api/v1/cidade

##### DESCRIÇÃO
Exclui uma cidade na base cidades

##### BODY
Exemplo:
{
	"id": "5b28613b7a39a90cc63f79b4"
}

* 'id':
  * Descrição: Identificador único do registro a ser excluído na base cidades
  * Valor: string com o identificador único da cidade a ser excluída
