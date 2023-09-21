# Garçom Digital - ServeJa

#### Projeto realizado na disciplina de Projeto Integrador

O objetivo do sistema é facilitar e agilizar os serviços oferecidos para o cliente, com o intuito de reduzir a demanda de garçons, diminuir o tempo de espera e produção dos pedidos, além de dar liberdade aos clientes para pedir o seu produto a qualquer momento e diminuindo as taxas de erro nos pedidos. Esse sistema é uma solução moderna e eficiente para atender às necessidades dos estabelecimentos, tornando a experiência do cliente mais agradável e prática.

## Roadmap

- ADM realiza cadastro dos produtos.
- Cliente realizar pedido através da plataforma.
- ADM visualiza mesa disponível, pedidos realizados, status dos pedidos em andamento

## Documentação

[Proposta de Projeto](https://docs.google.com/document/d/1XseWChOgcBphFrEAFiUr9oHZTFMQKw4lSVaR6o8zyn0/edit?usp=sharing)

[Especificação de Requisitos de Software](https://docs.google.com/document/d/1gHpeyXnm0_oT7simG8hvAJw4VMT6s-_jfD9I6xnL7a8/edit?usp=sharing)

[Diagrama de Classes](https://lucid.app/lucidchart/77456a49-7cbc-4c10-bf80-0777a998e93c/edit?viewport_loc=338%2C171%2C2122%2C990%2CHWEp-vi-RSFO&invitationId=inv_6690a2c2-602a-4f2a-b0fe-939a461bfd34)

[Diagrama de Casos de Usos](https://lucid.app/lucidchart/2d18c19c-450f-495d-b43d-889fee05d973/edit?view_items=CsQNzUkI.DKL&invitationId=inv_88f58d8f-de78-4d5b-9e0a-edfd7fda912c)

## Melhorias

Que melhorias você fez no seu código? Ex: refatorações, melhorias de performance, acessibilidade, etc


## Uso/Exemplos

```ts
    const scanner = new Html5QrcodeScanner('reader', {
        // O scanner será inicializado no DOM dentro do elemento com id de 'leitor'
        qrbox: {
            width: 250,
            height: 250,
        }, // Define as dimensões da caixa de digitalização (definida em relação à largura do elemento do leitor)
        fps: 20, // Quadros por segundo para tentar uma varredura
    });


    scanner.render(success, error);
    // Inicia o scanner

    function success(result) {

        document.getElementById('result').innerHTML = `
        <h2>Código escaneado com sucesso!</h2>
        <p><a href="${result}">${result}</a></p>
        `;
        // Imprime o resultado como um link dentro do elemento de resultado

        scanner.clear();
        // Limpa a instância de verificação

        document.getElementById('reader').remove();
        // Remove o elemento leitor do DOM, pois não é mais necessário

    }

    function error(err) {
        console.error(err);
        // Imprime quaisquer erros no console
    }
```

A verificação de código depende da biblioteca [Zxing-js](https://github.com/zxing-js/library). Estaremos trabalhando em cima disso para adicionar suporte para mais tipos de varredura de código.

| Code | Example |
| ---- | ----- |
| QR Code | <img src="https://scanapp.org/assets/github_assets/qr-code.png" width="200px" >|

## Stack utilizada

**Front-end:** HTML, CSS, PHP 

**Back-end:** PHP, TS, JS 


## Aprendizados

Utilização de classes e objetos, integração com banco de dados, Padrões de projetos, integrações back-end com o front-end...


## Autores

- [@Hudson Israel](https://github.com/Hudson-Isr)
- [@Daniel Tavares](https://github.com/danieltac)
- [@Francisco Júnior](https://github.com/xycojunior)
- [@Felipe Oliveira](https://github.com/felipeonl)

