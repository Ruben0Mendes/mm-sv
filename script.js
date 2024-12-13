document.addEventListener("DOMContentLoaded", () => {
    const carrossel = document.querySelector(".carrossel");
    const imagens = carrossel.querySelectorAll("img");
    
    imagens.forEach(img => {
      const clone = img.cloneNode(true);
      carrossel.appendChild(clone);
    });
  
    let deslocamento = 0;
    const imagemLargura = imagens[0].clientWidth;
    const totalLargura = imagemLargura * imagens.length;
  
    function rolarCarrossel() {
      deslocamento -= 1;
      if (deslocamento <= -totalLargura) {
        deslocamento = 0;
        carrossel.style.transition = 'none';
        carrossel.style.transform = `translateX(${deslocamento}px)`;
        carrossel.offsetHeight;
        carrossel.style.transition = 'transform 0.1s ease';
      } else {
        carrossel.style.transform = `translateX(${deslocamento}px)`;
      }
      requestAnimationFrame(rolarCarrossel);
    }
  
    rolarCarrossel();
});
