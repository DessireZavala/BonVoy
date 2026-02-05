/* =========================
   DATA SIMULADA (TEMPORAL)
   luego se conecta a APIs
========================= */

const destinos = [
  {
    id: 1,
    nombre: "Tanzania",
    descripcion: "Safari & naturaleza",
    imagen: "assets/img/tanzania.jpg"
  },
  {
    id: 2,
    nombre: "París",
    descripcion: "Ciudad del amor",
    imagen: "assets/img/paris.jpg"
  },
  {
    id: 3,
    nombre: "Tokio",
    descripcion: "Tecnología & cultura",
    imagen: "assets/img/tokyo.jpg"
  }
];

const actividades = [
  {
    id: 1,
    nombre: "Safari Africano",
    lugar: "Tanzania",
    imagen: "assets/img/safari.jpg"
  },
  {
    id: 2,
    nombre: "Tour Eiffel",
    lugar: "París",
    imagen: "assets/img/eiffel.jpg"
  }
];

/* =========================
   SEARCH / BUSCADOR
========================= */

const searchInput = document.querySelector(".search-box input");

if (searchInput) {
  searchInput.addEventListener("input", () => {
    const valor = searchInput.value.toLowerCase();
    filtrarDestinos(valor);
  });
}

function filtrarDestinos(texto) {
  const cards = document.querySelectorAll(".card-home");

  cards.forEach(card => {
    const titulo = card.querySelector("h3").innerText.toLowerCase();
    card.style.display = titulo.includes(texto) ? "block" : "none";
  });
}

/* =========================
   CLICK EN DESTINOS
========================= */

document.querySelectorAll(".card-home a").forEach(btn => {
  btn.addEventListener("click", (e) => {
    e.preventDefault();
    const destino = btn.dataset.destino;
    localStorage.setItem("destinoSeleccionado", destino);
    window.location.href = "destino.html";
  });
});

/* =========================
   ACTIVIDADES
========================= */

document.querySelectorAll(".activity-card button").forEach(btn => {
  btn.addEventListener("click", () => {
    alert("Actividad agregada a tu plan ✈️");
  });
});

/* =========================
   ICONOS HOME
========================= */

document.querySelectorAll(".icon").forEach(icon => {
  icon.addEventListener("click", () => {
    const seccion = icon.dataset.section;
    document.getElementById(seccion)?.scrollIntoView({
      behavior: "smooth"
    });
  });
});

/* =========================
   NEOPASS
========================= */

document.querySelectorAll(".neopass-card button").forEach(btn => {
  btn.addEventListener("click", () => {
    const plan = btn.dataset.plan;
    seleccionarNeopass(plan);
  });
});

function seleccionarNeopass(plan) {
  localStorage.setItem("neopass", plan);
  alert(`Has seleccionado NEOPASS ${plan.toUpperCase()} 🔥`);
}

/* =========================
   HERO ANIMADO (ROTACIÓN)
========================= */

const hero = document.querySelector(".hero");

let imagenActual = 0;
const imagenesHero = [
  "assets/img/tanzania.jpg",
  "assets/img/paris.jpg",
  "assets/img/tokyo.jpg"
];

setInterval(() => {
  imagenActual = (imagenActual + 1) % imagenesHero.length;
  hero.style.backgroundImage = `url('${imagenesHero[imagenActual]}')`;
}, 5000);

/* =========================
   PERFIL (AVATAR)
========================= */

const avatar = document.querySelector(".avatar");

if (avatar) {
  avatar.addEventListener("click", () => {
    window.location.href = "perfil.html";
  });
}

/* =========================
   CARGA INICIAL
========================= */

document.addEventListener("DOMContentLoaded", () => {
  console.log("Home listo 🚀");
});
