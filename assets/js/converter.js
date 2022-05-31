const loader = document.getElementById("loader");

const infoModal = new bootstrap.Modal(document.getElementById("infoModal"), {
  backdrop: true,
  keyboard: true,
  focus: true,
});

window.addEventListener("load", () => {
  loader.classList.add("d-none");
  loader.classList.remove("d-flex");
  if (document.getElementById("modalMessage")) {
    infoModal.show();
  }
});

const btnConvert = document.getElementById("btnConvert");

btnConvert.addEventListener("click", () => {
  loader.classList.add("d-flex");
  loader.classList.remove("d-none");
});
