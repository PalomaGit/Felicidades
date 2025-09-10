<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Feliz Cumple Carmen!</title>
<link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
<style>
body {
    margin: 0;
    padding: 0;
    height: 100vh;
    font-family: 'Roboto', sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    background: linear-gradient(to right, #ffecd2, #fcb69f);
    overflow: hidden;
}

.tarjeta {
    text-align: center;
    background: rgba(255,255,255,0.85);
    padding: 40px;
    border-radius: 25px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    max-width: 500px;
    position: relative;
    z-index: 10;
}

.tarjeta h1 {
    font-family: 'Pacifico', cursive;
    font-size: 3rem;
    margin-bottom: 15px;
    color: #ff6f91;
}

#mensajes {
    margin-top: 20px;
}

button {
    padding: 12px 25px;
    font-size: 1rem;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    background: #ff6f91;
    color: #fff;
    transition: transform 0.2s;
    font-weight: bold;
    margin-top: 20px;
}

button:hover { transform: scale(1.05); }

.globo {
    position: absolute;
    font-size: 2rem;
    opacity: 0.9;
    pointer-events: none;
}

.confeti {
    position: absolute;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    opacity: 0.8;
    pointer-events: none;
}

.mensaje-dinamico {
    font-size: 1.2rem;
    color: #ff6f91;
    margin: 10px 0;
    display: block;
    opacity: 0;
    transition: opacity 1s;
}
</style>
</head>
<body>

<div class="tarjeta">
    <h1>¡Feliz Cumple, Carmelilla! 🎉</h1>
    <div id="mensajes"></div>
    <button id="botonSorpresa">Pulsa aquí 🎈</button>
</div>

<script>
const colores = ["#ff6f91","#ff9472","#f9d976","#72e0ff","#728cff"];
const mensajes = [
    "🎈 Te amo gorditssss!! Feliz cumpleaños, gracias por seguir respirando un año más",
    "✨ Preferiría pasar tu duelo a no haberte conocido nunca",
    "💖 Menos mal que existes y no tenemos que imaginarte!!",
    "😎 ¡No todo el mundo tiene la suerte de tener una Carmen!",
    "🎈 Adióssss"
];

const boton = document.getElementById('botonSorpresa');
const contMensajes = document.getElementById('mensajes');
const body = document.body;

boton.addEventListener('click', ()=>{
    boton.disabled = true;
    mostrarMensajes();
    iniciarAnimacion();
});

function mostrarMensajes(){
    mensajes.forEach((msg, index) => {
        setTimeout(() => {
            const div = document.createElement('div');
            div.classList.add('mensaje-dinamico');
            div.textContent = msg;
            contMensajes.appendChild(div);
            setTimeout(()=> div.style.opacity = 1, 50);
        }, index * 3000);
    });
}

// Globos flotando suavemente con rebote lateral
function crearGlobo(){
    const globo = document.createElement('div');
    globo.classList.add('globo');
    globo.textContent = "🎈";
    let left = Math.random()*90;
    let posY = window.innerHeight + 50;
    let velY = 1 + Math.random()*1.5;
    let velX = Math.random()*2 - 1; // dirección horizontal
    body.appendChild(globo);

    function animar(){
        posY -= velY;
        left += velX;
        if(left <= 0 || left >= 90) velX *= -1; // rebote horizontal
        globo.style.bottom = posY + "px";
        globo.style.left = left + "%";
        if(posY > -50) requestAnimationFrame(animar);
        else globo.remove();
    }
    animar();
}

// Confeti cayendo con rebote lateral
function crearConfeti(){
    const c = document.createElement('div');
    c.classList.add('confeti');
    c.style.backgroundColor = colores[Math.floor(Math.random()*colores.length)];
    let left = Math.random()*100;
    let posY = -10;
    let velY = 1 + Math.random()*3;
    let velX = Math.random()*1.5 - 0.75; // vaivén horizontal
    body.appendChild(c);

    function animar(){
        posY += velY;
        left += velX;
        if(left <= 0 || left >= 100) velX *= -1;
        c.style.top = posY + "px";
        c.style.left = left + "%";
        if(posY < window.innerHeight) requestAnimationFrame(animar);
        else c.remove();
    }
    animar();
}

// Repetición continua para mantener todo dinámico
function iniciarAnimacion(){
    setInterval(crearGlobo, 200); // cada 0.2s un globo
    setInterval(crearConfeti, 50); // cada 0.05s confeti
}
</script>
</body>
</html>
