<!DOCTYPE html>
<html>
<head>
	<title></title>	
  	<script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
</head>

<body>

  <form id="text">
    <input type="text" name="id" id="id">
    <input type="number" name="numb" id="numb">

    <input type="submit" name="submit" id="submit">
  </form>

</body>
</html>

<script type="text/javascript">
  
  $(document).ready(function(){

    $("#text").submit(function(e){
      // var text = document.getElementByid('id').value;
      alert('text');
      // e.preventDefault();
      return false;

    });
  });

</script>

