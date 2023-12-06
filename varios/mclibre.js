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
