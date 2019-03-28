<?php
$root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Florestário</title>
  <style>
    input {
      display: block;
      margin-bottom: 5px;
    }

    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
    }

    td, th {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }

    tr:nth-child(even) {
      background-color: #dddddd;
    }

    header ul {
      padding: 0;
    }

    header li {
      display: inline-block;
    }

    header li a {
      padding: 15px;
      margin: 5px;
    }
  </style>
</head>
<body>