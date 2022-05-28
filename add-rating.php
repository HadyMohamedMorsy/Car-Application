<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assists/Framework/Bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" href="./assists/Framework/Fontawsome/css/all.css">
    <link rel="stylesheet" href="./assists/css/global.css">
    <link rel="stylesheet" href="./assists/css/rating.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="details">
            <img src="./assists/images/IMG-Defult-Female.jpg" alt="">
            <h1> Mohamed Ahmed </h1>
        </div>
        <form>
        <div class="form-group">
            <label for="formControlRange">Rating</label>
            <input type="number" class="form-control-range" id="formControlRange">
        </div>
            <div class="form-group">
                <label for="formControlRange">Attuide</label>
                <select class="form-control form-control-sm">
                    <option> Select His Attuide </option>
                    <option> He is Aggresive </option>
                    <option> He is good </option>
                    <option> He is shy </option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Add Rating</button>
            </div>
        </form>
    </div>
    <script src="./assists/Framework/jQuery/jquery.js"></script>
    <script src="./assists/Framework/Bootstrap/js/bootstrap.js"></script>
    <script src="./assists/Framework/Fontawsome/js/all.js"></script>
</body>
</html>