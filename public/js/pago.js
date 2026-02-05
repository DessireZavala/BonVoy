document.getElementById("pagoForm").addEventListener("submit", e => {
  e.preventDefault();

  let historial = JSON.parse(localStorage.getItem("historial")) || [];

  if(historial.length > 0){
    historial[historial.length - 1].estado = "Pagado";
    historial[historial.length - 1].pago = new Date().toLocaleString();
  }

  localStorage.setItem("historial", JSON.stringify(historial));

  alert("Pago realizado con éxito");

  window.location.href = "historial.html";
});
