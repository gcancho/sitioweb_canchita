let $elementosCanchitaTodos = document.querySelectorAll(".canchita-item");
let $elementoLima = document.querySelectorAll(".Lima");
let $elementosBreña = document.querySelectorAll(".Breña");
let $elementosSJL = document.querySelectorAll(".SJL");
let $elementosSanMiguel = document.querySelectorAll(".Miguel");
let $elementosSanBorja = document.querySelectorAll(".Borja");
let $elementosLosOlivos = document.querySelectorAll(".Olivos");

function changeFunc() {
  let $listaDistritos = document.getElementById("lista-distritos");
  var $selectedValue =
    $listaDistritos.options[$listaDistritos.selectedIndex].value;

  console.log($selectedValue);

  if ($selectedValue == "Todos") {
    for (let index of $elementosCanchitaTodos) {
      index.style.display = "flex";
    }
  }

  if ($selectedValue == "Lima") {
    for (let index of $elementosCanchitaTodos) {
      index.style.display = "none";
    }
    for (let index of $elementoLima) {
      index.style.display = "flex";
    }
  }

  if ($selectedValue == "Breña") {
    for (let index of $elementosCanchitaTodos) {
      index.style.display = "none";
    }
    for (let index of $elementosBreña) {
      index.style.display = "flex";
    }
  }

  if ($selectedValue == "SJL") {
    for (let index of $elementosCanchitaTodos) {
      index.style.display = "none";
    }
    for (let index of $elementosSJL) {
      index.style.display = "flex";
    }
  }

  if ($selectedValue == "Miguel") {
    for (let index of $elementosCanchitaTodos) {
      index.style.display = "none";
    }
    for (let index of $elementosSanMiguel) {
      index.style.display = "flex";
    }
  }

  if ($selectedValue == "Borja") {
    for (let index of $elementosCanchitaTodos) {
      index.style.display = "none";
    }
    for (let index of $elementosSanBorja) {
      index.style.display = "flex";
    }
  }
  if ($selectedValue == "Olivos") {
    for (let index of $elementosCanchitaTodos) {
      index.style.display = "none";
    }
    for (let index of $elementosLosOlivos) {
      index.style.display = "flex";
    }
  }
}
