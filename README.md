# Koz framework

O Koz não é apenas um pacote de ferramentas, a idéia principal é oferecer uma proposta única de estrura para aplicações web.
Características:
- Planejado e estruturado para aplicações web
- Fácil de aprender, simples de utilizar. Você não vai esquecer
- Contruído numa interface simples de programação onde a nomenclatura de cada componente do framework é pensado para ser o mais intuítivo e menos verboso possível
- Preparado para atuar junto com tasks runners, como o Grunt e Gulp

O Koz é exatamente o que você precisa hoje.

## Um padrão, padrão.

Oferecer um set grande de ferramentas é interessante, mas não é essa a proposta do Koz.
Acreditamos que oferecer multiplas opções ou diversas formas de se fazer o mesmo, possa gerar alguns resultados insatisfatórios, como por exemplo:
- Ter opções para obter um mesmo resultado, pode trazer mais dúvidas do que respostas
- Conhecer o framework utilizado não lhe dá garantia que você saberá mexer em outros sistemas desenvolvidos com o mesmo framework
- Se precisar fazer uma manutenção em um sistema que não foi desenvolvido por você ou por sua equipe. Você poderá encontrar padrões diferentes do que prefere, ai o código começa a ficar "aquela bagunça"
...

## Design pattern

Acreditamos que um código bem escrito é feito para pessoas interpretarem.
O comentário no código não deve "traduzir" o código. Ele deve explicar a sua linha de pensamento.
Um bom código é legível, não é verboso.

Um exemplo de quando um comentário é necessário, mas por conta de um código "mal escrito".
    /**
     * Valor da tangente
     */
    $t = 1;

Um exemplo de quando um código é verboso, e o comentário desnecessário:
    /**
     * Valor da tangente
     */
    $valorDaTangente = 1;

Ohhh, agora sim:
    /**
     * Valor da tangente que será utilizada
     * para calcular o cateto oposto
     */
    $tangente = 1;


