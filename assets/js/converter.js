const loader = document.getElementById("loader");

const modalElement = document.getElementById("infoModal");
const infoModal = new bootstrap.Modal(modalElement, {
  backdrop: "static",
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

modalElement.addEventListener("hide.bs.modal", () => {
  window.location.replace("/");
});

// popovers

const popoverTriggerList = [].slice.call(
  document.querySelectorAll('[data-bs-toggle="popover"]')
);
const popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
  return new bootstrap.Popover(popoverTriggerEl);
});

// launch loader after clicking 'convert data' button

const btnConvert = document.getElementById("btnConvert");

btnConvert.addEventListener("click", () => {});

// option block

const optionChboxs = document.querySelectorAll(".option-chbox");
let url = new URL(window.location);

function collapseIfCheckboxChecked(controlElement) {
  if (controlElement.checked) {
    if (
      controlElement.hasAttribute("data-bs-toggle") &&
      controlElement.getAttribute("data-bs-toggle") === "collapse"
    ) {
      let targetElementSelector = controlElement.getAttribute("data-bs-target");
      let targetElement = document.querySelector(targetElementSelector);
      targetElement.classList.add("show");
      controlElement.setAttribute("aria-expanded", "true");
    }
  }
}

optionChboxs.forEach((el) => {
  collapseIfCheckboxChecked(el);

  el.addEventListener("change", (e) => {
    if (e.target.checked) {
      if (!url.searchParams.has(e.target.id, true)) {
        url.searchParams.append(e.target.id, true);
        window.history.pushState({}, "", url);
      }
    } else {
      if (url.searchParams.has(e.target.id, true)) {
        url.searchParams.delete(e.target.id, true);
        window.history.pushState({}, "", url);
      }
    }
  });
});

// collapse control
