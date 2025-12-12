// This script handles user interactions across the site.
// Examples: displaying confirmation messages after feedback submission, showing alerts when the "Order Now" button is clicked, and adding simple dynamic behaviours to improve user experience.

//Rickroll interactivity for Order Now button
document.addEventListener("DOMContentLoaded", () => {
    const orderButton = document.getElementById("order-btn");

    if (orderButton) {
        orderButton.addEventListener("click", () => {
            // Open Rick Astley youtube video in new tab 
            window.open("https://www.youtube.com/watch?v=dQw4w9WgXcQ", "_blank");
        });
    }
});


// Handles the feedback form submission:
// Prevents the page from reloading, collects user input (name, email, rating, comments) and displays a confirmation message to the user.
const feedbackForm = document.getElementById("feedbackForm");
if (feedbackForm) {
    feedbackForm.addEventListener("submit", function(event) {
        event.preventDefault(); // prevent page reload    
        const confirmation = document.getElementById("confirmation");
        if (confirmation) {
            const name = document.getElementById("name").value;
            const ratingSelect = document.getElementById("rating");
            const ratingText = ratingSelect.options[ratingSelect.selectedIndex].text;
            const comments = document.getElementById("comments").value;
            confirmation.innerText = `Thanks, ${name}! You rated us "${ratingText}". You said: "${comments}".`;
            confirmation.classList.add("show");
            feedbackForm.reset(); 
        }
    });
}


// FAQ Accordion: improves usability by only showing one answer at a time
const faqItems = document.querySelectorAll('.faq-item');
faqItems.forEach(item => {
    const question = item.querySelector('.faq-question');
    const answer = item.querySelector('.faq-answer'); 
    question.addEventListener('click', () => {
        // Close others so only 1 is open at a time
        faqItems.forEach(i => {
            const q = i.querySelector('.faq-question');
            const a = i.querySelector('.faq-answer');
            if (i !== item) {
                i.classList.remove('active');
                q.setAttribute('aria-expanded', 'false');
                a.setAttribute('aria-hidden', 'true');
            }
        });
        // Toggle the clicked one
        const isActive = item.classList.toggle('active');
        question.setAttribute('aria-expanded', isActive ? 'true' : 'false');
        answer.setAttribute('aria-hidden', isActive ? 'false' :  'true');
    });
});