<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Borrow Book System</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="container">
    <header>
      <h1>To Do List App</h1>
    </header>

    <section class="book-form">
      <h2>Borrow a Book</h2>
      <form action="#">
        <div class="form-group">
          <label for="book-title">Book Title:</label>
          <input type="text" id="book-title" placeholder="Enter book title" required>
        </div>
        <div class="form-group">
          <label for="author">Author:</label>
          <input type="text" id="author" placeholder="Enter author's name" required>
        </div>
        <div class="form-group">
          <label for="borrower-name">Your Name:</label>
          <input type="text" id="borrower-name" placeholder="Enter your name" required>
        </div>
        <div class="form-group">
          <label for="borrow-date">Borrow Date:</label>
          <input type="date" id="borrow-date" required>
        </div>
        <button type="submit" class="btn">Borrow Book</button>
      </form>
    </section>

    <section class="borrowed-books">
      <h2>Borrowed Books</h2>
      <table>
        <thead>
          <tr>
            <th>Book Title</th>
            <th>Author</th>
            <th>Borrower's Name</th>
            <th>Borrow Date</th>
          </tr>
        </thead>
        <tbody>
          <!-- Borrowed books will be listed here -->
        </tbody>
      </table>
    </section>
  </div>
</body>
</html>
<style>
    /* Reset some basic styles */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: Arial, sans-serif;
  background-color: #f4f4f4;
  color: #333;
  line-height: 1.6;
}

.container {
  width: 80%;
  max-width: 1200px;
  margin: 20px auto;
  background-color: white;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

header h1 {
  text-align: center;
  font-size: 2.5rem;
  color: #333;
  margin-bottom: 20px;
}

h2 {
  font-size: 1.8rem;
  margin-bottom: 15px;
  color: #555;
}

.book-form, .borrowed-books {
  margin-bottom: 30px;
}

.form-group {
  margin-bottom: 15px;
}

label {
  display: block;
  font-size: 1rem;
  margin-bottom: 5px;
}

input[type="text"], input[type="date"] {
  width: 100%;
  padding: 10px;
  font-size: 1rem;
  border: 1px solid #ccc;
  border-radius: 5px;
}

input[type="text"]:focus, input[type="date"]:focus {
  outline: none;
  border-color: #007BFF;
}

button.btn {
  width: 100%;
  padding: 12px;
  background-color: #007BFF;
  color: white;
  font-size: 1.2rem;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

button.btn:hover {
  background-color: #0056b3;
}

/* Table Styling */
table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 15px;
}

th, td {
  padding: 12px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

th {
  background-color: #007BFF;
  color: white;
}

tbody tr:hover {
  background-color: #f9f9f9;
}

tbody tr:nth-child(even) {
  background-color: #f9f9f9;
}

</style>