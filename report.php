<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Medical Record</title>
    <meta name="viewport" content = "width = device-width, initial-scale=1">
    <link type="image" rel="icon" href="../../upload/icon.jpg">
    <link rel="stylesheet" href="../../components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../components/bootstrap/dist/css/bootstrap.min.css">
    <style>
      body {
        font-size: 14px;
        color: #1D1F21;
        font-family: Helvetica;
        background-image: url();
        background-size: cover;
        background-attachment: fixed;
        margin-top: 10px;
      }
      img {
        width: 70px;
        height: 70px;
      }
      td {
        text-align: center;
        width: 150px;
        padding: 0px;
      }
      th {
        width: 150px;
        text-align: left;
        padding: 2px;
      }
      table {
        margin-bottom: 10px;
        width: 100%
      }
      h2 {
        text-align: center;
      }
      section {
        margin: 60px 160px 0px 160px;
        background-color: rgba(255, 255, 255, 0.5);
        padding: 20px;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.5);
        background-image: url();
      }
      section strong {
        font-style: italic;
        color: green;
      }
      h2 {
        border-bottom: 1px solid #000;
        padding-bottom: 10px;
      }
      p {
        text-align: center;
      }
      h4 {
        text-align: center;
        line-height: 20px;
      }
      h3 {
        text-align: center;
        line-height: 20px;
      }
      h5 {

      }
      h2 > strong {
        font-size: 14px;
        font-weight: 400;
      }
      .total {
        text-align: right;
        line-height: 30px
      }
      .status {
        position: relative;
        float: right;
      }
      .hide {
        display: none !important;
      }
      .timeTable {
        width: 350px
      }
      @media print {
        body {
          font-size: 10px;
          background: #fff;
          color: #1D1F21;        }
      }
      @media (max-width: 768px) {
        body {
          width: 100%;
          height: 100%;
          margin: 0;
          background-image: url();
        }
        section {
          width: 800px;
          height: auto;
          float: none;
          padding: 30px;
          margin: 0;
          box-shadow: 0 0 0;
        }
        table {
          width: 100%;
        }
        .allowedUser {
          padding: 60px;
        }
      }
    </style>
  </head>
  <body>
    <section>
      <h2>
        <img src="../../upload/image/logo.png"><br>Don Ruben E. Ecleo Sr. Memorial National High School <br>
        <strong>Don Ruben, San Jose Dinagat Island</strong>
      </h2>
      <table>
        <tbody>
          <tr>
            <td></td>
            <td><b>REPORT<b></td>
            <td></td>
          </tr>
        </tbody>
      </table>
      <hr>
      <table>
        <tbody>
          <tr>
            <td>No.</td>
            <td>Borrower Name</td>
            <td>Book Name</td>
            <td>Date Borrowed</td>
            <td>Date Returned</td>
          </tr>
        </tbody>
      </table>
      <hr>
    </section>
    <script src="../../assets/js/jquery.1.11.1.js"></script>
  </body>
</html>
