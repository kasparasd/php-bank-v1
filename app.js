const funds = document.querySelector(".funds-input");
const fundsInAccount = document.querySelector(".fundsInAccount");

if (funds) {
  funds.addEventListener("input", (e) => {
    console.log(
      "input: ",
      parseFloat(e.target.value),
      "maximum: ",
      parseFloat(fundsInAccount.innerText)
    );
    if (parseFloat(fundsInAccount.innerText) < parseFloat(e.target.value)) {
      console.log("prideti");
      document
        .querySelector(".messageAboutFunds")
        .classList.remove("hiddenMessage");
    } else {
      document
        .querySelector(".messageAboutFunds")
        .classList.add("hiddenMessage");
    }
  });
}

const closeButton = document.querySelector(".closeBtn");
const infoAlert = document.querySelector(".infoAlert");

if (closeButton) {
  closeButton.addEventListener("click", (e) => {
    infoAlert.remove();
  });
}
