// nouveau message

const ecrireMP = document.querySelector(".btnNewMsg");
const formulaireMP = document.getElementById("formulaireMP");
const envoiMP = document.getElementById("envoiMP");
const annulerMP = document.getElementById("annulerMP");

if (ecrireMP && formulaireMP) {
  ecrireMP.addEventListener("click", () => {
    ecrireMP.classList.add("dnone");
    formulaireMP.classList.remove("dnone");
    gsap.from(formulaireMP,{opacity : 0.2,  x:-350,ease: "elastic.out(3, 0.5)", duration : 1.25} )
  });
}

if (annulerMP && envoiMP) {
  annulerMP.addEventListener("click", () => {
    ecrireMP.classList.remove("dnone");
    formulaireMP.classList.add("dnone");
    formulaireMP.classList.add("formEcrase");
  });
  envoiMP.addEventListener("click", () => {
    ecrireMP.classList.remove("dnone");
    formulaireMP.classList.add("dnone");
    formulaireMP.classList.add("formEcrase");
  });
}

//Lecture d'un message

const messages = document.querySelectorAll(".listeMessagesRecus");

messages.forEach((message) => {
  const messageDe = message.querySelector(".messageDe");
  const messageRecu = message.querySelector(".messageRecu");
  const messageRecuTitle = message.querySelector(".messageRecu h4");

  messageDe.addEventListener("click", () => {
    messageDe.classList.add("dnone");
    messageRecu.classList.remove("dnone");
  });

  messageRecuTitle.addEventListener("click", () => {
    messageRecu.classList.add("dnone");
    messageDe.classList.remove("dnone");
  });
});
