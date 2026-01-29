function muestra() {
    var elementos = document.querySelectorAll("[tooltip-id]");
    for (var i = 0; i < elementos.length; i++) {
        const x1 = elementos[i].getAttribute("tooltip-id");
        if (document.getElementById('tp-' + x1)) {
            document.getElementById('tp-' + x1).remove();
        }
        elementos[i].classList.add("tooltip");
        const x2 = document.getElementById(x1).textContent;
        const tp = document.createElement("span");
        tp.classList.add("tooltiptext");
        tp.setAttribute('id', 'tp-' + x1);
        tp.textContent = x2;
        elementos[i].appendChild(tp)
        elementos[i].removeAttribute("title");
    }
}
window.onload = muestra;

// Esto es para que copie el contenido de los details cerrados que se hayan seleccionado
// Por ejemplo, el contenido de la función recoge()
// El summary no se copia porque en la css hay summary { user-select: none; }
document.addEventListener("copy", (event) => {
    const details = document.querySelectorAll("details");
    details.forEach(d => { d.open = true; });
    setTimeout(() => {
        details.forEach(d => { d.open = false; });
    }, 100); // 100ms es suficiente para que el sistema complete la copia
});

// Esta versión también funciona, pero deja los details abiertos
// document.addEventListener("copy", () => {
//     document.querySelectorAll("details").forEach(d => { d.open = true; });
// });
