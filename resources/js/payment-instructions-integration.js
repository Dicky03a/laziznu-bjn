/**
 * Payment Instructions Modal Integration
 * 
 * This module handles the integration between payment forms and the
 * payment instructions modal. It ensures users see the payment information
 * before submitting any transaction form.
 * 
 * Usage:
 * 1. Add data-payment-form attribute to your form element
 * 2. The form will automatically show the modal before submission
 * 3. User must accept the terms before the form submits
 * 
 * Example:
 * <form ... data-payment-form="zakat" ...>
 */

document.addEventListener('DOMContentLoaded', function() {
    const paymentForms = document.querySelectorAll('[data-payment-form]');
    
    paymentForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Store the form for later submission
            window.pendingFormSubmission = this;
            
            // Dispatch the open event to the modal using Livewire
            if (window.Livewire) {
                Livewire.dispatch('openPaymentInstructions');
            } else {
                // Fallback: submit immediately if Livewire not available
                this.submit();
            }
        });
    });
    
    // Listen for the acceptance event from the modal
    document.addEventListener('paymentInstructionsAccepted', function() {
        if (window.pendingFormSubmission) {
            // Remove the event listener to prevent infinite loop
            const oldForm = window.pendingFormSubmission;
            window.pendingFormSubmission = null;
            
            // Submit the form after modal acceptance
            oldForm.submit();
        }
    });
});
