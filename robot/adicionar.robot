*** Settings ***
Library    SeleniumLibrary

*** Variables ***
${URL}    http://localhost:8500/users/adicionar
${BROWSER}    chrome
${USERNAME}    teste
${EMAIL}    teste@teste.com
${PASSWORD}    1

*** Test Cases ***
Cadastro com Sucesso
    Open Browser    ${URL}    ${BROWSER}
    Input Text    id=username    ${USERNAME}
    Input Text    id=email    ${EMAIL}
    Input Text    id=password    ${PASSWORD}
    Click Button    css:.btn.btn-dark.w-100.mt-4.mb-3
    Title Should Be    MyFinance - Controle de Finanças Pessoais
    Close Browser

Cadastro com Dados Incompletos
    Open Browser    ${URL}    ${BROWSER}
    Input Text    id=username    ${USERNAME}
    Click Button    css:.btn.btn-dark.w-100.mt-4.mb-3
    Page Should Contain    E-mail é obrigatório
    Close Browser
