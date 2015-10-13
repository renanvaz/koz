<?php

U::group('Description of this group test.', function(){
    U::assert('Testando', TRUE);
    U::assert('Testando denovo', TRUE);
    U::assert('Testando 3', TRUE);

    U::group('Description inner.', function(){
        U::assert('Testando', TRUE);
        U::assert('Testando denovo', TRUE);
        U::assert('Testando 3', TRUE);
    });
});

U::group('Description 2 of this group test.', function(){
    U::assert('Testando', TRUE);
    U::assert('Testando denovo', TRUE);
    U::assert('Testando 3', TRUE);

    U::group('Description inner.', function(){
        U::assert('Testando', TRUE);
        U::assert('Testando denovo', TRUE);
        U::assert('Testando 3', TRUE);
    });
});
