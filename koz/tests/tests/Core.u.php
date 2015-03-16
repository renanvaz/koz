<?php

U::group('Description of this group test.', function(){
    U::assert('Testando', FALSE);
    U::assert('Testando denovo', TRUE);
    U::assert('Testando 3', FALSE);

    U::group('Description inner.', function(){
        U::assert('Testando', FALSE);
        U::assert('Testando denovo', TRUE);
        U::assert('Testando 3', FALSE);
    });
});
