<div class="footer">
    <div style="align-self:center; margin-right:50px">
        <div style="font-family: 'Myriad pro Semibold'; font-size:30px; margin-bottom:20px;">Still can’t find an answer?</div>
        <span style="font-family: 'Myriad pro Medium'; font-weight:100;">Send us a ticket and we will get back to you.</span>
    </div>
    <div style="align-self: center; margin-left:50px">
        <button type="button" value="Send a ticket" class="ticket_button">Submit a ticket</button>

    </div>


</div>
<button onclick="topFunction()" id="myBtn" title="Go to top"><img src="<?php echo base_url().'/';?>images/top.png" style="width:30px;height:30px"></button>

<script>
    // Get the button
    let mybutton = document.getElementById("myBtn");
    
    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function() {scrollFunction()};
    
    function scrollFunction() {
      if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
        mybutton.style.display = "block";
      } else {
        mybutton.style.display = "none";
      }
    }
    
    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
      document.body.scrollTop = 20;
      document.documentElement.scrollTop = 20;
    }
</script>
<!-- <div><img src="music.png" style="width:40px;height:40px;"></div>
     -->

</body>
</html>


