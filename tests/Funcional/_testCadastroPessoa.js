Feature('test-selecao');

Scenario("Test of tasks" , (I) => {

    I.amOnPage('http://localhost:8000');

    I.click("Cadastrar");

    I.click('Nome');

    I.fillField('input[name="nome"]', 'Rodrigo teste funcional');

    I.click('Sobrenome');

    I.fillField('input[name="sobrenome"]', 'Araujo teste funcional');

    I.click('#salvar');

    I.wait(2);

    I.see("Cadastro realizado com com sucesso");
    //
});
