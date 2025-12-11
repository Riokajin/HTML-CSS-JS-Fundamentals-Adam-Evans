// This script handles user interactions across the site.
// Examples: displaying confirmation messages after feedback submission, showing alerts when the "Order Now" button is clicked, and adding sumple dunamic behaviours to improve user experience.

// Handles the feedback form submission:
// Prevents the page from reloading, collects user input (name, email, rating, comments) and displays a confirmation message to the user.
const feedbackForm = document.getElementById("feedbackForm");
if (feedbackForm) {
    feedbackForm.addEventListener("submit", function(event) {
        event.preventDefault(); // prevent page reload    
        const confirmation = document.getElementById("confirmation");
        if (confirmation) {
            confirmation.innerText = "Thank you for your feedback!";
        }
    });
}
    