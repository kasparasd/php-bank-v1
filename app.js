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

const createNewAccountCloseBtn = document.querySelector(
  ".createNewAccountCloseBtn"
);
const accountCreatedAlert = document.querySelector(".accountCreatedAlert");

if (createNewAccountCloseBtn) {
  createNewAccountCloseBtn.addEventListener("click", (e) => {
    accountCreatedAlert.remove();
  });
}
