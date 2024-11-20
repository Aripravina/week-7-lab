

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css" />
  <title>Income & Expense Tracker</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <form action="logout.php" method="POST" style="display: inline;">
    <button type="submit" style="background-color: #feca57; position: fixed; right: 20px; top: 20px; border-radius: 10px; padding: 10px; font-weight: 600; border: none; z-index: 1000;">Logout</button>
  </form>
  
  <div class="container">
    <div class="ledger">
      <h2>Income & Expense Tracker</h2>
      <h4>Your Balance</h4>
      <h1 id="balance">₹ 0.00</h1>

      <div class="inc-exp-container">
        <div class="inc">
          <h4>Income</h4>
          <p id="inc-amt" class="amt plus">₹ 0.00</p>
        </div>

        <div class="exp">
          <h4>Expense</h4>
          <p id="exp-amt" class="amt minus">₹ 0.00</p>
        </div>
      </div>

      <form action="#" id="form">
        <div class="form-control">
          <label for="desc">Description</label>
          <input type="text" name="desc" id="desc" placeholder="Enter Description" />
        </div>

        <div class="form-control">
          <label for="amount">Amount</label>
          <input type="number" name="amount" id="amount" placeholder="Enter Amount" />
        </div>
        <button class="btn" type="submit">Add Transaction</button>
      </form>

      <button class="btn" id="download-pdf" style="margin-top: 10px;">Download PDF</button>
    </div>

    <div class="transaction">
      <h3>Transaction Details</h3>
      <ul class="trans" id="trans">
        <li class="exp">Insurance<span>-1500</span>
          <button class="btn-del">x</button>
        </li>
        <li class="inc">Salary<span>35000</span>
          <button class="btn-del">x</button>
        </li>
        <li class="exp">Food<span>-350</span>
          <button class="btn-del">x</button>
        </li>
      </ul>

      <button class="btn-reset" id="reset-btn" style="margin-top: 10px;">Reset</button>
    </div>
  </div>

  <script src="script.js"></script>
</body>

</html>
