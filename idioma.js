function changeLanguage(language) {
    localStorage.setItem('language', language);  // Store language choice

    if (language === 'eng') {
        window.location.href = "index_eng.html"; // Redirect to English version
    } else {
        window.location.href = "index.html"; // Redirect to Portuguese version
    }
}