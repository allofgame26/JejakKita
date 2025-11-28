// ***********************************************************
// This example support/e2e.js is processed and
// loaded automatically before your test files.
//
// This is a great place to put global configuration and
// behavior that modifies Cypress.
//
// You can change the location of this file or turn off
// automatically serving support files with the
// 'supportFile' configuration option.
//
// You can read more here:
// https://on.cypress.io/configuration
// ***********************************************************

// Import commands.js using ES2015 syntax:
import './commands'

// Perintah ini memberi tahu Cypress untuk tidak
// menganggap request 'livewire/update' sebagai "loading" halaman.
// Ini akan menghentikan error timeout karena Livewire.
beforeEach(() => {
    cy.intercept('POST', '/livewire/update').as('livewireUpdate');
});

// (Opsional tapi direkomendasikan)
// Terkadang Livewire melempar error internal yang bisa
// menghentikan Cypress. Ini akan mengabaikannya.
Cypress.on('uncaught:exception', (err, runnable) => {
    // kita mengabaikan error dari Livewire
    if (err.message.includes('Livewire')) {
        return false;
    }
});