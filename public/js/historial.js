const contenedor = document.getElementById("historial");
const historial = JSON.parse(localStorage.getItem("historial")) || [];

if(historial.length === 0){
  contenedor.innerHTML = "<p>No hay reservas registradas.</p>";
}

historial.forEach(reserva => {
  const card = document.createElement("div");
  card.className = "history-card";

  card.innerHTML = `
    <h3>${reserva.huesped}</h3>
    <p>Check-in: ${reserva.checkin}</p>
    <p>Check-out: ${reserva.checkout}</p>
    <p class="estado">Confirmado</p>
    <p class="estado">${reserva.estado || "Pendiente"}</p>
    <p>Fecha de reserva: ${reserva.fecha}</p>
    <p>Pago: ${reserva.pago || "No realizado"}</p>

  `;

  contenedor.appendChild(card);
});
