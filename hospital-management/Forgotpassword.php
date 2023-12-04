<?php
include("header.php");
?>
<br>
<br>
<br>
<br>
<br>
<section class="vh-100">
  <div class="container py-5 h-100">
    <div class="row d-flex align-items-center justify-content-center h-100">
      <div class="col-md-8 col-lg-7 col-xl-6">
       
      <h1>Recuperar contraseña</h1>
    
      <form action="recuperar.php" method="post">
          <!-- Email input -->
          <div class="form-outline mb-4">
          <label class="form-label" for="form1Example13">numero de telefono</label>
            <input type="number" min="3000000000"  max="4000000000" name="telefono" class="form-control form-control-lg" />
          </div>
      <br>
          <button type="submit" id="volver" class="btn btn-primary btn-lg btn-block">recuperar</button>
        </form>
      </div>
    </div>
  </div>
</section>
<br>
<br>
<br>
<br><br>
<?php
include("footer.php");

?>