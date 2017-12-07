var http = require('http');
var mysql = require('mysql');
var content = '<b>Hello World</b>';
var connection = mysql.createConnection({
    host : 'localhost',
	port : 3306,
    user : 'root',
    password : '',
});
connection.connect(function(err) {
    console.log(err);
    content = '<b>Hello Mysql</b>';
});
http.createServer(function (request, response) {
	response.writeHead(200, {'Content-Type': 'text/html'});
	response.end(content);
}).listen(3000);

console.log('Server running at http://127.0.0.1:3000/');