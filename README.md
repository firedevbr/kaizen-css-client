# kaizen-css-client
Client para consumir a API de integração com a ferramenta de gerência de leads 
CSS da agência Kaizen.

## Como utilizar
Para utilizar o client, basta instanciar a classe `Firedev\KaizenCSS\Client`
e com isso temos acesso as suas funções:

`$cssClient = new Firedev\KaizenCSS\Client();`

### Para registrar um novo lead

Basta chamar a função registraLead e passar os dados do lead como parâmetro:

```php
$cssClient = new Firedev\KaizenCSS\Client();

$cssClient->registraLead(
    'Mateus Pereira',
    'contato@firedev.com.br',
    '51-999999999',
    'Tenho interesse no produto X disponível na home do site'
);
```

Com isso, será feita a comunicação com a API da agência Kaizen 
para registrar o lead.

Para registrar campos extras, basta passar o quinto argumento com uma lista
de campos no seguinte formato:
```php
[
    [
        'key'        => 'type',
        'title'      => 'Tipo',
        'value'      => 'venda',
        'searchable' => 1
    ]
]
```

Então digamos que queiramos passar o cpf também como um campo extra:

```php
$cssClient = new Firedev\KaizenCSS\Client();

$additionalFields = [
    [
        'key'        => 'cpf',
        'title'      => 'cpf',
        'value'      => '861.338.151-80',
        'searchable' => 1
    ]
];

$cssClient->registraLead(
    'Mateus Pereira',
    'contato@firedev.com.br',
    '51-999999999',
    'Tenho interesse no produto X disponível na home do site',
    $additionalFields
);
```

### Atenção

Para subir a imagem é importante antes de fazer o build da imagem setar o ID 
do seu usuário como usuário apache. Para isto basta executar o script
`set-user-id.sh` que está na raiz.