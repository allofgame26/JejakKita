// ***********************************************
// This example commands.js shows you how to
// create various custom commands and overwrite
// existing commands.
//
// For more comprehensive examples of custom
// commands please read more here:
// https://on.cypress.io/custom-commands
// ***********************************************
//
//
// -- This is a parent command --
// Cypress.Commands.add('login', (email, password) => { ... })
//
//
// -- This is a child command --
// Cypress.Commands.add('drag', { prevSubject: 'element'}, (subject, options) => { ... })
//
//
// -- This is a dual command --
// Cypress.Commands.add('dismiss', { prevSubject: 'optional'}, (subject, options) => { ... })
//
//
// -- This will overwrite an existing command --
// Cypress.Commands.overwrite('visit', (originalFn, url, options) => { ... })

Cypress.Commands.add('login', (email, password) => {
    cy.visit('http://127.0.0.1:8000/admin/login'); // Kunjungi untuk dapat CSRF token

    cy.get('meta[name="csrf-token"]').then((meta) => {
        const csrfToken = meta.attr('content');

        cy.request({
            method: 'POST',
            url: '/admin/login',
            form: true, // Penting
            body: {
                _token: csrfToken,
                'data.login': email, // Sesuai 'name' input Anda
                'data.password': password,
            }
        });
    });
});