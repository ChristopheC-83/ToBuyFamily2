const formCreationListe = document.querySelector(".formCreationListe");
const annulerFormCreationListe = document.querySelector(
  ".annulerFormCreationListe"
);
const creationListe = document.querySelector(".creationListe");
const overlay2 = document.querySelector(".overlay2");

if (creationListe) {
  creationListe.addEventListener("click", () => {
    formCreationListe.classList.remove("dnone");
    overlay2.classList.remove("dnone");
  });
}

if (annulerFormCreationListe) {
  annulerFormCreationListe.addEventListener("click", () => {
    formCreationListe.classList.add("dnone");
    overlay2.classList.add("dnone");
  });
}
if (annulerFormCreationListe) {
  overlay2.addEventListener("click", () => {
    formCreationListe.classList.add("dnone");
    overlay2.classList.add("dnone");
  });
}

const formAjoutElement = document.querySelector(".formAjoutElement");
const annulerFormAjoutElement = document.querySelector(
  ".annulerFormAjoutElement"
);
const ajoutElementListe = document.querySelector(".ajoutElementListe");

if (ajoutElementListe) {
  ajoutElementListe.addEventListener("click", () => {
    formAjoutElement.classList.remove("dnone");
    overlay2.classList.remove("dnone");
  });
}

if (annulerFormAjoutElement) {
  annulerFormAjoutElement.addEventListener("click", () => {
    formAjoutElement.classList.add("dnone");
    overlay2.classList.add("dnone");
  });
}

const miniBurgers = document.querySelectorAll(".miniBurger");
let gestionElement;

miniBurgers.forEach((miniBurger) => {
  miniBurger.addEventListener("click", () => {
    const contentList = miniBurger.closest(".contentList");
    gestionElement = contentList.querySelector(".gestionElement");
    gestionElement.classList.remove("dnone");
    overlay2.classList.remove("dnone");
  });
});

const updateElements = document.querySelectorAll(".updateElement");
const modifElements = document.querySelectorAll(".modifElement");
let modifElement = "";

updateElements.forEach((updateElement, index) => {
  updateElement.addEventListener("click", () => {
    modifElement = modifElements[index];
    modifElements[index].classList.remove("dnone");
    gestionElement.classList.add("dnone");
  });
});

overlay2.addEventListener("click", () => {
  overlay2.classList.add("dnone");
  if (gestionElement) {
    gestionElement.classList.add("dnone");
  }
  if (modifElement) {
    modifElement.classList.add("dnone");
  }
  if (formAjoutElement) {
    formAjoutElement.classList.add("dnone");
  }
});

const btnAjoutElementList = document.getElementById("btnAjoutElementList");
const inputAjoutElementList = document.getElementById("inputAjoutElementList");

function verifContenuAjoutElement() {
  if (inputAjoutElementList.value.trim() === "") {
    btnAjoutElementList.classList.add("btnListDisable");
  } else {
    btnAjoutElementList.classList.remove("btnListDisable");
  }
}

const partageListes = document.querySelectorAll(".partageListe"); 
const ajouterUtilisateurListes = document.querySelectorAll(
  ".ajouterUtilisateurListe"
); 
const annulerPartageListe = document.querySelectorAll(".annulerPartageListe");
let ajouterUtilisateurListe = ""; 

partageListes.forEach((partageListe, index) => {
  partageListe.addEventListener("click", () => {
    ajouterUtilisateurListe = ajouterUtilisateurListes[index];
    ajouterUtilisateurListe.classList.remove("dnone");
    overlay2.classList.remove("dnone");
  });
});

overlay2.addEventListener("click", () => {
  overlay2.classList.add("dnone");
  if (ajouterUtilisateurListe) {
    ajouterUtilisateurListe.classList.add("dnone");
  }
});

annulerPartageListe.forEach((annulerPartage) => {
  annulerPartage.addEventListener("click", () => {
    overlay2.classList.add("dnone");
    if (ajouterUtilisateurListe) {
      ajouterUtilisateurListe.classList.add("dnone");
    }
  });
});
