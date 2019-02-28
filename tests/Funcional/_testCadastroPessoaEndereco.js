Feature('test-selecao');

Scenario("Test of tasks" , (I) => {

    I.amOnPage('http://localhost:8000');

    I.click("Cadastrar");

    I.click('Nome');

    I.fillField('input[name="nome"]', 'Rodrigo com endereco');

    I.click('Sobrenome');

    I.fillField('input[name="sobrenome"]', 'Araujo com endereco');

    I.click('#add-endereco');

    I.click('cep');

    I.fillField('input[name="cep"]', '722250658');

    I.click('localidade');

    I.fillField('input[name="localidade"]', 'DF');

    I.click('bairro');

    I.fillField('input[name="bairro"]', 'Ceilandia');

    I.click('logradouro');

    I.fillField('input[name="logradouro"]', 'QNL 9');

    I.click('complemento');

    I.fillField('input[name="complemento"]', 'Rua da academia Barbosa');

    I.click('#btn-push-endereco');

    I.wait(2);

    I.click('#salvar');

    I.see("Cadastro realizado com com sucesso");
    //
});
