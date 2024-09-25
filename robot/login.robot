*** Settings ***
Library    SeleniumLibrary

*** Variables ***
${URL}    http://localhost:8500/login
${BROWSER}    chrome
${USERNAME}    lucas1042@live.com
${PASSWORD}    1234

*** Test Cases ***
Validar Login
    Open Browser    ${URL}    ${BROWSER}
    Input Text    id=email    ${USERNAME}
    Input Text    id=password    ${PASSWORD}
    Click Button    css:.btn.btn-dark.w-100.mt-4.mb-3
    Title Should Be    MyFinance
    Close Browser

Invalidar Login
    Open Browser    ${URL}    ${BROWSER}
    Input Text    id=email    ${USERNAME}
    Input Text    id=password    ${PASSWORD}123
    Click Button    css:.btn.btn-dark.w-100.mt-4.mb-3
    Page Should Contain    E-mail ou senha incorretos! Por favor, tente novamente.
    Close Browser