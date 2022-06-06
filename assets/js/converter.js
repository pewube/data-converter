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

// option block

const optionChboxs = document.querySelectorAll(".option-chbox");
const optionBold = document.getElementById("copy-bold");
let url = new URL(window.location);

if (url.searchParams.has("copy-styles", true)) {
  optionBold.checked = !optionBold.checked;
  optionBold.setAttribute("disabled", "true");
  url.searchParams.delete("copy-bold", true);
  window.history.pushState({}, "", url);
  if (optionBold.checked) {
    optionBold.checked = !optionBold.checked;
  }
}

function collapseIfCheckboxChecked(controlElement) {
  if (controlElement.checked) {
    if (
      controlElement.hasAttribute("data-bs-toggle") &&
      controlElement.getAttribute("data-bs-toggle") === "collapse"
    ) {
      let targetElementSelector = controlElement.getAttribute("data-bs-target");
      let targetElement = document.querySelector(targetElementSelector);
      let targetInput = document.querySelector(
        targetElementSelector + " > input.form-control"
      );
      targetElement.classList.add("show");
      targetInput.setAttribute("required", "true");
      controlElement.setAttribute("aria-expanded", "true");
      console.log(targetInput);
    }
  } else {
    if (
      controlElement.hasAttribute("data-bs-toggle") &&
      controlElement.getAttribute("data-bs-toggle") === "collapse"
    ) {
      let targetElementSelector = controlElement.getAttribute("data-bs-target");
      let targetElement = document.querySelector(targetElementSelector);
      let targetInput = document.querySelector(
        targetElementSelector + " > input.form-control"
      );
      targetElement.classList.remove("show");
      targetInput.removeAttribute("required");
      controlElement.setAttribute("aria-expanded", "false");
      console.log(targetInput);
    }
  }
}

optionChboxs.forEach((el) => {
  collapseIfCheckboxChecked(el);

  el.addEventListener("change", (e) => {
    if (e.target.checked) {
      if (!url.searchParams.has(e.target.id, true)) {
        switch (e.target.id) {
          case "copy-pictures":
            url.searchParams.append(e.target.id, true);
            window.history.pushState({}, "", url);

            break;
          case "copy-styles":
            if (url.searchParams.has("copy-bold", true)) {
              url.searchParams.delete("copy-bold", true);
              optionBold.checked = !optionBold.checked;
              optionBold.setAttribute("disabled", "true");
            } else {
              optionBold.setAttribute("disabled", "true");
            }

            url.searchParams.append(e.target.id, true);
            window.history.pushState({}, "", url);
            break;
          default:
            url.searchParams.append(e.target.id, true);
            window.history.pushState({}, "", url);
            break;
        }
      }
    } else {
      if (url.searchParams.has(e.target.id, true)) {
        switch (e.target.id) {
          case "copy-styles":
            url.searchParams.delete(e.target.id, true);
            window.history.pushState({}, "", url);

            if (optionBold.hasAttribute("disabled")) {
              optionBold.removeAttribute("disabled");
            }
            break;
          default:
            url.searchParams.delete(e.target.id, true);
            window.history.pushState({}, "", url);
            break;
        }
      }
    }

    collapseIfCheckboxChecked(e.target);
  });
});

// collapse control
