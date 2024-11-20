const balance = document.querySelector("#balance");
const inc_amt = document.querySelector("#inc-amt");
const exp_amt = document.querySelector("#exp-amt");
const trans = document.querySelector("#trans");
const form = document.querySelector("#form");
const description = document.querySelector("#desc");
const amount = document.querySelector("#amount");
const downloadBtn = document.querySelector("#download-pdf"); // Add download button reference
const resetBtn = document.querySelector("#reset-btn"); // Add reset button reference

const localStorageTrans = JSON.parse(localStorage.getItem("trans"));
let transactions = localStorage.getItem("trans") !== null ? localStorageTrans : [];


function loadTransactionDetails(transaction) {
  const sign = transaction.amount < 0 ? "-" : "+";
  const item = document.createElement("li");
  item.classList.add(transaction.amount < 0 ? "exp" : "inc");
  item.innerHTML = `
    ${transaction.description}
    <span> ${sign}  ${Math.abs(transaction.amount)}</span>
    <button class="btn-del" onclick="removeTrans(${transaction.id})">x</button>
  `;
  trans.appendChild(item);
}

function removeTrans(id) {
  if (confirm("Are You Sure You Want To  Delete The Transaction?")) {
    transactions = transactions.filter((transaction) => transaction.id != id);
    config();
    updateLocalStorage();
  } else {
    return;
  }
}

function updateAmount() {
  const amounts = transactions.map((transaction) => transaction.amount);
  const total = amounts.reduce((acc, item) => (acc += item), 0).toFixed(2);
  balance.innerHTML = `₹ ${total}`;

  const income = amounts
    .filter((item) => item > 0)
    .reduce((acc, item) => (acc += item), 0)
    .toFixed(2);
  inc_amt.innerHTML = `₹ ${income}`;

  const expense = amounts
    .filter((item) => item < 0)
    .reduce((acc, item) => (acc += item), 0)
    .toFixed(2);
  exp_amt.innerHTML = `₹ ${Math.abs(expense)}`;
}

function config() {
  trans.innerHTML = "";
  transactions.forEach(loadTransactionDetails);
  updateAmount();
}

function addTransaction(e) {
  e.preventDefault();
  if (description.value.trim() === "" || amount.value.trim() === "") {
    alert("Please Enter Amount And Description");
  } else {
    const transaction = {
      id: uniqueId(),
      description: description.value,
      amount: +amount.value,
    };
    transactions.push(transaction);
    loadTransactionDetails(transaction);
    description.value = "";
    amount.value = "";
    updateAmount();
    updateLocalStorage();
  }
}

function uniqueId() {
  return Math.floor(Math.random() * 10000000);
}

form.addEventListener("submit", addTransaction);

window.addEventListener("load", function () {
  config();
});

function updateLocalStorage() {
  localStorage.setItem("trans", JSON.stringify(transactions));
}

// Function to download the transaction data as a PDF
function downloadPDF() {
  const { jsPDF } = window.jspdf;
  const doc = new jsPDF();

  // Set title for the PDF
  doc.setFontSize(18);
  doc.text("Income & Expense Transactions", 10, 10);

  // Add balance, income, and expense summary to the PDF
  doc.setFontSize(12);
  doc.text(`Balance: ${balance.innerText}`, 10, 30);
  doc.text(`Income: ${inc_amt.innerText}`, 10, 40);
  doc.text(`Expense: ${exp_amt.innerText}`, 10, 50);

  // Add transaction details to the PDF
  doc.text("Transaction Details:", 10, 70);
  let yPosition = 80; // Starting position for transaction details

  transactions.forEach((transaction, index) => {
    const sign = transaction.amount < 0 ? "-" : "+";
    doc.text(
      `${index + 1}. ${transaction.description}: ${sign} ₹${Math.abs(
        transaction.amount
      )}`,
      10,
      yPosition
    );
    yPosition += 10; // Move to next line
  });

  // Save the PDF
  doc.save("transactions.pdf");
}

// Add event listener to the download button
downloadBtn.addEventListener("click", downloadPDF);

// Add reset functionality
resetBtn.addEventListener("click", function() {
  if (confirm("Are you sure you want to reset all transactions?")) {
    transactions = []; // Clear transactions
    updateLocalStorage(); // Update local storage
    config(); // Reconfigure the display
  }
});
