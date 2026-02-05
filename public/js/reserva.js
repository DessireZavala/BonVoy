document.getElementById("reservaForm").addEventListener("submit", e => {
  e.preventDefault();

  const inputs = e.target.querySelectorAll("input, textarea");

  const reserva = {
    titular: inputs[0].value,
    correo: inputs[1].value,
    telefono: inputs[2].value,
    huesped: inputs[3].value,
    documento: inputs[4].value,
    checkin: inputs[5].value,
    checkout: inputs[6].value,
    notas: inputs[7].value,
    fecha: new Date().toLocaleDateString()
  };

  let historial = JSON.parse(localStorage.getItem("historial")) || [];
  historial.push(reserva);

  localStorage.setItem("historial", JSON.stringify(historial));

  window.location.href = "pago.html";
});
