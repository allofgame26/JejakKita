describe('Skenario Login Super Admin', () => {
  it('Login dengan Username Valid, Password Valid', () => {
    cy.visit('http://127.0.0.1:8000/admin/login')

    cy.get('[data-cy="input-login"]').type('admin@yahoo.com');
    cy.get('[data-cy="password-input"]').type('admin123');

    cy.get('button[type="submit"]').click();

    cy.url().should('include', 'http://127.0.0.1:8000/admin');
    cy.contains('Dasbor').should('be.visible');

    cy.get('img[alt="Avatar admin"]').click();
    cy.contains('Keluar').click();

    cy.url().should('include', 'http://127.0.0.1:8000/admin/login');
  });

  it('Login dengan Username Tidak Valid, Password Valid', () => {
    cy.visit('http://127.0.0.1:8000/admin/login')

    cy.get('[data-cy="input-login"]').type('admin21@yahoo.com');
    cy.get('[data-cy="password-input"]').type('admin123');

    cy.get('button[type="submit"]').click();

    cy.contains('Kredensial yang diberikan tidak dapat ditemukan.').should('be.visible');
  });

  it('Login dengan Username dan Password Invalid', () => {
    cy.visit('http://127.0.0.1:8000/admin/login')

    cy.get('[data-cy="input-login"]').type('admin21@yahoo.com');
    cy.get('[data-cy="password-input"]').type('admin12');

    cy.get('button[type="submit"]').click();

    cy.contains('Kredensial yang diberikan tidak dapat ditemukan.').should('be.visible')
  });
})