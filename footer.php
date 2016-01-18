<footer id="footer"><a href="http://toatech.com">Chat, Oralce edition</a></footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js'></script>
<script src="http://localhost:3000/socket.io/socket.io.js"></script>
<script src="js/main.js"></script>
<script>
	$(document).ready(function () {
		$("#loginBtn").click(function () {
			$("#myModal").modal();
		});
		$("#registerBtn").click(function () {
			$("#regModal").modal();
		});
	});
</script>
</body>
</html>
