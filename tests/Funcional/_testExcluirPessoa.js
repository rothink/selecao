Feature('test-selecao');

Scenario("Test of tasks" , (I) => {

    I.amOnPage('http://localhost:8000');

    I.click("Cadastrar");

    I.click('Nome');

    I.fillField('input[name="nome"]', 'Rodrigo teste exclusão');

    I.click('Sobrenome');

    I.fillField('input[name="sobrenome"]', 'Araujo teste exclusão');

    I.click('#salvar');

    I.see("Cadastro realizado com com sucesso");

    I.wait(4);

    I.click('body > div.swal2-container.swal2-center.swal2-fade.swal2-shown > div > div.swal2-actions > button.swal2-confirm.swal2-styled');

    I.click('#app > div.application--wrap > main > div > div > div > div > div.v-table__overflow > table > tbody > tr:nth-child(1) > td:nth-child(3) > i:nth-child(1)');

    I.see("Tem certeza?");

    I.click('body > div.swal2-container.swal2-center.swal2-fade.swal2-shown > div > div.swal2-actions > button.swal2-confirm.swal2-styled');

    I.see("Excluído");
    //
});
