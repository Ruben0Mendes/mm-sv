document.getElementById("contactForm").addEventListener("submit", function(event) {
    event.preventDefault();


    document.getElementById("formMessage").innerText = "Obrigado por entrares em contato, Vamos responder em breve!";


    document.getElementById("contactForm").reset();
});