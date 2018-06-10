const express = require('express'),
      path    = require('path'),
      app = express();

      const PORT = process.env.PORT || 5000;    
      app.engine('html', require('ejs').renderFile);
      app.set('view engine', 'ejs');
      app.use(express.static(path.join(__dirname, 'public')));

app.get('/', function (req, res) {
  res.render('index.html');
});

app.listen(3000, function () {
  console.log('Example app listening on port' + PORT);
});